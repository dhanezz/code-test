<?php
require_once "config.php";
require_once "core/Utilities.php"
?>

<!DOCTYPE html>

<html lang="en" class="h-100" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/main.css">

    <script src="https://unpkg.com/vb-canvas/dist/vb-canvas.min.js"></script>
    <title><?php echo getenv("APP_NAME"); ?></title>
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <div class="container">
            <div class="alert-wrapper alert-fixed"></div>
            <!-- shows the content in the view -->
            <?php require_once "router.php"; ?>
        </div>
    </main>

    <!-- <footer class="footer px-3 bg-dark">
        <p class="text-light">&copy; <?php echo date("Y"); ?> Code-Test</p>
    </footer> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript">
        const alertList = document.querySelectorAll('.alert')
        alertList.forEach(function(alert) {
            new bootstrap.Alert(alert);

            let alertTimeout = alert.getAttribute('data-timeout');
            setTimeout(() => {
                bootstrap.Alert.getInstance(alert).close();
            }, +alertTimeout);
        });
    </script>
</body>

</html>