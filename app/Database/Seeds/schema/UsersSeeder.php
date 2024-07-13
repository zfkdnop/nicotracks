<?php

namespace App\Database\Seeds\schema;

use CodeIgniter\Database\Seeder;
// use CodeIgniter\Database\RawSql;
use \App\Models\UsersModel;

class UsersSeeder extends Seeder {
    /**
     * This seeder will create the requisite tables for the app to function properly
     */
    public function run() {
        $forge = \Config\Database::forge();
        $usersModel = model(UsersModel::class);

        log_message('info', "(UsersSeeder) Users table: {$usersModel->table}");
        $users_pkey     = ['id'];
        $users_ukey     = ['username'];
        $users_fields   = [
            'id'                => [
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => true,
                'auto_increment'=> true
            ],
            'username'      => [
                'type'      => 'TINYTEXT',
            ],
            'displayname'   => [
                'type'      => 'TINYTEXT',
            ],
            'passwd'        => [
                'type'      => 'TEXT',
            ],
            'salt'          => [
                'type'      => 'TEXT',
            ],
            'usergroup'     => [
                'type'      => 'SET',
                'constraint'=> ['users', 'admins'],
                'default'   => 'users',
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
        $users_attr     = [
            'ENGINE'        => 'InnoDB',
            'CHARACTER SET' => 'utf8mb4',
            'COLLATE'       => 'utf8mb4_general_ci',
        ];
        log_message('info', "(UsersSeeder)    Setting up primary key...");
        $forge->addPrimaryKey($users_pkey);
        log_message('info', "(UsersSeeder)    Setting up unique key...");
        $forge->addUniqueKey($users_ukey);
        log_message('info', "(UsersSeeder)    Setting up fields...");
        $forge->addField($users_fields);
        log_message('info', "(UsersSeeder)    Creating table (if needed)...");
        $forge->createTable($usersModel->table, true, $users_attr);

        log_message('info', "(UsersSeeder) Generating default admin password");
        $algo       = $usersModel->hashAlgo;
        $cost       = $usersModel->cryptCost;
        $defaultUN  = 'admin';
        $defaultPW  = 'default123';
        $salt       = bin2hex(random_bytes(strlen(hash_hmac($algo, 'fakepw', 'fakesalt')))); // generate a salt equivalent in length to the length of the desired hashing algo
        $prehash    = hash_hmac($algo, $defaultPW, hex2bin($salt)); // prehash the default passwd
        $cryptPW    = password_hash($prehash, PASSWORD_BCRYPT, ['cost' => $cost]); // crypt the default pw

        $d = [
            'username'      => $defaultUN,
            'displayname'   => 'admin',
            'passwd'        => $cryptPW,
            'salt'          => $salt,
            'usergroup'     => 'admins',
        ];

        log_message('info', "(UsersSeeder) Inserting default admin account. Username: {$defaultUN}, Password: {$defaultPW}");
        if ($usersModel->save($d, false) === true) log_message('notice', "(UsersSeeder) All done!");
        else log_message('warning', "(UsersSeeder) An error occurred");
    }
}