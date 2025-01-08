<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat Roles jika belum ada
        $roles = ['Inspektur', 'Pegawai', 'Ketua Tim'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Buat pengguna untuk setiap role
        $users = [
            [
                'name' => 'Inspektur User',
                'username' => 'inspektur',
                'email' => 'inspektur@example.com',
                'password' => bcrypt('password'),
                'role' => 'Inspektur',
            ],
            [
                'name' => 'Pegawai User',
                'username' => 'pegawai',
                'email' => 'pegawai@example.com',
                'password' => bcrypt('password'),
                'role' => 'Pegawai',
            ],
            [
                'name' => 'Ketua Tim User',
                'username' => 'ketua_tim',
                'email' => 'ketua_tim@example.com',
                'password' => bcrypt('password'),
                'role' => 'Ketua Tim',
            ],
        ];

        foreach ($users as $userData) {
            // Buat pengguna jika belum ada berdasarkan email
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'username' => $userData['username'],
                    'password' => $userData['password'],
                ]
            );

            // Assign role ke pengguna
            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($userData['role']);
            }
        }

        // Informasi seeder berhasil dijalankan
        $this->command->info('Roles dan pengguna berhasil dibuat!');
    }
}
