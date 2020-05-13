<?php
/*IMPORT*/ 
require_once('Model/Multilingual.php');
require_once('Model/Person.php');
require_once('Model/Member.php');

if (!isset($_SESSION['member'])) {
	header("Location: index.php");
	exit();
}

$_SESSION['page'] = "649ffcc6b21ccd8ff7b1d5ebc43cf8c464f03990b3a28428debae4cb21166562";

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	header("Location: index.php");
	exit();
}else{
	array_push($linkCSS, "Public/CSS/default.css");
	array_push($linkJS, "Public/JS/member.js");
	$title = $multilingualArray['userAccount'][$_SESSION['lang']]['title'];
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
				<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
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
<!-- [MODAL-GALLERY] -->
<div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-labelledby="ModalGalleryTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered " role="document">
		<div class="modal-content backgroundDarkGrey">
			<div class="modal-header">
				<img src="Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
				<h5 class="mt-2 navFontSize text-center" id="ModalGalleryTitle">Gallery</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="galleryInputName">Gallery name</label>
						<input type="text" class="form-control" id="galleryInputName" aria-describedby="emailHelp" placeholder="Enter gallery name" required>
					</div>
					<div id="alert_gallery" class="alert alert-info fade show" role="alert">
						<p id="alert_gallery_message" class="text-center">Vous devez remplir le champs pour pouvoir creer votre gallerie</p>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_gallery_create">Créer</button>
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
					<h1 class=" font-weight-bold text-center" ><span class="titleContent">Mon compte</span></h1>
				</div>
				<div class="card-body backgroundDarkGrey">
					<div class="input-group mb-3 justify-content-center ">
						<input id="field_username" type="text" class=" text-center borderBleue backgroundDarkGrey" placeholder="new username" aria-label="Recipient's username" aria-describedby="btn_modifier_username">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary btn-lg borderBleue" type="button" id="btn_modifier_username">Modifier</button>
						</div>
					</div>
					<div class="input-group mb-3 justify-content-center">
						<input id="field_password" type="Password" class=" text-center backgroundDarkGrey borderBleue" placeholder="new password" aria-label="Recipient's username" aria-describedby="btn_modifier_password">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary btn-lg backgroundDarkGrey borderBleue" type="button" id="btn_modifier_password">Modifier</button>
						</div>
					</div>
					<div id="alert_modification" class="alert alert-info fade show" role="alert">
						<p id="alert_modification_message">Pour modifier une information il vous suffit de rentrer dans le champs prévu a cet effet la nouvelle information. Une fois terminé il vous suffit d'appyuer sur le bouton modifier près du champs dans lequel vous avez rentré une nouvelle information.</p>
					</div>
					<a href="#" id="btn_exporter"><button type="button" class="btn btn-outline-secondary btn-lg backgroundDarkGrey borderBleue">Exporter</button></a>
					<a href="#" id="btn_supprimer"><button type="button" class="btn btn-outline-secondary btn-lg backgroundDarkGrey borderBleue" data-toggle="modal" data-target="#modalConfirmation">supprimer</button></a>
				</div>
				<div class="card-footer text-muted backgroundOrange">
					<p class="text-white navFontSize">Membre depuis : <?php echo date_format($_SESSION['member']->getRegistationDate(),"d/m/Y"); ?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card text-center m-5 borderBleue">
				<div class="card-header backgroundOrange">
					<h1 class=" font-weight-bold text-center" ><span class="titleContent">Données</span></h1>
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
												<div class="h5 mb-0 font-weight-bold textBleue">2</div>
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
												<div class="h5 mb-0 font-weight-bold textBleue">40</div>
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
												<div class="h5 mb-0 font-weight-bold textBleue">40</div>
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
												<div class="h5 mb-0 font-weight-bold textBleue">122</div>
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
												<div class="h5 mb-0 font-weight-bold textBleue">122</div>
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
					<p class="text-white navFontSize">Membre depuis : <?php echo date_format($_SESSION['member']->getRegistationDate(),"d/m/Y"); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<!--[INCLUDE FOOTER USER] -->
<?php include('FooterUser.php'); ?>
</body>

<?php $content = ob_get_clean(); ?>
<?php require('template.php');?>