<!-- [HEADER NORMAL] -->
<nav class="navbar navbar-expand-lg sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">
			<img id="logo"src="#" width="50" height="50" alt="Logo">
			<span class="text-white navFontSize">Gallery</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="text-white"><i class="fas fa-bars fa-1x"></i></span>
		</button>
		<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active pr-5">
					<a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalSearch"><i class="fas fa-search"></i> <?php echo $multilingualArray['hfNormal'][$_SESSION['lang']]['recherche']; ?></a>
				</li>
				<li class="nav-item active pr-5">
					<a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalConnexion"><i class="fas fa-user"></i> <?php echo $multilingualArray['hfNormal'][$_SESSION['lang']]['connexion']; ?></a>
				</li>
				<li class="nav-item pr-5">
					<a class="nav-link text-white navFontSize"data-toggle="modal" data-target="#modalRegister"><i class="fas fa-user-edit"></i> <?php echo $multilingualArray['hfNormal'][$_SESSION['lang']]['enregistrement']; ?></a>
				</li>
				<li class="nav-item dropdown pr-5">
					<a class="nav-link dropdown-toggle text-white navFontSize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> <?php echo $multilingualArray['hfNormal'][$_SESSION['lang']]['langue']; ?></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item navFontSize langLinkAuto" href="">FR</a>
						<a class="dropdown-item navFontSize langLinkAuto" href="">EN</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>