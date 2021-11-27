<h1>
    SQL - TP - 
    <?php
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            if (file_exists('views/' . $_GET['page'] . '.php')) {
                echo $_GET['page'];
            } else {
                 echo 'accueil';
            }
        } else {
            echo 'accueil';
        }
    ?>
</h1>