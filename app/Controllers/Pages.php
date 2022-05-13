<?php

namespace App\Controllers;
use App\Models\ArticleModel;
use App\Models\UserModel;
use App\Models\ContactModel;
use App\Models\LikeModel;

class Pages extends BaseController
{
   protected $articleModel;
   protected $contactModel;
   protected $likeModel;
   protected $userModel;

   public function __construct()
   {
      $this->articleModel = new ArticleModel();
      $this->contactModel = new ContactModel();
      $this->userModel = new UserModel();
      $this->likeModel = new LikeModel();
   }

   public function index()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'two_articles' => $this->articleModel->getTopTwoArticle(),
         'three_articles' => $this->articleModel->getTopThreeArticle(),
         'validation' => \Config\Services::validation()
      ];

      return view('index', $data);
   }

   public function search()
   {
      $keyword = $this->request->getVar('keyword');
      if(!empty($keyword)) {
         $data = [
            'appName' => getenv('APP_NAME'),
            'articles' => $this->articleModel->searchArticle($this->request->getVar('keyword')),
            'keyword' => $this->request->getVar('keyword')
         ];
      } 
      else {
         $data = [
            'appName' => getenv('APP_NAME'),
            'articles' => $this->articleModel->getAllArticle(),
            'pager' => $this->articleModel->pager,
            'keyword' => $this->request->getVar('keyword')
         ];
      }

      return view('search', $data);
   }

   public function view($slug)
   {
      $article = $this->articleModel->where('slug', $slug)->first();
      // check if user is logged in
      if(session()->has('id')) {
         $data_like = $this->likeModel->checkIsLiked(session()->get('id'), $article['id']);
      }
      else {
         $data_like = 'Not logged in';
      }

      $data = [
         'appName' => getenv('APP_NAME'),
         'articles' => $this->articleModel->getArticleBySlug($slug),
         'data_like' => $data_like,
         'count_likes' => count($this->likeModel->where('id_article', $article['id'])->findAll()),
      ];

      return view('view', $data);
   }

   public function contactSave()
   {
      // validation input
      if(!$this->validate([
         'email' => 'required|valid_email',
         'body' => 'required|min_length[10]|max_length[500]'
      ])) {
         return redirect()->to('/#contact')->withInput();
      }

      // save to database
      $data = [
         'email' => htmlspecialchars($this->request->getVar('email')),
         'content' => htmlspecialchars($this->request->getVar('body')),
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s')
      ];
      
      $this->contactModel->save($data);
      session()->setFlashdata('msg', 'Your message has been sent');
      return redirect()->to('/#contact');
   }

   public function user($username) {
      $data = [
         'appName' => getenv('APP_NAME'),
         'user' => $this->userModel->where('username', $username)->first(),
         'count_articles' => count($this->articleModel->getArticleByUser($username)),
         'articles' => $this->articleModel->getRecentArticleByUsername($username, 3)
      ];

      return view('user', $data);
   }
}
