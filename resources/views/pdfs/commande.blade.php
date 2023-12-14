<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<style>
    table{
        width: 100%;
    }
</style>
</head>
<body>
<div style="display: flex; justify-content: space-between">
    <div>
        Nom du client: {{ $commande->client_nom }}
    </div>
    <div style="position: absolute; top: 10px; right: 15px">
        Delaie de livraison: {{ date_format(Date::create($commande->deadline), 'd/M/Y') }}
    </div>
</div>



</body>
</html>
