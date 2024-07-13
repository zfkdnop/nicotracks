<?php

namespace App\Database\Seeds\schema;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Database\RawSql;
use \App\Models\DataPointModel;

class NicSeeder extends Seeder {
    /**
     * This seeder will create the requisite tables for the app to function properly
     */
    public function run() {
        $forge = \Config\Database::forge();
        $nicModel = model(DataPointModel::class);

        log_message('info', "(NicSeeder) Nicotine datapoints table: {$nicModel->table}");
        $nic_pkey     = ['id'];
        $nic_ukey     = ['instance'];
        $nic_fields   = [
            'id'                => [
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => true,
                'auto_increment'=> true
            ],
            'ts'            => [
                'type'      => 'TIMESTAMP',
                'default'   => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'mg'            => [
                'type'      => 'TINYINT',
                'constraint'=> 3,
                'unsigned'  => true,
            ],
            'brand'         => [
                'type'      => 'TINYTEXT',
            ],
            'ct'            => [
                'type'      => 'INT',
                'constraint'=> 10,
                'unsigned'  => true,
            ],
            'instance'      => [
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
        $nic_attr     = [
            'ENGINE'        => 'InnoDB',
            'CHARACTER SET' => 'utf8mb4',
            'COLLATE'       => 'utf8mb4_general_ci',
        ];
        log_message('info', "(NicSeeder)    Setting up primary key...");
        $forge->addPrimaryKey($nic_pkey);
        log_message('info', "(NicSeeder)    Setting up unique key...");
        $forge->addUniqueKey($nic_ukey);
        log_message('info', "(NicSeeder)    Setting up fields...");
        $forge->addField($nic_fields);
        log_message('info', "(NicSeeder)    Creating table (if needed)...");
        $forge->createTable($nicModel->table, true, $nic_attr);

        log_message('notice', "(NicSeeder) All done!");
    }
}