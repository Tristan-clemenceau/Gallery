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

$_SESSION['page'] = "22d94b62867c07c7582765cdf83ba9d7a0225f8d4fb55c422cd0f4ed54a2812f";

/*VAR*/
$linkCSS = [];
$linkJS = [];
if (!isset($_SESSION['lang'])) {
    header("Location: ../index.php");
    exit();
}else{
    array_push($linkCSS, "../Public/CSS/default.css");
    array_push($linkJS, "../Public/JS/home.js");
    $title = $multilingualArray['searchGallery'][$_SESSION['lang']]['pageTitle'];
}
/*GET DATA*/
$gallery = new Gallery();
$galleryDAO = new GalleryDAO();
$gallery = $galleryDAO->getGaleryByName($_GET['galleryName']);
$gallery->setArrMember($galleryDAO->getAllMember($gallery->getId()));

function displayMember(Gallery $galleryTemp,$multilingualArray){
    if(count($galleryTemp->getArrMember()) == 0){
        echo '<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['noMember'].'</a></div><div class="col-xl-1 col-sm-12"></div></div></div></li>';
    }else{
        if(isset($_SESSION['member'])){
            if ($_SESSION['member']->getId() == $galleryTemp->getOwner()->getId()) {/*ADMIN*/
            foreach($galleryTemp->getArrMember() as $memberGal){
               echo'<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase" href="searchUser.php?loginUser='.$memberGal->getLogin().'">'.$memberGal->getLogin().'</a></div><div class="col-xl-1 col-sm-12"><a class="h-5 text-white text-uppercase" href="#"><i class="fas fa-times fa-2x textOrange "></i></a></div></div></div></li>';
            }
        } else {/*MEMBER*/
            foreach($galleryTemp->getArrMember() as $memberGal){
               echo'<li class="list-group-item backgroundDarkGrey textBleue borderBleue"><div class="container"><div class="row"><div class="col-xl-11 col-sm-12"><a class="h-5 text-white text-uppercase" href="searchUser.php?loginUser='.$memberGal->getLogin().'">'.$memberGal->getLogin().'</a></div><div class="col-xl-1 col-sm-12"></div></div></div></li>';
            }
        }
        }else{
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
           $cpt+= $memberDAO->getNbPostGallery($memberGal->getId(),$galleryTemp->getId());
        }
        return $cpt;
    }
}

function displayPost(Gallery $galleryTemp,$multilingualArray){
    if (displayNumberOfpost($galleryTemp) == 0) {
        echo '<p class="text-center">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['noPost'].'</p>';
    } else {
        $arrayPost = array();
        $postDAO = new PostDAO();

        foreach ($galleryTemp->getArrMember() as $galleryItem) {
        /*GET POST*/
        $arrayPost = array_merge($arrayPost,$postDAO->getPostById($galleryItem->getId(),$galleryTemp->getId(),$galleryItem->getLogin()));
        }

        foreach ($arrayPost as $post) {
            echo '<div class="col-xl-4 col-md-12 mb-12 "><div class="card borderBleue mb-4"><img class="card-img-top card_Image_modal"src="'."../Public/Images/Uploads/".$post->getImage()->getLink().'" alt="Image"><div class="card-body backgroundDarkGrey"><p class="card-text">'.$post->getDescription().'</p><p class="card-text-botom-auth"><small class="text-muted text-uppercase">'.$post->getPublisher()->getLogin().'</small></p>
            <button class="btn btn-outline-secondary btn-md backgroundDarkGrey borderBleue deletePost" value="'.$post->getId().'">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['cardPostBtnDelete'].'</button><button class="btn btn-outline-secondary btn-md backgroundDarkGrey borderBleue modifyPost" value="'.$post->getId().'">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['cardPostBtnModify'].'</button></div></div></div>';
        }
    }
}

function displayButtonAddPost($multilingualArray,$galleryDao,$gallery){
    if(isset($_SESSION['member'])){
        if($galleryDao->isMemberFromGalleryWithoutPost($_SESSION['member']->getId(),$gallery->getId())){
            echo '<button id="btn_Upload" type="button" class="btn btn-primary btn-lg btn-block mb-4">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['addPostBtn'].'</button>';
        }
    }
}

function displayAddMemberFeature(Gallery $galleryTemp,$multilingualArray){
    if (isset($_SESSION['member'])) {
        if ($_SESSION['member']->getId() == $galleryTemp->getOwner()->getId()) {
            echo '<form class="form-inline justify-content-center">
    <div class="form-group mx-sm-4 mb-2">
        <input type="hidden" name="idGallery" value="'.$galleryTemp->getId().'">
        <input class="form-control" list="inputAddMember" placeholder="'.$multilingualArray['searchGallery'][$_SESSION['lang']]['cardMemberInputUsername'].'" id="inputAddmemberField">
        <datalist id="inputAddMember">
        </datalist>
    </div>
    <button id="btn_Member" class="btn btn-primary mb-2">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['cardMemberBtn'].'</button>
</form>';
        }
    }
}


function displayAddPostFeature(Gallery $galleryTemp,$multilingualArray){
    if(isset($_SESSION['member'])){
        echo '<label for="uplaodInputUsername">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadInputAuthor'].'</label>
<input type="text" class="form-control" id="uplaodInputUsername" aria-describedby="emailHelp" value="'.$_SESSION['member']->getLogin().'" readonly>
<label for="uploadInputDesc" class="mt-2">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadInputDescription'].'</label>
<textarea class="form-control" id ="uploadInputDesc" placeholder="1000 char max" aria-label="With textarea" maxlength="1000" name="desc"></textarea>
<label for="uploadFile" class="mt-2">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadInputFile'].'</label>
<input type="file" id="uploadFile" name="file" required>
<input type="hidden" name="galleryId" value="'.$galleryTemp->getId().'">';
    }

}

function displayModifyFeature($multilingualArray){
   if(isset($_SESSION['member'])){
    echo'<label for="modifyInputUsername">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadInputAuthor'].'</label>
    <input type="text" class="form-control" id="modifyInputUsername" aria-describedby="emailHelp" value="'.$_SESSION['member']->getLogin().'" readonly>
    <label for="uploadModifyInputDesc" class="mt-2">'.$multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadInputDescription'].'</label>
    <textarea class="form-control" id ="uploadModifyInputDesc" placeholder="1000 char max" aria-label="With textarea" maxlength="1000" name="desc"></textarea>
    <input id="hidden_Field_IdPost" type="hidden" name="idPost" value="">';
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
                <h5 class="mt-2 navFontSize text-center" id="modalConnexionTitle"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionTitle']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="connexionInputUsername"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionInputUsername']; ?></label>
                        <input type="text" class="form-control" id="connexionInputUsername" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionInputUsername']; ?>" required>
                        <label for="connexionInputPassword" class="mt-2"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionInputPassword']; ?></label>
                        <input type="password" class="form-control" id="connexionInputPassword" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionInputPassword']; ?>" aria-describedby="passHelp" required>
                    </div>
                    <div id="alert_connexion" class="alert alert-info fade show" role="alert">
                        <p id="alert_connexion_message" class="text-center"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionAlertMessage']; ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_connexion" ><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalConnexionBtn']; ?></button>
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
                <h5 class="mt-2 navFontSize text-center" id="modalRegisterTitle"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterTitle']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="registerInputUsername"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterInputUsername']; ?></label>
                        <input type="text" class="form-control" id="registerInputUsername" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterInputUsername']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="registerInputPassword"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterInputPassword']; ?></label>
                        <input type="password" class="form-control" id="registerInputPassword" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterInputPassword']; ?>" aria-describedby="passHelp" required>
                        <label for="confirmRegisterInputPassword"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterInputPasswordConfirm']; ?></label>
                        <input type="password" class="form-control" id="confirmRegisterInputPassword" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterInputPasswordConfirm']; ?>" aria-describedby="passHelp" required>
                    </div>
                    <div id="alert_register" class="alert alert-info fade show" role="alert">
                        <p id="alert_register_message" class="text-center"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterAlertMessage']; ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_register"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalRegisterBtn']; ?></button>
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
                <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchTitle']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="searchInputUsername"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchInputUsername']; ?></label>
                        <input type="text" class="form-control" id="searchInputUsername" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchInputUsername']; ?>" required>
                        <label for="searchInputGallery" class="mt-2"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchInputGallery']; ?></label>
                        <input type="text" class="form-control" id="searchInputGallery" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchInputGallery']; ?>" aria-describedby="passHelp" required>
                    </div>
                    <div id="alert_search" class="alert alert-info fade show" role="alert">
                        <p id="alert_search_message" class="text-center"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchAlertMessage']; ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_search"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalSearchBtn']; ?></button>
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
                <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadImgTitle']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" method="post" id="formDataUpload">
                    <div class="form-group">
                        <?php displayAddPostFeature($gallery,$multilingualArray); ?>
                    </div>
                    <div id="upload_search" class="alert alert-info fade show" role="alert">
                        <p id="upload_search_message" class="text-center"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadImgAlertMessage']; ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_upload_modal"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalUploadImgBtnAdd']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- [MODAL-Modify-Image] -->
<div id="modalModifyPost" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content backgroundDarkGrey">
            <div class="modal-header">
                <img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
                <h5 class="mt-2 navFontSize text-center" id="ModalSearchTitle"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalModifyImgTitle']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group">
                        <?php  displayModifyFeature($multilingualArray); ?>
                    </div>
                    <div id="upload_Modify" class="alert alert-info fade show" role="alert">
                        <p id="upload_Modify_message" class="text-center"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalModifyImgAlertMessage']; ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_modify_modal"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalModifyImgBtnAdd']; ?></button>
            </div>
        </div>
    </div>
</div>
<!-- [MODAL-GALLERY] -->
<div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-labelledby="ModalGalleryTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content backgroundDarkGrey">
            <div class="modal-header">
                <img src="../Public/Images/Icon/Logo01.png" width="50" height="50" alt="Logo">
                <h5 class="mt-2 navFontSize text-center" id="ModalGalleryTitle"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalGalleryTitle']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times text-white" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="galleryInputName"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalGalleryInputGallery']; ?></label>
                        <input type="text" class="form-control" id="galleryInputName" aria-describedby="emailHelp" placeholder="<?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalGalleryInputGallery']; ?>" required>
                    </div>
                    <div id="alert_gallery" class="alert alert-info fade show" role="alert">
                        <p id="alert_gallery_message" class="text-center"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalGalleryAlertMessage']; ?></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_gallery_create"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['modalGalleryBtn']; ?></button>
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
                    <h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['cardMemberTitle']; ?></span></h1>
                </div>
                <div class="card-body backgroundDarkGrey">
                    <div class="panel panel-primary" id="result_panel">
                        <div class="panel-heading">
                            
                        </div>
                        <div class="panel-body">
                            <?php displayAddMemberFeature($gallery,$multilingualArray);?>
                            <ul class="list-group">
                                <?php displayMember($gallery,$multilingualArray);?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 ">
            <div class="card text-center m-5 borderBleue">
                <div class="card-header backgroundOrange">
                    <h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['cardDonneeTitle']; ?></span></h1>
                </div>
                <div class="card-body backgroundDarkGrey">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4"><!--[CARD nb gallery]-->
                                <div class="card borderBleue shadow h-100 py-2 backgroundDarkGrey">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['cardDonneLabelNbMember']; ?></div>
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
                                                <div class="text-xs font-weight-bold textBleue text-uppercase mb-1"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['cardDonneLabelNbPost']; ?></div>
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
                    <h1 class=" font-weight-bold text-center" ><span class="titleContent text-uppercase"><?php echo $multilingualArray['searchGallery'][$_SESSION['lang']]['cardPostTitle']; ?></span></h1>
                </div>
                <div class="card-body backgroundDarkGrey">
                    <?php displayButtonAddPost($multilingualArray,$galleryDAO,$gallery);?>
                    <div class="container-fluid">
                        <div class="row">
                            <?php displayPost($gallery,$multilingualArray); ?>
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