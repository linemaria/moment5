
<?php

//INSTALL DATABASE

include("includes/config.php");

//anslut
$db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
if($db->connect_errno > 0) {
    die('Fel vid anslutning [' . $db->connect_error . ']');
}
//
$sql = "DROP TABLE IF EXISTS courses;";
$sql .= " CREATE TABLE courses(
           id INT(11) PRIMARY KEY AUTO_INCREMENT, code VARCHAR(11) NOT NULL, 
            courseName VARCHAR(64) NOT NULL, 
            progression VARCHAR(1) NOT NULL, 
            syllabus VARCHAR(500) NOT NULL, 
            term INT(1) NOT NULL
        );";


// echo SQL-question
echo "<pre>$sql</pre>";

//Send SQL-question to database
if($db ->multi_query($sql)) {
    echo "<p>Tables are installed on <strong>" . DBHOST . "</strong></p>";
} else {
    echo "<p class='error'>Error installing tables</p>";
}
    
?>

</body>
</html>