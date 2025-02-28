<?php
require_once "config.php";
?>

<!DOCTYPE html>

<html lang="de" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title><?php echo getenv("APP_NAME"); ?></title>
</head>

<body class=" d-flex flex-column h-100">
    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    Willkommen auf meiner PHP-Seite
                </a>
            </div>
        </nav>
    </header>

    <main class="flex-shrink-0">
        <div class="container">
            <!-- shows the content in the view -->
            <?php require_once "router.php"; ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <p class="text-muted">&copy; <?php echo date("Y"); ?> Code-Test</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>