<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link rel="stylesheet" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab|Alegreya+SC' rel='stylesheet' type='text/css'>
</head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

 <?php

try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=securechat', 'root', '');
}
catch (Exception $e)
{
        die('ERROR: ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM users');

$i=0;
while ($donnees = $reponse->fetch()) {
    $user[$i]=$donnees['name'];
    $passwd[$i]=$donnees['password'];
    $i=$i+1;

}



$hash1= md5($_POST['pw']);
$hash2 = $_POST['id'] . $hash1 ;
$hash= sha1($hash2);

$connection=false;

for ($j=0; $j < $i; $j++) { 
    
    if ($_POST['id']==$user[$j]) {

        if ($hash==$passwd[$j]) {

            $connection=true;
            $afficher= '\'' . 'Welcome ' . ucwords($_POST['id']) . ' !' . '\'' ;
            $_SESSION['Connected']=true;
            $_SESSION['pseudo']=ucwords($_POST['id']);
            $_SESSION['password']=$hash;
        }
    }


}

if($connection==false) {$afficher= '\'' . 'Too sad... Your Id or Password is not the good one :( <br> Try again !'  . '\''; }

?>

<script type="text/javascript">
    var text = <?php echo $afficher; ?> ;

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




<body>


<?php

if ($connection==true) { ?>


<div id="console">
    <pre id="consoleText">
    </pre>
</div>

<a href="chat.php">Access to the chat room</a><br><a href="changepw.php">Change my password</a>


<?php } 

if($connection==false) { ?>

<div id="console">
    <pre id="consoleText">
    </pre>
</div>

<a href="index.php">Go back home</a>

<?php } ?>




</body>



</html>