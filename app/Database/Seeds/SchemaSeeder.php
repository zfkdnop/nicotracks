<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SchemaSeeder extends Seeder {
    /**
     * This seeder will create the requisite tables for the app to function properly
     */
    public function run() {
        $seeder = \Config\Database::seeder();
        $forge = \Config\Database::forge();

        log_message('info', 'Creating database (if needed) as defined in .env: '.env('database.default.database'));
        $forge->createDatabase(env('database.default.database'), true);

        $seeder->call('App\Database\Seeds\schema\UsersSeeder');
        $seeder->call('App\Database\Seeds\schema\SessionsSeeder');
        $seeder->call('App\Database\Seeds\schema\NicSeeder');
    }
}