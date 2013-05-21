<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link rel="stylesheet" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab|Alegreya+SC' rel='stylesheet' type='text/css'>
</head>

<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<?php

if (isset($_POST['fpw']) || isset($_POST['pw1']) || isset($_POST['pw2']) || $_SESSION['Connected']==true) {

    
    if ($_POST['pw1'] != $_POST['pw2']) {

        echo "The two passwords don't match!<br><a href='changepw.php'>Go back</a>";
    }

    if ($_POST['pw1'] == $_POST['pw2']) {

        $bdd = new PDO('mysql:host=127.0.0.1;dbname=securechat', 'root', '');
        $reponse = $bdd->query('SELECT * FROM users');
        $i=0;
        while ($donnees = $reponse->fetch()) {
        $user[$i]=$donnees['name'];
        $passwd[$i]=$donnees['password'];
        $i=$i+1;
        }

        $hash1 = md5($_POST['fpw']);
        $hash2 = strtolower($_SESSION['pseudo']) . $hash1 ;
        $hash = sha1($hash2);

        $new1 = md5($_POST['pw1']);
        $new2 = strtolower($_SESSION['pseudo']) . $new1 ;
        $new3 = sha1($new2);

        $test=0;

        for ($j=0; $j < $i; $j++) { 

            if ($hash==$passwd[$j]) {

                $req = $bdd->prepare('UPDATE users SET password = :new WHERE password = :former');
                $req->execute(array(
                'new' => $new3,
                'former' => $hash,
                ));
                echo "Your password have successfully been changed <br> <a href='chat.php'>Go to the chat</a>";
                $test=1;
            }

        }
    }

if ($test==0) {echo "Your former password is not the good one<br><a href='changepw.php'>Go back</a>";}

}
else {
?>








<script type="text/javascript">
    var text = '<span class="string">Change.</span><span class="keyword"> Your.</span><span class="variable"> Password.</span>';

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




<div id="console">
    <pre id="consoleText">
    
    </pre>



</div>

<form action="changepw.php" method="POST" >
   
<table>
   <tr><td>Former password </td><td><input type="password" name="fpw" size=12></td></tr>
    <tr><td> New one  </td><td><input type="password" name="pw1" size=12></td></tr>
    <tr><td>New one again</td> <td><input type="password" name="pw2" size=12></td></tr>
    <tr><td></td><td><input type="submit" value="Change"></td></tr>
   
</table>
    
</form>








</body>







</html>

<?php }?>