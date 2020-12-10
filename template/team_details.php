<?php


$servername="localhost";
$username = "root";
$password = "";
$DBname = "esports";
$nbreEquipeMax=1;
$idUserCurrent=3;
$idEquipeCurrent=0;
$currentParams="";




//print $idEquipeCurrent;

$connexion = mysqli_connect($servername,$username,$password,$DBname);


if($_GET["rejoindre"]) {
    $idEquipeCurrent=$_GET["rejoindre"];
    $req2 = "UPDATE roles set roles.LibelleRole=0,roles.idEquipe=$idEquipeCurrent WHERE roles.idUtilisateur=$idUserCurrent";
    $updateEquipe = $connexion->query($req2);
    if($updateEquipe){
        echo "Félicitation, vous êtes bien ajoutés à l'équipe";
    }
    else {
       echo $connexion->error;
    }
}
else{

}

if($_GET["team"]){
    $idEquipeCurrent= $_GET["team"];
    $req3= "SELECT equipes.LibelleEquipe As nom_equipe From equipes WHERE  equipes.idEquipe=$idEquipeCurrent";
    $equipe = $connexion->query($req3);
    if($equipe) echo $connexion->error;
}
else{

}

/*if($_GET["team"&"idUsers"]){
    echo "Bonjour11111111111111111111111111111111111111";
}*/

$req = "SELECT utilisateurs.idUtilisateur,utilisateurs.Nom,utilisateurs.Prenom,utilisateurs.Pseudo,utilisateurs.Discord,utilisateurs.Mail,roles.LibelleRole FROM equipes INNER JOIN roles ON equipes.idEquipe=roles.idEquipe INNER JOIN utilisateurs ON utilisateurs.idUtilisateur=roles.idUtilisateur WHERE equipes.idEquipe=$idEquipeCurrent";

 $users= $connexion->query($req); // envoi de la requête


mysqli_close($connexion);





?>
<script type="text/javascript">
    function onQuitteEquipe(){
        alert("bonjour");
    }
</script>
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
    <div id="main" class="alt">

        <!-- One -->
        <section id="one">
            <div class="inner">
                <header class="major">
                    <h1>Les membres de l'équipe <?php echo " ".$idEquipeCurrent?> </h1>
                </header>
                <div class="container">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Discord</th>
                            <th scope="col">Adresse mail</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            while($row = $users->fetch_array()) {
                                if ($row['LibelleRole'] == 1 ) { // role=1 id=1
                                    $role = "Chef de l'équipe";
                                    echo '<th scope="row">' . $row['Nom'] . '</th>
                                      <td>' . $row['Prenom'] . '</td>
                                      <td>' . $row['Pseudo'] . '</td>
                                      <td>' . $row['Discord'] . '</td>
                                      <td>' . $row['Mail'] . '</td>
                                      <td>' . $role . '</td>
                                      <td><a href="team_details.php?team=' . $idEquipeCurrent . '& idUser=' . $row['idUtilisateur'] . '" btn btn-success " >Quitter</a></td> 
                            </tr>';
                                }
                                if ($row['LibelleRole'] == 0) { //role=0 id=2,id=3
                                    $role = "Membre";
                                    if($row['idUtilisateur']!=$idUserCurrent){
                                        echo '<th scope="row">' . $row['Nom'] . '</th>
                                      <td>' . $row['Prenom'] . '</td>
                                      <td>' . $row['Pseudo'] . '</td>
                                      <td>' . $row['Discord'] . '</td>
                                      <td>' . $row['Mail'] . '</td>
                                      <td>' . $role . '</td>
                                      <td><a href="team_details.php?team=' . $idEquipeCurrent . '& idUser=' . $row['idUtilisateur'] . '" btn btn-success " >Quitter</a></td> 
                            </tr>';
                                    }
                                    if($row['idUtilisateur']==$idUserCurrent) {
                                        echo '<th scope="row">' . $row['Nom'] . '</th>
                                      <td>' . $row['Prenom'] . '</td>
                                      <td>' . $row['Pseudo'] . '</td>
                                      <td>' . $row['Discord'] . '</td>
                                      <td>' . $row['Mail'] . '</td>
                                      <td>' . $role . '</td>
                                      <td><a href="team_details.php?team=' . $idEquipeCurrent . '& idUser=' . $row['idUtilisateur'] . '" btn btn-success " >Quitter</a></td> 
                            </tr>';
                                    }

                                }
                            }
                            ?>
                        </tbody>
                    </table>



                </div>
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
