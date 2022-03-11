<?php
namespace App\Controllers;
use \App\Models\UserModel;

class Profile extends BaseController
{
   protected $userModel;

   public function __construct() {
      $this->userModel = new UserModel();
   }
   
   public function index()
   {
      $data = [
         'appName' => getenv('APP_NAME'),
         'title' => 'My Profile',
         'validation' => \Config\Services::validation(),
         'user' => $this->userModel->where('id', session()->get('id'))->first()
      ];
      return view('/dashboard/profile', $data);
   }

   public function userSave()
   {
      $data_lama = $this->userModel->where('id', session()->get('id'))->first();

      // cek apakah username baru = username lama
      if($data_lama['username'] != $this->request->getVar('username')) {
         $rule_username = 'required|is_unique[user.username]|min_length[5]|max_length[20]';
      } else {
         $rule_username = 'required|min_length[5]|max_length[20]';
      }

      // cek apakah email baru = email lama
      if($data_lama['email'] != $this->request->getVar('email')) {
         $rule_email = 'required|valid_email|is_unique[user.email]';
      } else {
         $rule_email = 'required|valid_email';
      }

      // validasi input
      if(!$this->validate([
         'username' => $rule_username,
         'email' => $rule_email,
         'firstname' => 'required',
         'lastname' => 'required',
      ])) {
         return redirect()->to('/dash/profile')->withInput();
      }

      // simpan ke database
      $this->userModel->save([
         'id' => session()->get('id'),
         'username' => $this->request->getVar('username'),
         'email' => $this->request->getVar('email'),
         'firstname' => $this->request->getVar('firstname'),
         'lastname' => $this->request->getVar('lastname'),
      ]);

      session()->set('username', $this->request->getVar('username'));
      session()->setFlashdata('msg', 'Profile succesfully updated');
      return redirect()->to('/dash/profile');
   }

   public function passSave()
   {
      $data_lama = $this->userModel->where('id', session()->get('id'))->first();

      // validasi input
      if(!$this->validate([
         'current_pwd' => 'required',
         'pwd' => 'required|min_length[8]',
         'confirm_pwd' => 'required|matches[pwd]',
      ])) {
         return redirect()->to('/dash/profile')->withInput();
      }

      // cek password lama
      if(!password_verify($this->request->getVar('current_pwd'), $data_lama['password'])) {
         session()->setFlashdata('error', 'Wrong current password');
         return redirect()->to('/dash/profile');
      }

      // simpan ke database
      $this->userModel->save([
         'id' => session()->get('id'),
         'password' => password_hash($this->request->getVar('pwd'), PASSWORD_DEFAULT),
      ]);

      session()->setFlashdata('msg', 'Password succesfully updated');
      return redirect()->to('/dash/profile');
   }

   public function imageSave()
   {
      // validasi input
      if(!$this->validate([
         'profile' => 'mime_in[profile,image/jpg,image/jpeg,image/png]|max_size[profile,10240]',
      ])) {
         return redirect()->to('/dash/profile')->withInput();
      }

      // ambil file gambar
      $file = $this->request->getFile('profile');

      // cek apakah ada file gambar baru
      if($file->getError() == 4) {
         $namaFile = $this->request->getVar('imageLama');
      } 
      else {
         $namaFile = $file->getRandomName();
         $file->move('img/user-images/', $namaFile);
         
         // hapus cover cover lama
         if($this->request->getVar('imageLama') != 'default.jpg') {
            unlink('img/user-images/'.$this->request->getVar('imageLama'));
         }
      }

      // simpan ke database
      $this->userModel->save([
         'id' => session()->get('id'),
         'image' => $namaFile,
      ]);

      session()->setFlashdata('msg', 'Image succesfully updated');
      return redirect()->to('/dash/profile');
   }
}
