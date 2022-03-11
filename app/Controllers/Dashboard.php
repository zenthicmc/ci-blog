<?php
namespace App\Controllers;
use \App\Models\AuthModel;
use App\Models\ArticleModel;

class Dashboard extends BaseController
{
   protected $authModel;
   protected $articleModel;

   public function __construct() {
      $this->authModel = new AuthModel();
      $this->articleModel = new ArticleModel();
   }
   
   
   public function index()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Dashboard',
         'articles' => $this->articleModel->getArticleByUser(session()->get('username')),
         'recent_articles' => $this->articleModel->getRecentArticleByUsername(session()->get('username'),3),
      ];
      return view('/dashboard/index', $data);
   }
}
