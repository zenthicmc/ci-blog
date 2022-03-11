<?php

namespace App\Controllers;
use \App\Models\ArticleModel;
use \App\Models\ContactModel;

class Pages extends BaseController
{
   protected $articleModel;
   protected $contactModel;

   public function __construct()
   {
      $this->articleModel = new ArticleModel();
      $this->contactModel = new ContactModel();
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
            'articles' => $this->articleModel->join('category', 'category.name = article.category')->paginate(6, 'article'),
            'pager' => $this->articleModel->pager,
            'keyword' => $this->request->getVar('keyword')
         ];
      }

      return view('search', $data);
   }

   public function view($slug)
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'articles' => $this->articleModel->getArticleBySlug($slug)
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
}
