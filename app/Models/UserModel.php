<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model 
{
   protected $table = 'user';
   protected $primaryKey = 'id';
   protected $allowedFields = ['username', 'email', 'password', 'firstname', 'lastname', 'role', 'image', 'created_at', 'updated_at'];
   protected $useTimestamps = true;
}
?>