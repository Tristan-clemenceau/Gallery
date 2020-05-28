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
	array_push($linkJS, "Public/JS/home.js");
	$title = $multilingualArray['homeView'][$_SESSION['lang']]['pageTitle'];
}

$_SESSION['page'] = "56872ee8a82e5b999541244e318f5e9945a7e95835c47fc54deb0788f708ad61";?>

<?php ob_start(); ?>
<!--[INCLUDE HEADER NORMAL] -->
<?php include('HeaderNormal.php'); ?>
	<!-- [MODAL] -->
	<!-- [MODAL-CONNEXION] -->
	<div class="modal fade" id="modalConnexion" tabindex="-1" role="dialog" aria-labelledby="modalConnexionTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="modalConnexionTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionTitle']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="connexionInputUsername"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionInputUsername']; ?></label>
	            <input type="text" class="form-control" id="connexionInputUsername" placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionInputUsername']; ?>" required>
	            <label for="connexionInputPassword" class="mt-2"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionInputPassword']; ?></label>
	            <input type="password" class="form-control" id="connexionInputPassword" placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionInputPassword']; ?>" required>
	          </div>
	          <div id="alert_connexion" class="alert alert-info fade show" role="alert">
	            <p id="alert_connexion_message" class="text-center"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionAlertMessage']; ?></p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_connexion" ><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalConnexionBtn']; ?></button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-REGISTER] -->
	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="modalRegisterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="modalRegisterTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterTitle']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="registerInputUsername"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterInputUsername']; ?></label>
	            <input type="text" class="form-control" id="registerInputUsername"  placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterInputUsername']; ?>" required>
	          </div>
	          <div class="form-group">
	            <label for="registerInputPassword"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterInputPassword']; ?></label>
	            <input type="password" class="form-control" id="registerInputPassword" placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterInputPassword']; ?>"  required>
	            <label for="confirmRegisterInputPassword"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterInputPasswordConfirm']; ?></label>
	            <input type="password" class="form-control" id="confirmRegisterInputPassword" placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterInputPasswordConfirm']; ?>"  required>
	          </div>
	          <div id="alert_register" class="alert alert-info fade show" role="alert">
	            <p id="alert_register_message" class="text-center"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterAlertMessage']; ?></p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_register"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalRegisterBtn']; ?></button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-SEARCH] -->
	<div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="ModalSearchTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchTitle']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="searchInputUsername"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchInputUsername']; ?></label>
	            <input type="text" class="form-control" id="searchInputUsername"  placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchInputUsername']; ?>" required>
	            <label for="searchInputGallery" class="mt-2"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchInputGallery']; ?></label>
	            <input type="text" class="form-control" id="searchInputGallery" placeholder="<?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchInputGallery']; ?>"  required>
	          </div>
	          <div id="alert_search" class="alert alert-info fade show" role="alert">
	            <p id="alert_search_message" class="text-center"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchAlertMessage']; ?></p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_search"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['modalSearchBtn']; ?></button>
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
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<button class="btn btn-primary  "onclick="location.href='#decouvrir'" type="button"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderBtn']; ?></button>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="Public/Images/Pictures/Slide_02.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<button class="btn btn-primary  "onclick="location.href='#decouvrir'" type="button"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderBtn']; ?></button>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="Public/Images/Pictures/Slide_03.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<button class="btn btn-primary  "onclick="location.href='#decouvrir'" type="button"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderBtn']; ?></button>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="Public/Images/Pictures/Slide_04.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<button class="btn btn-primary  "onclick="location.href='#decouvrir'" type="button"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['sliderBtn']; ?></button>
			      		</div>
				    </div>
				  </div>
				</div>
  			</div>
  		</div>
  	</div>
  	<hr class="text-white m-3 whiteLine">
  	<h1 class="display-3 font-weight-bold text-center" id="decouvrir"><span class="titleContent"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['bigTitle']; ?></span></h1>
  	<div class="container-fluid">
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardTitle01']; ?> <span class="backgroundOrange" ><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardOrangeText01']; ?></span></h2>
          		<p class="lead"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardContent01']; ?></p>
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block specialImg " src="Public/Images/Pictures/mesGalleries.PNG" alt="">
  			</div>
  		</div>
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block specialImg" src="Public/Images/Pictures/RechercherGallerie.PNG" alt="">
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardTitle02']; ?> <span class="backgroundOrange"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardOrangeText02']; ?></span></h2>
          		<p class="lead"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardContent02']; ?></p>
  			</div>
  		</div>
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardTitle03']; ?> <span class="backgroundOrange"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardOrangeText03']; ?></span></h2>
          		<p class="lead"><?php echo $multilingualArray['homeView'][$_SESSION['lang']]['cardContent03']; ?></p>
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block specialImg" src="Public/Images/Pictures/ajouterPost.PNG" alt="">
  			</div>
  		</div>
  	</div>
  	<hr class="text-white m-3 whiteLine">
  	<!--[INCLUDE FOOTER NORMAL] -->
  	<?php include('FooterNormal.php'); ?>
  </body>

<?php $content = ob_get_clean(); ?>
<?php require('View/template.php');?>