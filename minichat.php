<?php
header("Content-Type: text/html; charset=utf-8");
mysql_connect("localhost", "root", "");
mysql_query('set names utf8');
mysql_select_db("securechat");

if (isset($_POST['pseudo']) && isset($_POST['message'])) 
{
    if (!empty($_POST['pseudo']) && !empty($_POST['message'])) 
    {
		//$message = mysql_real_escape_string(utf8_decode($_POST['message']));
        $message = mysql_real_escape_string($_POST['message']);
        $pseudo = mysql_real_escape_string($_POST['pseudo']);
        mysql_query("INSERT INTO minichat(pseudo,message,timestamp) VALUES('$pseudo', '$message', '".time()."')");
    }
}
$reponse = mysql_query("SELECT * FROM minichat ORDER BY id DESC LIMIT 0,10");

$i=0;
while($val = mysql_fetch_array($reponse))
{
	$apseudo[$i]=$val['pseudo'];
	$atimestamp[$i]=$val['timestamp'];
	$amessage[$i]=$val['message'];
	$i=$i+1;

}



for ($j=0; $j < 10 ; $j++) { 
	$k=9-$j;


	//echo '<p><strong>'.htmlentities(stripslashes($apseudo[$k])).'</strong>'.date('H\:i\:s',$atimestamp[$k]).' : '. htmlentities(stripslashes($amessage[$k])) .'</p>';
	echo '<p><strong>'. htmlentities(stripslashes($apseudo[$k])) . '</strong> : <span class="' . htmlentities(stripslashes($apseudo[$k])) . '" id="mess">'. htmlentities(stripslashes($amessage[$k])) .'</span></p>';

}





mysql_close();



?>
