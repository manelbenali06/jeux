<?php
    // afficher le nombre d'utilisateurs
    $reqUtilisateurs = $bdd->query('SELECT count(*) AS nb_utilisateurs FROM utilisateur');
    $nbUtilisateurs = $reqUtilisateurs->fetch();
    
    // afficher le nombre de jeux
    $reqJeux = $bdd->query('SELECT count(*) AS nb_jeux FROM jeu');
    $nbJeux = $reqJeux->fetch();

    // afficher le nombre d'associations
    $reqAssociations = $bdd->query('SELECT count(*) AS nb_associations FROM association_utilisateur_jeu');
    $nbAssociations = $reqAssociations->fetch();

    // afficher les jeux n'ayant pas d'utilisateur
    $reqJsu = $bdd->query('SELECT j.nom FROM jeu AS j WHERE j.id_jeu NOT IN ( SELECT id_jeu FROM association_utilisateur_jeu AS a)');
    $jeuxSansUtilisateurs = $reqJsu->fetchAll();

    // afficher les jeux possédés par sachou
    $reqJeuxSachou = $bdd->query('SELECT nom FROM association_utilisateur_jeu AS a INNER JOIN jeu AS j on j.id_jeu = a.id_jeu INNER JOIN utilisateur AS u ON u.id_utilisateur = a.id_utilisateur WHERE u.pseudo = \'sachou\'');
    $jeuxSachou = $reqJeuxSachou->fetchAll();
?>

<h2>Bienvenue</h2>

<ul>Quelques informations :
    <li>nombre d'utilisateurs : <?= $nbUtilisateurs['nb_utilisateurs'] ?></li>
    <li>nombre de jeux : <?= $nbJeux['nb_jeux'] ?></li>
    <li>nombre d'associations : <?= $nbAssociations['nb_associations'] ?></li>
    <li>jeux n'ayant pas d'utilisateur :
        <?php
            $i = 0;
            for ($i = 0; $i < count($jeuxSansUtilisateurs); $i++) {
                echo $jeuxSansUtilisateurs[$i]['nom'];
                if ($i < count($jeuxSansUtilisateurs) -1) {
                    echo ', ';
                }
            }
        ?>
    </li>
    <li>jeux possédés par sachou :
        <?php
            $i = count($jeuxSachou);
            for ($i = 0; $i < count($jeuxSachou); $i++) {
                echo $jeuxSachou[$i]['nom'];
                if ($i < count($jeuxSachou) -1) {
                    echo ', ';
                }
            }
        ?>
    </li>
</ul>