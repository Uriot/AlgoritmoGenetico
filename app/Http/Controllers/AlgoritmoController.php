<?php

namespace App\Http\Controllers;

use App\Models\Algoritmo;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Switch_;

class AlgoritmoController extends Controller
{
    public $generaciones = 50;
    public $probabilidadCruce = 0.98;
    public $probabilidadMutacion = 0.1;

    public function index()
    {
        if (isset($_GET['ovejas'])) {
            $ovejas     = $_GET['ovejas'];
            $pesoMinimo = $_GET['pesoMinimo'] ?: rand(15, 50);
            $pesoMaximo = $_GET['pesoMaximo'] ?: rand(150, 300);

            $algoritmo = new Algoritmo();
            $ovejasGeneradas = $algoritmo->generarOvejas($ovejas, $pesoMinimo, $pesoMaximo);

            $pesoTotal = $algoritmo->pesoTotal($ovejasGeneradas);
            $array = json_encode($ovejasGeneradas);

            $ovejasConHijos = $this->seleccion($ovejasGeneradas);
            return view('algoritmo', compact('ovejasGeneradas', 'ovejasConHijos'));
        }

        return view('algoritmo');
    }

    public function evaluacion($ovejasGeneradas)
    {
        //!puntuacion
        $totalPunteo = 0;
        $probAcumulada = 0;
        foreach ($ovejasGeneradas as $key => $oveja) {
            $puntiacion = 0;

            if ($oveja['pelaje']) {
                $puntiacion += 20;
            }
            if ($oveja['color']) {
                $puntiacion += 20;
            }
            if ($oveja['leche']) {
                $puntiacion += 20;
            }
            if ($oveja['grande']) {
                $puntiacion += 20;
            }
            if ($oveja['protectora']) {
                $puntiacion += 20;
            }
            $totalPunteo += $puntiacion;
            $ovejasGeneradas[$key]['puntuacion'] = $puntiacion;
        }

        //!probabilidad
        foreach ($ovejasGeneradas as $key => $oveja) {
            $probabilidad = $oveja['puntuacion'];
            $probabilidad = ($probabilidad / $totalPunteo);
            $probAcumulada += $probabilidad;
            $ovejasGeneradas[$key]['probabilidad'] = $probabilidad;
            $ovejasGeneradas[$key]['probabilidadAcumulada'] = $probAcumulada;
        }

        return $ovejasGeneradas;
    }

    public function seleccion($ovejasGeneradas)
    {
        $ovejasGeneradas = $this->evaluacion($ovejasGeneradas);

        //! primera iteracion
            $padre = 0;
        for ($i = 0; $i < 2; $i++) {
            $aleatorio = rand(1, 100);
            $prob = (1 / $aleatorio);
            for ($j = 0; $j < count($ovejasGeneradas); $j++) {
                switch (true) {
                    case $prob  >= $ovejasGeneradas[$j]['probabilidadAcumulada']:
                        try {
                            $cromosomaPadre[$padre] = $ovejasGeneradas[$j + 1];
                        } catch (\Exception $e) {
                            $cromosomaPadre[$padre] = $ovejasGeneradas[$j];
                        }
                        break;
                    case $prob == $ovejasGeneradas[$j]['probabilidadAcumulada']:
                        $cromosomaPadre[$padre] = $ovejasGeneradas[$j];
                        break;
                    default:
                        $cromosomaPadre[$padre] = $ovejasGeneradas[$j];
                        break;
                }
            }
            $padre++;
        }
        $ovejasGeneradas = $this->mutacion($ovejasGeneradas, $cromosomaPadre[0], $cromosomaPadre[1]);
        return $ovejasGeneradas;
    }

    public function mutacion($ovejasGeneradas, $padre, $madre)
    {
        $aleatorio = rand(1, 100);
        $prob = (1 / $aleatorio);

        if ($prob <= $this->probabilidadCruce) {
            $pesoMinimo =  rand(15, 50);
            $pesoMaximo =  rand(150, 300);

            $cantidad = count($ovejasGeneradas);

            $nuevasOvejas = new Algoritmo();
            $nuevasOvejas = $nuevasOvejas->generarOvejas(2, $pesoMinimo, $pesoMaximo, $cantidad);

            foreach ($nuevasOvejas as $nueva) {
                    $nueva['pelaje'] = $padre['pelaje'];
                    $nueva['color']  = $padre['color'];
                    $nueva['leche']  = $madre['leche'];
                    $nueva['grande'] = $madre['grande'];
                    $nueva['protectora'] = $madre['protectora'];
            }

            $masOvejas = array_merge($ovejasGeneradas, $nuevasOvejas);
        }

        return $masOvejas;
    }
}
