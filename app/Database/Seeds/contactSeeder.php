<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class contactSeeder extends Seeder
{
   public function run()
   {
      $data = [
         [
            'email' => 'user1@gmail.com',
            'content'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit libero adipisci magni     veniam alias deleniti asperiores ipsa aspernatur! Eos ducimus corporis iure corrupti explicabo in dolor facilis sapiente nisi recusandae.',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
         ],
         [
            'email' => 'user2@gmail.com',
            'content'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum magnam necessitatibus distinctio ducimus doloribus ipsam odio sunt earum facere saepe.',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
         ],
         [
            'email' => 'user3@gmail.com',
            'content'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla ex, esse hic adipisci natus quia enim voluptatibus fugit eligendi labore distinctio placeat dicta nisi assumenda, molestiae maiores dolore. Tenetur, architecto dolore! Inventore, expedita consequatur recusandae dicta esse dolorum quibusdam. Mollitia.',
            'created_at' => Time::now(),
            'updated_at' => Time::now(),
         ]
      ];

      $this->db->table('contact')->insertBatch($data);
   }
}