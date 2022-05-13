<?php

namespace App\Controllers;
use \App\Models\ArticleModel;
use \App\Models\CategoryModel;
use CodeIgniter\I18n\Time;

class Articles extends BaseController
{
   protected $articleModel;
   protected $categoryModel;

   public function __construct()
   {
      $this->articleModel = new ArticleModel();
      $this->categoryModel = new CategoryModel();
   }

   public function index()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Articles',
         'articles' => $this->articleModel->getArticleByUser(session()->get('username')),
      ];

      return view('/dashboard/articles', $data);
   }

   public function new()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'New Articles',
         'categories' => $this->categoryModel->getCategory(),
         'validation' => \Config\Services::validation()
      ];

      return view('/dashboard/new', $data);
   }

   public function save()
   {
      // validasi input
      if(!$this->validate([
         'title' => 'required|is_unique[article.title]|min_length[10]',
         'category' => 'required',
         'cover' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,10240]',
         'body' => 'required|min_length[100]',
      ])) {
         return redirect()->to('/dash/articles/new')->withInput();
      }

      // ambil gambar
      $file = $this->request->getFile('cover');
      $namaFile = $file->getRandomName();
      $file->move('img/article-images/', $namaFile);
      
      // simpan ke database
      $this->articleModel->save([
         'title' => $this->request->getVar('title'),
         'slug' => url_title($this->request->getVar('title'), '-', true),
         'category' => $this->request->getVar('category'),
         'content' => $this->request->getVar('body'),
         'author' => $_SESSION['username'],
         'cover' => $namaFile,
      ]);

      session()->setFlashdata('msg', 'Article succesfully created');
      return redirect()->to('/dash/articles');
   }

   public function edit($id)
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'id' => $id,
         'title' => 'Edit Articles',
         'article' => $this->articleModel->getArticleById($id),
         'categories' => $this->categoryModel->getCategory(),
         'validation' => \Config\Services::validation()
      ];

      return view('/dashboard/edit', $data);
   }


   public function update($id)
   {
      // cek judul
      $articleModel = $this->articleModel->getArticleById($id);
      if($articleModel['title'] == $this->request->getVar('title')) {
         $rule_judul = 'required|min_length[10]';
      }
      else {
         $rule_judul = 'required|is_unique[article.title]|min_length[10]';
      }

      // validasi input
      if(!$this->validate([
         'title' => $rule_judul,
         'category' => 'required',
         'cover' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,10240]',
         'body' => 'required|min_length[100]',
      ])) {
         session()->setFlashdata('error', 'Error occured while updating article, please check your input again');
         return redirect()->to('/dash/articles');
      }

      // ambil file cover
      $file = $this->request->getFile('cover');

      // cek apakah ada gambar baru
      if($file->getError() == 4) {
         $namaFile = $this->request->getVar('coverLama');
      } else {
         $namaFile = $file->getRandomName();
         $file->move('img/article-images/', $namaFile);
         
         // hapus cover cover lama
         unlink('img/article-images/' . $this->request->getVar('coverLama'));
      }

      // simpan ke database
      $this->articleModel->save([
         'id' => $id,
         'title' => $this->request->getVar('title'),
         'slug' => url_title($this->request->getVar('title'), '-', true),
         'category' => $this->request->getVar('category'),
         'content' => $this->request->getVar('body'),
         'author' => $_SESSION['username'],
         'cover' => $namaFile,
         'updated_at' => Time::now()
      ]);

      session()->setFlashdata('msg', 'Article succesfully updated');
      return redirect()->to('/dash/articles');
   }


   public function delete($id)
   {
      // cari gambar berdasarkan id
      $article = $this->articleModel->getArticleById($id);

      // cek jika file gambar bukan default
      if($article['cover'] != 'default.jpg') {
         // hapus file gambar
         unlink('img/article-images/' . $article['cover']);
      }

      $this->articleModel->delete($id);

      session()->setFlashdata('error', 'Article has been deleted');
      return redirect()->to('/dash/articles');
   }
}
