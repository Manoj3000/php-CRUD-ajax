<?php
include('conn.php');

$std_id = $_POST['std_id'];
$std_no = $_POST['std_no'];
$std_name = $_POST['std_name'];
$std_dob = $_POST['std_dob'];
$std_doj = $_POST['std_doj'];

$sql = "UPDATE students_details SET std_no='$std_no', std_name='$std_name', std_dob='$std_dob', std_doj='$std_doj' WHERE id='$std_id'";

if ($conn->query($sql) === TRUE) {
  echo "1";
} else {
  echo "0";
}

$conn->close();
?>