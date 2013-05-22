function getXMLHttpRequest() {
	var xhr = null;	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	return xhr;
}


function refreshChat()  
{
var xhr = getXMLHttpRequest();
xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById('minichat').innerHTML = xhr.responseText; // Données textuelles récupérées
        }
//FIXME OR REMOVE: Cannot set property 'value' of null 
// var encryptedmess = document.getElementById('mess');
// encryptedmess.value = 'message decrypté';
};

//xhr.open("GET", "minichat.php", true);
//xhr.send(null);
//getMessages("minichat.php")

//Must have jQuery library loaded if you want to use JSON, 
//otherwise getXMLHttpRequest can only get Text or XML, and it's not the current trend going on today
  $.getJSON("minichat.php", function(data){ 
    $.each( data, function(index) {
      $("<p><strong>").text(data[index].pseudo).appendTo("#minichat");
      var dectryptedMessage = AESDecryptCtr(data[index].message,'clé-clé-clé-clé',256);
      $("<span>").addClass(data[index].pseudo).text(dectryptedMessage).appendTo("#minichat");
    })
  });
}



function submitChat()
{
var xhr = getXMLHttpRequest();
var pseudo = encodeURIComponent(document.getElementById('pseudo').value);
var message = AESEncryptCtr(encodeURIComponent(document.getElementById('message').value), 'clé-clé-clé-clé',256);
document.getElementById('message').value = ""; // on vide le message sur la page

xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
               // document.getElementById('minichat').innerHTML = xhr.responseText; // Données textuelles récupérées
        }
};

xhr.open("POST", "minichat.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.send("pseudo="+pseudo+"&message="+message);

}
var timer=setInterval("refreshChat()", 5000); // répète toutes les x ms