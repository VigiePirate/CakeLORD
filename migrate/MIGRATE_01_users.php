<?php

include 'MIGRATE.config.php';
include 'MIGRATE_00_initDB.php';


/*** TABLE UTILISATEURS ***/
echo "<h2>USERS MIGRATION</h2>";
echo "<h3>Select users from lordrat_v1.peel_utilisateurs</h3>";
$sql = "SELECT email,mot_passe,priv,civilite,prenom,nom_famille,pseudo,naissance,newsletter,ville,date_insert,date_update FROM peel_utilisateurs";
$result = $old->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$users[] = $row;
    }
} else {
    echo "0 results";
}
$old->close();
echo count($users) . " users to migrate <br>";

echo "<h3>Convert old users to new users...</h3>";

for ($i=0;$i<count($users);$i++) {
    // PRIV -> ROLE_ID
	switch ($users[$i]["priv"]){
		case "":
		case "util":
			$users[$i]["priv"] = 4;	
			break;
		case "redac":
		case "comm":
		case "rats":
			$users[$i]["priv"] = 3;	
			echo "STAFF " . $users[$i]["prenom"] . " " . $users[$i]["nom_famille"] . "<br>";
			break;
		case "admin":
			$users[$i]["priv"] = 2;	
			echo "ADMIN " . $users[$i]["prenom"] . " " . $users[$i]["nom_famille"] . "<br>";
			break;
	}
	
	
	// CIVILITE -> USER_SEX
	switch ($users[$i]["civilite"]){
		case "Mlle":
		case "Mme":
			$users[$i]["civilite"] = "F";
			break;
		case "M.":
			$users[$i]["civilite"] = "M";
			break;
	}
	
	// DATES
	if ($users[$i]["date_insert"] != "0000-00-00 00:00:00"){
		$users[$i]["date_insert"] = date("Y-m-d", strtotime($users[$i]["date_insert"]));
	} else {
		$users[$i]["date_insert"] = '1981-08-01';
	}

	if ($users[$i]["date_update"] != "0000-00-00 00:00:00"){
		$users[$i]["date_update"] = date("Y-m-d", strtotime($users[$i]["date_update"]));
	} else {
		$users[$i]["date_update"] = '1981-08-01';
	}
	
		if ($users[$i]["naissance"] != "0000-00-00"){
		$users[$i]["naissance"] = date("Y-m-d", strtotime($users[$i]["naissance"]));
	} else {
		$users[$i]["naissance"] = NULL;
	}

}

echo "<h4>Insert users to cakelord.users</h4>";
$new->query("SET FOREIGN_KEY_CHECKS = 0;");
$new->query("TRUNCATE users");
$new->query("SET FOREIGN_KEY_CHECKS = 1;");
$nbErr = 0;

// Création de l'utilisateur générique LORD 
$sql = 	"INSERT INTO users (email,password,role_id,sex,firstname,lastname,username,birth_date,wants_newsletter,created,modified) ";
$sql .= " VALUES ('admin@lord-rat.org','',1,NULL,'LORD','LORD','LORD',NULL,0,'1981-08-01','1981-08-01')";

	if ($new->query($sql) === TRUE) {
		echo "New user created LORD successfully <br>";
	} else {
		echo "<span style='color:red'>!!! ERROR !!!";
		echo $sql . "<br>" . $new->error. "<br></span>";
		$nbErr +=1;
	}
	
// Création de l'utilisateur générique Unregistered pour y rattacher les rateries génériques et les rateries en erreur par la suite 
$sql = 	"INSERT INTO users (email,password,role_id,sex,firstname,lastname,username,birth_date,wants_newsletter,created,modified) ";
$sql .= " VALUES ('admin@lord-rat.org','',1,NULL,'LORD','LORD','Unregistered',NULL,0,'1981-08-01','1981-08-01')";

	if ($new->query($sql) === TRUE) {
		echo "New user created Unregistered successfully <br>";
	} else {
		echo "<span style='color:red'>!!! ERROR !!!";
		echo $sql . "<br>" . $new->error. "<br></span>";
		$nbErr +=1;
	}
	
foreach ($users as $user){
	$sql = 	"INSERT INTO users (email,password,role_id,sex,firstname,lastname,username,birth_date,wants_newsletter,localization,created,modified) ";
	$sql .= " VALUES ('".$user["email"]."'";
	$sql .= ",'" . $user["mot_passe"] . "'";
	$sql .= "," . $user["priv"];
	$sql .= "," . var_export($user["civilite"], true);
	$sql .= ",'" . $new->real_escape_string(html_entity_decode($user["prenom"])) . "'";
	$sql .= ",'" . $new->real_escape_string(html_entity_decode($user["nom_famille"])) . "'";
	$sql .= ",'" . $new->real_escape_string(html_entity_decode($user["pseudo"])) . "'";
	$sql .= "," . var_export($user["naissance"], true);
	$sql .= "," . var_export($user["newsletter"], true);
	$sql .= ",'" . $new->real_escape_string(html_entity_decode($user["ville"])) . "'";
	$sql .= "," . var_export($user["date_insert"], true);
	$sql .= "," . var_export($user["date_update"], true) . ")";
	
	if ($new->query($sql) === TRUE) {
		echo "New user created " . $user['pseudo'] . " (". $user["prenom"] . " " . $user["nom_famille"] . ") successfully <br>";
	} else {
		echo "<span style='color:red'> !!! ERROR !!! " . $user['pseudo'] . " (". $user["prenom"] . " " . $user["nom_famille"] . ") <br>";
		echo $sql . "<br>" . $new->error . "</span><br>";
		$nbErr +=1;
	}
}

echo "<h3>Check migration</h3>";
echo "<h4>Select users from cakelord.users</h4>";

$sql = "SELECT username FROM users where id > 2";
$result = $new->query($sql);

if ($result->num_rows > 0) {
	echo $result->num_rows . " users migrated";
} else {
    echo "0 results";
}

echo "<h4>Nb err</h4>";
echo $nbErr;

$new->close(); 

?>