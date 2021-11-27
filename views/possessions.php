<?php
    $req = $bdd->query('SELECT * FROM association_utilisateur_jeu AS a
                        INNER JOIN utilisateur AS u ON a.id_utilisateur = u.id_utilisateur
                        INNER JOIN jeu AS j ON a.id_jeu = j.id_jeu
                        ORDER BY u.pseudo ASC, j.nom ASC');
    $associations = $req->fetchAll();

    if (isset($_GET['id']) && $_GET['id'] !== NULL) {
        $id = (int)($_GET['id']);
        $reqOwnership = $bdd->prepare('SELECT * FROM association_utilisateur_jeu INNER JOIN utilisateur ON association_utilisateur_jeu.id_utilisateur = utilisateur.id_utilisateur INNER JOIN jeu ON association_utilisateur_jeu.id_jeu = jeu.id_jeu WHERE id_association = :id');
        $reqOwnership->bindParam(':id', $id, PDO::PARAM_INT);
        $reqOwnership->execute();
        $ownership = $reqOwnership->fetch();
    }

    $reqUtilisateur = $bdd->query('SELECT * FROM utilisateur');
    $utilisateurs = $reqUtilisateur->fetchAll();

    $reqJeu = $bdd->query('SELECT * FROM jeu');
    $jeux = $reqJeu->fetchAll();
?>

<h2>Liste des possessions</h2>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Utilisateur</th>
            <th>Jeu</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach ($associations as $association) {
                $i++;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $association['pseudo'] ?></td>
                <td><?= $association['nom'] ?></td>
                <td>
                    <a href="index.php?page=possessions&id=<?= $association['id_association'] ?>">edit</a> - 
                    <a href="controllers/traitement.php?association-delete=<?= $association['id_association'] ?>">delete</a>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<hr>

<h2>Formulaire</h2>

<form action="controllers/traitement.php?association-<?= isset($ownership) ? 'update=' . $ownership['id_association'] : 'create' ?>" method="post">

    <label for="utilisateur">Utilisateur</label>
    <select name="utilisateur" required>
        <option value="">-- sélectionner un utilisateur --</option>
        <?php foreach ($utilisateurs as $utilisateur) { ?>
            <option value="<?= $utilisateur['id_utilisateur'] ?>" <?= isset($ownership) && $ownership['id_utilisateur'] === $utilisateur['id_utilisateur']  ? 'selected' : null ?>>
                <?= $utilisateur['id_utilisateur'] . ' - ' . $utilisateur['pseudo'] ?>
            </option>
        <?php } ?>
    </select>

    <label for="jeu"></label>
    <select name="jeu" required>
        <option value="">-- sélectionner un jeu --</option>
        <?php foreach ($jeux as $jeu) { ?>
            <option value="<?= $jeu['id_jeu'] ?>" <?= isset($ownership) && $ownership['id_jeu'] === $jeu['id_jeu']  ? 'selected' : null ?>>
                <?= $jeu['id_jeu'] . ' - ' . $jeu['nom'] ?>
            </option>
        <?php } ?>
    </select>

    <input type="submit" value="envoyer">

</form>