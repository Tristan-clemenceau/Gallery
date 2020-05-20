<?php
/*IMPORT*/ 
require_once('../Model/Multilingual.php');
require_once('../Model/Person.php');
require_once('../Model/Member.php');

session_start();
if (!isset($_SESSION['member'])) {
	header("Location: index.php");
	exit();
}

$_SESSION['page'] = "aae48327bf1546a57399a8be29d5db613efaf801054053f7458e94b9a4f9e828";

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	header("Location: index.php");
	exit();
}else{
	array_push($linkCSS, "../Public/CSS/default.css");
	array_push($linkJS, "../Public/JS/member.js");
	$title = $multilingualArray['userView'][$_SESSION['lang']]['pageTitle'];
}
ob_start();?>
<!--[INCLUDE HEADER USER] -->
<?php include('HeaderUser.php'); ?>
	<!-- [MODAL] -->
	<!-- [MODAL-SEARCH] -->
	<div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="ModalSearchTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchTitle']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="searchInputUsername"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchInputUsername']; ?></label>
	            <input type="text" class="form-control" id="searchInputUsername" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchInputUsername']; ?>" required>
	            <label for="searchInputGallery" class="mt-2"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchInputGallery']; ?></label>
	            <input type="text" class="form-control" id="searchInputGallery" placeholder="<?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchInputGallery']; ?>" aria-describedby="passHelp" required>
	          </div>
	          <div id="alert_search" class="alert alert-info fade show" role="alert">
	            <p id="alert_search_message" class="text-center"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchAlertMessage']; ?></p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_search"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalSearchBtn']; ?></button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-GALLERY] -->
	<div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-labelledby="ModalGalleryTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="ModalGalleryTitle"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalGalleryTitle']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="galleryInputName"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalGalleryInputGallery']; ?></label>
	            <input type="text" class="form-control" id="galleryInputName" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalGalleryInputGallery']; ?>" required>
	          </div>
	          <div id="alert_gallery" class="alert alert-info fade show" role="alert">
	            <p id="alert_gallery_message" class="text-center"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalGalleryAlertMessage']; ?></p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_gallery_create"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['modalGalleryBtn']; ?></button>
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
				      <img src="../Public/Images/Pictures/Slide_01.jpg" class="d-block w-100" alt="...">
				      	<div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<a href="#decouvrir"><button type="button" class="btn btn-primary "><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderBtn']; ?></button></a>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="../Public/Images/Pictures/Slide_02.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<a href="#decouvrir"><button type="button" class="btn btn-primary "><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderBtn']; ?></button></a>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="../Public/Images/Pictures/Slide_03.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<a href="#decouvrir"><button type="button" class="btn btn-primary "><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderBtn']; ?></button></a>
			      		</div>
				    </div>
				    <div class="carousel-item">
				      <img src="../Public/Images/Pictures/Slide_04.jpg" class="d-block w-100" alt="...">
				      <div class="carousel-caption d-none d-md-block">
			        		<h1 class="display-1 font-weight-bold"><span class="itemBoxTitle"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderTitle']; ?></span> </h1>
			        		<p class="display-4 itemBoxContent"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderContent']; ?></p>
			        		<a href="#decouvrir"><button type="button" class="btn btn-primary "><?php echo $multilingualArray['userView'][$_SESSION['lang']]['sliderBtn']; ?></button></a>
			      		</div>
				    </div>
				  </div>
				</div>
  			</div>
  		</div>
  	</div>
  	<hr class="text-white m-3 whiteLine">
  	<h1 class="display-3 font-weight-bold text-center" id="decouvrir"><span class="titleContent"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['bigTitle']; ?></span></h1>
  	<div class="container-fluid">
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardTitle01']; ?> <span class="backgroundOrange" ><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardOrangeText01']; ?></span></h2>
          		<p class="lead"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardContent01']; ?></p>
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block specialImg" src="../Public/Images/Pictures/mesGalleries.PNG" alt="">
  			</div>
  		</div>
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block specialImg" src="../Public/Images/Pictures/RechercherGallerie.PNG" alt="">
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardTitle02']; ?> <span class="backgroundOrange"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardOrangeText02']; ?></span></h2>
          		<p class="lead"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardContent02']; ?></p>
  			</div>
  		</div>
  		<div class="row pt-5">
  			<div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 text-center my-auto">
  				<h2 class="featurette-heading"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardTitle03']; ?> <span class="backgroundOrange"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardOrangeText03']; ?></span></h2>
          		<p class="lead"><?php echo $multilingualArray['userView'][$_SESSION['lang']]['cardContent03']; ?></p>
  			</div>
  			<div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
  				<img class="img-responsive center-block specialImg" src="../Public/Images/Pictures/ajouterPost.PNG" alt="">
  			</div>
  		</div>
  	</div>
  	<hr class="text-white m-3 whiteLine">
	<!--[INCLUDE FOOTER USER] -->
  	<?php include('FooterUser.php'); ?>
  </body>

<?php $content = ob_get_clean(); ?>
<?php require('template.php');?>