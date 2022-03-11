<?php
namespace App\Controllers;
use \App\Models\UserModel;
use \App\Models\ArticleModel;
use \App\Models\CategoryModel;
use \App\Models\RoleModel;
use \App\Models\ContactModel;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
   protected $userModel;
   protected $articleModel;
   protected $categoryModel;
   protected $roleModel;
   protected $contactModel;

   public function __construct() {
      $this->userModel = new UserModel();
      $this->articleModel = new ArticleModel();
      $this->categoryModel = new CategoryModel();
      $this->roleModel = new RoleModel();
      $this->contactModel = new ContactModel();
   }
   
   public function users()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Users',
         'users' => $this->userModel->paginate(10, 'user'),
         'pager' => $this->userModel->pager, 
      ];
      return view('/dashboard/admin/admin_users', $data);
   }

   public function newUsers()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Users',
         'validation' => \Config\Services::validation(),
         'roles' => $this->roleModel->orderBy('id', 'ASC')->findAll(),
      ];
      return view('/dashboard/admin/admin_new_users', $data);
   }

   public function saveUsers()
   {
      if (!$this->validate([
         'firstname' => 'required|min_length[3]|max_length[20]',
         'lastname' => 'required|min_length[3]|max_length[20]',
         'username' => 'required|min_length[5]|max_length[20]|is_unique[user.username]',
         'email' => 'required|valid_email|is_unique[user.email]',
         'password' => 'required|min_length[8]|max_length[20]',
         'pass_confirm' => 'required|matches[password]',
         'role' => 'required',
      ])) {
         return redirect()->to('/dash/admin/users/new')->withInput();
      }
   
      $data = [
         'username' => htmlspecialchars($this->request->getVar('username')),
         'email' => htmlspecialchars($this->request->getVar('email')),
         'firstname' => htmlspecialchars($this->request->getVar('firstname')),
         'lastname' => htmlspecialchars($this->request->getVar('lastname')),
         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
         'image' => 'default.jpg',
         'role' => htmlspecialchars($this->request->getVar('role')),
      ];

      // simpan ke database
      $this->userModel->save($data);
      session()->setFlashdata('msg', 'User succesfully created');
      return redirect()->to('/dash/admin/users/');
   }

   public function editUsers($id)
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Users',
         'validation' => \Config\Services::validation(),
         'roles' => $this->roleModel->orderBy('id', 'ASC')->findAll(),
         'user' => $this->userModel->find($id),
      ];
      return view('/dashboard/admin/admin_edit_users', $data);
   }

   public function saveEditUsers($id)
   {
      // cek apakah username diganti
      $user = $this->userModel->find($id);
      if ($user['username'] != $this->request->getVar('username')) {
         $rules_username = 'required|is_unique[user.username]|min_length[5]|max_length[20]';
      } else {
         $rules_username = 'required|min_length[5]|max_length[20]';
      }

      // cek apakah email diganti
      if ($user['email'] != $this->request->getVar('email')) {
         $rules_email = 'required|valid_email|is_unique[user.email]';
      } else {
         $rules_email = 'required|valid_email';
      }

      // cek apakah password diisi
      if ($this->request->getVar('password') != '') {
         $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
      } else {
         $password = $this->request->getVar('passwordLama');
      }

      if (!$this->validate([
         'firstname' => 'required|min_length[3]|max_length[20]',
         'lastname' => 'required|min_length[3]|max_length[20]',
         'username' => $rules_username,
         'email' =>  $rules_email,
         'password' => 'max_length[20]',
         'pass_confirm' => 'matches[password]',
         'role' => 'required',
      ])) {
         session()->setFlashdata('error', 'Error occured while updating user, please check your input again');
         return redirect()->to('/dash/admin/users/');
      }
   
      $data = [
         'id' => $id,
         'username' => htmlspecialchars($this->request->getVar('username')),
         'email' => htmlspecialchars($this->request->getVar('email')),
         'firstname' => htmlspecialchars($this->request->getVar('firstname')),
         'lastname' => htmlspecialchars($this->request->getVar('lastname')),
         'password' => $password,
         'role' => htmlspecialchars($this->request->getVar('role')),
      ];

      // simpan ke database
      $this->userModel->save($data);
      session()->setFlashdata('msg', 'User succesfully updated');
      return redirect()->to('/dash/admin/users/');
   }

   public function articles()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Articles',
         'articles' => $this->articleModel->paginate(10, 'article'),
         'pager' => $this->articleModel->pager, 
      ];
      return view('/dashboard/admin/admin_articles', $data);
   }

   public function newArticles()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Articles',
         'validation' => \Config\Services::validation(),
         'categories' => $this->categoryModel->findAll(),
         'users' => $this->userModel->findAll(),
      ];
      return view('/dashboard/admin/admin_new_articles', $data);
   }

   public function saveArticles()
   {
      // validasi input
      if(!$this->validate([
         'title' => 'required|is_unique[article.title]',
         'category' => 'required',
         'author' => 'required',
         'cover' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,10240]',
         'body' => 'required',
      ])) {
         return redirect()->to('/dash/admin/articles/new')->withInput();
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
         'author' => $this->request->getVar('author'),
         'cover' => $namaFile,
      ]);

      session()->setFlashdata('msg', 'Article succesfully created');
      return redirect()->to('/dash/admin/articles');
   }

   public function editArticles($id)
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Articles',
         'validation' => \Config\Services::validation(),
         'categories' => $this->categoryModel->findAll(),
         'users' => $this->userModel->findAll(),
         'article' => $this->articleModel->find($id),
      ];
      return view('/dashboard/admin/admin_edit_articles', $data);
   }

   public function saveEditArticles($id)
   {
      // cek apakah judul diganti
      $article = $this->articleModel->find($id);
      if ($article['title'] != $this->request->getVar('title')) {
         $rules_title = 'required|is_unique[article.title]';
      } else {
         $rules_title = 'required';
      }

      // validasi input
      if(!$this->validate([
         'title' => $rules_title,
         'category' => 'required',
         'author' => 'required',
         'cover' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,10240]',
         'body' => 'required',
      ])) {
         session()->setFlashdata('error', 'Error occured while updating article, please check your input again');
         return redirect()->to('/dash/admin/articles/');
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
         'author' => $this->request->getVar('author'),
         'cover' => $namaFile,
         'updated_at' => Time::now()
      ]);

      session()->setFlashdata('msg', 'Article succesfully updated');
      return redirect()->to('/dash/admin/articles');
   }

   public function category()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Categories',
         'categories' => $this->categoryModel->paginate(10, 'category'),
         'pager' => $this->categoryModel->pager, 
      ];
      return view('/dashboard/admin/admin_category', $data);
   }

   public function newCategory()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Categories',
         'validation' => \Config\Services::validation(),
      ];
      return view('/dashboard/admin/admin_new_category', $data);
   }

   public function saveCategory()
   {
      // validasi input
      if(!$this->validate([
         'name' => 'required|is_unique[category.name]',
         'class' => 'required',
      ])) {
         return redirect()->to('/dash/admin/category/new')->withInput();
      }

      // simpan ke database
      $this->categoryModel->save([
         'name' => $this->request->getVar('name'),
         'class' => $this->request->getVar('class'),
      ]);

      session()->setFlashdata('msg', 'Category succesfully created');
      return redirect()->to('/dash/admin/category');
   }

   public function editCategory($id)
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Categories',
         'validation' => \Config\Services::validation(),
         'category' => $this->categoryModel->find($id),
      ];
      return view('/dashboard/admin/admin_edit_category', $data);
   }

   public function saveEditCategory($id) 
   {
      // cek apakah nama category sama dengan yang lama
      $category = $this->categoryModel->find($id);
      if ($category['name'] != $this->request->getVar('name')) {
         $rules_name = 'required|is_unique[category.name]|min_length[3]|max_length[20]';
      } else {
         $rules_name = 'required|min_length[3]|max_length[20]';
      }

      // validasi input
      if(!$this->validate([
         'name' => $rules_name,
         'class' => 'required|min_length[3]|max_length[100]',
      ])) {
         session()->setFlashdata('error', 'Error occured while updating category, please check your input again');
         return redirect()->to('/dash/admin/category/');
      }

      // simpan ke database
      $this->categoryModel->save([
         'id' => $id,
         'name' => $this->request->getVar('name'),
         'class' => $this->request->getVar('class'),
      ]);

      session()->setFlashdata('msg', 'Category succesfully updated');
      return redirect()->to('/dash/admin/category');   
   }

   public function contact()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Contacts',
         'contacts' => $this->contactModel->where('status', 'unread')->findAll(),
      ];
      return view('/dashboard/admin/admin_contact', $data);
   }

   public function viewContact($id)
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'Admin | Contacts',
         'contact' => $this->contactModel->find($id),
      ];
      return view('/dashboard/admin/admin_view_contact', $data);
   }

   public function delete($type, $id)
   {
      if ($type == 'users') {
         $this->userModel->delete($id);
         session()->setFlashdata('error', 'User succesfully deleted');
         return redirect()->to('/dash/admin/users/');
      } elseif ($type == 'articles') {
         $this->articleModel->delete($id);
         session()->setFlashdata('error', 'Article succesfully deleted');
         return redirect()->to('/dash/admin/articles/');
      } elseif ($type == 'category') {
         $this->categoryModel->delete($id);
         session()->setFlashdata('error', 'Category succesfully deleted');
         return redirect()->to('/dash/admin/category/');
      } elseif ($type == 'contact') {
         $this->contactModel->delete($id);
         session()->setFlashdata('error', 'Contact succesfully deleted');
         return redirect()->to('/dash/admin/contact/');
      }
   }
}
