<!--[LANG FR/EN]-->
<!-- [HEADER USER] -->
<nav class="navbar navbar-expand-lg sticky-top">
	    <div class="container-fluid">
	      	<a class="navbar-brand" href="UserView.php">
     			<img id ="logo" src="#" width="50" height="50" alt="Logo">
     			<span class="text-white navFontSize">Gallery</span>
  			</a>
	      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="text-white"><i class="fas fa-bars fa-1x"></i></span>
	  		</button>
		    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
		        <ul class="navbar-nav ml-auto">
		        	<li class="nav-item active pr-5">
			            <a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalSearch"><i class="fas fa-search"></i> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['recherche']; ?></a>
			        </li>
			        <li class="nav-item dropdown pr-5">
			            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdownGallery" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-image"></i> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['galleries']; ?></a>
			            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownGallery">
			              <a class="dropdown-item navFontSize" data-toggle="modal" data-target="#modalGallery"> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['creerGalleries']; ?></a>
			              <a class="dropdown-item navFontSize galleryLinkAuto" href=""> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['mesGalleries']; ?></a>
			            </div>
          			</li>
			        <li class="nav-item dropdown pr-5">
			            <a class="nav-link dropdown-toggle text-white navFontSize" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo $_SESSION['member']->getLogin();?></a>
			            <div class="dropdown-menu dropdown-menu-right" >
			              <a  class="dropdown-item navFontSize accountLinkAuto" href=""> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['moncompte']; ?></a>
			              <a class="dropdown-item navFontSize logoutLinkAuto" href=""> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['deconnexion']; ?></a>
			            </div>
          			</li>
			        <li class="nav-item dropdown pr-5">
			            <a class="nav-link dropdown-toggle text-white navFontSize" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['langue']; ?></a>
			            <div class="dropdown-menu dropdown-menu-right" >
			              <a class="dropdown-item navFontSize langLinkAuto" href="">FR</a>
			              <a class="dropdown-item navFontSize langLinkAuto" href="">EN</a>
			            </div>
          			</li>
		        </ul>
		    </div>
	    </div>
	</nav>