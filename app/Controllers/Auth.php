<?php

namespace App\Controllers;
use \App\Models\AuthModel;


class Auth extends BaseController
{
   protected $authModel;

   public function __construct()
   {
      $this->authModel = new AuthModel();
   }

   public function login()
   {
      if(session()->has('id')) {
         return redirect()->to('/dash');
      }
      
      $data = [
         'appName' => getenv('APP_NAME'),
         'validation' => \Config\Services::validation()
      ];

      return view('/auth/login', $data);
   }

   public function register()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'validation' => \Config\Services::validation()
      ];

      return view('/auth/signup', $data);
   }

   public function registerCheck()
   {
      // validasi input
      if(!$this->validate([
         'username' => 'required|is_unique[user.username]|min_length[5]|max_length[20]',
         'email' => 'required|is_unique[user.email]|valid_email',
         'firstname' => 'required',
         'lastname' => 'required',
         'password' => 'required|min_length[8]',
         'pass_confirm' => 'required|matches[password]',
      ])) {
         return redirect()->to('/auth/register')->withInput();
      }

      $data = [
         'username' => htmlspecialchars($this->request->getVar('username')),
         'email' => htmlspecialchars($this->request->getVar('email')),
         'firstname' => htmlspecialchars($this->request->getVar('firstname')),
         'lastname' => htmlspecialchars($this->request->getVar('lastname')),
         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
         'image' => 'default.jpg',
         'role' => 'user',
      ];

      // simpan ke database
      $this->authModel->addUser($data);
      session()->setFlashdata('msg', 'Account has been created, please login with your credentials');

      return redirect()->to('/auth/login');
   }

   public function loginCheck()
   {
      $username = htmlspecialchars($this->request->getVar('username'));
      $password = htmlspecialchars($this->request->getVar('password'));


      $user = $this->authModel->check($username, $password);

      if ($user) {
         $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
         ];

         session()->set($data);
         session()->setFlashdata('msg', 'Welcome, ' . session()->get('username') . '!');
         return redirect()->to('/dash');
      }
     
      session()->setFlashdata('error', 'Username or password is not valid');
      return redirect()->to('/auth/login')->withInput();
   }

   // logout
   public function logout()
   {
      if(session()->has('id')) {
         session()->destroy();
      }
      return redirect()->to('/auth/login');
   }
}
