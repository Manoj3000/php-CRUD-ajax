<?php
include('conn.php');

$std_no = $_POST['std_no'];
$std_name = $_POST['std_name'];
$std_dob = $_POST['std_dob'];
$std_doj = $_POST['std_doj'];


$sql = "INSERT INTO students_details (std_no, std_name, std_dob, std_doj)
VALUES ('$std_no', '$std_name', '$std_dob', '$std_doj')";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}
$conn->close();

?>