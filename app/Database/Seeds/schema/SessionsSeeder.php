<?php

namespace App\Database\Seeds\schema;

use CodeIgniter\Database\Seeder;
// use CodeIgniter\Database\RawSql;
use \App\Models\SessionsModel;

class SessionsSeeder extends Seeder {
    /**
     * This seeder will create the requisite tables for the app to function properly
     */
    public function run() {
        $forge = \Config\Database::forge();
        $sessModel = model(SessionsModel::class);

        log_message('info', "(SessionsSeeder) Sessions table: {$sessModel->table}");
        $sess_pkey     = ['id'];
        $sess_ukey     = ['token'];
        $sess_fields   = [
            'id'                => [
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => true,
                'auto_increment'=> true
            ],
            'userid'        => [
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => true,
            ],
            'token'         => [
                'type'      => 'TEXT',
            ],
            'ip'            => [
                'type'      => 'TINYTEXT',
            ],
            'created_at'    => [
                'type'      => 'INT',
                'constraint'=> 10,
                'unsigned'  => true,
                'null'      => true,
            ],
            'updated_at'    => [
                'type'      => 'INT',
                'constraint'=> 10,
                'unsigned'  => true,
                'null'      => true,
            ],
            'deleted_at'    => [
                'type'      => 'INT',
                'constraint'=> 10,
                'unsigned'  => true,
                'null'      => true,
            ],
        ];
        $sess_attr     = [
            'ENGINE'        => 'InnoDB',
            'CHARACTER SET' => 'utf8mb4',
            'COLLATE'       => 'utf8mb4_general_ci',
        ];
        log_message('info', "(SessionsSeeder)    Setting up primary key...");
        $forge->addPrimaryKey($sess_pkey);
        log_message('info', "(SessionsSeeder)    Setting up unique key...");
        $forge->addUniqueKey($sess_ukey);
        log_message('info', "(SessionsSeeder)    Setting up fields...");
        $forge->addField($sess_fields);
        log_message('info', "(SessionsSeeder)    Creating table (if needed)...");
        $forge->createTable($sessModel->table, true, $sess_attr);

        log_message('notice', "(SessionsSeeder) All done!");
    }
}