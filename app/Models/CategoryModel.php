<?php
namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model 
{
   protected $table = 'category';
   protected $primaryKey = 'id';
   protected $allowedFields = ['name', 'class'];
   
   public function getCategory()
   {
      return $this->findAll();
   }
}
?>