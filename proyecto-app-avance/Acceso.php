<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso</title>
</head>

<body>
    <div class="text-center">
        <?php
        include '../Controller/AccesoController.php';
        $controller = new AccesoController();
        $controller->mostrar_qr();
        ?>
    </div>
</body>

</html>