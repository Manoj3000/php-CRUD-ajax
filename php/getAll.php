<?php
include('conn.php');

$sql = "SELECT * FROM students_details";
$result = $conn->query($sql);

$dbdata = array();

while ( $row = $result->fetch_assoc())  {
$dbdata[]=$row;
}

$conn->close();
?>