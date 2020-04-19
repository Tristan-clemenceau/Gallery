<?php
/*IMPORT*/ 
require_once('Model/Multilingual.php');
require_once('Model/Person.php');
require_once('Model/Member.php');

if (!isset($_SESSION['member'])) {
	header("Location: index.php");
	exit();
}


/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
	header("Location: index.php");
	exit();
}else{
	array_push($linkCSS, "Public/CSS/default.css");
	array_push($linkJS, "Public/JS/home.js");
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
		<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active pr-5">
					<a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalSearch"><i class="fas fa-search"></i> Recherche</a>
				</li>
				<li class="nav-item active pr-5">
					<a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalConnexion"><i class="fas fa-image"></i> Gallery</a>
				</li>
				<li class="nav-item dropdown pr-5">
					<a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo $_SESSION['member']->getLogin();?></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item navFontSize" type="button" href="index.php?action=userAccount">Mon compte</a>
						<a class="dropdown-item navFontSize" type="button" href="index.php?action=logout">Log out</a>
					</div>
				</li>
				<li class="nav-item dropdown pr-5">
					<a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> Langues</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item navFontSize" type="button" href="index.php?action=lang&lang=fr">Français</a>
						<a class="dropdown-item navFontSize" type="button" href="index.php?action=lang&lang=en">Anglais</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
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
							<div class="col-xl-3 col-md-6 mb-4"><!--col-sm-12 col-md-12 col-lg-12 col-xl-12 -->
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Gallery Owned</div>
												<div class="h5 mb-0 font-weight-bold textBleue">2</div>
											</div>
											<div class="col-auto textBleue">
												<i class="fas fa-image fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Gallery Member</div>
												<div class="h5 mb-0 font-weight-bold textBleue">40</div>
											</div>
											<div class="col-auto">
												<i class="fas fa-users fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Max member</div>
												<div class="h5 mb-0 font-weight-bold textBleue">40</div>
											</div>
											<div class="col-auto">
												<i class="fas fa-users fa-2x textBleue"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-md-6 mb-4">
								<div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
									<div class="card-body">
										<div class="row no-gutters align-items-center">
											<div class="col mr-2">
												<div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Max post</div>
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
					<a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalConnexion"><i class="fas fa-image"></i> Gallery</a>
				</h6>
			</div>
			<div class="col-md-2 mb-3">
				<h6>
					<div class="dropup">
						<a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo $_SESSION['member']->getLogin();?></a>
						<div class="dropdown-menu">
							<!-- Dropdown menu links -->
							<a class="dropdown-item navFontSize" type="button" href="index.php?action=userAccount">Mon compte</a>
							<a class="dropdown-item navFontSize" type="button" href="index.php?action=logout">Log out</a>
						</div>
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
<?php require('template.php');?>