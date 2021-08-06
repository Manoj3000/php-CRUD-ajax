<?php
include('conn.php');

$std_id = $_POST['id'];

$sql = "DELETE FROM students_details WHERE id='$std_id'";

if ($conn->query($sql) === TRUE) {
    echo "1";
} else {
    echo "0";
}

$conn->close();
?>