<?php
namespace App\Models;
use CodeIgniter\Model;

class RoleModel extends Model 
{
   protected $table = 'role';
   protected $primaryKey = 'id';
   protected $allowedFields = ['name'];
   
   public function getRoles()
   {
      return $this->findAll();
   }
}
?>