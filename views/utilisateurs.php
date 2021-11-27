<?php
    $req = $bdd->query('SELECT * FROM utilisateur');
    $utilisateurs = $req->fetchAll();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = (int)$_GET['id'];
        $reqUser = $bdd->prepare('SELECT * FROM utilisateur WHERE id_utilisateur=:id');
        $reqUser->bindParam(':id', $id, PDO::PARAM_INT);
        $reqUser->execute();
        $user = $reqUser->fetch();
    }
?>

<h2>Liste des utilisateurs</h2>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 0;
            foreach ($utilisateurs as $utilisateur) { 
                $i++;
        ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $utilisateur['pseudo'] ?></td>
                <td><?= $utilisateur['email'] ?></td>
                <td>
                    <a href="index.php?page=utilisateurs&id=<?= $utilisateur['id_utilisateur'] ?>">edit</a> - 
                    <a href="controllers/traitement.php?utilisateur-delete=<?= $utilisateur['id_utilisateur'] ?>" class="suppression">del</a>
                </td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>

<hr>

<h2>Formulaire</h2>

<form action="controllers/traitement.php?utilisateur-<?= isset($user) ? 'update=' . $user['id_utilisateur'] : 'create' ?>" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" maxlength="100" value="<?= isset($user) ? $user['email'] : null ?>" required>
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" maxlength="25" value="<?= isset($user) ? $user['pseudo'] : null ?>" required>
    <input type="submit" value="envoyer">
</form>