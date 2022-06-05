<?php namespace App\Database\Seeds;

class UsersSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
            $data = [
                'id'        => 1,
                'username'  => 'admin',
                'email'     => 'admin@example.com',
                'password'  => '21232f297a57a5a743894a0e4a801fc3',
            ];
            $this->db->table('users')->emptyTable();
            $this->db->table('users')->insert($data);
        }
}