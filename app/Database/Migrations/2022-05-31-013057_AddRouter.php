<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRouter extends Migration
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
                    'router_name'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'router_dns'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'router_host'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'router_user'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],  
                    'router_pass'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'router_ntp'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'traffic_interface'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'tripay_merchant_code'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'tripay_api_key'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'tripay_private_key'  => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '255',
                    ],
                    'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                    'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                ]);
                $this->forge->addKey('id', TRUE);
                $attributes = ['ENGINE' => 'InnoDB'];
                $this->forge->createTable('router', TRUE, $attributes);
        }

        public function down()
        {
                $this->forge->dropTable('router', TRUE);
        }
}