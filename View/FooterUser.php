<!--[LANG FR/EN]-->
<!-- [FOOTER USER] -->
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
          <div class="dropup">
            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-image"></i> Gallery</a>
              <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item navFontSize" type="button" data-toggle="modal" data-target="#modalGallery">Creer une galerie</a>
                <a class="dropdown-item navFontSize galleryLinkAuto" type="button" href="">Mes galleries</a>
              </div>
          </div>
          
        </h6>
      </div>
      <div class="col-md-2 mb-3">
        <h6>
          <div class="dropup">
            <a class="nav-link dropdown-toggle text-white navFontSize" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo $_SESSION['member']->getLogin();?></a>
              <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item navFontSize accountLinkAuto" type="button" href="">Mon compte</a>
			          <a class="dropdown-item navFontSize logoutLinkAuto" type="button" href="">Log out</a>
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
                <a href="#" class="dropdown-item navFontSize langLinkAuto">Français</a>
                <a href="#" class="dropdown-item navFontSize langLinkAuto">Anglais</a>
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