<?php

require_once('../config/bdd.php');

/* **************************************** UTILISATEURS **************************************** */

    /* ******************** utilisateurs - ajout / modification ******************** */

        if (isset($_GET['utilisateur-create']) || (isset($_GET['utilisateur-update']) && !empty($_GET['utilisateur-update']))) {

            // nettoyage des données
            $email = htmlentities($_POST['email']);
            $pseudo = htmlentities($_POST['pseudo']);

            // création ou modification ?
            if (isset($_GET['utilisateur-create'])) {
                $action = 'creation';
            } else {
                $action = 'modification';
            }
            
            // gestion du message d'erruer
            $errorMessage = '<ul>Une erreur s\'est produite :';
            $valid = true;

            // vérification de la présence de l'adresse mail en BDD
            if ($action === 'creation') {
                $reqEmail = $bdd->prepare('SELECT * FROM utilisateur WHERE email=:email');
                $reqEmail->bindParam(':email', $email, PDO::PARAM_STR);
                $reqEmail->execute();
                if($reqEmail->rowCount() > 0) {
                    $errorMessage .= '<li>l\'adresse email est déjà utilisée.</li>';
                    $valid = false;
                }
            }

            // vérification de l'adresse mail
            if (empty($email) || strlen($email) > 100) {
                $errorMessage .= '<li>l\'adresse email est vide ou trop longue (maximum 100 caractères).</li>';
                $valid = false;
            }

            // vérification du pseudo
            if (empty($pseudo) || strlen($pseudo) > 25) {
                $errorMessage .= '<li>le pseudo est vide ou trop long (maximum 25 caractères).</li>';
                $valid = false;
            }

            // finalisation du message d'erreur
            $errorMessage .= '</ul>';

            // requêtes
            if ($valid === true) { // tout est ok
                if ($action === 'creation') {
                    $req = $bdd->prepare('INSERT INTO utilisateur (email, pseudo) VALUES (:email, :pseudo)'); // insertion
                } else {
                    $id = (INT)$_GET['utilisateur-update'];
                    $req = $bdd->prepare('UPDATE utilisateur SET email=:email, pseudo=:pseudo WHERE id_utilisateur=:id'); // modification
                    $req->bindParam(':id', $id, PDO::PARAM_INT);
                }
                $req->bindParam(':email', $email, PDO::PARAM_STR);
                $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
                $req->execute();
                header('Location: ../index.php?page=utilisateurs');
            } else { // une erreur a été détectée
                die($errorMessage);
            }

        }

    /* ******************** utilisateurs - suppression ******************** */

        if (isset($_GET['utilisateur-delete']) && !empty($_GET['utilisateur-delete'])) {
            $id = (INT)$_GET['utilisateur-delete'];
            $req = $bdd->query('DELETE FROM utilisateur WHERE id_utilisateur=' . $id);
            header('Location: ../index.php?page=utilisateurs');
        }

/* **************************************** JEUX **************************************** */

    /* ******************** jeux - ajout / modification ******************** */

        if (isset($_GET['jeu-create'])|| (isset($_GET['jeu-update']) && !empty($_GET['jeu-update']))) {

            // nettoyage des données
            $nom = htmlentities($_POST['nom']);
            $categorie = htmlentities($_POST['categorie']);
            $editeur = htmlentities($_POST['editeur']);
            $joueursMin = (INT)$_POST['joueurs_min'];
            $joueursMax = (INT)$_POST['joueurs_max'];
            $duree = htmlentities($_POST['duree']);
            $ageMinimum = (INT)$_POST['age_minimum'];

            // création ou modification ?
            if (isset($_GET['jeu-create'])) {
                $action = 'creation';
            } else {
                $action = 'modification';
            }
            
            if (
                strlen($nom) <= 45 &&
                strlen($categorie) <= 45 &&
                strlen($editeur) <= 45 &&
                is_int($joueursMin) && $joueursMin > 0 && $joueursMin <= 99 &&
                is_int($joueursMax) && $joueursMax > 0 && $joueursMax <= 99 &&
                is_int($ageMinimum) && $ageMinimum > 0 && $ageMinimum <= 99
            ) {
                if ($action === 'creation') {
                    $req = $bdd->prepare('INSERT INTO jeu (nom, categorie, editeur, joueurs_min, joueurs_max, duree, age_minimum) VALUES (:nom, :categorie, :editeur, :joueurs_min, :joueurs_max, :duree, :age_minimum)');
                } else {
                    $id = (int)($_GET['jeu-update']);
                    $req = $bdd->prepare('UPDATE jeu SET nom=:nom, categorie=:categorie, editeur=:editeur, joueurs_min=:joueurs_min, joueurs_max=:joueurs_max, duree=:duree, age_minimum=:age_minimum WHERE id_jeu=:id');
                    $req->bindParam(':id', $id, PDO::PARAM_INT);
                }
                $req->bindParam(':nom', $nom, PDO::PARAM_STR, 45);
                $req->bindParam(':categorie', $categorie, PDO::PARAM_STR, 45);
                $req->bindParam(':editeur', $editeur, PDO::PARAM_STR, 45);
                $req->bindParam(':joueurs_min', $joueursMin, PDO::PARAM_INT, 2);
                $req->bindParam(':joueurs_max', $joueursMax, PDO::PARAM_INT, 2);
                $req->bindParam(':duree', $duree, PDO::PARAM_STR, 8);
                $req->bindParam(':age_minimum', $ageMinimum, PDO::PARAM_INT, 2);
                $req->execute();
                header('Location: ../index.php?page=jeux');
            }

        }

    /* ******************** jeux - suppression ******************** */

        if (isset($_GET['jeu-delete']) && !empty($_GET['jeu-delete'])) {
            $id = (INT)$_GET['jeu-delete'];
            $req = $bdd->prepare('DELETE FROM jeu WHERE id_jeu=:id');
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();
            header('Location: ../index.php?page=jeux');
        }

/* **************************************** ASSOCIATIONS **************************************** */

    /* ******************** associations - ajout / modification ******************** */

        if (isset($_GET['association-create']) || (isset($_GET['association-update']) && !empty($_GET['association-update']))) {
            if (isset($_GET['association-create'])) {
                $action = 'creation';
            } else {
                $action = 'modification';
            }
            $id_utilisateur = (INT)$_POST['utilisateur'];
            $id_jeu = (INT)$_POST['jeu'];
            if ($action === 'creation') {
                $req = $bdd->prepare('INSERT INTO association_utilisateur_jeu (id_utilisateur, id_jeu) VALUES (:id_utilisateur, :id_jeu)');
            } else {
                $id = (int)($_GET['association-update']);
                $req = $bdd->prepare('UPDATE association_utilisateur_jeu SET id_utilisateur=:id_utilisateur, id_jeu=:id_jeu WHERE id_association=:id');
                $req->bindParam(':id', $id, PDO::PARAM_INT);
            }
            $req->bindParam('id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $req->bindParam('id_jeu', $id_jeu, PDO::PARAM_INT);
            $req->execute();
            header('Location: ../index.php?page=possessions');
        }

    /* ******************** associations - suppression ******************** */

        if (isset($_GET['association-delete']) && !empty($_GET['association-delete'])) {
            $id = (INT)$_GET['association-delete'];
            $req = $bdd->prepare('DELETE FROM association_utilisateur_jeu WHERE id_association=:id');
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->execute();
            header('Location: ../index.php?page=possessions');
        }

/* **************************************** ASSOCIATIONS **************************************** */

    else {
        die('Une erreur est survenue.');
    }

?>