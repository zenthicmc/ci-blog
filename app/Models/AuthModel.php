<?php
namespace App\Models;
use CodeIgniter\Model;

class AuthModel extends Model 
{
   protected $table = 'user';
   protected $primaryKey = 'id';
   protected $allowedFields = ['username', 'email', 'password', 'firstname', 'lastname', 'image', 'role', 'created_at', 'updated_at'];
   protected $useTimestamps = true;

   public function check($username, $password)
   {
      $user = $this->where('username', $username)->first();
      if($user) {
         if(password_verify($password, $user['password'])) {
            return $user;
         }
      }
      return false;
   }

   public function addUser($data)
   {
      $this->table('user')->insert($data);
   }
}
?>