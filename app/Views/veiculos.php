<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veiculos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <p class="h1">Veiculos</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Valor</th>
            <th scope="col">Cota</th>
            <th scope="col">Mensalidade</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($veiculos as $veiculo): ?>
            <tr>
                <th scope="row"><?= esc($veiculo['id']) ?></th>
                <td><?= esc($veiculo['valor']) ?></td>
                <td><?= esc($veiculo['cota']) ?></td>
                <td><?= esc($veiculo['mensalidade']) ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>