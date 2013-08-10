/* Title:
 *   Kevin's FORM INPUT CHECKER
 * Author:
 *   Kevin Johnson
 * Licence:
 *   Public Domain, for now (subject to change)
 *
 *
 * USAGE 
 * 1) Include this javascript file
 * 2) Customize __Kevin_checkvalidity to contain the necessary checks.
 *    These checks don't always have to be checks, they can sometimes just modify the
 *    input. See case "trim_edge_spaces", as long as it returns true, it won't block the
 *    checks.
 * 3) Add the checks to each input as classes, in the order you want them run.
 * 4) Add {onsubmit="return isformvalid(this)"} to your form element.
 * 5) ???
 * 6) Profit!
 */
 
  __Kevin_phonereg = /^(?:\d){10}$/;
  __Kevin_fourdigreg = /^(?:\d){4}$/;
  __Kevin_emailreg = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
  
  function __Kevin_checkvalidity(checkfor, checkon){
    switch(checkfor){
    case "email":
        if (__Kevin_emailreg.test(checkon.value)){
          return true;
        }
        else {
          return "Expecting a valid email address"
        }
    case "trim_edge_spaces":
      checkon.value = checkon.value.trim();
      return true;
      break;
    case "phonenumber":
      checkon.value = checkon.value.replace(/[^0-9]/g, '');
        if (__Kevin_phonereg.test(checkon.value)){
          return true;
        }
        else {
          return "Expecting a 10 digit number"
        }
      break;
    case "required":
      if (checkon.value != ""){
        return true;
      } else {
        return "This is a required field"
      }
      break;
    case "fourdigits":
      checkon.value = checkon.value.replace(/[^0-9]/g, '');
        if (__Kevin_fourdigreg.test(checkon.value)){
          return true;
        }
        else{
          return "Expecting a 4 digit number"
        }
      break;
    }
    return true;
  }

  function __Kevin_showerror(error, element){
    
    var errornodetext=document.createTextNode(error);
    var errornode=document.createElement("span");
    errornode.appendChild(errornodetext)
    errornode.className = "FormInputError"
    element.parentNode.insertBefore(errornode,element)
  }
  
  function __Kevin_clearallerrors(){
    var arrayoferrornodes = document.getElementsByClassName("FormInputError");
    while (arrayoferrornodes.length > 0){
      arrayoferrornodes[0].parentNode.removeChild(arrayoferrornodes[0]);
    }
  }
  
  function isformvalid(form){
    __Kevin_clearallerrors();
    
    var istheformvalid = true;
    for (var elementindex = 0; elementindex < form.length; elementindex++){
      var element = form[elementindex];
      if (element.className != undefined){
        var classarray = element.className.split(' ');
        for (var classindex in classarray){
          var result = __Kevin_checkvalidity(classarray[classindex], element);
          if (result != true){
            __Kevin_showerror(result, element);
            istheformvalid = false;
          }
        }
      }
    }
    return istheformvalid;
  }