<?php

require_once ("xena/Validator.php");

@$nom = secure_donnees($_POST['nom']);
@$prenom = secure_donnees($_POST['prenom']);
@$date = secure_donnees($_POST['date']);
@$genre = secure_donnees($_POST['genre']);
@$langages = secure_donnees($_POST['langages']);
@$email = secure_donnees($_POST['mail']);
@$password = secure_donnees($_POST['password']);
@$renew = secure_donnees($_POST['renew']);

@$valider = $_POST['valider'];

if (isset($valider)) {
    /* code de vérification et de validation */
    $validator=new UniValidator();
    $validator->is_valide("alphabetic",$nom);
    $validator->is_valide("alphabetic",$prenom);
    $validator->is_valide("mail",$email);
    $validator->is_valide("date",$date);
    $validator->is_valide("password",$password);
    $validator->is_valide("password",$renew);
    $validator->is_same($password, $renew);

    $errors= $validator->status();


    /* si pas d'erreur on créer les objets user et infos*/
    if (count($errors)==0){
        $user=new User($nom, $prenom, $date, $genre);
        $infos= new Infos($email, $password, $langages);
        $user->setInfos($infos);
    }
}

$langages_tab = [
    "C#",
    "JAVA",
    "Javascript",
    "SQL",
    "PHP",
    "HTML/CSS",
];

$genre_tab = [
    "Masculin",
    "Féminin"
];

function secure_donnees($donnees)
{
    /*$donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);*/
    return $donnees;
}

function list_langages($list)
{
    $ch = "";
    if (isset($list)) {
        foreach ($list as $langage) {
            $ch .= "<li>" . $langage . "</li>";
        }
    }
    return $ch;
}

function isChecked_genre($val, $comp)
{
    return ($val == $comp ? "checked" : "");
}

function isChecked_langages($val, $tab)
{
    $ret = "";
    if (isset($tab)) {
        if (sizeof($tab) != 0) {
            $ret = in_array($val, $tab) ? "checked" : "";
        }
    }
    return $ret;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="formulaire.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <form action="" method="POST">
        <fieldset class="expand">
            <legend class="float-none w-auto">Etat civil</legend>
            <div class="mb-3 input-group">
                <span class="input-group-text">Nom</span>
                <input class="form-control" name="nom" value="<?= $nom ?>">
                <span class="input-group-text">Prénom</span>
                <input class="form-control" name="prenom" value="<?= $prenom ?>">
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text">Date</span>
                <input class="form-control" type="date" name="date" value="<?= $date ?>"/>
            </div>
        </fieldset>
        <div class="mb-3">
            <fieldset class="p-2" name="Genre">
                <legend class="float-none w-auto">Genre</legend>
                <input class="form-check-input" type="radio" name="genre" <?= isChecked_genre($genre_tab[0], $genre); ?>
                       value="<?= $genre_tab[0]; ?>"><span class="label"><?= $genre_tab[0]; ?></span></input>
                <input class="form-check-input" type="radio" name="genre" <?= isChecked_genre($genre_tab[1], $genre); ?>
                       value="<?= $genre_tab[1]; ?>"><span class="label"><?= $genre_tab[1]; ?></span></input>
            </fieldset>
        </div>
        <div class="mb-3">
            <fieldset class="expand">
                <legend class="float-none w-auto">Langages</legend>
                <?php foreach ($langages_tab as $item) { ?>
                    <input class="form-check-input" type="checkbox" name="langages[]" <?= isChecked_langages($item, $langages) ?>
                           value="<?= $item ?>"><span class="label"><?= $item ?></span>
                <?php } ?>
            </fieldset>
        </div>
        <div class="mb-3">
            <fieldset name="Identifiants p-5" class="expand">
                <legend class="float-none w-auto">Identifiants</legend>
                <div class="mb-3 input-group">
                    <span class="input-group-text">Email</span>
                    <input class="form-control" type="mail" name="mail" value="<?= @$email; ?>">
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text">Mot de passe</span>
                    <input class="form-control" type="password" name="password" value="<?= @$password; ?>">
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text">Tapez à nouveau</span>
                    <input class="form-control" type="password" name="renew" value="<?= @$renew; ?>">
                </div>
            </fieldset>
        </div>
        <button type="submit" name="valider" class="btn btn-primary">Envoyer le formulaire</button>
    </form>
</div>
<card>

        <?php
        if (isset($errors)){
            foreach ( $errors as $error=>$state){
                echo "<div class='alert alert-danger'>".$error." ".$state."</div>";
            }
        }
        ?>


</card>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>