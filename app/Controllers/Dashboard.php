<?php
namespace App\Controllers;
use \App\Models\AuthModel;
use App\Models\ArticleModel;
use App\Models\LikeModel;
use App\Models\FollowerModel;

class Dashboard extends BaseController
{
   protected $authModel;
   protected $articleModel;
   protected $likeModel;
   protected $followerModel;

   public function __construct() {
      $this->authModel = new AuthModel();
      $this->articleModel = new ArticleModel();
      $this->likeModel = new LikeModel();
      $this->followerModel = new FollowerModel();
   }
   
   
   public function index()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Dashboard',
         'articles' => $this->articleModel->getArticleByUser(session()->get('username')),
         'recent_articles' => $this->articleModel->getRecentArticleByUsername(session()->get('username'),3),
         'followers' => $this->followerModel->where('id_user_following', session()->get('id'))->findAll(),
         'count_likes' => count($this->likeModel->where('article_author', session()->get('username'))->findAll()),

      ];
      return view('/dashboard/index', $data);
   }
}
