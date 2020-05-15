<?php
/*IMPORT*/ 
require_once('../Model/Multilingual.php');
require_once('../Model/Person.php');
require_once('../Model/Member.php');
require_once('../Model/Connection.php');
require_once('../Model/MemberDAO.php');
require_once('../Model/Gallery.php');
require_once('../Model/GalleryDAO.php');

if (!isset($_GET['loginUser'])) {
	header("Location: ../index.php");
	exit();
}

session_start();

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	header("Location: ../index.php");
	exit();
}else{
	array_push($linkCSS, "../Public/CSS/default.css");
	array_push($linkJS, "../Public/JS/home.js");
	$title = $multilingualArray['searchUser'][$_SESSION['lang']]['title'];
}
$member = new Member();
$galleryDAO = new GalleryDAO();
$memberDao = new MemberDAO();
$member = $memberDao->searchByLogin($_GET['loginUser']);
$member->setArrOwned($galleryDAO->getGalleriesOwnedFromIdUser($member->getId()));
$member->setArrGallery($galleryDAO->getGalleriesMemberFromIdUser($member->getId()));

ob_start();?>

<!--[INCLUDE HEADER] -->
<?php
	if(!isset($_SESSION['member']) && !isset($_SESSION['admin'])){/*ADMIN and User*/
		/*HEADER NORMAL*/
		include('HeaderNormal.php');
	}elseif (isset($_SESSION['member']) && !isset($_SESSION['admin'])) {
		/*HEADER USER*/
		include('HeaderUser.php');
	}elseif(!isset($_SESSION['member']) && isset($_SESSION['admin'])){
		/*HEADER ADMIN*/
		include('HeaderAdmin.php');
	}else{
		/*ERREUR*/
		include('HeaderNormal.php'); 
	}
?>

	<!-- [MODAL] -->
	<!-- [MODAL-CONNEXION] -->
	<div class="modal fade" id="modalConnexion" tabindex="-1" role="dialog" aria-labelledby="modalConnexionTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="modalConnexionTitle">Connexion</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form><!--action="Register" method="post"-->
	          <div class="form-group">
	            <label for="connexionInputUsername">Username</label>
	            <input type="text" class="form-control" id="connexionInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required><!-- name="registerInputUsername" -->
	            <label for="connexionInputPassword" class="mt-2">Password</label>
	            <input type="password" class="form-control" id="connexionInputPassword" placeholder="Password" aria-describedby="passHelp" required><!-- name="registerInputPassword" -->
	          </div>
	          <div id="alert_connexion" class="alert alert-info fade show" role="alert">
	            <p id="alert_connexion_message" class="text-center">Tous les champs doivent êtres remplis</p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_connexion" >Connexion</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-REGISTER] -->
	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="modalRegisterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="modalRegisterTitle">Register</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form><!--action="Register" method="post"-->
	          <div class="form-group">
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
	            <p id="alert_register_message" class="text-center">Tous les champs doivent êtres remplis et les deux mots de passes doivent correspondre</p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_register">S'enregistrer</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- [MODAL-SEARCH] -->
	<div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="ModalSearchTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered " role="document">
	    <div class="modal-content backgroundDarkGrey">
	      <div class="modal-header">
	      	<img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
	        <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle">Search</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form><!--action="Register" method="post"-->
	          <div class="form-group">
	            <label for="searchInputUsername">Username</label>
	            <input type="text" class="form-control" id="searchInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required><!-- name="registerInputUsername" -->
	            <label for="searchInputGallery" class="mt-2">Gallery</label>
	            <input type="text" class="form-control" id="searchInputGallery" placeholder="Enter Gallery name" aria-describedby="passHelp" required><!-- name="registerInputPassword" -->
	          </div>
	          <div id="alert_search" class="alert alert-info fade show" role="alert">
	            <p id="alert_search_message" class="text-center">Vous devez remplir un des deux champs afin d'effectuer une recherche</p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_search">Recherche</button>
	      </div>
	    </div>
	  </div>
	</div>
<!-- [CONTENT] -->
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card text-center m-5 borderBleue">
				<div class="card-header backgroundOrange">
					<h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase"><?php echo $member->getLogin(); ?></span></h1>
				</div>
				<div class="card-body backgroundDarkGrey">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb gallery]-->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Number of Gallery</div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo (count($member->getArrOwned())+count($member->getArrGallery()));?></div>
											</div>
											<div class="col-auto textBleue">
												<i class="fas fa-image fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb post]-->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Number post</div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo $memberDao->getNbPost($member->getId()); ?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-users fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb gallery owned]-->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Gallery owned</div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo count($member->getArrOwned());?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-users fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb gallery member]-->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Gallery member</div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo count($member->getArrGallery());?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-sticky-note fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-12 col-md-6 mb-4"><!--[nb max member]-->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Max member</div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo $memberDao->getNbMaxMemberOfOwnedGallery($member->getId()); ?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-sticky-note fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-muted backgroundOrange">
					<p class="text-white navFontSize">Membre depuis : <?php echo date_format($member->getRegistationDate(),"d/m/Y"); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<!--[INCLUDE FOOTER] -->
<?php
	if(!isset($_SESSION['member']) && !isset($_SESSION['admin'])){/*ADMIN and User*/
		/*HEADER NORMAL*/
		include('FooterNormal.php');
	}elseif (isset($_SESSION['member']) && !isset($_SESSION['admin'])) {
		/*HEADER USER*/
		include('FooterUser.php');
	}elseif(!isset($_SESSION['member']) && isset($_SESSION['admin'])){
		/*HEADER ADMIN*/
		include('FooterAdmin.php');
	}else{
		/*ERREUR*/
		include('FooterNormal.php'); 
	}
?>
</body>

<?php $content = ob_get_clean(); ?>
<?php require('template.php');?>