//Parent Chat function
function Chat () {
    this.refresh = refreshChat;
    this.submit = submitChat;
    this.getState = getStateOfChat;
}

//Function to get chat info like number of users online, number of messages, .....
function getStateOfChat() {
  //TODO
}


//function to ask server for new message, return them as JSON and decrypted
function refreshChat() {
    var lastMessageId = $('.post').last().attr('id');
    $.ajax({
      type: "POST",
      url: "minichat.php",
      data: {'lastMessageId': lastMessageId}, //TODO: query only last messages without decrypting, decryption occurs later with the type function
      dataType: "json",
      success: function(data) {
        if(data){
          for(var i=9; i>=0; i--) { //FIXME: This is a hack, the length of data should not be harcoded
          //create a div container for each message  
          var div = $("<div>").addClass('post').attr('id',data[i].id).appendTo("#minichat");
          $("<p><strong>").text(data[i].pseudo+data[i].id+":").appendTo(div);
          var dectryptedMessage = AESDecryptCtr(data[i].message,'clé-clé-clé-clé',256);         //Decode AES
          //console.log(dectryptedMessage+" "+i);
          dectryptedMessage = decodeURIComponent(dectryptedMessage);                            //Decode URL encoded
          $("<p><span>").addClass(data[i].pseudo).addClass('type').text(dectryptedMessage).appendTo(div);
        }
        }
        //Scroll #minichat to bottom
        document.getElementById('minichat').scrollTop = document.getElementById('minichat').scrollHeight;
      }
    });
}




//function to send data to server
function submitChat(pseudoText, messageText) {
  refreshChat();
  //Get input data
  messageText = encodeURIComponent(messageText);                      //encodes special characters
  messageText = AESEncryptCtr(messageText, 'clé-clé-clé-clé',256);    //Encrypt usign AES
  pseudoText = encodeURIComponent(pseudoText);
  
  //POST encrypted message NOTE: using $.ajax instead of $.post for more options 
  $.ajax({
    type: "POST",
    url: "minichat.php",
    data: {pseudo: pseudoText, message: messageText },
    dataType: "json",
    success: function(data){
      refreshChat();
    }
  });
  //$.post("minichat.php", {pseudo: pseudoText, message: messageText });  

  //Clear form input value
  $("#message").attr("value", "");
}











// function getXMLHttpRequest() {
//   var xhr = null; 
//   if (window.XMLHttpRequest || window.ActiveXObject) {
//     if (window.ActiveXObject) {
//       try {
//         xhr = new ActiveXObject("Msxml2.XMLHTTP");
//       } catch(e) {
//         xhr = new ActiveXObject("Microsoft.XMLHTTP");
//       }
//     } else {
//       xhr = new XMLHttpRequest(); 
//     }
//   } else {
//     alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
//     return null;
//   }
//   return xhr;
// }

// function submitChatOld()
// {
// var xhr = getXMLHttpRequest();
// var pseudo = encodeURIComponent(document.getElementById('pseudo').value);
// var message = AESEncryptCtr(encodeURIComponent(document.getElementById('message').value), 'clé-clé-clé-clé',256);
// document.getElementById('message').value = ""; // on vide le message sur la page

// xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
//                 document.getElementById('minichat').innerHTML = xhr.responseText; // Données textuelles récupérées
//         }
// };

// xhr.open("POST", "minichat.php", true);
// xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
// xhr.send("pseudo="+pseudo+"&message="+message);

// }

// function refreshChatOld()  
// {
// var xhr = getXMLHttpRequest();
// xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
//                 document.getElementById('minichat').innerHTML = xhr.responseText; // Données textuelles récupérées
//         }
// var encryptedmess = document.getElementById('mess');
// encryptedmess.value = 'message decrypté';
// };

// xhr.open("GET", "minichat.php", true);
// xhr.send(null);
// }

//var timer=setInterval("refreshChat()", 5000); // répète toutes les x ms