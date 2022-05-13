<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'like';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'id_article', 'article_author', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function checkIsLiked($id_user, $id_article) {
        $data = $this->where('id_user', $id_user)->where('id_article', $id_article)->first();
        if($data) {
            return 'true';
        }
        else {
            return 'false';
        }
    }
}
