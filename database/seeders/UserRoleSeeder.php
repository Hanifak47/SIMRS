<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // Definisikan daftar peran (roles) dan izin (permissions)
        $roles = ['manager', 'customer', 'doctor', 'patient', 'insurance'];
        $permissions = ['create role', 'edit role', 'delete role', 'view role'];

        // 1. Membuat Role (Peran) role ini bawaan spatie
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // 2. Membuat Permission (Izin) permission ini bawaan spatie
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // 3. Memberikan semua Permission kepada Role 'manager'
        $managerRole = Role::where('name', 'manager')->first();
        $managerRole->givePermissionTo($permissions);

        // 4. Membuat User (Pengguna) dummy untuk setiap Role
        foreach ($roles as $roleName) {
            $user = User::factory()->create([
                'name' => ucfirst($roleName) . ' User',
                'gender' => fake()->randomElement(['Male', 'Female']),
                'email' => $roleName . '@bwa.com',
                'phone' => fake()->phoneNumber(),
                'photo' => fake()->imageUrl(200, 200, 'people', true, 'profile'),
                'password' => Hash::make('rahasiabro'), // Default password
            ]); // phpcs:ignore PEAR.Functions.FunctionCallSignature.CloseBracketLine

            $user->assignRole($roleName);
        }

    }
}
