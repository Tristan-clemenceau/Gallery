<!--[LANG FR/EN]-->
<!-- [FOOTER USER] -->
<footer class="sticky-bottom">
    <div class="container-fluid padding">
    <div class="row text-center d-flex justify-content-center pt-5 mb-3">
      <div class="col-md-2 mb-3">
      
          <a class="nav-link text-white navFontSize" data-toggle="modal" data-target="#modalSearch"><i class="fas fa-search"></i> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['recherche']; ?></a>
      
      </div>
      <div class="col-md-2 mb-3">
      
          <div class="dropup">
            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-image"></i> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['galleries']; ?></a>
              <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item navFontSize" data-toggle="modal" data-target="#modalGallery"> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['creerGalleries']; ?></a>
                <a class="dropdown-item navFontSize galleryLinkAuto" href=""> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['mesGalleries']; ?></a>
              </div>
          </div>
      </div>
      <div class="col-md-2 mb-3">
      
          <div class="dropup">
            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo $_SESSION['member']->getLogin();?></a>
              <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item navFontSize accountLinkAuto" href=""> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['moncompte']; ?></a>
			          <a class="dropdown-item navFontSize logoutLinkAuto" href=""> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['deconnexion']; ?></a>
              </div>
          </div>
      
      </div>
      <div class="col-md-2 mb-3">
      
          <div class="dropup">
            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-globe"></i> <?php echo $multilingualArray['hfUser'][$_SESSION['lang']]['langue']; ?></a>
              <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a href="#" class="dropdown-item navFontSize langLinkAuto">FR</a>
                <a href="#" class="dropdown-item navFontSize langLinkAuto">EN</a>
              </div>
          </div>
      
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