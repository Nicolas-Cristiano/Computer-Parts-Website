$(function() {
    $('.error').hide(); 
	
    $('#button').click(function() {
		$('.error').hide();
		
	// Name validation	
	  var name = $("input#name").val(); // take value of tag = input, id = name
	  // name must contain no number or special character  
	  var pattern = /^[a-z A-Z]*$/;  
	  if(!pattern.test(name)){ 			// test if the name in the specified range or not, if not
		 $("label#name_error").show(); 	// execute the code below 
		 $("input#name").focus(); 
		 return false; 	  
	  }

	// email validation
	   var email = $("input#email").val();
	// jquery email validaton   :
	var pattern1 = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 

    // search regular expression in jquery to understand more about this
	if (!pattern1.test(email)) {
        $("label#email_error").show();
        $("input#email").focus();
        return false;
      }
	  
	  // checkbox validation
      var checkbox1 = $('#check1').is(":checked");
	  var checkbox2 = $('#check2').is(":checked");
	  var checkbox3 = $('#check3').is(":checked");
	  
	  if(!checkbox1 && !checkbox2 && !checkbox3){
		$('label#checkbox_error').show(); 
		$("input#check1").focus();
		$("input#check2").focus();
		$("input#check3").focus();
        return false; // without this the error won't stay for long 
	}
	  
 });
  });
  
  
 
