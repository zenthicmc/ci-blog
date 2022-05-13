<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Like extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'id_article' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'article_author' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('like');
    }

    public function down()
    {
        $this->forge->dropTable('like');
    }
}
