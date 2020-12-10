<?php
session_start();
include('php/connect.php');

$tournois = $bdd->query('select p.idTournois, t.* from participation p left join roles r on p.IdEquipe = r.idEquipe left join utilisateurs u on u.idUtilisateur = r.idUtilisateur left join tournois t on p.IdTournois = t.idTournois where u.idUtilisateur = '.$_SESSION['id'].' order by DateHeure');
$count = $tournois->rowCount();

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Mes tournois</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main1.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

</head>
<body class="is-preload">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header" class="alt">
        <a href="index.html" class="logo"><strong>Computer Store</strong> <span>Website</span></a>
        <nav>
            <a href="#menu">Menu</a>
        </nav>
    </header>

    <!-- Menu -->
    <nav id="menu">
        <ul class="links">
            <li> <a href="index.html">Home </a> </li>

            <li> <a href="jobs.html">Jobs</a> </li>

            <li> <a href="blog.html">Blog</a> </li>

            <li> <a href="about-us.html">About Us</a> </li>

            <li><a href="team.html">Team</a></li>

            <li class="active"><a href="testimonials.html">Testimonials</a></li>

            <li><a href="terms.html">Terms</a></li>

            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="" class="alt">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-center">Mes tournois</h2>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="container-fluid">
            <div class="row">
                <?php
                if(isset($tournois)) {
                    if($count > 0) {
                        while ($donnees = $tournois->fetch()) {
                            $reqPseudoUser = $bdd->query('select Pseudo from utilisateurs where idUtilisateur = '.$donnees['IdUserOrganisateur']);
                            $pseudo = $reqPseudoUser->fetch();

                            $reqLibelleJeu = $bdd->query('select LibelleJeux from jeux where IdJeux = '. $donnees['Jeux']);
                            $libelleJeu = $reqLibelleJeu->fetch();

                            $reqEquipe = $bdd->query('SELECT COUNT(*) AS nbEquipe FROM participation p INNER JOIN tournois t ON t.idTournois = p.IdTournois WHERE t.IdTournois = '.$donnees['idTournois']);
                            $nbEquipe = $reqEquipe->fetch();


                            $dateTournoi = (new \DateTime($donnees['DateHeure']));
                            $dateNow = new DateTime("now",new DateTimeZone('Europe/Paris'));
                            ?>

                            <div class="card" style="width: 500px; margin-left: 100px; margin-bottom: 50px">
                                <h3 class="card-header" style="color:black"><?= $donnees['Nom'] ?></h3>
                                <div class="card-body" style="color:black;">
                                    Organisateur : <?= $pseudo['Pseudo'] ?><br>
                                    Jeu : <?= $libelleJeu['LibelleJeux'] ?><br>
                                    Date / Heure : <?= $donnees['DateHeure'] ?><br>
                                    Nombre Equipe : <?= $nbEquipe['nbEquipe'] ?> / <?= $donnees['NombreEquipe'] ?><br>
                                    Nombre Personne / Equipe : <?= $donnees['NombrePersonneEquipe'] ?><br><br>
                                    <?php

                                    if($dateNow > $dateTournoi) {
                                        ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="joinTournoi" value="<?= $donnees['idTournois'].'-'.$donnees['NombrePersonneEquipe'] ?>">
                                            <button class="btn btn-primary col-md-8 offset-md-2">Voir le tournoi</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    else {
                        ?>
                        <div class="alert alert-danger col-md-4 offset-md-4 text-center" role="alert">
                            Vous n'êtes inscrit à aucun tournois.
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>

<?php
if(isset($_POST['nameTournament'])) {
    $insertTournament = $bdd->prepare('INSERT INTO tournois (Nom, DateHeure, NombreEquipe, NombrePersonneEquipe, LienInvitation Jeux) VALUES (?, ?, ?, ?, ?)');
    $insertTournament->execute(array($_POST['nameTournament'], $_POST['date'], $_POST['nbTeams'], $_POST['nbPers_Teams'], $_POST['jeux']));
    ?> <script> $('#insertsuccess').removeAttr('hidden'); </script><?php
}
?>
