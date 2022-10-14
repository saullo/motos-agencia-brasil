<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarTabelaFipe extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'intervaloInicio' => [
                'type' => 'BIGINT',
                'unsigned' => true
            ],
            'intervaloFim' => [
                'type' => 'BIGINT',
                'unsigned' => true
            ],
            'total' => [
                'type' => 'BIGINT',
                'unsigned' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('fipe');
    }

    public function down()
    {
        $this->forge->dropTable('fipe');
    }
}
