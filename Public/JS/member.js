$(document).ready(function(){
  /*BUTTON*/
  $btn_search = $('#btn_search');
  $btn_gallery_create = $('#btn_gallery_create');

  /*BTN DISABLED BY DEFAULT*/
  $btn_search.attr("disabled", true);
  $btn_gallery_create.attr("disabled", true);

  /*FIELDS*/
  $field_gallery_name = $('#galleryInputName');

  $field_search_username = $('#searchInputUsername');
  $field_search_gallery = $('#searchInputGallery');
  /*ALERT*/
  $alert_gallery = $('#alert_gallery');
  $alert_gallery_msg = $('#alert_gallery_message');
  $alert_search = $('#alert_search');
  $alert_search_msg = $('#alert_search_message');

  /*EVENT MODAL GALLERY*/
  $field_gallery_name.keyup(submitGallery);

  $btn_gallery_create.click(sendDataGallery);
  /*EVENT MODAL SEARCH*/
  $field_search_username.keyup(submitSearch);
  $field_search_gallery.keyup(submitSearch);

  $btn_search.click(senDataResearch);
  /*OTHER*/
  $logo = $("#logo");
  $linkIndex = $(".navbar-brand");
  $accountLink = $("#accountLink");
  $logOutLink = $("#logOutLink");
  $galleryLink = $("#galleryLink");

  /*VAR*/
  var emptyArr = [];
  var arrayLink =[];
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

  function setMessageAndState(objParent,objChield,state,message){
    switch(objParent.attr('id')){
      case "alert_search":
      objParent.toggleClass(emptyArr[0]+" "+state);
      emptyArr[0] = state;
      break;
      case "alert_gallery":
      objParent.toggleClass(emptyArr[1]+" "+state);
      emptyArr[1] = state;
      break;
    }
    objChield.empty();
    objChield.html(message);
  }

  function submitGallery(){
    if(!isEmptyField($field_gallery_name)){
      setMessageAndState($alert_gallery,$alert_gallery_msg,getAlert(0),"Vous pouvez appuyer sur le bouton connexion");
      $btn_gallery_create.attr("disabled", false);
    }else{
      $btn_gallery_create.attr("disabled", true);
      setMessageAndState($alert_gallery,$alert_gallery_msg,getAlert(2),"Vous devez remplir le champs afin de pouvoir proceder à la création");
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

  function sendDataGallery(){
      $.ajax({
       url: arrayLink[0],
       method: "POST",
       data: { name : $field_gallery_name.val()}
      }).done(function(message){//need to change Alert in fact of result
    if (message.state == "OK") {
      setMessageAndState($alert_gallery,$alert_gallery_msg,getAlert(0),message.msg);
      }else{
        setMessageAndState($alert_gallery,$alert_gallery_msg,getAlert(1),message.msg);
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
       url: arrayLink[1],
       method: "POST",
       data: { UserName : $field_search_username.val() }
      }).done(function(message){//need to change Alert in fact of result
    if (message.state == "OK") {
      setMessageAndState($alert_search,$alert_search_msg,getAlert(0),message.msg);
      location.href = arrayLink[2]+$field_search_username.val();
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
       url: arrayLink[1],
       method: "POST",
       data: { GalleryName : $field_search_gallery.val()}
      }).done(function(message){//need to change Alert in fact of result
    if (message.state == "OK") {
      setMessageAndState($alert_search,$alert_search_msg,getAlert(0),message.msg);
        location.href = arrayLink[3]+$field_search_gallery.val();
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

function getDateTimeFromNow(){
    //H:i:s
    var d = new Date();
    var str="";
    str+= d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
    return str;
  }

  function setLink(){
    if((document.title == "Accueil") || (document.title == "Home")){
      $logo.attr('src', '../Public/Images/Icon/Logo01.png');
      $linkIndex.attr('href','UserView.php');
      $('.galleryLinkAuto').each(function(item){
        $( this ).attr('href','../index.php?action=userGallery');
      });
      $('.accountLinkAuto').each(function(item){
        $( this ).attr('href','../index.php?action=userAccount');
      });
      $('.logoutLinkAuto').each(function(item){
        $( this ).attr('href','../index.php?action=logout');
      });
      $('.langLinkAuto').each(function(item){
        $( this ).attr('href','../sourceLang.php');
      });
      arrayLink.push("../Controller/galleryCreate.php");
      arrayLink.push("../Controller/search.php");
      arrayLink.push("../View/searchUser.php?loginUser=");
      arrayLink.push("../View/searchGallery.php?galleryName=");
    }else{
      $logo.attr('src', 'Public/Images/Icon/Logo01.png');
      $linkIndex.attr('href','View/UserView.php');
       $('.galleryLinkAuto').each(function(item){
        $( this ).attr('href','index.php?action=userGallery');
      });
      $('.accountLinkAuto').each(function(item){
        $( this ).attr('href','index.php?action=userAccount');
      });
      $('.logoutLinkAuto').each(function(item){
        $( this ).attr('href','index.php?action=logout');
      });
      $('.langLinkAuto').each(function(item){
        $( this ).attr('href','sourceLang.php');
      });
      arrayLink.push("Controller/galleryCreate.php");
      arrayLink.push("Controller/search.php");
      arrayLink.push("View/searchUser.php?loginUser=");
      arrayLink.push("View/searchGallery.php?galleryName=");
    }
  }


});