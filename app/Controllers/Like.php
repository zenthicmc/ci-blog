<?php
namespace App\Controllers;
use App\Models\LikeModel;
use App\Models\ArticleModel;

class Like extends BaseController
{
   protected $likeModel;
   protected $articleModel;

   public function __construct() {
      $this->likeModel = new LikeModel();
      $this->articleModel = new ArticleModel();
   }

   public function save($id)
   {
      $article = $this->articleModel->where('id', $id)->first();
      $is_liked = $this->likeModel->checkIsLiked(session()->get('id'), $id);
      if($is_liked == 'true') {
         $this->likeModel->where('id_user', session()->get('id'))->where('id_article', $id)->delete();
         session()->setFlashdata('msg', 'You unliked this article');
         return redirect()->to('/view/' . $article['slug']);  
      }
      elseif($is_liked == 'false') {
         $data = [
            'id_user' => session()->get('id'),
            'id_article' => $id,
            'article_author' => $article['author'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
         ];
         $this->likeModel->save($data);
         session()->setFlashdata('msg', 'You liked this article');
         return redirect()->to('/view/' . $article['slug']);
      }
   }
}
