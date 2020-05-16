$(document).ready(function(){
  /*BUTTON*/
  $btn_connexion = $('#btn_connexion');
  $btn_register = $('#btn_register');
  $btn_search = $('#btn_search');
  $btn_upload_modal = $('#btn_upload_modal');
  $btn_Upload= $("#btn_Upload");

  /*BTN DISABLED BY DEFAULT*/
  $btn_connexion.attr("disabled", true);
  $btn_register.attr("disabled", true);
  $btn_search.attr("disabled", true);
  $btn_upload_modal.attr("disabled", true);

  /*FIELDS*/
  $field_connexion_username = $('#connexionInputUsername');
  $field_connexion_password = $('#connexionInputPassword');

  $field_register_username = $('#registerInputUsername');
  $field_register_password = $('#registerInputPassword');
  $field_register_confirmpassword = $('#confirmRegisterInputPassword');

  $field_search_username = $('#searchInputUsername');
  $field_search_gallery = $('#searchInputGallery');

  $field_upload_desc =$('#uploadInputDesc');
  $field_upload_file =$('#uploadFile');
  /*ALERT*/
  $alert_connexion = $('#alert_connexion');
  $alert_connexion_msg = $('#alert_connexion_message');
  $alert_register = $('#alert_register');
  $alert_register_msg = $('#alert_register_message');
  $alert_search = $('#alert_search');
  $alert_search_msg = $('#alert_search_message');
  $alert_upload =$("#upload_search");
  $alert_upload_msg = $("#upload_search_message");

  /*OTHER*/

  $logo = $("#logo");
  $linkIndex = $(".navbar-brand");

  $(".card_Image_modal").click(displayImage);

  $btn_Upload.click(function(){
    $("#modalUpload").modal();
  });

  /*EVENT MODAL CONNEXION*/
  $field_connexion_username.keyup(submitConnexion);
  $field_connexion_password.keyup(submitConnexion);

  $btn_connexion.click(sendDataConnexion);
  /*EVENT MODAL REGISTER*/
  $field_register_username.keyup(submitRegister);
  $field_register_password.keyup(submitRegister);
  $field_register_confirmpassword.keyup(submitRegister);

  $btn_register.click(sendDataRegister);
  /*EVENT MODAL SEARCH*/
  $field_search_username.keyup(submitSearch);
  $field_search_gallery.keyup(submitSearch);

  /*EVENT MODAL UPLOAD*/
  $field_upload_desc.keyup(submitUpload);
  $field_upload_file.change(submitUpload);

  $btn_upload_modal.click(sendDataUpload);
  /*VAR*/
  var emptyArr = [];
  var arrayLink =[];
  emptyArr.push("alert-info");
  emptyArr.push("alert-info");
  emptyArr.push("alert-info");
  emptyArr.unshift("alert-info");

  setLink();

  /*FUNCTION*/
  function isEmptyField(field){
    if (field.val() === '') {
      return true;
    } else {
      return false;
    }
  }

  function getAlert(state){
    var result ="";
    switch(state){
      case 0:
        result ="alert-success";
        break;
      case 1:
        result ="alert-danger";
        break;
      case 2:
        result ="alert-warning";
        break;
      case 3:
        result ="alert-info";
        break;
    }
    return result;
  }

  function setMessageAndState(objParent,objChield,state,message){//[0]modal connexion [1]modal register [2]modal search
    switch(objParent.attr('id')){
      case "alert_connexion":
        objParent.toggleClass(emptyArr[0]+" "+state);
        emptyArr[0] = state;
        break;
      case "alert_register":
        objParent.toggleClass(emptyArr[1]+" "+state);
        emptyArr[1] = state;
        break;
      case "alert_search":
        objParent.toggleClass(emptyArr[2]+" "+state);
        emptyArr[2] = state;
        break;
      case "upload_search":
        objParent.toggleClass(emptyArr[3]+" "+state);
        emptyArr[3] = state;
        break;
    }
    objChield.empty();
    objChield.html(message);
  }

  function submitConnexion(){
    if(!isEmptyField($field_connexion_username) && !isEmptyField($field_connexion_password)){
      /*OK QUERY AJAX*/
      setMessageAndState($alert_connexion,$alert_connexion_msg,getAlert(0),"Vous pouvez appuyer sur le bouton connexion");
      $btn_connexion.attr("disabled", false);
    }else{
      /*NOT OK*/
      $btn_connexion.attr("disabled", true);
      setMessageAndState($alert_connexion,$alert_connexion_msg,getAlert(2),"Vous devez remplir tous les champs pour vous connecter");
    }
    
  }

  function submitRegister(){
    if(!isEmptyField($field_register_username) && !isEmptyField($field_register_password) && !isEmptyField($field_register_confirmpassword)){
      if ($field_register_password.val() == $field_register_confirmpassword.val()) {//ok
        setMessageAndState($alert_register,$alert_register_msg,getAlert(0),"Vous pouvez appuyer sur le bouton register");
        $btn_register.attr("disabled",false);
      } else {
        $btn_register.attr("disabled",true);
        setMessageAndState($alert_register,$alert_register_msg,getAlert(1),"Mot de passe non identique");
      }
    }else{
      $btn_register.attr("disabled",true);
      setMessageAndState($alert_register,$alert_register_msg,getAlert(2),"Vous devez remplir tous les champs pour vous enregistrer");
    }
  }

  function submitSearch(){
    if (!isEmptyField($field_search_username) || !isEmptyField($field_search_gallery)) {
      if (!isEmptyField($field_search_username) && !isEmptyField($field_search_gallery)) {
        $btn_search.attr("disabled",true);
        setMessageAndState($alert_search,$alert_search_msg,getAlert(1),"Il n'est pas possible de faire deux recherches en même temps");
      }else{
        setMessageAndState($alert_search,$alert_search_msg,getAlert(0),"Vous pouvez appuyer sur le bouton search");
        $btn_search.attr("disabled",false);
      }
    }else{
      $btn_search.attr("disabled",true);
      setMessageAndState($alert_search,$alert_search_msg,getAlert(2),"Vous devez remplir un des deux champs pour effectuer une recherche");
    }
  }

  function submitUpload(){
    if(!isEmptyField($field_upload_desc) && !($field_upload_file.val() == '')){
      console.log($field_upload_file.length)
      setMessageAndState($alert_upload,$alert_upload_msg,getAlert(0),"Vous pouvez appuyer sur le bouton ajouter");
      $btn_upload_modal.attr("disabled",false);
    }else{
      $btn_upload_modal.attr("disabled",true);
       setMessageAndState($alert_upload,$alert_upload_msg,getAlert(2),"Vous devez choisir un fichier et ajouter une description");
    }

  }

  function sendDataConnexion(){
  $.ajax({
      url: arrayLink[0],
      method: "POST",
      data: { login : $field_connexion_username.val() , password : $field_connexion_password.val()}
  }).done(function(message){
      console.log(message.state);
      if (message.state == "OK") {
        setMessageAndState($alert_connexion,$alert_connexion_msg,getAlert(0),message.msg);
        location.href = arrayLink[3];
      }else{
        setMessageAndState($alert_connexion,$alert_connexion_msg,getAlert(1),message.msg);
      }
  }).fail(function( jqXHR, textStatus,errorThrown) {
      console.log( "Request failed: " + textStatus );
      $.each( jqXHR, function( i, item ){
                       console.log(item);
                     });
      console.log( "errorThrown" + errorThrown );
  });
    
  }
  function sendDataRegister(){
  $.ajax({
      url: arrayLink[1],
      method: "POST",
      data: { login : $field_register_username.val() , password : $field_register_password.val(), dateRegister : getDateTimeFromNow()}
  }).done(function(message){//need to change Alert in fact of result
    console.log(message.state);
      if (message.state == "OK") {
        setMessageAndState($alert_register,$alert_register_msg,getAlert(0),message.msg);
        location.href = arrayLink[3];
      }else{
        setMessageAndState($alert_register,$alert_register_msg,getAlert(1),message.msg);
      }
  }).fail(function( jqXHR, textStatus,errorThrown) {
      console.log( "Request failed: " + textStatus );
      $.each( jqXHR, function( i, item ){
                       console.log(item);
                     });
      console.log( "errorThrown" + errorThrown );
  });
    
  }

  function senDataResearch(){
  if(!isEmptyField($field_search_username)){
    sendDataSearchUsername();
  }else{
    sendDataSearchGallery();
  }
}

function sendDataSearchUsername(){
$.ajax({
       url: arrayLink[2],
       method: "POST",
       data: { UserName : $field_search_username.val() }
      }).done(function(message){//need to change Alert in fact of result
    if (message.state == "OK") {
      setMessageAndState($alert_search,$alert_search_msg,getAlert(0),message.msg);
        location.href = arrayLink[4]+$field_search_username.val();
      }else{
        setMessageAndState($alert_search,$alert_search_msg,getAlert(1),message.msg);
      }
    }).fail(function( jqXHR, textStatus,errorThrown) {
      console.log( "Request failed: " + textStatus );
      $.each( jqXHR, function( i, item ){
       console.log(item);
     });
      console.log( "errorThrown" + errorThrown );
    });
}

function sendDataSearchGallery(){
  $.ajax({
       url: arrayLink[2],
       method: "POST",
       data: { GalleryName : $field_search_gallery.val()}
      }).done(function(message){//need to change Alert in fact of result
    if (message.state == "OK") {
        setMessageAndState($alert_search,$alert_search_msg,getAlert(0),message.msg);
        location.href = arrayLink[5]+$field_search_gallery.val();
      }else{
        setMessageAndState($alert_search,$alert_search_msg,getAlert(1),message.msg);
      }
    }).fail(function( jqXHR, textStatus,errorThrown) {
      console.log( "Request failed: " + textStatus );
      $.each( jqXHR, function( i, item ){
       console.log(item);
     });
      console.log( "errorThrown" + errorThrown );
    });
}

function sendDataUpload(){
  var dataFormUpl = new FormData(document.getElementById("formDataUpload"));
  $.ajax({
       url: '../Controller/upload.php',
       method: "POST",
       enctype: 'multipart/form-data',
       processData: false,
       contentType: false,
       data: dataFormUpl
      }).done(function(message){//need to change Alert in fact of result
    if (message.state == "OK") {
        setMessageAndState($alert_upload,$alert_upload_msg,getAlert(0),message.msg);
        //location.href = arrayLink[5]+$field_search_gallery.val();
      }else{
        setMessageAndState($alert_upload,$alert_upload_msg,getAlert(1),message.msg);
      }
    }).fail(function( jqXHR, textStatus,errorThrown) {
      console.log( "Request failed: " + textStatus );
      $.each( jqXHR, function( i, item ){
       console.log(item);
     });
      console.log( "errorThrown" + errorThrown );
    });
}

  function getDateTimeFromNow(){
    //H:i:s
    var d = new Date();
    var str="";
    str+= d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
    return str;
  }

  function setLink(){
    if((document.title == "Accueil") || (document.title == "Home")){
      $logo.attr('src', 'Public/Images/Icon/Logo01.png');
      $linkIndex.attr('href','index.php');
      arrayLink.push("Controller/auth.php");
      arrayLink.push("Controller/register.php");
      arrayLink.push("Controller/search.php");
      arrayLink.push("View/UserView.php");
      arrayLink.push("View/searchUser.php?loginUser=");
      arrayLink.push("View/searchGallery.php?galleryName=");
    }else{
      $logo.attr('src', '../Public/Images/Icon/Logo01.png');
      $linkIndex.attr('href','../index.php');
      arrayLink.push("../Controller/auth.php");
      arrayLink.push("../Controller/register.php");
      arrayLink.push("../Controller/search.php");
      arrayLink.push("../View/UserView.php");
      arrayLink.push("../View/searchUser.php?loginUser=");
      arrayLink.push("../View/searchGallery.php?galleryName=");
    }
  }

  function displayImage(){
  /*TAKE INFORMATION FROM CHILD EL*/
  console.log($(this).children('.card-img-top').attr('src'));
  console.log($(this).children('.card-body').children('.card-title').text());
  console.log($(this).children('.card-body').children('.card-text').text());
  console.log($(this).children('.card-body').children('.card-text-botom-auth').children('.text-muted').text());
  /*PUT IT ON MODAL*/
  $("#modalImageImage").attr('src',$(this).children('.card-img-top').attr('src'));
  $("#modalImageTitle").text($(this).children('.card-body').children('.card-title').text());
  $("#modalImageContent").text($(this).children('.card-body').children('.card-text').text());
  $("#modalImageAuthor").text($(this).children('.card-body').children('.card-text-botom-auth').children('.text-muted').text());
  /*DISPLAY MODAL*/
  $("#modalImage").modal();
}

});