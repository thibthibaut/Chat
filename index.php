<?php session_start();
$_SESSION['Connected']=false;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link rel="stylesheet" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab|Alegreya+SC' rel='stylesheet' type='text/css'>
</head>

<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>


<div id="console">
    <pre id="consoleText">
    
    </pre>



</div>

<form action="connect.php" method="POST" >
    Id  <input type="text" name="id" size=12> &nbsp &nbsp
    Pass  <input type="password" name="pw" size=12> &nbsp
    <input type="submit" value=">>">
</form>



<script type="text/javascript">
    var text = '<span class="string">Hello.</span> Welcome to the secured chat of Thibaut Vercueil. <br> <span class="variable">Now, connect please...</span>';

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
        setTimeout(type, 00100);
    });

</script>




</body>







</html>