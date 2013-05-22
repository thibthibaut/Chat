//Decalre a new chat instance
var chat =  new Chat();

$(function() {

    // watch text input for key presses
    $("#message").keydown(function(event) {  
       var key = event.which;  
        
        //TODO: send typing status to server
    
    });


    // watch textarea for release of key press
    $('#message').keydown(function(e) {  

      if (e.keyCode == 13) { 

        var text = $(this).val(); 
        var name = $('#pseudo').val();
              
        console.log(text);
        // send 
        chat.submit(name, text);  
        $(this).val("");
      }
    });
   });