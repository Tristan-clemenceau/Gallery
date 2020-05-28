<?php
/*IMPORT*/ 
require_once('Model/Multilingual.php');
require_once('Model/Person.php');
require_once('Model/Member.php');
require_once('Model/Gallery.php');
require_once('Model/GalleryDAO.php');

if (!isset($_SESSION['member'])) {
	header("Location: index.php");
	exit();
}

$_SESSION['page'] = "60bfee97a2e5f6df3b4e2eaefbf3d9f426bfe98d7768dac6ca2d5da44624d1b8";

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	header("Location: index.php");
	exit();
}else{
	array_push($linkCSS, "Public/CSS/default.css");
	array_push($linkJS, "Public/JS/member.js");
	$title = $multilingualArray['userGallery'][$_SESSION['lang']]['pageTitle'];
}

/*GET DATA*/
$galleryDAO = new GalleryDAO();
$_SESSION['member']->setArrOwned($galleryDAO->getGalleriesOwnedFromIdUser($_SESSION['member']->getId()));
$_SESSION['member']->setArrGallery($galleryDAO->getGalleriesMemberFromIdUser($_SESSION['member']->getId()));

function diplayOwnedGallery($msg){
	if (count($_SESSION['member']->getArrOwned()) == 0) {
		echo '<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase">'.$msg.'</a></div><div class="col-xl-1 col-sm-12"></div></div></div></li>';
	} else {
		foreach($_SESSION['member']->getArrOwned() as $galleryOwned){
		echo '<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase" href="View/searchGallery.php?galleryName='.$galleryOwned->getName().'">'.$galleryOwned->getName().'</a></div><div class="col-xl-1 col-sm-12"><a class="h-5 text-white text-uppercase" href="#"><i class="fas fa-times fa-2x textOrange "></i></a></div></div></div></li>';
		}
	}
}

function diplayMemberGallery($msg){
	if (count($_SESSION['member']->getArrGallery()) == 0) {
		echo '<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><a class="h-5 text-white text-uppercase">'.$msg.'</a></li>';
	} else {
		foreach($_SESSION['member']->getArrGallery() as $galleryMember){
			echo '<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><a class="h-5 text-white text-uppercase" href="View/searchGallery.php?galleryName='.$galleryMember->getName().'">'.$galleryMember->getName().'</a></li>';
		}
	}
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
				<h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchTitle']; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="searchInputUsername"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchInputUsername']; ?></label>
						<input type="text" class="form-control" id="searchInputUsername"  placeholder="<?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchInputUsername']; ?>" required>
						<label for="searchInputGallery" class="mt-2"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchInputGallery']; ?></label>
						<input type="text" class="form-control" id="searchInputGallery" placeholder="<?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchInputGallery']; ?>" required>
					</div>
					<div id="alert_search" class="alert alert-info fade show" role="alert">
						<p id="alert_search_message" class="text-center"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchAlertMessage']; ?></p>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_search"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalSearchBtn']; ?></button>
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
	        <h5 class="mt-2 navFontSize text-center" id="ModalGalleryTitle"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalGalleryTitle']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="galleryInputName"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalGalleryInputGallery']; ?></label>
	            <input type="text" class="form-control" id="galleryInputName" placeholder="<?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalGalleryInputGallery']; ?>" required>
	          </div>
	          <div id="alert_gallery" class="alert alert-info fade show" role="alert">
	            <p id="alert_gallery_message" class="text-center"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalGalleryAlertMessage']; ?></p>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="btn_gallery_create"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['modalGalleryBtn']; ?></button>
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
					<h1 class=" font-weight-bold text-center" ><span class="titleContent"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['cardGalleryOwnedTitle']; ?></span></h1>
				</div>
				<div class="card-body backgroundDarkGrey">
					<div class="panel panel-primary" >
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                        <ul class="list-group">
                        	<!--[PHP AUTO OWNED Gallery] -->
                        	<?php diplayOwnedGallery($multilingualArray['userGallery'][$_SESSION['lang']]['withoutGallery']); ?>
                        </ul>
                        </div>
                    </div>
				</div>
				<div class="card-footer text-muted backgroundOrange">
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="card text-center m-5 borderBleue">
				<div class="card-header backgroundOrange">
					<h1 class=" font-weight-bold text-center" ><span class="titleContent"><?php echo $multilingualArray['userGallery'][$_SESSION['lang']]['cardGalleryMemberTitle']; ?></span></h1>
				</div>
				<div class="card-body backgroundDarkGrey">
					<div class="panel panel-primary">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                        <ul class="list-group">
                        	<!--[PHP AUTO MEMBER Gallery] -->
                        	<?php diplayMemberGallery($multilingualArray['userGallery'][$_SESSION['lang']]['withoutGallery']); ?>
                        </ul>
                        </div>
                    </div>
				</div>
				<div class="card-footer text-muted backgroundOrange">
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