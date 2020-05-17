<?php
/*IMPORT*/ 
require_once('../Model/Multilingual.php');
require_once('../Model/Person.php');
require_once('../Model/Member.php');
require_once('../Model/Connection.php');
require_once('../Model/MemberDAO.php');
require_once('../Model/Post.php');
require_once('../Model/PostDAO.php');
require_once('../Model/Image.php');
require_once('../Model/ImageDAO.php');
require_once('../Model/Gallery.php');
require_once('../Model/GalleryDAO.php');

if (!isset($_GET['galleryName'])) {
    header("Location: ../index.php");
    exit();
}

session_start();

$_SESSION['page'] = "bf6957fb3792c3f2ab826e647557d1b58dcecafb0f366030ad2aaf91cb1303d5";

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
    header("Location: ../index.php");
    exit();
}else{
    array_push($linkCSS, "../Public/CSS/default.css");
    array_push($linkJS, "../Public/JS/home.js");
    $title = $multilingualArray['searchGallery'][$_SESSION['lang']]['title'];
}
/*GET DATA*/
$gallery = new Gallery();
$galleryDAO = new GalleryDAO();
$gallery = $galleryDAO->getGaleryByName($_GET['galleryName']);
$gallery->setArrMember($galleryDAO->getAllMember($gallery->getId()));

function displayMember(Gallery $galleryTemp){
    if(count($galleryTemp->getArrMember()) == 0){
        echo '<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase">'."Pas de membre".'</a></div><div class="col-xl-1 col-sm-12"></div></div></div></li>';
    }else{
        if ($_SESSION['member']->getId() == $galleryTemp->getOwner()->getId()) {/*ADMIN*/
            foreach($galleryTemp->getArrMember() as $memberGal){
               echo'<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase" href="searchUser.php?loginUser='.$memberGal->getLogin().'">'.$memberGal->getLogin().'</a></div><div class="col-xl-1 col-sm-12"><a class="h-5 text-white text-uppercase" href="#"><i class="fas fa-times fa-2x textOrange "></i></a></div></div></div></li>';
            }
        } else {/*MEMBER*/
            foreach($galleryTemp->getArrMember() as $memberGal){
               echo'<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase" href="searchUser.php?loginUser='.$memberGal->getLogin().'">'.$memberGal->getLogin().'</a></div><div class="col-xl-1 col-sm-12"></div></div></div></li>';
            }
        }
        
    }
}

function displayNumberOfpost(Gallery $galleryTemp){
    if(count($galleryTemp->getArrMember()) == 0){
        return 0;
    }else{
        $cpt = 0;
        foreach ($galleryTemp->getArrMember() as $memberGal) {
           $memberDAO = new MemberDAO();
           $cpt+= $memberDAO->getNbPost($memberGal->getId());
        }
        return $cpt;
    }
}

function displayPost(Gallery $galleryTemp){
    if (displayNumberOfpost($galleryTemp) == 0) {
        echo '<p class="text-center">Pas de post</p>';
    } else {
        $arrayPost = array();
        $postDAO = new PostDAO();

        foreach ($galleryTemp->getArrMember() as $galleryItem) {
        /*GET POST*/
        $arrayPost = array_merge($arrayPost,$postDAO->getPostById($galleryItem->getId(),$galleryTemp->getId(),$galleryItem->getLogin()));
        }

        foreach ($arrayPost as $post) {
            echo '<div class="col-xl-4 col-md-12 mb-12 "><div class="card borderBleue mb-4 card_Image_modal"><img class="card-img-top"src="'."../Public/Images/Uploads/".$post->getImage()->getLink().'" alt="Image"><div class="card-body backgroundDarkGrey"><p class="card-text">'.$post->getDescription().'</p><p class="card-text-botom-auth"><small class="text-muted text-uppercase">'.$post->getPublisher()->getLogin().'</small></p>
            <button class="btn btn-outline-secondary btn-md backgroundDarkGrey borderBleue" value="'.$post->getId().'">Delete</button></div></div></div>';
        }
    }
}

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
                <form>
                    <div class="form-group">
                        <label for="registerInputUsername">Username</label>
                        <input type="text" class="form-control" id="registerInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="registerInputPassword">Password</label>
                        <input type="password" class="form-control" id="registerInputPassword" placeholder="Password" aria-describedby="passHelp" required>
                        <label for="confirmRegisterInputPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmRegisterInputPassword" placeholder="Confirm password" aria-describedby="passHelp" required>
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
                <form>
                    <div class="form-group">
                        <label for="searchInputUsername">Username</label>
                        <input type="text" class="form-control" id="searchInputUsername" aria-describedby="emailHelp" placeholder="Enter username" required>
                        <label for="searchInputGallery" class="mt-2">Gallery</label>
                        <input type="text" class="form-control" id="searchInputGallery" placeholder="Enter Gallery name" aria-describedby="passHelp" required>
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
<!--[MODAL IMAGE]-->
<div id="modalImage" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div  class="modal-dialog modal-xl">
    <div  class="modal-content backgroundDarkGrey">
      <img id="modalImageImage" src="../Public/Images/Pictures/Slide_03.jpg" alt="Card image cap">
      <h5 id ="modalImageContent" class="text-center text-break"></h5>
      <p id="modalImageAuthor" class="text-center"></p>
    </div>
  </div>
</div>
<!-- [MODAL-UPLOAD-Image] -->
<div id="modalUpload" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content backgroundDarkGrey">
            <div class="modal-header">
                <img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
                <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle">Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" id="formDataUpload">
                    <div class="form-group">
                        <label for="uplaodInputUsername">Auteur</label>
                        <input type="text" class="form-control" id="uplaodInputUsername" aria-describedby="emailHelp" value="<?php echo $_SESSION['member']->getLogin(); ?>" readonly>
                        <label for="uploadInputDesc" class="mt-2">Gallery</label>
                        <textarea class="form-control" id ="uploadInputDesc" placeholder="1000 char max" aria-label="With textarea" maxlength="1000" name="desc"></textarea>
                        <label for="uploadFile" class="mt-2">Fichier</label>
                        <input type="file" id="uploadFile" name="file" required>
                        <input type="hidden" name="galleryId" value="<?php echo $gallery->getId(); ?>">
                    </div>
                    <div id="upload_search" class="alert alert-info fade show" role="alert">
                        <p id="upload_search_message" class="text-center">Ajouter un fichier et une description pour ajouter un post.</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_upload_modal">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<!-- [CONTENT] -->
<h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase"><?php echo $_GET['galleryName'];?></span></h1>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
            <div class="card text-center m-5 borderBleue">
                <div class="card-header backgroundOrange">
                    <h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase">Membres</span></h1>
                </div>
                <div class="card-body backgroundDarkGrey">
                    <div class="panel panel-primary" id="result_panel">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <?php displayMember($gallery);?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 ">
            <div class="card text-center m-5 borderBleue">
                <div class="card-header backgroundOrange">
                    <h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase">Données</span></h1>
                </div>
                <div class="card-body backgroundDarkGrey">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb gallery]-->
                                <div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold textBleue text-uppercase mb-1">Number of Member</div>
                                                <div class="h5 mb-0 font-weight-bold textBleue"><?php echo count($gallery->getArrMember())?></div>
                                            </div>
                                            <div class="col-auto ">
                                                <i class="fas fa-users fa-2x textBleue"></i>
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
                                                <div class="h5 mb-0 font-weight-bold textBleue"><?php echo displayNumberOfpost($gallery);?></div>
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
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card text-center m-5 borderBleue">
                <div class="card-header backgroundOrange">
                    <h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase">Post</span></h1>
                </div>
                <div class="card-body backgroundDarkGrey">
                    <button id="btn_Upload" type="button" class="btn btn-primary btn-lg btn-block mb-4">Add image</button>
                    <div class="container-fluid">
                        <div class="row">
                            <?php displayPost($gallery); ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted backgroundOrange">
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