<?php
$servername="localhost";
$username = "root";
$password = "";
$DBname = "esports";
$idEquipeCurrent=0;
$nbreEquipeMax=1;



$connexion = mysqli_connect($servername,$username,$password,$DBname);

if(!$connexion){
    die("La connexion a échoué: " .mysqli_connect_error());
}

$requete = "SELECT * from equipes";
$req2 = "SELECT * from utilisateurs";// requête
$equipes = $connexion->query($requete); // envoi de la requête


mysqli_close($connexion);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>PHPJabbers.com | Free Computer Store Website Template</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
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
            <li class="active"> <a href="index.html">Home </a> </li>

            <li><a href="index.html">Other</a></li>
            <li><a href="about-us.html">About Us</a></li>
            <li><a href="teams.html">Team</a></li>
            <li><a href="testimonials.html">Testimonials</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="terms.html">Terms</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main" class="alt container-fluid col-md-6">

        <!-- One -->
        <section id="one">
            <div class="inner">
                <header class="major">
                    <h1 class="align-center">Ajouter une équipe:</h1>
                    <div class="align-right">
                    </div>
                </header>
            </div>
        </section>

        <!-- Featured Products -->
        <section class="tiles ">
            <form method="post" action="equipes.php">
                <div class="mb-3">
                    <label for="nomEquipe" class="form-label">Nom de l'équipe</label>
                    <input type="text" class="form-control" id="nomEquipe" name="nomEquipe" required>

                </div>
                <div class="mb-3">
                    <label for="marque" class="form-label">Tag</label>
                    <input type="text" class="form-control" id="tag" name="tag" required>

                </div>
                <div class="mb-3">
                    <label for="nbremax" class="form-label">Nombre max de l'équipe</label>
                    <input type="number" class="form-control" id="nbremax" min="1" name="nbremax" required>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
                <button  class="btn btn-danger onclick="window.location.href='equipes.php';">Annuler</button>
            </form>

        </section>

    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <ul class="icons">
                <li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>
            </ul>
            <ul class="copyright">
                <li>Copyright © 2020 Company Name - Template by:</li>
                <li> <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></li>
            </ul>
        </div>
    </footer>

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