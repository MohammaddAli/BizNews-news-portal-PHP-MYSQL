<?php
require "../../lib/employee.php";
$extErr = "";
$fileName = "";
$profileImage = "";

$profileImagePath = "./employee_profile_image/";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $is_admin = $_POST["is_admin"] ? 1 : 0;

        if ($_FILES["profileImage"]["error"] == 0) {
            $fileName = $_FILES["profileImage"]["name"];
            $fileTmp = $_FILES["profileImage"]["tmp_name"];
            $fileExtension = pathinfo($_FILES["profileImage"]["name"], PATHINFO_EXTENSION);
            $allowedExt = ["jpg", "jpeg", "png", "webp"];
            if (in_array($fileExtension, $allowedExt)) {
                $profileImage = "$name.$fileExtension";
                if (file_exists("./employee_profile_image")) {
                    move_uploaded_file($fileTmp, $profileImagePath . $profileImage);
                }
            } else {
                $extErr = "the $fileExtension extention not allowed";
            }
        }
        $addEmployee = new employee;
        $addEmployee->addNewEmployee($name, $email, $password, $is_admin, $profileImage);
        header("Location: ./show_all_employee.php");
    }
}

include "../header.php";

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add employee</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="./add_new_employee.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Please enter the employee name here ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Please enter the employee email here ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add password</label>
                            <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Please enter the employee password here ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add profile image</label>
                            <input type="file" name="profileImage" class="form-control" id="exampleInputEmail1">
                        </div>

                        <div>
                            <label for="exampleInputEmail1">Is admin</label>
                            <input type="checkbox" name="is_admin" id="exampleInputEmail1">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->





<?php

include "../footer.php";
?>