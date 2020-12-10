<?php
session_start();
include('php/connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Créer un tournoi</title>
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
            <div class="d-flex justify-content-center h-100">
                <div class="card" style="width: 600px">
                    <div class="card-header">
                        <h3 style="color:black">Création d'un tournoi</h3>
                    </div>
                    <div class="card-body">
                        <form action="./createTournament.php" method="post">

                            <div class="form-group">
                                <label for="nameTournament">Nom du tournoi :</label>
                                <input type="text" class="form-control" id="nameTournament" name="nameTournament" required>
                            </div>

                            <div class="form-group">
                                <label for="game">Jeu :</label>
                                <select class="form-control" id="game" name="jeux" required>
                                    <option selected disabled value="">Choisissez un jeu</option>
                                    <?php

                                    $req = $bdd->query('SELECT * FROM jeux');

                                    while ($donnees = $req->fetch()) {
                                        echo "<option value='".$donnees['IdJeux']."'>".$donnees['LibelleJeux']."</option>";
                                    }

                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nbTeam">Nombre d'équipes pour le tournoi :</label>
                                <input type="number" min="2" step="2" class="form-control" id="nbTeam" name="nbTeams" required>
                            </div>

                            <div class="form-group">
                                <label for="nbPers_Teams">Nombre personnes par équipes :</label>
                                <input type="number" min="1" class="form-control" id="nbPers_Teams" name="nbPers_Teams" required>
                            </div>

                            <div class="form-group">
                                <label for="time">Date début du tournoi :</label>
                                <input type="datetime-local" class="form-control" id='time' name='date' required/>
                            </div>

                            <div id='insertsuccess' class="alert alert-success col-md-12 text-center" role="alert" hidden>
                                Le tournoi a bien été créé !
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Créer le tournoi</button>
                            </div>
                        </form>
                    </div>
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
    $insertTournament = $bdd->prepare('INSERT INTO tournois (Nom, DateHeure, NombreEquipe, NombrePersonneEquipe, Jeux, IdUserOrganisateur) VALUES (?, ?, ?, ?, ?, ?)');
    $insertTournament->execute(array($_POST['nameTournament'], $_POST['date'], $_POST['nbTeams'], $_POST['nbPers_Teams'], $_POST['jeux'], $_SESSION['id_User']));
    ?> <script> $('#insertsuccess').removeAttr('hidden'); </script><?php
}
?>
