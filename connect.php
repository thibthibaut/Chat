<?php session_start(); 

if(!empty($_POST['id']) and !empty($_POST['pw']) ){
    //Include database class
    require_once 'class/database.class.php';
    //Include database config file
    require_once 'Connections/dbconn.php';

    // Instantiate database.
    $database = new Database();

    //Hash password
    $hash1= md5($_POST['pw']);
    $hash2 = $_POST['id'] . $hash1 ;
    $hash= sha1($hash2);

    $database->query('SELECT * FROM users WHERE name = :name AND password = :password');
    $database->bind(':name',$_POST['id']);
    $database->bind(':password', $hash);
    $row = $database->single();
    $isValidUser = $database->rowCount();

    if ($isValidUser == 1) { 
            $_SESSION['Connected'] = true;
            $_SESSION['pseudo'] = $_POST['id'];
            $_SESSION['password'] = $hash;
            $afficher= '\'' . 'Welcome ' . ucwords($_POST['id']) . ' !' . '\'' ;
    
    } else {
            $_SESSION['Connected'] = false;
            $afficher= '\'' . 'Too sad... Your Id or Password is not the good one :( <br> Try again !'  . '\'';
    }

}





/********
* NEVER QUERY ALL PASSWORDS !!!!
* By doing this, all users and passwords are loaded into the $reponse variable.
*
*/

//$i=0;
// while ($donnees = $reponse->fetch()) {
//     $user[$i]=$donnees['name'];
//     $passwd[$i]=$donnees['password'];
//     $i=$i+1;

// }

// for ($j=0; $j < $i; $j++) { 
//     if ($_POST['id']==$user[$j] and $hash==$passwd[$j]) {
//         $afficher= '\'' . 'Welcome ' . ucwords($_POST['id']) . ' !' . '\'' ;
//         $_SESSION['Connected']=true;
//         $_SESSION['pseudo']=ucwords($_POST['id']);
//         $_SESSION['password']=$hash;
//     }

// }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link rel="stylesheet" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab|Alegreya+SC' rel='stylesheet' type='text/css'>
</head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>




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
    if ($isValidUser){
    ?>

        <div id="console">
            <pre id="consoleText">
            </pre>
        </div>

        <a href="chat.php">Access to the chat room</a><br><a href="changepw.php">Change my password</a>

    <?php } else { ?>

    <div id="console">
        <pre id="consoleText">
        </pre>
    </div>

    <a href="index.php">Go back home</a>

    <?php } ?>




</body>
</html>