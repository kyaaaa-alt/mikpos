<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPaymentMethod extends Migration
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
                    'user_id'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'auto_increment' => false,
                        'null'           => false,
                    ],
                    'router_id'  => [
                        'type'           => 'INT',
                        'constraint'     => 11,
                        'auto_increment' => false,
                        'null'           => false,
                    ],   
                    'kode'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'nama'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'status'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                    'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                ]);
                $this->forge->addKey('id', TRUE);
                $attributes = ['ENGINE' => 'InnoDB'];
                $this->forge->createTable('payment_method', TRUE, $attributes);
        }

        public function down()
        {
                $this->forge->dropTable('payment_method', TRUE);
        }
}