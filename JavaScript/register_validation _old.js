$(function() {
	$('.error').hide();
	$(".button").click(function() {
		
		$('.error').hide();
		
		 var namenum = /^[A-Za-z ]*$/;
		 var passnum = /[0-9]/g;	
		 var passletter = /[A-Za-z]/g;
		 var passchars = /[!$]/g;		 
		
		 var name = $("input#username").val();
         if (name == "") {
			$("label#nameerror").show();
			$("input#username").focus();
         return false; }
     	 			 
		 if (!namenum.test(name)){
			$("label#namenumber").show();
			$("input#username").focus();
	     return false;  }		 
				
		 var email = $("input#email").val();
		 if (email == ""){
			$("label#emailerror").show();
			$("input#email").focus();
		 return false; }
		
		 var password = $("input#password").val();
		 if (password == ""){
			$("label#passworderror").show();
			$("input#password").focus();
		 return false; } 
		
		 if (password.length < 8) {
			$("label#passwordlength").show();
			$("input#password").focus()			
		 return false; }
		
		 if (password.length < 8) {
			$("label#passwordlength").show();
			$("input#password").focus()			
		 return false; }
		
		 if (!passnum.test(password)){
		   $("label#passwordcharacters").show();
           $("input#password").focus();
	     return false;  }
		
		 if (!passletter.test(password)){
		   $("label#passwordcharacters").show();
           $("input#password").focus();
	     return false;  }
		
		 if (!passchars.test(password)){
		   $("label#passwordcharacters").show();
           $("input#password").focus();
	     return false;  }
		
        alert ('name='+ firstname + ' ' + lastname + '\nemail=' + email + '\npassword=' + password);
	    return false;

	 });
  });
		
		
	
