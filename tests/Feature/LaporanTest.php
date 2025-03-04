<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Pastikan role dibuat
        Role::create(['name' => 'Inspektur', 'guard_name' => 'web']);
        Role::create(['name' => 'Ketua Tim', 'guard_name' => 'web']);
        Role::create(['name' => 'Pegawai', 'guard_name' => 'web']);
    }

    // inspektur
    /** @test */
    public function inspektur_can_view_all_laporan()
    {
        $inspektur = User::factory()->create();
        $inspektur->assignRole('Inspektur');
        
        // buat laporan dari berbagai user
        $laporans = Laporan::factory()->count(5)->create();

        $response = $this->actingAs($inspektur)
            ->get('/dashboard/laporan');

        $response->assertStatus(200);
        $response->assertViewHas('laporans');

        $viewData = $response->original->getData();
        $this->assertEquals(5, $viewData['totalLaporan']);
    }

    /** @test */
    public function inspektur_can_create_laporan_with_complete_data()
    {
        $inspektur = User::factory()->create(['role' => 'Inspektur']);
        
        $laporanData = [
            'kodeLaporan' => '12345',
            'nomor_lhp' => '67890',
            'judul' => 'Laporan Pemeriksaan Lengkap',
            'tgl_pemeriksaan' => now()->format('Y-m-d'),
            'ringkasan_hasil' => 'Ringkasan hasil pemeriksaan yang komprehensif',
            'uraian_hasil' => 'Uraian detail hasil pemeriksaan dengan analisis mendalam',
            'kesimpulan' => 'Kesimpulan pemeriksaan yang akurat',
            'saran' => 'Saran perbaikan yang konstruktif',
            'ttd' => 'Inspektur Senior',
            'namaTtd' => 'Dr. Nama Inspektur'
        ];

        $response = $this->actingAs($inspektur)
            ->post('/dashboard/laporan', $laporanData);

        $response->assertRedirect('/dashboard/laporan')
            ->assertSessionHas('success', 'Laporan berhasil ditambahkan!');
        
        $this->assertDatabaseHas('laporans', $laporanData);
    }

    /** @test */
    public function inspektur_can_edit_any_laporan()
    {
        $inspektur = User::factory()->create(['role' => 'Inspektur']);
        $laporan = Laporan::factory()->create();

        $updatedData = [
            'kodeLaporan' => $laporan->kodeLaporan,
            'nomor_lhp' => $laporan->nomor_lhp,
            'judul' => 'Laporan yang Diperbarui',
            'tgl_pemeriksaan' => now()->format('Y-m-d'),
            'ringkasan_hasil' => 'Ringkasan hasil pemeriksaan yang diperbarui',
            'uraian_hasil' => 'Uraian detail hasil pemeriksaan yang diperbarui',
            'kesimpulan' => 'Kesimpulan pemeriksaan yang diperbarui',
            'saran' => 'Saran perbaikan yang diperbarui',
            'ttd' => 'Inspektur Pengkaji',
            'namaTtd' => 'Dr. Nama Baru'
        ];

        $response = $this->actingAs($inspektur)
            ->put("/dashboard/laporan/{$laporan->nomor_lhp}", $updatedData);

        $response->assertRedirect('/dashboard/laporan')
            ->assertSessionHas('success', 'Laporan berhasil diperbarui!');

        $this->assertDatabaseHas('laporans', $updatedData);
    }

    /** @test */
    public function inspektur_can_cetak_any_laporan()
    {
        $inspektur = User::factory()->create(['role' => 'Inspektur']);
        $laporan = Laporan::factory()->create();

        $response = $this->actingAs($inspektur)
            ->get("/dashboard/laporan/{$laporan->nomor_lhp}/cetak");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // ketua tim
    /** @test */
    public function ketua_tim_can_view_all_laporan()
    {
        $ketuaTim = User::factory()->create();
        $ketuaTim->assignRole('Ketua Tim');
        
        $laporans = Laporan::factory()->count(3)->create();

        $response = $this->actingAs($ketuaTim)
            ->get('/dashboard/laporan');

        $response->assertStatus(200);
        $response->assertViewHas('laporans');
        
        $viewData = $response->original->getData();
        $this->assertEquals(3, $viewData['totalLaporan']);
    }

    // pegawai
    /** @test */
    public function pegawai_can_only_view_own_laporan()
    {
        $pegawai = User::factory()->create(['role' => 'Pegawai']);
        
        // buat laporan milik pegawai
        $ownLaporan = Laporan::factory()->create(['user_id' => $pegawai->id]);
        
        // buat laporan milik pegawai lain
        Laporan::factory()->create();

        $response = $this->actingAs($pegawai)
            ->get('/dashboard/laporan');

        $response->assertStatus(200);
        $response->assertViewHas('totalLaporan', 1);
    }

    /** @test */
    public function pegawai_cannot_edit_other_laporan()
    {
        $pegawai = User::factory()->create(['role' => 'Pegawai']);
        $otherLaporan = Laporan::factory()->create();

        $updatedData = [
            'judul' => 'Laporan yang Diperbarui',
        ];

        $response = $this->actingAs($pegawai)
            ->put("/dashboard/laporan/{$otherLaporan->nomor_lhp}", $updatedData);

        $response->assertStatus(403);
    }

    /** @test */
    public function pegawai_cannot_cetak_other_laporan()
    {
        $pegawai = User::factory()->create(['role' => 'Pegawai']);
        $otherLaporan = Laporan::factory()->create();

        $response = $this->actingAs($pegawai)
            ->get("/dashboard/laporan/{$otherLaporan->nomor_lhp}/cetak");

        $response->assertStatus(403);
    }

    // negative testing
    /** @test */
    public function cannot_create_laporan_with_invalid_data()
    {
        $inspektur = User::factory()->create(['role' => 'Inspektur']);
        
        $invalidData = [
            'kodeLaporan' => 'not a number',
            'nomor_lhp' => 'invalid',
            // data yang kurang
        ];

        $response = $this->actingAs($inspektur)
            ->post('/dashboard/laporan', $invalidData);

        $response->assertSessionHasErrors([
            'kodeLaporan', 
            'nomor_lhp', 
            'judul', 
            'tgl_pemeriksaan',
            'ringkasan_hasil',
            'uraian_hasil',
            'kesimpulan',
            'saran',
            'ttd',
            'namaTtd'
        ]);
    }
}