<?php 

echo "<h2>Init DB CakeLORD</h2>";

echo "<h3>Insert roles to cakelord.roles</h3>";

$new->query("SET FOREIGN_KEY_CHECKS = 0;");
$new->query("TRUNCATE roles;");
$new->query("SET FOREIGN_KEY_CHECKS = 1;");

// ROOT
$sql = 	"INSERT INTO roles (id,name) VALUES (1,'root')";
if ($new->query($sql) === TRUE) {
	echo "New role root created successfully <br>";
} else {
	echo "!!! ERROR !!!";
	echo $sql . "<br>" . $new->error;
}

// ADMIN
$sql = 	"INSERT INTO roles (id,name) VALUES (2,'admin')";
if ($new->query($sql) === TRUE) {
	echo "New role admin created successfully <br>";
} else {
	echo "!!! ERROR !!!";
	echo $sql . "<br>" . $new->error;
}

// STAFF
$sql = 	"INSERT INTO roles (id,name) VALUES (3,'staff')";
if ($new->query($sql) === TRUE) {
	echo "New role staff created successfully <br>";
} else {
	echo "!!! ERROR !!!";
	echo $sql . "<br>" . $new->error;
}

// USER
$sql = 	"INSERT INTO roles (id,name) VALUES (4,'user')";
if ($new->query($sql) === TRUE) {
	echo "New role user created successfully <br>";
} else {
	echo "!!! ERROR !!!";
	echo $sql . "<br>" . $new->error;
}

?>