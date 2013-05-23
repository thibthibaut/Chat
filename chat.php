<?php 
if (!isset($_SESSION)) {
  session_start();
}
/*if(!$_SESSION['Connected'])
{
    exit('You must be logged to view this page');
};*/
if(isset($_SESSION['Connected']) and $_SESSION['Connected'] == true) {
?> 


<!DOCTYPE html >
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chat - minichat</title>
    <link rel="stylesheet" href="style.css" />
    <link href='http://fonts.googleapis.com/css?family=Josefin+Slab|Alegreya+SC' rel='stylesheet' type='text/css'>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="https://c328740.ssl.cf1.rackcdn.com/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    
    <script src="js/aes.js"></script>
    <script src="js/minichat.js"></script>
    <script src="js/minchat.page.js"></script>
    <script src="js/type.js"></script>

    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>

</head>

<body onload="setInterval('chat.refresh()', 500)">

<?php $key= strtolower($_SESSION['pseudo']) . $_SESSION['password']; ?>

<div class="container">
<div id="minichat"></div>

    <input type="hidden" name="pseudo" id="pseudo" value=<?php echo '"' . $_SESSION['pseudo'] . '"'; ?>   />
    <input type="hidden" name="key" id="key" value=<?php echo '"' . $key . '"'; ?>   /> 
    <br />
    Message : <br/>
    <input type="text" name="message" id="message" size=44 maxlength = '100'>

    <br />
<br>
<a href="changepw.php">Changer le mot de passe</a>  &nbsp &nbsp   <a href="connect.php?logout">Se deconnecter</a>
</div>

</body>
</html>
























<?php } else { ?>

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
</html>
<?php } ?>