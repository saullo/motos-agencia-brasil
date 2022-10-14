<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VeiculoSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            $valor = rand(0, 15200000);
            $seed = [
                'valor' => $valor
            ];
            $this->db->table('veiculo')->insert($seed);
        }
    }
}
