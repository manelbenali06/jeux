<?php
    require_once('config/bdd.php');
?>

<!DOCTYPE html>

<html lang="fr">

    <head>
        <?php require_once('views/_partials/head.php') ?>
    </head>

    <body>

        <header>
            <?php require_once('views/_partials/header.php') ?>
        </header>

        <main>

            <?php require_once('views/_partials/nav.php') ?>

            <div id="content">
                <?php
                    if (isset($_GET['page']) && !empty($_GET['page'])) {
                        if (file_exists('views/' . $_GET['page'] . '.php')) {
                            require_once('views/' . $_GET['page'] . '.php');
                        } else {
                            require_once('views/accueil.php');
                        }
                    } else {
                        require_once('views/accueil.php');
                    }
                ?>
            </div>

        </main>

        <footer>
            <?php require_once('views/_partials/footer.php') ?>
        </footer>

        <script src="js/script.js"></script>

    </body>

</html>