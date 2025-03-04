<?php

namespace Tests\Feature;

use App\Models\Usaha;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Barryvdh\DomPDF\Facade\Pdf;
use Mockery;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DashboardUsaTest extends TestCase
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
       $userUsaha = Usaha::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);
       $otherUsaha = Usaha::factory()->create([
           'user_id' => $this->inspekturUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get('/dashboard/usaha')
            ->assertStatus(200)
            ->assertSee($userUsaha->noSurat)
            ->assertDontSee($otherUsaha->noSurat);
   }

   /** @test */
   public function index_method_for_inspektur_shows_all_records()
   {
       $usahas = Usaha::factory()->count(5)->create([
           'user_id' => $this->inspekturUser->id
       ]);

       $this->actingAs($this->inspekturUser)
            ->get('/dashboard/usaha')
            ->assertStatus(200)
            ->assertViewHas('usahas', function ($viewUsahas) use ($usahas) {
                return $viewUsahas->count() === 5;
            });
   }

   /** @test */
   public function create_method_returns_create_view()
   {
       $this->actingAs($this->pegawaiUser)
            ->get('/dashboard/usaha/create')
            ->assertStatus(200)
            ->assertViewIs('dashboard.usahas.create')
            ->assertViewHas('title', 'Usaha');
   }

   /** @test */
   public function store_method_creates_new_usaha_record()
   {
       $usahaData = [
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
            ->post('/dashboard/usaha', $usahaData)
            ->assertRedirect('/dashboard/usaha')
            ->assertSessionHas('success', 'Surat berhasil ditambahkan!');

       $this->assertDatabaseHas('usahas', [
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
            ->post('/dashboard/usaha', $invalidData)
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
   public function show_method_returns_usaha_details()
   {
       $usaha = Usaha::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/usaha/{$usaha->noSurat}")
            ->assertStatus(200)
            ->assertViewIs('dashboard.usahas.show')
            ->assertViewHas('usaha', $usaha);
   }

   /** @test */
   public function pegawai_cannot_access_others_usaha_record()
   {
       $otherUserUsaha = Usaha::factory()->create([
           'user_id' => $this->inspekturUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/usaha/{$otherUserUsaha->noSurat}")
            ->assertForbidden();
   }

   /** @test */
   public function edit_method_returns_edit_view()
   {
       $usaha = Usaha::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/usaha/{$usaha->noSurat}/edit")
            ->assertStatus(200)
            ->assertViewIs('dashboard.usahas.edit')
            ->assertViewHas('usaha', $usaha);
   }

   /** @test */
   public function update_method_modifies_usaha_record()
   {
       $usaha = Usaha::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $updatedData = [
           'kodeSurat' => '789',
           'noSurat' => $usaha->noSurat,
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
            ->put("/dashboard/usaha/{$usaha->noSurat}", $updatedData)
            ->assertRedirect('/dashboard/usaha')
            ->assertSessionHas('success', 'Surat berhasil di edit!');

       $this->assertDatabaseHas('usahas', [
           'id' => $usaha->id,
           'nama' => 'Updated Name'
       ]);
   }

   /** @test */
   public function destroy_method_deletes_usaha_record()
   {
       $usaha = Usaha::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->delete("/dashboard/usaha/{$usaha->noSurat}")
            ->assertRedirect('/dashboard/usaha')
            ->assertSessionHas('success', 'Surat berhasil dihapus!');

       $this->assertDatabaseMissing('usahas', ['id' => $usaha->id]);
   }

   /** @test */
   public function cetak_method_generates_pdf()
   {
       PDF::shouldReceive('loadView')
           ->once()
           ->with('dashboard.usahas.cetak', \Mockery::any())
           ->andReturnSelf();

       PDF::shouldReceive('setPaper')
           ->once()
           ->with('a4', 'portrait')
           ->andReturnSelf();

       PDF::shouldReceive('stream')
           ->once()
           ->andReturn(response('PDF Content'));

       $usaha = Usaha::factory()->create([
           'user_id' => $this->pegawaiUser->id
       ]);

       $this->actingAs($this->pegawaiUser)
            ->get("/dashboard/usaha/{$usaha->noSurat}/cetak")
            ->assertSuccessful();
   }

   /** @test */
  //  public function unique_no_surat_validation()
  //  {
  //      $existingUsaha = Usaha::factory()->create([
  //          'user_id' => $this->pegawaiUser->id
  //      ]);

  //      $usahaData = [
  //          'kodeSurat' => '123',
  //          'noSurat' => $existingUsaha->noSurat,
  //          'nama' => 'John Doe',
  //          'nik' => '1234567890',
  //          'tempatTglLahir' => 'Test Place',
  //          'pekerjaan' => 'Test Job',
  //          'alamat' => 'Test Address',
  //          'keterangan' => 'Test Keterangan',
  //          'tglSurat' => now()->format('Y-m-d'),
  //          'ttd' => 'Test TTD',
  //          'namaTtd' => 'Test Nama TTD',
  //      ];

  //      $this->actingAs($this->pegawaiUser)
  //           ->post('/dashboard/usaha', $usahaData)
  //           ->assertSessionHasErrors(['noSurat']);
  //  }
}