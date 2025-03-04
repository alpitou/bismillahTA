<?php

namespace Tests\Feature;

use App\Models\Sakit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Mockery;

class SakitTest extends TestCase
{
    use RefreshDatabase;

    protected $pegawaiUser;
    protected $inspekturUser;
    protected $ketuaTimUser;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'Pegawai', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Inspektur', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Ketua Tim', 'guard_name' => 'web']);

        $this->pegawaiUser = User::factory()->create()->assignRole('Pegawai');
        $this->inspekturUser = User::factory()->create()->assignRole('Inspektur');
        $this->ketuaTimUser = User::factory()->create()->assignRole('Ketua Tim');
    }

    /** @test */
    public function index_method_for_pegawai_shows_only_own_records()
    {
        $userSakit = Sakit::factory()->create(['user_id' => $this->pegawaiUser->id]);
        $otherSakit = Sakit::factory()->create();

        $this->actingAs($this->pegawaiUser)
             ->get('/dashboard/sakit')
             ->assertStatus(200)
             ->assertSee($userSakit->noSurat)
             ->assertDontSee($otherSakit->noSurat);
    }

    /** @test */
    public function index_method_for_inspektur_shows_all_records()
    {
        $sakits = Sakit::factory()->count(5)->create();

        $this->actingAs($this->inspekturUser)
             ->get('/dashboard/sakit')
             ->assertStatus(200)
             ->assertViewHas('sakits', function ($viewSakits) use ($sakits) {
                 return $viewSakits->count() === 5;
             });
    }

    /** @test */
    public function create_method_returns_create_view()
    {
        $this->actingAs($this->pegawaiUser)
             ->get('/dashboard/sakit/create')
             ->assertStatus(200)
             ->assertViewIs('dashboard.sakits.create')
             ->assertViewHas('title', 'Tambah Surat Sakit');
    }

    /** @test */
    public function store_method_creates_new_sakit_record()
    {
        $sakitData = [
            'kodeSurat' => '123',
            'noSurat' => '456',
            'nama' => 'John Doe',
            'nik' => '1234567890',
            'tempatTglLahir' => 'Test Place',
            'pekerjaan' => 'Test Job',
            'tglSurat' => now()->format('Y-m-d'),
            'alamat' => 'Test Address',
            'keterangan' => 'test',
            'ttd' => 'test',
            'namaTtd' => 'test'
        ];

        $this->actingAs($this->pegawaiUser)
             ->post('/dashboard/sakit', $sakitData)
             ->assertRedirect('/dashboard/sakit')
             ->assertSessionHas('success', 'Surat sakit berhasil ditambahkan!');

        $this->assertDatabaseHas('sakits', [
            'noSurat' => '456',
            'user_id' => $this->pegawaiUser->id
        ]);
    }

    /** @test */
    public function store_method_validates_input()
    {
        $invalidData = [
            'kodeSurat' => 'not a number',
            'noSurat' => 'not a number'
        ];

        $this->actingAs($this->pegawaiUser)
             ->post('/dashboard/sakit', $invalidData)
             ->assertSessionHasErrors(['kodeSurat', 'noSurat']);
    }

    /** @test */
    public function show_method_returns_sakit_details()
    {
        $sakit = Sakit::factory()->create(['user_id' => $this->pegawaiUser->id]);

        $this->actingAs($this->pegawaiUser)
             ->get("/dashboard/sakit/{$sakit->noSurat}")
             ->assertStatus(200)
             ->assertViewIs('dashboard.sakits.show')
             ->assertViewHas('sakit', $sakit);
    }

    /** @test */
    public function pegawai_cannot_access_others_sakit_record()
    {
        $otherUserSakit = Sakit::factory()->create();

        $this->actingAs($this->pegawaiUser)
             ->get("/dashboard/sakit/{$otherUserSakit->noSurat}")
             ->assertForbidden();
    }

    /** @test */
    public function edit_method_returns_edit_view()
    {
        $sakit = Sakit::factory()->create(['user_id' => $this->pegawaiUser->id]);

        $this->actingAs($this->pegawaiUser)
             ->get("/dashboard/sakit/{$sakit->noSurat}/edit")
             ->assertStatus(200)
             ->assertViewIs('dashboard.sakits.edit')
             ->assertViewHas('sakit', $sakit);
    }

    /** @test */
    public function update_method_modifies_sakit_record()
    {
        $sakit = Sakit::factory()->create(['user_id' => $this->pegawaiUser->id]);

        $updatedData = [
            'kodeSurat' => '789',
            'noSurat' => $sakit->noSurat,
            'nama' => 'Updated Name',
            'tglSurat' => now()->format('Y-m-d')
        ];

        $this->actingAs($this->pegawaiUser)
             ->put("/dashboard/sakit/{$sakit->noSurat}", $updatedData)
             ->assertRedirect('/dashboard/sakit')
             ->assertSessionHas('success', 'Surat sakit berhasil diperbarui!');

        $this->assertDatabaseHas('sakits', [
            'id' => $sakit->id,
            'nama' => 'Updated Name'
        ]);
    }

    /** @test */
    public function destroy_method_deletes_sakit_record()
    {
        $sakit = Sakit::factory()->create(['user_id' => $this->pegawaiUser->id]);

        $this->actingAs($this->pegawaiUser)
             ->delete("/dashboard/sakit/{$sakit->noSurat}")
             ->assertRedirect('/dashboard/sakit')
             ->assertSessionHas('success', 'Surat sakit berhasil dihapus!');

        $this->assertDatabaseMissing('sakits', ['id' => $sakit->id]);
    }

    /** @test */
public function cetak_method_generates_pdf()
{

    $sakit = Sakit::factory()->create(['user_id' => $this->pegawaiUser->id]);

    $mockPdf = Mockery::mock('alias:' . Pdf::class);
    $mockPdf->shouldReceive('loadView')
        ->once()
        ->with('dashboard.sakits.cetak', \Mockery::any())
        ->andReturnSelf();

    $mockPdf->shouldReceive('setPaper')
        ->once()
        ->with('a4', 'portrait')
        ->andReturnSelf();

    $mockPdf->shouldReceive('stream')
        ->once()
        ->andReturn(response('PDF Content'));

    $this->actingAs($this->pegawaiUser)
         ->get("/dashboard/sakit/{$sakit->noSurat}/cetak")
         ->assertSuccessful();
}

    /** @test */
    public function unique_no_surat_validation()
    {
        $existingSakit = Sakit::factory()->create();

        $sakitData = [
            'kodeSurat' => '123',
            'noSurat' => $existingSakit->noSurat,
            'nama' => 'John Doe',
            'nik' => '1234567890',
            'tempatTglLahir' => 'Test Place',
            'pekerjaan' => 'Test Job',
            'tglSurat' => now()->format('Y-m-d'),
        ];

        $this->actingAs($this->pegawaiUser)
             ->post('/dashboard/sakit', $sakitData)
             ->assertSessionHasErrors(['noSurat']);
    }
}