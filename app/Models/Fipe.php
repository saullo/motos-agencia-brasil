<?php

namespace App\Models;

use CodeIgniter\Model;

class Fipe extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'fipe';
    protected $afterFind = ['valorIntParaFloat'];

    /**
     * Converte o valor armazenado no banco de dados (BIGINT) para float.
     *
     * @param array $data Dados armazenados no banco de dados
     * @return array|array[]
     */
    protected function valorIntParaFloat(array $data): array
    {
        if (!$data['data'])
            return $data;

        if (($data['method'] == 'first')) {
            $item = $data['data'];
            $item['intervaloInicio'] = $item['intervaloInicio'] / 100;
            $item['intervaloFim'] = $item['intervaloFim'] / 100;
            $item['total'] = $item['total'] / 100;
            return ['data' => $item];
        }

        return $data;
    }
}