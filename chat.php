<?php session_start();

if ($_SESSION['Connected']==true) { ?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab|Alegreya+SC' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="minichat.js"></script>
</head>

<body onload="refreshChat();" onKeyPress="if (event.keyCode == 13) submitChat()">

<?php $key= strtolower($_SESSION['pseudo']) . $_SESSION['password']; ?>

<div class="container">
<div id="minichat"></div>

<input type="hidden" name="pseudo" id="pseudo" value=<?php echo '"' . $_SESSION['pseudo'] . '"'; ?>   />
<input type="hidden" name="key" id="key" value=<?php echo '"' . $key . '"'; ?>   />
<br />
Message : <br/><input name="message" id="message" size=44><br />

<br>
<a href="changepw.php">Changer le mot de passe</a>  &nbsp &nbsp   <a href="deconnect.php">Se deconnecter</a>
</div>







</body>
























<?php } 

else { ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link rel="stylesheet" href="style.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
    var text = 'Oooooh, you can\'t go to the chat... you are not connected ! That is sooo sad.' ;

    var currentChar = 1;
    var htmltag = false;
    var cache = '';


    function type()
    {
        var str = text.substr(0, currentChar);
        var last = str.substr(str.length -1, str.length);
        if(last != '<' && last != '>' & last != '/') {
            $("#consoleText").html(str);
        }
        currentChar++;
        if(currentChar <= text.length)
        {
            if(last == '<') {
                htmltag = true;
            } else if(last == '>') {
                htmltag = false;
            }
            if(htmltag) {
                setTimeout(type, 1);
            } else {
                setTimeout(type, 50);
            }
        }
    }

    $(document).ready(function() {
        $("#consoleText").html("");
        setTimeout(type, 0010);
    });

</script>
</head>

<body>
<div id="console">
    <pre id="consoleText">
    </pre>
</div>
</body>
<?php } ?>







</html>