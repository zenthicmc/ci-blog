<?php

namespace App\Models;

use CodeIgniter\Model;

class FollowerModel extends Model
{
    protected $table = 'follower';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'id_user_following', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function checkIsFollowing($id_user, $id_user_following) {
        $data = $this->where('id_user', $id_user)->where('id_user_following', $id_user_following)->first();
        
        if($data) {
           return "true";
        }
        else {
           return "false";
        }
    }
}
