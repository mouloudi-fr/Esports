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
		                <li> <a href="index.html">Home </a> </li>

		                <li> <a href="jobs.html">Jobs</a> </li>

		                <li> <a href="blog.html">Blog</a> </li>

		                <li class="active"> <a href="about-us.php">About Us</a> </li>

		                <li><a href="team.html">Team</a></li>

		                <li><a href="testimonials.html">Testimonials</a></li>

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
										<h1>Connexion</h1>
									</header>
									<span class="image main"><img src="images/about-fullscreen-1-1920x700.jpg" alt="" /></span>



										<?php
                        if(isset($_GET['login_err']))
                        {
                          $err = htmlspecialchars($_GET['login_err']);

                          switch($err)
                          {
                            case 'password':
                              ?>
										<div class="alert alert-danger">
											<strong>Erreur</strong> : Mot de passe incorrect
										</div>
										<?php
                              break;

                            case 'email':
                              ?>
										<div class="alert alert-danger">
											<strong>Erreur</strong> : Email incorrect
										</div>
										<?php
                              break;

                            case 'already':
                              ?>
										<div class="alert alert-danger">
											<strong>Erreur</strong> : Compte non existant
										</div>
										<?php
                              break;
                          }
                        }
                      ?>

							</section>

					</div>

                <div class="more-info about-info">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="more-info-content">
                                    <div class="row">
                                        <div class="col-md-12 align-self-center">
                                            <div class="right-content">
                                                <div class="login-form">

                <form action="connexion_traitement.php" method="post">

                    <h2>Identifie-toi :</h2>
                    <div class="form-group">
                        <input type="email" name="mail" class="form-control" placeholder="Adresse mail" required="required" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                    </div>
                </form>
                <p class="text-center"><a href="inscription.php">Inscription</a></p>
            </div>
        </div>
        </div>

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <br><br>

<!--				<!-- Footer -->-->
<!--				<footer id="footer">-->
<!--					<div class="inner">-->
<!--						<ul class="icons">-->
<!--							<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>-->
<!--							<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>-->
<!--							<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>-->
<!--							<li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>-->
<!--						</ul>-->
<!--						<ul class="copyright">-->
<!--							<li>Copyright © 2020 Company Name - Template by:</li>-->
<!--							<li> <a href="https://www.phpjabbers.com/">PHPJabbers.com</a></li>-->
<!--						</ul>-->
<!--					</div>-->
<!--				</footer>-->
<!---->
<!--			</div>-->
<!---->
<!--		<!-- Scripts -->-->
<!--			<script src="assets/js/jquery.min.js"></script>-->
<!--			<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!--			<script src="assets/js/jquery.scrolly.min.js"></script>-->
<!--			<script src="assets/js/jquery.scrollex.min.js"></script>-->
<!--			<script src="assets/js/browser.min.js"></script>-->
<!--			<script src="assets/js/breakpoints.min.js"></script>-->
<!--			<script src="assets/js/util.js"></script>-->
<!--			<script src="assets/js/main.js"></script>-->

	</body>
</html>