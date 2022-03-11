<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class categorySeeder extends Seeder
{
   public function run()
   {
      $data = [
         [
            'name' => 'tech',
            'class'    => 'b-primary category-card text-center'
         ],
         [
            'name' => 'health',
            'class'    => 'b-danger category-card text-center'
         ],
         [
            'name' => 'style',
            'class'    => 'b-pink category-card text-center'
         ],
         [
            'name' => 'nature',
            'class'    => 'b-success category-card text-center'
         ],
         [
            'name' => 'food',
            'class'    => 'b-warning category-card text-center'
         ],
         [
            'name' => 'sport',
            'class'    => 'bg-info category-card text-center'
         ]
      ];

      $this->db->table('category')->insertBatch($data);
   }
}