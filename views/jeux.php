<?php
    $req = $bdd->query('SELECT * FROM jeu');
    $jeux = $req->fetchAll();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        $reqGame = $bdd->prepare('SELECT * FROM jeu WHERE id_jeu=:id');
        $reqGame->bindParam(':id', $id, PDO::PARAM_INT);
        $reqGame->execute();
        $game = $reqGame->fetch();
    }
?>

<h2>Liste des jeux</h2>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Éditeur</th>
            <th>Joueurs</th>
            <th>Durée</th>
            <th>Âge</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach ($jeux as $jeu) {
                $i++;
        ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $jeu['nom'] ?></td>
                    <td><?= $jeu['categorie'] ?></td>
                    <td><?= $jeu['editeur'] ?></td>
                    <td><?= $jeu['joueurs_min'] ?> - <?= $jeu['joueurs_max'] ?></td>
                    <td><?= $jeu['duree'] ?></td>
                    <td><?= $jeu['age_minimum'] ?> an(s)</td>
                    <td>
                        <a href="index.php?page=jeux&id=<?= $jeu['id_jeu'] ?>">edit</a> - 
                        <a href="controllers/traitement.php?jeu-delete=<?= $jeu['id_jeu'] ?>" class="suppression">del</a>
                    </td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<hr>

<h2>Formulaire</h2>

<form action="controllers/traitement.php?jeu-<?= isset($game) ? 'update=' . $game['id_jeu'] : 'create' ?>" method="post">
    <label for="nom">Nom</label>
    <input type="text" name="nom" maxlength="45" value="<?= isset($game) ? $game['nom'] : null ?>" required>
    <label for="categorie">Catégorie</label>
    <input type="text" name="categorie" maxlength="45" value="<?= isset($game) ? $game['categorie'] : null ?>" required>
    <label for="editeur">Éditeur</label>
    <input type="text" name="editeur" maxlength="45" value="<?= isset($game) ? $game['editeur'] : null ?>" required>
    <label for="joueurs_min">Joueurs minimum</label>
    <input type="number" name="joueurs_min" min="1" max="99" step="1" value="<?= isset($game) ? $game['joueurs_min'] : null ?>">
    <label for="joueurs_max">Joueurs maximum</label>
    <input type="number" name="joueurs_max" min="1" max="99" step="1" value="<?= isset($game) ? $game['joueurs_max'] : null ?>">
    <label for="duree">Durée</label>
    <input type="time" name="duree" value="<?= isset($game) ? $game['duree'] : null ?>">
    <label for="age_minimum">Âge minimum</label>
    <input type="number" name="age_minimum" min="0" max="99" step="1" value="<?= isset($game) ? $game['age_minimum'] : null ?>">
    <input type="submit" value="envoyer">
</form>