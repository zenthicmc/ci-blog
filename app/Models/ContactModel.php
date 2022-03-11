<?php
namespace App\Models;
use CodeIgniter\Model;

class ContactModel extends Model 
{
   protected $table = 'contact';
   protected $primaryKey = 'id';
   protected $allowedFields = ['email', 'content', 'created_at', 'updated_at'];
   protected $useTimestamps = true;
   
   public function getContacts()
   {
      return $this->findAll();
   }
}
?>