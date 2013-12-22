$("#validate").keyup(function(){

        var email = $("#validate").val();

        if(email != 0)
        {
            if(isValidEmailAddress(email))
            {
                $("#validEmail").html('Ok.');
            } else {
                $("#validEmail").html('Please enter valid email.');
            }
        } else {
            $("#validEmail").html(' ');         
        }

 });
 
 $("#validate_login").keyup(function(){
 
         var email = $("#validate_login").val();
 
         if(email != 0)
         {
             if(isValidEmailAddress(email))
             {
                 $("#validEmail_login").html('Ok.');
             } else {
                 $("#validEmail_login").html('Please enter valid email.');
             }
         } else {
             $("#validEmail_login").html(' ');         
         }
 
  });
 
 function isValidEmailAddress(emailAddress) {
     var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
     return pattern.test(emailAddress);
 };