<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class roleSeeder extends Seeder
{
   public function run()
   {
      $data = [
         [
            'name' => 'guest'
         ],
         [
            'name' => 'unverified'
         ],
         [
            'name' => 'user'
         ],
         [
            'name' => 'admin'
         ]
      ];

      $this->db->table('role')->insertBatch($data);
   }
}