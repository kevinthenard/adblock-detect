<?php
$ip = $_SERVER["REMOTE_ADDR"];
$navigateur = $_SERVER['HTTP_USER_AGENT'];

/* --- fonctions --- */

function newVisiteur($ip, $navigateur, $ab, $site) {
		
 	try {
		$DB_TYPE = 'mysql'; //Type of database<br>
		$DB_HOST = 'localhost'; //Host name<br>
		$DB_USER = 'root'; //Host Username<br>
		$DB_PASS = 'root'; //Host Password<br>
		$DB_NAME = 'test_adblock'; //Database name<br><br>	

		$dbh = new PDO("$DB_TYPE:host=$DB_HOST; dbname=$DB_NAME;", $DB_USER, $DB_PASS); // PDO Connection
	} catch (PDOException $e) {
	  	echo "Failed to get DB handle: " . $e->getMessage() . "\n";
	  exit;
	}
	$ip = $dbh->quote($ip);
	$ab = $dbh->quote($ab);
	$navigateur = $dbh->quote($navigateur);
	$site = $dbh->quote($site);

	$stmt = $dbh->prepare(
		'INSERT INTO `visiteurs`(`ip`, `adblock`, `navigateur`, `site`)
	   VALUES ('.$ip.', '.$ab.', '.$navigateur.', '.$site.')'
	);

  	$stmt->execute();
}
/* --- enregistrer navigateur et si AdBlock + est active --- */
//if (isset($_GET['navigateur']) && isset($_GET['ab'])) {
if (isset($_GET['ab']) && isset($_GET['site'])) {
	// $navigateur = $_GET['navigateur'];
	// $navigateur = base64_decode($navigateur);
	$ab =  $_GET['ab'];
	$site =  $_GET['site'];
	/*
	ab = 1; // adblock est present et actif
	ab = 2; // adblock est present mais desactive
	ab = 0; // adblock absent
	 */
	newVisiteur($ip, $navigateur, $ab, $site);
	echo "ok";
}else {
	echo "error";
}

?>