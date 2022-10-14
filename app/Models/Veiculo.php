<?php

namespace App\Models;

use CodeIgniter\Model;

class Veiculo extends Model
{
    /**
     * Cota de participação minima em reais
     */
    public const COTA_MINIMA = 900;

    /**
     * FIPE minima para cota de participação > COTA_MINIMA em reais
     */
    public const FIPE_MINIMA = 8000;

    /**
     * Cota de participação em porcentagem
     */
    public const COTA = 11;

    protected $primaryKey = 'id';
    protected $table = 'veiculo';
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

        if (($data['method'] == 'find') || ($data['method'] == 'first')) {
            $data['data'] = [$data['data']];
        }

        $result = [];
        if ($data['data']) {
            if (($data['method'] == 'findAll')) {
                foreach ($data['data'] as $item) {
                    $item['valor'] = $item['valor'] / 100;
                    $result[] = $item;
                }
            }
        }

        if (($data['method'] == 'find') || ($data['method'] == 'first')) {
            return ['data' => $result[0]];
        } else {
            return ['data' => $result];
        }
    }
}