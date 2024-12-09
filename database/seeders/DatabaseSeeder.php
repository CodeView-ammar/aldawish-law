<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Tasawk\Models\Content\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            PageSeeder::class,
            CasePartySeeder::class,
            NationalitySeeder::class,
            CasesType::class,
            // ContactSeeder::class,
            // UserSeeder::class,
            // RoleSeeder::class,
            // PermissionSeeder::class,
            // RolePermissionSeeder::class,
            // UserRole
        ]);
    }
}
