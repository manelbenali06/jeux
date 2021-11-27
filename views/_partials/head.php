<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">

<title>
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
</title>

<link rel="stylesheet" href="css/style.css">