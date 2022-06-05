<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class AddUsers extends Migration
{
        public function up()
        {
                $this->forge->addField([
                    'id'    => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'auto_increment' => true,
                        'null'           => false,
                    ],
                    'username'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'email'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],   
                    'password'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                    'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                ]);
                $this->forge->addKey('id', TRUE);
                $attributes = ['ENGINE' => 'InnoDB'];
                $this->forge->createTable('users', TRUE, $attributes);
        }

        public function down()
        {
                $this->forge->dropTable('users', TRUE);
        }
}