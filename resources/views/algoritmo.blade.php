<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Algoritmo Genetico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="text-center">
        <h1>Algoritmo genetico</h1>
        <hr>
        <h4>Generar poblacion Inicial</h4>
    </div>
    <div class="container-xl text-center">
        <form method="GET">
            <div class="form-group">
                <label>
                    cantidad de ovejas
                    <input type="number" class="form-control" id="ovejas" name="ovejas" required>
                </label>
                <label>
                    peso minimo
                    <input type="number" class="form-control" id="pesoMinimo" name="pesoMinimo">
                </label>
                <label>
                    peso maximo
                    <input type="number" class="form-control" id="pesoMaximo" name="pesoMaximo">
                </label>
            </div>
            <div class="form-group pt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <div class="container text-center">
        <?php if (isset($ovejasGeneradas)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" colspan="8">Poblacion inicial</th>
                </tr>
                <tr>
                    <th scope="col" colspan="3">ovejas</th>
                    <th scope="col" colspan="5">cromosomas</th>
                </tr>
                <tr>
                    <th scope="col">No. Oveja</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Pelaje</th>
                    <th scope="col">Color</th>
                    <th scope="col">Leche</th>
                    <th scope="col">Grande</th>
                    <th scope="col">protectora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ovejasGeneradas as $i => $data): ?>
                    <tr>
                        <th scope="col"><?=$i+1?></th>
                        <th scope="col"><?=$data['peso']?> lbs</th>
                        <th scope="col">Q. <?=$data['precio']?></th>
                        <th scope="col"><?=$data['pelaje']?></th>
                        <th scope="col"><?=$data['color']?></th>
                        <th scope="col"><?=$data['leche']?></th>
                        <th scope="col"><?=$data['grande']?></th>
                        <th scope="col"><?=$data['protectora']?></th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php endif ?>
    </div>
    <br><br>
    <hr>

    <div class="container text-center">
        <?php if (isset($ovejasConHijos)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" colspan="8">Poblacion Con mutaciones</th>
                </tr>
                <tr>
                    <th scope="col" colspan="3">ovejas</th>
                    <th scope="col" colspan="5">cromosomas</th>
                </tr>
                <tr>
                    <th scope="col">No. Oveja</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Pelaje</th>
                    <th scope="col">Color</th>
                    <th scope="col">Leche</th>
                    <th scope="col">Grande</th>
                    <th scope="col">protectora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ovejasConHijos as $i => $data): ?>
                    <tr>
                        <th scope="col"><?=$i+1?></th>
                        <th scope="col"><?=$data['peso']?> lbs</th>
                        <th scope="col">Q. <?=$data['precio']?></th>
                        <th scope="col"><?=$data['pelaje']?></th>
                        <th scope="col"><?=$data['color']?></th>
                        <th scope="col"><?=$data['leche']?></th>
                        <th scope="col"><?=$data['grande']?></th>
                        <th scope="col"><?=$data['protectora']?></th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php endif ?>
    </div>

    </div>
    <br><br>
    <hr>

    <div class="container text-center">
        <?php if (isset($elegidos)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" colspan="8">las ovejas elegidas para el camion son</th>
                </tr>
                <tr>
                    <th scope="col" colspan="3">ovejas</th>
                    <th scope="col" colspan="5">cromosomas</th>
                </tr>
                <tr>
                    <th scope="col">No. Oveja</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Pelaje</th>
                    <th scope="col">Color</th>
                    <th scope="col">Leche</th>
                    <th scope="col">Grande</th>
                    <th scope="col">protectora</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($elegidos as $i => $data): ?>
                    <tr>
                        <th scope="col"><?=$i+1?></th>
                        <th scope="col"><?=$data['peso']?> lbs</th>
                        <th scope="col">Q. <?=$data['precio']?></th>
                        <th scope="col"><?=$data['pelaje']?></th>
                        <th scope="col"><?=$data['color']?></th>
                        <th scope="col"><?=$data['leche']?></th>
                        <th scope="col"><?=$data['grande']?></th>
                        <th scope="col"><?=$data['protectora']?></th>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <p>El peso total de las elegidas es <?=$pesoTotal?></p>
        <?php endif ?>
    </div>

</body>
</html>