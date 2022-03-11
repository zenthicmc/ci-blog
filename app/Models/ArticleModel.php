<?php
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class ArticleModel  extends Model 
{
   protected $table = 'article';
   protected $primaryKey = 'id';
   protected $allowedFields = ['title', 'slug', 'category', 'content', 'author', 'cover', 'created_at', 'updated_at'];
   protected $useTimestamps = true;

   public function getTopTwoArticle()
   {
      $query = $this->query("SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name ORDER BY updated_at DESC LIMIT 0,2;");
      $results = $query->getResult();
      return $results;
   }

   public function getTopThreeArticle()
   {
      $query = $this->query("SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name ORDER BY updated_at DESC LIMIT 2,3;");
      $results = $query->getResult();
      return $results;
   }

   public function getRecentArticleByUsername($username, $limit)
   {
      $query = $this->query("SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name WHERE article.author = '$username' ORDER BY updated_at DESC LIMIT 0,$limit;");
      $results = $query->getResult();
      return $results;
   }

   public function getArticleBySlug($slug)
   {  
      $query = $this->query("SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name WHERE article.slug = '$slug';");
      $results = $query->getResult();
      return $results;
   }

   public function searchArticle($keyword)
   {
      $sql = "SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name WHERE article.title LIKE '%".
      $this->escapeLikeString($keyword) . "%' ESCAPE '!'".
      " OR article.content LIKE '%".
      $this->escapeLikeString($keyword) . "%' ESCAPE '!'";

      $query = $this->query($sql);
      $results = $query->getResult();
      return $results;
   }

   public function getAllArticle()
   {
      $query = $this->query("SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name;");
      $results = $query->getResult();
      return $results;
   }

   public function getArticleByUser($username)
   {
      $query = $this->query("SELECT article.*,category.class FROM article INNER JOIN category ON article.category = category.name WHERE article.author = '$username';");
      $results = $query->getResult();
      return $results;
   }

   public function getArticleById($id)
   {
      return $this->where(['id' => $id])->first();
   }

   function time_elapsed_string($datetime, $full = false) {
      $now = Time::now('Asia/Jakarta', 'en_US');
      $ago = new Time($datetime);
      $diff = $now->diff($ago);
  
      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;
  
      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'min',
          's' => 'sec',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }
  
      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
  }

   // function to create article
   public function createArticle($data)
   {
      $this->table('article')->insert($data);
   }
}
?>