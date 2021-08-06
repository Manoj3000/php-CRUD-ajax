<?php
include('conn.php');

$id=$_POST['id'];
$sql = "SELECT id, std_no, std_name, std_dob, std_doj FROM students_details WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print_r(json_encode($row));
    }
} else {
    echo "0";
}
$conn->close();
?>