<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Algoritmo extends Model
{
    use HasFactory;

    public const PRECIOLIBRA = 40;
    public const VALORPELAJE = 100;
    public $cantidadOvejas = 0;
    public $esBlanca = [1 => 200 , 0 => 0];
    public $pelaje       = [1, 0];
    public $daLeche      = [1, 0];
    public $esGrande     = [1, 0];
    public $esProtectora = [1, 0];

    public function generarOvejas(int $ovejas, int $pesoMinimo, int $pesoMaximo, int $cantidad = 0)
    {
        $this->cantidadOvejas += ($ovejas + $cantidad);
        $ovejasGeneradas = [];
        for ($i = ($this->cantidadOvejas - $ovejas); $i < $this->cantidadOvejas; $i++) {
            $color        = array_rand($this->esBlanca, 1);
            $peso         = rand($pesoMinimo, $pesoMaximo);
            $pelaje       = array_rand($this->pelaje);
            $leche        = array_rand($this->daLeche);
            $esGrande     = array_rand($this->esGrande);
            $esProtectora = array_rand($this->esProtectora);

            $precio = (($peso * Algoritmo::PRECIOLIBRA) + (Algoritmo::VALORPELAJE * $pelaje) + $this->esBlanca[$color]);
            $ovejasGeneradas[$i] = [
                    'peso'       => $peso,
                    'precio'     => $precio,
                    'pelaje'     => $pelaje,
                    'color'      => $color,
                    'leche'      => $leche,
                    'grande'     => $esGrande,
                    'protectora' => $esProtectora,
            ];
        }
        return $ovejasGeneradas;
    }

    public function pesoTotal(array $ovejas)
    {
        $totalPeso = 0;
        foreach ($ovejas as $oveja) {
            $totalPeso += $oveja['peso'];
        }
        return $totalPeso;
    }
}
