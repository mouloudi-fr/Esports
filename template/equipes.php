<?php
$servername="localhost";
$username = "root";
$password = "";
$DBname = "esports";

$idEquipeCurrent=3;
$nbPerson=0;
$idUserCurrent=1;



$connexion = mysqli_connect($servername,$username,$password,$DBname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nomEquipe = $_POST['nomEquipe'];
    $tag = $_POST['tag'];
    $nbremax = $_POST['nbremax'];
// commentaire
   // print $nomEquipe. " ".$tag."  ".$nbremax;

    if (!isset($nomEquipe)){
        die("S'il vous plaît donnez un nom à votre équipe");
    }
    if (!isset($tag)){
        die("S'il vous plaît entrez un tag");
    }
    if(!isset($nbremax)){
        $nbremax = 1;
    }

    $mysqli = new mysqli($servername, $username, $password, $DBname);

    //Afficher toute erreur de connexion
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }


    $req="INSERT INTO equipes VALUES (NULL ,'$nomEquipe','$tag','$nbremax')";


    $res = $mysqli->query($req);
    $idEquipe=$mysqli->insert_id;

    if($res){
        echo //'<div class="alert-success">Votre équipe a été ajouté avec succéss</div>';
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Votre équipe a été ajouté avec succéss.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        $req2="INSERT INTO roles VALUES ('$idUserCurrent',$idEquipe,'1')";
        $res2=$mysqli->query($req2);
    }
    else{
         //'<div class="alert-warning"> Oups!! Merci de saisir tous les champs</div>';
      /* ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oups!!</strong>  Merci de saisir tous les champs.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';*/
        echo $mysqli->error;
    }

    mysqli_close($mysqli);
}


if(!$connexion){
    die("La connexion a échoué: " .mysqli_connect_error());
}

$requete ="SELECT equipes.idEquipe,equipes.LibelleEquipe,equipes.Marque,equipes.NbMembres,roles.LibelleRole FROM equipes INNER JOIN roles ON equipes.idEquipe=roles.idEquipe INNER JOIN utilisateurs ON utilisateurs.idUtilisateur=roles.idUtilisateur WHERE utilisateurs.idUtilisateur=$idUserCurrent  ";
$req2 = "SELECT  COUNT(utilisateurs.idUtilisateur) AS nbreJoueurs
FROM utilisateurs INNER JOIN roles on utilisateurs.idUtilisateur=roles.idUtilisateur INNER JOIN equipes on equipes.idEquipe=roles.idEquipe
WHERE equipes.idEquipe=50";
$equipes = $connexion->query($requete);
$response= $connexion->query($req2);
$nbPerson=$response->fetch_assoc();
 echo $nbPerson['nbreJoueurs'];



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
					<div id="main" class="alt container-fluid">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<header class="major">
										<h1>Mes équipes:</h1>
                                        <div class="align-right">
                                           <button class="btn btn-block " onclick="window.location.href='addteam.php';">Ajouter une équipe</button>
                                        </div>
									</header>
								</div>
							</section>

							<!-- Featured Products -->
							<section class="tiles">
                                <?php
                                    while ($row = $equipes->fetch_assoc()) {

                                        echo '<article>
									<span class="image">
										<img src="images/product-1-720x480.jpg" alt="" />
									</span>
									<header class="major">
                                                                 
										<h3>'.$row['LibelleEquipe'].'</h3>
										
										<p><strong><h4>"'.$row['Marque'].'</h4></strong></p>
                                
										<p><h4>/'.$row['NbMembres'].'</h4></p>
                                        
										<div class="major-actions">
										  <a href="team_details.php?team='.$row['idEquipe'].'" class="button small next">Afficher</a> 
										</div>
										<div class="major-actions">
											<a href="team_details.php?rejoindre='.$row['idEquipe'].'" class="button small next">Rejoindre</a> 
										</div>
									</header>
								</article>';
                                 }
                                 ?>

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