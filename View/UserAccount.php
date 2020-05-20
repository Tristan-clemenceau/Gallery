<?php
/*IMPORT*/ 
require_once('Model/Multilingual.php');
require_once('Model/Person.php');
require_once('Model/Member.php');
require_once('Model/MemberDAO.php');
require_once('Model/Gallery.php');
require_once('Model/GalleryDAO.php');

if (!isset($_SESSION['member'])) {
	header("Location: index.php");
	exit();
}

$_SESSION['page'] = "7f8e4897734363243e7b7078605ebf76f2af57e673168f83b8476176fd869a79";

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	header("Location: index.php");
	exit();
}else{
	array_push($linkCSS, "Public/CSS/default.css");
	array_push($linkJS, "Public/JS/member.js");
	$title = $multilingualArray['userAccount'][$_SESSION['lang']]['pageTitle'];
}
/*GET DATA*/
$galleryDAO = new GalleryDAO();
$memberDAO = new MemberDAO();
$_SESSION['member']->setArrOwned($galleryDAO->getGalleriesOwnedFromIdUser($_SESSION['member']->getId()));
$_SESSION['member']->setArrGallery($galleryDAO->getGalleriesMemberFromIdUser($_SESSION['member']->getId()));

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
				<h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchTitle']; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="searchInputUsername"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchInputUsername']; ?></label>
						<input type="text" class="form-control" id="searchInputUsername" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchInputUsername']; ?>" required>
						<label for="searchInputGallery" class="mt-2"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchInputGallery']; ?></label>
						<input type="text" class="form-control" id="searchInputGallery" placeholder="<?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchInputGallery']; ?>" aria-describedby="passHelp" required>
					</div>
					<div id="alert_search" class="alert alert-info fade show" role="alert">
						<p id="alert_search_message" class="text-center"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchAlertMessage']; ?></p>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_search"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalSearchBtn']; ?></button>
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
				<h5 class="mt-2 navFontSize text-center" id="ModalGalleryTitle"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalGalleryTitle']; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="galleryInputName"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalGalleryInputGallery']; ?></label>
						<input type="text" class="form-control" id="galleryInputName" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalGalleryInputGallery']; ?>" required>
					</div>
					<div id="alert_gallery" class="alert alert-info fade show" role="alert">
						<p id="alert_gallery_message" class="text-center"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalGalleryAlertMessage']; ?></p>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_gallery_create"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['modalGalleryBtn']; ?></button>
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
					<h1 class=" font-weight-bold text-center" ><span class="titleContent"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteTitle']; ?></span></h1>
				</div>
				<div class="card-body backgroundDarkGrey">
					<div class="input-group mb-3 justify-content-center ">
						<input id="field_username" type="text" class=" text-center borderBleue backgroundDarkGrey" placeholder="<?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteInputUsername']; ?>" aria-label="Recipient's username" aria-describedby="btn_modifier_username">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary btn-lg borderBleue" type="button" id="btn_modifier_username"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteBtnModify']; ?></button>
						</div>
					</div>
					<div class="input-group mb-3 justify-content-center">
						<input id="field_password" type="Password" class=" text-center backgroundDarkGrey borderBleue" placeholder="<?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteInputPassword']; ?>" aria-label="Recipient's username" aria-describedby="btn_modifier_password">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary btn-lg backgroundDarkGrey borderBleue" type="button" id="btn_modifier_password"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteBtnModify']; ?></button>
						</div>
					</div>
					<div id="alert_modification" class="alert alert-info fade show" role="alert">
						<p id="alert_modification_message"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteAlertMessage']; ?></p>
					</div>
					<a href="#" id="btn_exporter"><button type="button" class="btn btn-outline-secondary btn-lg backgroundDarkGrey borderBleue"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteBtnExport']; ?></button></a>
					<a href="#" id="btn_supprimer"><button type="button" class="btn btn-outline-secondary btn-lg backgroundDarkGrey borderBleue" data-toggle="modal" data-target="#modalConfirmation"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardCompteBtnDelete']; ?></button></a>
				</div>
				<div class="card-footer text-muted backgroundOrange">
					<p class="text-white navFontSize"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['memberSince']; ?><?php echo date_format($_SESSION['member']->getRegistationDate(),"d/m/Y"); ?></p>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card text-center m-5 borderBleue">
				<div class="card-header backgroundOrange">
					<h1 class=" font-weight-bold text-center" ><span class="titleContent"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardDonneTitle']; ?></span></h1>
				</div>
				<div class="card-body backgroundDarkGrey">
					<div class="container-fluid">
						<div class="row">
							<div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb gallery]-->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardDonneLabelNbGalleries']; ?></div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo (count($_SESSION['member']->getArrOwned())+count($_SESSION['member']->getArrGallery()));?></div>
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
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardDonneLabelNbPost']; ?></div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo $memberDAO->getNbPost($_SESSION['member']->getId()); ?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-sticky-note fa-2x textBleue"></i>
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
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardDonneLabelNbGalleriesOwned']; ?></div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo count($_SESSION['member']->getArrOwned());?></div>
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
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardDonneLabelNbGalleriesJoined']; ?></div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo count($_SESSION['member']->getArrGallery());?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-users fa-2x textBleue"></i>
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
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['cardDonneLabelNbGalleriesMaxMember']; ?></div>
												<div class="h5 mb-0 font-weight-bold textBleue"><?php echo $memberDAO->getNbMaxMemberOfOwnedGallery($_SESSION['member']->getId()); ?></div>
											</div>
											<div class="col-auto">
												<i class="fas fa-users fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-muted backgroundOrange">
					<p class="text-white navFontSize"><?php echo $multilingualArray['userAccount'][$_SESSION['lang']]['memberSince']; ?><?php echo date_format($_SESSION['member']->getRegistationDate(),"d/m/Y"); ?></p>
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