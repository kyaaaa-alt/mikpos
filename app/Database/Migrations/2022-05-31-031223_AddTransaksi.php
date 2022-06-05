<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransaksi extends Migration
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
                    'merchant_ref'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'customer_name'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'reference'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'payment_name'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'amount_received'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'return_url'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'service'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'profile'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ], 
                    'query_status'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'query_result'  => [
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
                $this->forge->createTable('transaksi', TRUE, $attributes);
        }

        public function down()
        {
                $this->forge->dropTable('transaksi', TRUE);
        }
}