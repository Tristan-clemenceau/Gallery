<?php
/*IMPORT*/ 
require_once('Model/Multilingual.php');
/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	echo "session unset";
}else{
	array_push($linkCSS, "Public/CSS/default.css");
	$title = $multilingualArray['homeView'][$_SESSION['lang']]['title'];
}
ob_start();?>
<!-- [NAVBAR] -->
	<nav class="navbar navbar-expand-lg sticky-top">
	    <div class="container-fluid">
	      	<a class="navbar-brand" href="#">
     			<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
     			<span class="text-white navFontSize">Gallery</span>
  			</a>
	      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="text-white"><i class="fas fa-bars fa-1x"></i></span>
	  		</button>
		    <div class="collapse navbar-collapse" id="navbarSupportedContent">
		        <ul class="navbar-nav ml-auto">
		        	<li class="nav-item active pr-5">
			            <a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalSearch"><i class="fas fa-search"></i> Recherche</a>
			        </li>
			        <li class="nav-item active pr-5">
			            <a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalConnexion"><i class="fas fa-user"></i> Connexion</a>
			        </li>
			        <li class="nav-item pr-5">
			            <a class="nav-link text-white navFontSize"data-toggle="modal" data-target="#modalRegister"><i class="fas fa-user-edit"></i> S'enregistrer</a>
			        </li>
			        <li class="nav-item dropdown pr-5">
			            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> Langues</a>
			            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
			              <a class="dropdown-item navFontSize" type="button" href="index.php?action=test&lang=fr">Français</a>
			              <a class="dropdown-item navFontSize" type="button" href="index.php?action=test&lang=en">Anglais</a>
			            </div>
          			</li>
		        </ul>
		    </div>
	    </div>
	</nav>
	<!-- [MODAL] -->
	<!-- [MODAL-CONNEXION] -->
	<div class="modal fade" id="modalConnexion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="exampleModalCenterTitle">Connexion</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form><!--action="Register" method="post"-->
	          <div class="form-group">
	            <label for="registerInputUsername">Username</label>
	            <input type="text" class="form-control" id="registerInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required><!-- name="registerInputUsername" -->
	            <label for="registerInputPassword" class="mt-2">Password</label>
	            <input type="password" class="form-control" id="registerInputPassword" placeholder="Password" aria-describedby="passHelp" required><!-- name="registerInputPassword" -->
	          </div>
	          <div id="alert_register" class="alert alert-info fade show" role="alert">
	            <p id="alert_register_message" class="text-center">Tous les champs doivent êtres remplis</p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary">Connexion</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-REGISTER] -->
	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="exampleModalCenterTitle">Register</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form><!--action="Register" method="post"-->
	          <div class="form-group">
	            <label for="registerInputEmail">Email address</label>
	            <input type="text" class="form-control" id="registerInputEmail" aria-describedby="emailHelp" placeholder="Enter email" required><!-- name="registerInputEmail" -->
	            <label for="registerInputUsername">Username</label>
	            <input type="text" class="form-control" id="registerInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required><!-- name="registerInputUsername" -->
	          </div>
	          <div class="form-group">
	            <label for="registerInputPassword">Password</label>
	            <input type="password" class="form-control" id="registerInputPassword" placeholder="Password" aria-describedby="passHelp" required><!-- name="registerInputPassword" -->
	            <label for="confirmRegisterInputPassword">Confirm Password</label>
	            <input type="password" class="form-control" id="confirmRegisterInputPassword" placeholder="Confirm password" aria-describedby="passHelp" required><!-- name="confirmRegisterInputPassword" -->
	          </div>
	          <div id="alert_register" class="alert alert-info fade show" role="alert">
	            <p id="alert_register_message" class="text-center">Tous les champs doivent êtres remplis</p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary">S'enregistrer</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-SEARCH] -->
	<div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="exampleModalCenterTitle">Search</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form><!--action="Register" method="post"-->
	          <div class="form-group">
	            <label for="registerInputUsername">Username</label>
	            <input type="text" class="form-control" id="registerInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required><!-- name="registerInputUsername" -->
	            <label for="registerInputPassword" class="mt-2">Gallery</label>
	            <input type="password" class="form-control" id="registerInputPassword" placeholder="Enter Gallery name" aria-describedby="passHelp" required><!-- name="registerInputPassword" -->
	          </div>
	          <div id="alert_register" class="alert alert-info fade show" role="alert">
	            <p id="alert_register_message" class="text-center">Tous les champs doivent êtres remplis</p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary">Recherche</button>
	      </div>
	    </div>
	  </div>
	</div>
  	<!-- [CONTENT] -->
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
  				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
				  </ol>
				  <div class="carousel-inner">
				    <div class="carousel-item active">
				      <img src="Public/Images/Pictures/Slide_01.jpg" class="d-block w-100" alt="...">
				      	<div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle">Gallery en ligne</span> </h1>
			        		<p class="display-4 itemBoxContent">Grâce à ce site il vous est possible de créer votre gallery et d'y ajouter vos posts. Pour en savoir plus cliquez sur le bouton en savoir plus.</p>
			        		<button type="button" class="btn btn-primary ju">Primary</button>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="Public/Images/Pictures/Slide_02.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle">Gallery en ligne</span> </h1>
			        		<p class="display-4 itemBoxContent">Grâce à ce site il vous est possible de créer votre gallery et d'y ajouter vos posts. Pour en savoir plus cliquez sur le bouton en savoir plus.</p>
			        		<button type="button" class="btn btn-primary ju">Primary</button>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="Public/Images/Pictures/Slide_03.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle">Gallery en ligne</span> </h1>
			        		<p class="display-4 itemBoxContent">Grâce à ce site il vous est possible de créer votre gallery et d'y ajouter vos posts. Pour en savoir plus cliquez sur le bouton en savoir plus.</p>
			        		<button type="button" class="btn btn-primary ju">Primary</button>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="Public/Images/Pictures/Slide_04.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle">Gallery en ligne</span> </h1>
			        		<p class="display-4 itemBoxContent">Grâce à ce site il vous est possible de créer votre gallery et d'y ajouter vos posts. Pour en savoir plus cliquez sur le bouton en savoir plus.</p>
			        		<button type="button" class="btn btn-primary ju">Primary</button>
			      		</div>
				    </div>
				  </div>
				</div>
  			</div>
  		</div>
  	</div>
  	<hr class="text-white m-3 whiteLine">
  	<h1 class="display-3 font-weight-bold text-center" ><span class="titleContent">Examples d'utilisation</span></h1>
  	<div class="container-fluid">
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading">First featurette heading. <span class="backgroundOrange" >It'll blow your mind.</span></h2>
          		<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block" src="Public/Images/Pictures/Pictures01.jpg" alt="">
  			</div>
  		</div>
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block" src="Public/Images/Pictures/Pictures01.jpg" alt="">
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading">First featurette heading. <span class="backgroundOrange">It'll blow your mind.</span></h2>
          		<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  			</div>
  		</div>
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading">First featurette heading. <span class="backgroundOrange">It'll blow your mind.</span></h2>
          		<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block" src="Public/Images/Pictures/Pictures01.jpg" alt="">
  			</div>
  		</div>
  	</div>
  	<hr class="text-white m-3 whiteLine">
  	<!--<form action="Controller/register.php" method="POST">
  			<label for="fname">First name:</label><br>
  			<input type="text" id="fname" name="fname" value="John"><br>
  			<label for="lname">Last name:</label><br>
  			<input type="text" id="lname" name="lname" value="Doe"><br><br>
  			<input type="submit" value="Submit">
	</form>-->
	<!-- [FOOTER] -->
	<footer class="sticky-bottom">
    <div class="container-fluid padding">
    <div class="row text-center d-flex justify-content-center pt-5 mb-3">
      <div class="col-md-2 mb-3">
        <h6>
          <a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalSearch"><i class="fas fa-search"></i> Recherche</a>
        </h6>
      </div>
      <div class="col-md-2 mb-3">
        <h6>
          <a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalConnexion"><i class="fas fa-user"></i> Connexion</a>
        </h6>
      </div>
      <div class="col-md-2 mb-3">
        <h6>
          <div class="dropup">
             <a class="nav-link text-white navFontSize"data-toggle="modal" data-target="#modalRegister"><i class="fas fa-user-edit"></i> S'enregistrer</a>
          </div>
        </h6>
      </div>
      <div class="col-md-2 mb-3">
        <h6>
          <div class="dropup">
            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> Langues</a>
              <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a href="#" class="dropdown-item navFontSize">Français</a>
                <a href="#" class="dropdown-item navFontSize">Anglais</a>
              </div>
          </div>
        </h6>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-md-12">
        <hr id="hr_footer">
        <ul class="list-inline list-unstyled">
          <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-github fa-2x"></i></a></li>
          <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-facebook-square fa-2x"></i></a></li>
          <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a></li>
          <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-youtube-square fa-2x"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  </footer>
  </body>

<?php $content = ob_get_clean(); ?>
<?php require('View/template.php');?>