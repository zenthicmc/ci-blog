<?php 
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
  
class dataSeeder extends Seeder
{
   public function run()
   {
      $this->call('articleSeeder');
      $this->call('categorySeeder');
      $this->call('userSeeder');
      $this->call('contactSeeder');
      $this->call('roleSeeder');
   }
} 