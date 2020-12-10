<?php
session_start();
include("./php/connect.php");

$tournois = $bdd->query('SELECT t.*, j.LibelleJeux, u.pseudo FROM ((tournois t LEFT JOIN jeux j ON t.Jeux = j.IdJeux) LEFT JOIN utilisateurs u ON t.IdUserOrganisateur = u.idUtilisateur)');
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $tournois = $bdd->query('SELECT t.*, j.LibelleJeux, u.pseudo FROM ((tournois t LEFT JOIN jeux j ON t.Jeux = j.IdJeux) LEFT JOIN utilisateurs u ON t.IdUserOrganisateur = u.idUtilisateur) WHERE t.nom LIKE "%'.$search.'%" OR j.LibelleJeux LIKE "%'.$search.'%" ');
}
$count = $tournois->rowCount();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Rejoindre un tournoi</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main1.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/konpa/devicon@master/devicon.min.css">

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
                    <h2 class="text-center">Rejoindre un tournoi</h2>
                    <form action="./joinTournament.php" id="searchForm" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Rechercher par nom ou par jeux" name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    Rechercher
                                </button>
                            </div>
                        </div>
                    </form>
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
                            $reqVerifTournoi = $bdd->query('select p.idTournois from participation p left join roles r on p.IdEquipe = r.idEquipe left join utilisateurs u on u.idUtilisateur = r.idUtilisateur where u.idUtilisateur = '.$_SESSION['id']. ' AND IdTournois = '.$donnees['idTournois']);
                            $countVerifTournoi = $reqVerifTournoi->rowCount();

                            $reqEquipe = $bdd->query('SELECT COUNT(*) AS nbEquipe FROM participation p INNER JOIN tournois t ON t.idTournois = p.IdTournois WHERE t.IdTournois = '.$donnees['idTournois']);
                            $nbEquipe = $reqEquipe->fetch();
                            ?>

                            <div class="card" style="width: 500px; margin-left: 100px; margin-bottom: 50px">
                                <h3 class="card-header" style="color:black"><?= $donnees['Nom'] ?></h3>
                                <div class="card-body" style="color:black;">
                                    Organisateur : <?= $donnees['pseudo'] ?><br>
                                    Jeu : <?= $donnees['LibelleJeux'] ?><br>
                                    Date / Heure : <?= $donnees['DateHeure'] ?><br>
                                    Nombre Equipe : <?= $nbEquipe['nbEquipe'] ?> / <?= $donnees['NombreEquipe'] ?><br>
                                    Nombre Personne / Equipe : <?= $donnees['NombrePersonneEquipe'] ?><br><br>
                                    <?php

                                        if($nbEquipe['nbEquipe'] >= $donnees['NombreEquipe']) {
                                            ?><button class="btn btn-primary col-md-8 offset-md-2 disabled">Complet</button><?php
                                        }
                                        if($countVerifTournoi > 0) {
                                            ?><button class="btn btn-primary col-md-8 offset-md-2 disabled">Vous participez déjà</button><?php
                                        }
                                        else {
                                            ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="joinTournoi" value="<?= $donnees['idTournois'].'-'.$donnees['NombrePersonneEquipe'] ?>">
                                                    <button class="btn btn-primary col-md-8 offset-md-2">Rejoindre</button>
                                                    <Label style="font-size: 0.6em; margin-top: 15px">Pour inscrire votre équipe vous devez être le chef.</label>
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
                        echo "Aucun résultat pour : ".$search;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php
if(isset($_POST['joinTournoi'])) {
    $valueJoinTournoi = explode("-", $_POST['joinTournoi']);
    $equipes = $bdd->prepare('SELECT e.* FROM roles r left join equipes e ON r.idEquipe = e.idEquipe WHERE idUtilisateur = ? and LibelleRole = \'1\' AND e.NbMembres = ? AND (select count(*) from roles where idEquipe = e.idEquipe) = ? ');
    $equipes->execute(array($_SESSION['id'], $valueJoinTournoi[1], $valueJoinTournoi[1]));
    $idTournoi = $valueJoinTournoi[0];
    $countEquipes = $equipes->rowCount();
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Vous voulez participez à ce tournoi avec quelle équipe :</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color: black">

                <?php
                if(isset($equipes)) {
                    if ($countEquipes) {
                        while ($donneesEquipes = $equipes->fetch()) {
                            $membreEquipe = $bdd->prepare('SELECT Pseudo, LibelleRole FROM utilisateurs u inner join roles r where u.idUtilisateur = r.idUtilisateur AND r.idEquipe = ? order by LibelleRole desc');
                            $membreEquipe->execute(array($donneesEquipes['idEquipe']));
                            ?>
                            <br>
                            <div class='equipe'>
                                <div class='row'>
                                    <div class='info-principal offset-md-1 col-md-10 col-10 border' id='info-principal-<?= $donneesEquipes['idEquipe'] ?>' style="cursor: pointer">
                                        <div class="module-border-wrap">
                                            <div class='module'>
                                                <div class='row'>
                                                    <div class='col-md-8 col-8'>
                                                        <label1>Nom d'équipe : <?= $donneesEquipes['LibelleEquipe'] ?> <?= $donneesEquipes['idEquipe'] ?></label1>
                                                        <br>
                                                        <label1>Tag de l'équipe : <?= $donneesEquipes['Marque'] ?></label1>
                                                    </div>
                                                    <div class='col-md-4 col-4'>
                                                        <div class='float-right'>
                                                            <label class='expand<?= $donneesEquipes['idEquipe'] ?>'><i class="fas fa-expand-alt fa"></i></label>
                                                            <label class='compress<?= $donneesEquipes['idEquipe'] ?>' hidden><i class="fas fa-compress-alt"></i></label>
                                                            <label><a href='' class="inscriptionLien" data-toggle="popover" data-trigger="hover" data-content="Valider votre inscription" data-placement="right" id="<?= $idTournoi.'-'.$donneesEquipes['idEquipe'] ?>"><i class="fas fa-check" style="color: green"></i></a></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='offset-md-1 col-md-10 col-10 border' id='info-secondaire-<?= $donneesEquipes['idEquipe'] ?>' hidden>
                                        <div class="module-border-wrap">
                                            <div class='module'>
                                                <div class='row'>
                                                    <?php
                                                    while ($membre = $membreEquipe->fetch()) {
                                                        if($membre['LibelleRole'] == "1") {
                                                            $titre = 'Chef';
                                                        }
                                                        else {
                                                            $titre = 'Membre';
                                                        }
                                                        ?>
                                                        <?= $titre; ?> : <?= $membre['Pseudo'] ?> <br>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else {
                        ?>  Vous n'êtes pas chef d'équipe d'une équipe de <?php echo $valueJoinTournoi[1]." personnes ou votre équipe n'a pas assez de membres pour y participer";
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

<?php
    if(isset($_POST['joinTournoi'])) {
        ?> <script>$('#exampleModal').modal('show')</script> <?php
    }
?>

<script>
    $('.info-principal').click(function(){
        var numero = $(this).attr('id');
        var result = numero.split('-');
        if($('#info-secondaire-' + result[2]).attr('hidden'))
        {
            $('#info-secondaire-' + result[2]).removeAttr("hidden");
            $('.expand' + result[2]).attr('hidden', true);
            $('.compress' + result[2]).removeAttr('hidden');
        }
        else
        {
            $('#info-secondaire-' + result[2]).attr("hidden", true);
            $('.compress' + result[2]).attr('hidden', true);
            $('.expand' + result[2]).removeAttr('hidden');
        }
    });

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
    });

    $('.inscriptionLien').click(function(e){
        e.preventDefault();
       let donneesInscription = $(this).attr('id');
       let donneesInscriptionSplit = donneesInscription.split("-");
       let idTournoi = donneesInscriptionSplit[0];
       let idEquipe = donneesInscriptionSplit[1];

        $.post(
            './php/inscriptionTournoi',
            {
                idTournoi: idTournoi,
                idEquipe: idEquipe
            },

            function(data){
                if(data == 'erreur') {
                    alert('erreur')
                }
                else {
                    window.location.href = './joinTournament.php';
                }
            }
        );
    });
</script>

</body>
</html>

