<?php

namespace Tests\Feature;

use App\Models\Domisili;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Barryvdh\DomPDF\Facade\Pdf;
use Mockery;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DashboardDomTest extends TestCase
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
       $userDomisili = Domisili::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);
       $otherDomisili = Domisili::factory()->create([
           'user_id' => $this->inspekturUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get('/dashboard/domisili')
            ->assertStatus(200)
            ->assertSee($userDomisili->noSurat)
            ->assertDontSee($otherDomisili->noSurat);
   }

   /** @test */
   public function index_method_for_inspektur_shows_all_records()
   {
       $domisilis = Domisili::factory()->count(5)->create([
           'user_id' => $this->inspekturUser->id
       ]);

       $this->actingAs($this->inspekturUser)
            ->get('/dashboard/domisili')
            ->assertStatus(200)
            ->assertViewHas('domisilis', function ($viewDomisilis) use ($domisilis) {
                return $viewDomisilis->count() === 5;
            });
   }

   /** @test */
   public function create_method_returns_create_view()
   {
       $this->actingAs($this->pegawaiUser)
            ->get('/dashboard/domisili/create')
            ->assertStatus(200)
            ->assertViewIs('dashboard.domisilis.create')
            ->assertViewHas('title', 'Domisili');
   }

   /** @test */
   public function store_method_creates_new_domisili_record()
   {
       $domisiliData = [
           'kodeSurat' => '123',
           'noSurat' => '456',
           'nama' => 'John Doe',
           'nik' => '1234567890',
           'tempatTglLahir' => 'Test Place',
           'pekerjaan' => 'Test Job',
           'alamat' => 'Test Address',
           'keterangan' => 'Test Keterangan',
           'tglSurat' => now()->format('Y-m-d'),
           'ttd' => 'Test TTD',
           'namaTtd' => 'Test Nama TTD',
       ];

       $this->actingAs($this->pegawaiUser)
            ->post('/dashboard/domisili', $domisiliData)
            ->assertRedirect('/dashboard/domisili')
            ->assertSessionHas('success', 'Surat berhasil ditambahkan!');

       $this->assertDatabaseHas('domisilis', [
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
            ->post('/dashboard/domisili', $invalidData)
            ->assertSessionHasErrors([
                'kodeSurat', 
                'noSurat', 
                'nama', 
                'nik', 
                'tempatTglLahir', 
                'pekerjaan', 
                'alamat', 
                'keterangan', 
                'tglSurat', 
                'ttd', 
                'namaTtd'
            ]);
   }

   /** @test */
   public function show_method_returns_domisili_details()
   {
       $domisili = Domisili::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/domisili/{$domisili->noSurat}")
            ->assertStatus(200)
            ->assertViewIs('dashboard.domisilis.show')
            ->assertViewHas('domisili', $domisili);
   }

   /** @test */
   public function pegawai_cannot_access_others_domisili_record()
   {
       $otherUserDomisili = Domisili::factory()->create([
           'user_id' => $this->inspekturUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/domisili/{$otherUserDomisili->noSurat}")
            ->assertForbidden();
   }

   /** @test */
   public function edit_method_returns_edit_view()
   {
       $domisili = Domisili::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/domisili/{$domisili->noSurat}/edit")
            ->assertStatus(200)
            ->assertViewIs('dashboard.domisilis.edit')
            ->assertViewHas('domisili', $domisili);
   }

   /** @test */
   public function update_method_modifies_domisili_record()
   {
       $domisili = Domisili::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $updatedData = [
           'kodeSurat' => '789',
           'noSurat' => $domisili->noSurat,
           'nama' => 'Updated Name',
           'nik' => '0987654321',
           'tempatTglLahir' => 'Updated Place',
           'pekerjaan' => 'Updated Job',
           'alamat' => 'Updated Address',
           'keterangan' => 'Updated Keterangan',
           'tglSurat' => now()->format('Y-m-d'),
           'ttd' => 'Updated TTD',
           'namaTtd' => 'Updated Nama TTD',
       ];

       $this->actingAs($this->pegawaiUser)
            ->put("/dashboard/domisili/{$domisili->noSurat}", $updatedData)
            ->assertRedirect('/dashboard/domisili')
            ->assertSessionHas('success', 'Surat berhasil di edit!');

       $this->assertDatabaseHas('domisilis', [
           'id' => $domisili->id,
           'nama' => 'Updated Name'
       ]);
   }

   /** @test */
   public function destroy_method_deletes_domisili_record()
   {
       $domisili = Domisili::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->delete("/dashboard/domisili/{$domisili->noSurat}")
            ->assertRedirect('/dashboard/domisili')
            ->assertSessionHas('success', 'Surat berhasil dihapus!');

       $this->assertDatabaseMissing('domisilis', ['id' => $domisili->id]);
   }

   /** @test */
   public function cetak_method_generates_pdf()
   {
       PDF::shouldReceive('loadView')
           ->once()
           ->with('dashboard.domisilis.cetak', \Mockery::any())
           ->andReturnSelf();

       PDF::shouldReceive('setPaper')
           ->once()
           ->with('a4', 'portrait')
           ->andReturnSelf();

       PDF::shouldReceive('stream')
           ->once()
           ->andReturn(response('PDF Content'));

       $domisili = Domisili::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/domisili/{$domisili->noSurat}/cetak")
            ->assertSuccessful();
   }

/** @test */
// public function unique_no_surat_validation()
// {
//     $existingNoSurat = '642';

//     Domisili::factory()->create([
//         'noSurat' => $existingNoSurat,
//         'user_id' => $this->pegawaiUser->id
//     ]);

//     $domisiliData = [
//         'kodeSurat' => '123',
//         'noSurat' => $existingNoSurat,
//         'nama' => 'John Doe',
//         'nik' => '1234567890',
//         'tempatTglLahir' => 'Test Place',
//         'pekerjaan' => 'Test Job',
//         'alamat' => 'Test Address',
//         'keterangan' => 'Test Keterangan',
//         'tglSurat' => now()->format('Y-m-d'),
//         'ttd' => 'Test TTD',
//         'namaTtd' => 'Test Nama TTD',
//     ];

//     $this->withoutExceptionHandling();

//     try {
//         $response = $this->actingAs($this->pegawaiUser)
//             ->post('/dashboard/domisili', $domisiliData);

//         $response->assertSessionHasErrors(['noSurat']);
//     } catch (\Illuminate\Validation\ValidationException $e) {
//         $this->assertArrayHasKey('noSurat', $e->errors());
//     }
// }
}