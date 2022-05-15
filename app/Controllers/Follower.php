<?php
namespace App\Controllers;
use App\Models\FollowerModel;
use App\Models\UserModel;
use App\Models\ArticleModel;
use App\Models\LikeModel;

class Follower extends BaseController
{
   protected $followerModel;
   protected $userModel;
   protected $articleModel;
   protected $likeModel;

   public function __construct() {
      $this->followerModel = new FollowerModel();
      $this->userModel = new UserModel();
      $this->articleModel = new ArticleModel();
      $this->likeModel = new LikeModel();
   }

   public function index($username)
   {
      $user = $this->userModel->where('username', $username)->first();
      if(!$user) {
         throw new \CodeIgniter\Exceptions\PageNotFoundException('User not found');
      }
      // check if user is logged in
      if(session()->has('id')) {
         $data_following = $this->followerModel->checkIsFollowing(session()->get('id'), $user['id']);
      }
      else {
         $data_following = 'Not logged in';
      }

      $data = [
         'appName' => getenv('APP_NAME'),
         'user' => $this->userModel->where('username', $username)->first(),
         'count_articles' => count($this->articleModel->getArticleByUser($username)),
         'articles' => $this->articleModel->getRecentArticleByUsername($username, 3),
         'data_following' => $data_following,
         'count_followers' => count($this->followerModel->where('id_user_following', $user['id'])->findAll()),
         'count_likes' => count($this->likeModel->where('article_author', $username)->findAll()),
      ];

      return view('user', $data);
   }

   public function follow($id)
   {
      $user = $this->userModel->where('id', $id)->first();
      if(session()->get('id') == $id) {
         session()->setFlashdata('error', "You cant follow yourself");
         return redirect()->to('/user/' . $user['username']);
      }

      $is_following = $this->followerModel->checkIsFollowing(session()->get('id'), $id);
      if($is_following == 'true') {
         $this->followerModel->where('id_user', session()->get('id'))->where('id_user_following', $id)->delete();
         session()->setFlashdata('msg', 'You had unfollowed '.$user['username']);
         return redirect()->to('/user/' . $user['username']);
      }
      elseif($is_following == 'false') {
         $data = [
            'id_user' => session()->get('id'),
            'id_user_following' => $id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
         ];
         
         $this->followerModel->save($data);
         
         session()->setFlashdata('msg', 'You are now following '.$user['username']);
         return redirect()->to('/user/' . $user['username']);
      }
   }
}
