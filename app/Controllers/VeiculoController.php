<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Fipe;
use App\Models\Veiculo;
use CodeIgniter\CLI\CLI;
use NumberFormatter;

class VeiculoController extends BaseController
{
    /**
     * Procura todos os veiculos no banco de dados e retorna a view `veiculos` populada
     *
     * @return string `veiculos` view
     */
    public function index()
    {
        $result = $this->procurarVeiculos();
        $data = [
            'veiculos' => $result
        ];
        return view('veiculos', $data);
    }

    /**
     * Retorna todos os veiculos do banco de dados e suas cotas calculadas
     *
     * @return array Todos os veiculos
     */
    private function procurarVeiculos()
    {
        $veiculoModel = new Veiculo();
        $veiculos = $veiculoModel->findAll();

        $result = [];
        foreach ($veiculos as $veiculo) {
            $valor = $veiculo['valor'];
            $cota = $this->calcularCota($valor);
            $mensalidade = $this->calcularMensalidade($valor);

            $veiculo['cota'] = $this->formatarValorParaReal($cota);
            $veiculo['valor'] = $this->formatarValorParaReal($valor);
            $veiculo['mensalidade'] = $this->formatarValorParaReal($mensalidade);

            $result[] = $veiculo;
        }
        return $result;
    }

    /**
     * Dado um valor do veiculo, retorna a cota de participação minima
     *
     * @param float $valor Valor do veiculo
     * @return float|int A cota de participação minima
     */
    private function calcularCota(float $valor)
    {
        $cota = Veiculo::COTA_MINIMA;
        if ($valor >= Veiculo::FIPE_MINIMA) {
            $cota = (Veiculo::COTA / 100) * $valor;
        }
        return $cota;
    }

    /**
     * Dado um valor do veiculo, retorna a mensalidade do plano
     *
     * @param float $valor Valor do veiculo
     * @return int|mixed A mensalidade do plano
     */
    private function calcularMensalidade(float $valor)
    {
        $fipeModel = new Fipe();
        $fipe = $fipeModel->where([
            'intervaloInicio <=' => $valor * 100,
            'intervaloFim >=' => $valor * 100,
        ])->first();

        if (!$fipe)
            return 0;

        return $fipe['total'];
    }

    /**
     * Formata um valor (float) para a REAL (R$)
     *
     * @param float $valor Valor para ser formatado
     * @return false|string Retorna false quando o valor informado for invalido, ou retorna o valor formatado em string
     */
    private function formatarValorParaReal(float $valor)
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($valor, 'BRL');
    }
}
