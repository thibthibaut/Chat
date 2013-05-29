<?php

//Include database class
require_once 'class/database.class.php';
//Include database config file
require_once 'Connections/dbconn.php';

// Instantiate database.
$database = new Database();


// mysql_connect("localhost", "chat_admin", "dim70#meanly");
// mysql_query('set names utf8');
// mysql_select_db("securechat");


if (!empty($_POST['pseudo']) && !empty($_POST['message'])) {

    	//TODO: instead of getting pseudo from $_POST, recover pseudo in the session id

		//$message = mysql_real_escape_string(utf8_decode($_POST['message']));
        //$message = mysql_real_escape_string($_POST['message']);
        //$pseudo = mysql_real_escape_string($_POST['pseudo']);
        $database->query('INSERT INTO minichat(pseudo,message) VALUES(:pseudo, :message)');
        $database->bind(':pseudo',$_POST['pseudo']);
        $database->bind(':message',$_POST['message']);
        $database->execute();
        //mysql_query("INSERT INTO minichat(pseudo,message,timestamp) VALUES('$pseudo', '$message', '".time()."')");
}



if (isset($_POST['lastMessageId'])){
	//$result = mysql_query("SELECT * FROM minichat ORDER BY id DESC LIMIT 0,10");
	$database->query('SELECT * FROM minichat WHERE id > :lastMessageId ORDER BY id ASC');
	$database->bind(':lastMessageId',$_POST['lastMessageId']);
	$rows = $database->resultSet();

	if($rows){
		header('Content-Type: application/json'); //Set mime type to JSON
		echo json_encode($rows); //Return messages into JSON
	}

}





/******************************
$i=0;
while($val = mysql_fetch_array($reponse))
{
	$apseudo[$i]=$val['pseudo'];
	$atimestamp[$i]=$val['timestamp'];
	$amessage[$i]=$val['message'];
	$i=$i+1;

}
print_r(expression)


for ($j=0; $j < 10 ; $j++) { 
	$k=9-$j;


	//echo '<p><strong>'.htmlentities(stripslashes($apseudo[$k])).'</strong>'.date('H\:i\:s',$atimestamp[$k]).' : '. htmlentities(stripslashes($amessage[$k])) .'</p>';
	echo '<p><strong>'. htmlentities(stripslashes($apseudo[$k])) . '</strong> : <span class="' . htmlentities(stripslashes($apseudo[$k])) . '" id="mess">'. htmlentities(stripslashes($amessage[$k])) .'</span></p>';

}
*******************************/




//mysql_close();



?>
