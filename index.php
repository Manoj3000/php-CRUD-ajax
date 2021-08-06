<!DOCTYPE html>
<html lang="en">
<?php include('php/getAll.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card p-3">
            <div class="card-heading d-flex justify-content-between">
                <h3>Students</h3>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Student</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student No</th>
                            <th>Student Name</th>
                            <th>Student DOB</th>
                            <th>Student DOJ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($dbdata as $std){ ?>
                            <tr>
                                <td><?php echo $std['std_no']; ?></td>
                                <td><?php echo $std['std_name']; ?></td>
                                <td><?php echo $std['std_dob']; ?></td>
                                <td><?php echo $std['std_doj']; ?></td>
                                <td>
                                    <a class="btn btn-success" type="button" onclick="getStdDataForEdit(<?php echo $std['id']; ?>)" ><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger" type="button" onclick="deleteStd(<?php echo $std['id']; ?>)" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Student</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body p-4">
                    <form id="add_std_form">
                        <div class="form-group">
                            <label for="std_no">Student No:</label>
                            <input required type="number" class="form-control" placeholder="Enter No" id="std_no" name="std_no">
                        </div>
                        <div class="form-group">
                            <label for="std_name">Student Name:</label>
                            <input required type="text" class="form-control" placeholder="Enter Name" id="std_name"
                                name="std_name">
                        </div>
                        <div class="form-group">
                            <label for="std_dob">Student DOB:</label>
                            <input required type="date" class="form-control" id="std_dob" name="std_dob">
                        </div>
                        <div class="form-group">
                            <label for="std_doj">Student DOJ:</label>
                            <input required type="date" class="form-control" id="std_doj" name="std_doj">
                        </div>
                        <div class="text-center">
                            <p id="add_msg"></p>
                            <button type="submit" class="btn btn-primary my-3 ">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade " id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Student</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body p-4">
                    <form id="edit_std_form">
                        <input type="hidden" name="std_id" id="std_id">
                        <div class="form-group">
                            <label for="edit_std_no">Student No:</label>
                            <input required type="number" class="form-control" placeholder="Enter No" id="edit_std_no" name="edit_std_no">
                        </div>
                        <div class="form-group">
                            <label for="edit_std_name">Student Name:</label>
                            <input required type="text" class="form-control" placeholder="Enter Name" id="edit_std_name"
                                name="edit_std_name">
                        </div>
                        <div class="form-group">
                            <label for="edit_std_dob">Student DOB:</label>
                            <input required type="date" class="form-control" id="edit_std_dob" name="edit_std_dob">
                        </div>
                        <div class="form-group">
                            <label for="edit_std_doj">Student DOJ:</label>
                            <input required type="date" class="form-control" id="edit_std_doj" name="edit_std_doj">
                        </div>
                        <div class="text-center">
                            <p id="edit_msg"></p>
                            <button type="submit" class="btn btn-success my-3 ">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){

            // add student
            $("#add_std_form").submit(function(e){
                e.preventDefault();

                var std_no = $("#std_no").val();
                var std_name = $("#std_name").val();
                var std_dob = $("#std_dob").val();
                var std_doj = $("#std_doj").val();

                $.ajax({
                    type: "POST",
                    url: "php/add.php",
                    data: "std_no="+std_no+"&std_name="+std_name+"&std_dob="+std_dob+"&std_doj="+std_doj,
                    success: function(res) {
                        setTimeout(function(){ $("#add_std_form")[0].reset(); $('#addModal').modal('hide'); location.reload();}, 3000);
                        if(res == '1'){
                            $("#add_msg").text('New Student Added Successfully!').css('color','green');
                        }else{
                            $("#add_msg").text('Add Failed!').css('color','red');
                        }
                    }
                });
            });

            // get std edit data
            getStdDataForEdit = function(id){
                $.ajax({
                    type: "POST",
                    url: "php/getForEdit.php",
                    data: "id="+id,
                    success: function(res) {
                        if(res != ''){
                            var data = JSON.parse(res);
                            $("#std_id").val(data.id);
                            $("#edit_std_no").val(data.std_no);
                            $("#edit_std_name").val(data.std_name);
                            $("#edit_std_dob").val(data.std_dob);
                            $("#edit_std_doj").val(data.std_doj);
                            $('#editModal').modal('show');
                        }else{
                            alert('Fetch Data Failed!');
                        }
                    }
                });
            }

            // edit student
            $("#edit_std_form").submit(function(e){
                e.preventDefault();

                var std_id = $("#std_id").val();
                var std_no = $("#edit_std_no").val();
                var std_name = $("#edit_std_name").val();
                var std_dob = $("#edit_std_dob").val();
                var std_doj = $("#edit_std_doj").val();

                $.ajax({
                    type: "POST",
                    url: "php/update.php",
                    data: "std_no="+std_no+"&std_name="+std_name+"&std_dob="+std_dob+"&std_doj="+std_doj+"&std_id="+std_id,
                    success: function(res) {
                        setTimeout(function(){ $("#add_std_form")[0].reset(); $('#editModal').modal('hide'); location.reload();}, 3000);
                        if(res == '1'){
                            $("#edit_msg").text('Student Data Updated Successfully!').css('color','green');
                        }else{
                            $("#edit_msg").text('Update Failed!').css('color','red');
                        }
                    }
                });
            });

            deleteStd = function(id){
                $.ajax({
                    type: "POST",
                    url: "php/delete.php",
                    data: "id="+id,
                    success: function(res) {
                        if(res == '1'){
                            alert("Student Deleted Successfully!");
                            location.reload();
                        }else{
                            alert('Delete Failed!');
                            location.reload();
                        }
                    }
                });
            }
            
        });
    </script>
</body>

</html>
