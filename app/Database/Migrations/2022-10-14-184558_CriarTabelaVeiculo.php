<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarTabelaVeiculo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'valor' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('veiculo');
    }

    public function down()
    {
        $this->forge->dropTable('veiculo');
    }
}
