$(document).ready(function(){
  /*BUTTON*/
  $btn_connexion = $('#btn_connexion');
  $btn_register = $('#btn_register');
  $btn_search = $('#btn_search');

  /*BTN DISABLED BY DEFAULT*/
  $btn_connexion.attr("disabled", true);
  $btn_register.attr("disabled", true);
  $btn_search.attr("disabled", true);

  /*FIELDS*/
  $field_connexion_username = $('#connexionInputUsername');
  $field_connexion_password = $('#connexionInputPassword');

  $field_register_username = $('#registerInputUsername');
  $field_register_password = $('#registerInputPassword');
  $field_register_confirmpassword = $('#confirmRegisterInputPassword');

  $field_search_username = $('#searchInputUsername');
  $field_search_gallery = $('#searchInputGallery');
  /*ALERT*/
  $alert_connexion = $('#alert_connexion');
  $alert_connexion_msg = $('#alert_connexion_message');
  $alert_register = $('#alert_register');
  $alert_register_msg = $('#alert_register_message');
  $alert_search = $('#alert_search');
  $alert_search_msg = $('#alert_search_message');

  /*EVENT MODAL CONNEXION*/
  $field_connexion_username.keyup(submitConnexion);
  $field_connexion_password.keyup(submitConnexion);
  /*EVENT MODAL REGISTER*/
  $field_register_username.keyup(submitRegister);
  $field_register_password.keyup(submitRegister);
  $field_register_confirmpassword.keyup(submitRegister);
  /*EVENT MODAL SEARCH*/
  $field_search_username.keyup(submitSearch);
  $field_search_gallery.keyup(submitSearch);

  /*VAR*/
  var emptyArr = [];
  emptyArr.push("alert-info");
  emptyArr.unshift("alert-info");

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
    console.log(objParent.attr('id'));
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
    }
    objChield.empty();
    objChield.html(message);
  }

  function submitConnexion(){
    if(!isEmptyField($field_connexion_username) && !isEmptyField($field_connexion_password)){
      /*OK QUERY AJAX*/
      setMessageAndState($alert_connexion,$alert_connexion_msg,getAlert(0),"Condition ok");
      $btn_connexion.attr("disabled", false);
    }else{
      /*NOT OK*/
      setMessageAndState($alert_connexion,$alert_connexion_msg,getAlert(2),"Condtion pas ok");
    }
    
  }

  function submitRegister(){
    alert("submit register");
  }

  function submitSearch(){
    alert("submit search");
  }


});