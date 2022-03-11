<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class userSeeder extends Seeder
{
   public function run()
   {
      $data = [
         [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'firstname' => 'admin',
            'lastname' => '',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'image'    => 'default.jpg',
            'role'     => 'admin',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
         ],
         [
            'username' => 'user',
            'email' => 'user@gmail.com',
            'firstname' => 'user',
            'lastname' => '',
            'password' => password_hash('user', PASSWORD_DEFAULT),
            'image'    => 'default.jpg',
            'role'     => 'user',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
         ],
      ];

      $this->db->table('user')->insertBatch($data);
   }
}