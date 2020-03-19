<?php

$servername = "localhost";
$username = "root";
$password = "";
$old_db = "lordrat_v1";
$new_db = "cakelord";

echo "<h2>Databases connection</h2>";
// Create connection
$old = new mysqli($servername, $username, $password, $old_db);
// Check connection
if ($old->connect_error) {
    die("Connection failed: " . $old->connect_error);
} 
echo "Connected successfully to old db <br>";
echo "Jeu de caractère initial : " . $old->character_set_name() . "<br>";

/* Modification du jeu de résultats en utf8 */
if (!$old->set_charset("utf8")) {
    echo "Erreur lors du chargement du jeu de caractères utf8 : " . $old->error . "<br>";
    exit();
} else {
    echo "Jeu de caractères courant : " . $old->character_set_name() . "<br>";
}
echo "<br>";

// Create connection
$new = new mysqli($servername, $username, $password, $new_db);
// Check connection
if ($new->connect_error) {
    die("Connection failed: " . $new->connect_error);
} 
echo "Connected successfully to new db <br>";

/* Modification du jeu de résultats en utf8 */
if (!$new->query("SET NAMES utf8mb4 COLLATE utf8mb4_general_ci")) {
    echo "Erreur lors du chargement du jeu de caractères utf8 : " . $new->error . "<br>";
    exit();
} else {
    echo "Jeu de caractères courant : " . $new->character_set_name() . "<br>";
}
echo "<br>";
?>