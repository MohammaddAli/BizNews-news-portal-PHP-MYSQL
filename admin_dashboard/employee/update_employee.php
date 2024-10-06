<?php
require "../../lib/employee.php";
$employee = new employee;
$selectedEmployeey = "";
$extErr = "";
$fileName = "";
$profileImage = "";
if (isset($_GET['id'])) {
    $selectedEmployeey = $employee->getEmployee($_GET['id']);
} elseif (isset($_POST['sub'])) {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['sub'])) {
        if (!empty($_POST['employeeName']) && !empty($_POST['id'])) {
            $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

            if (!empty($_FILES["profileImage"]["name"])) {
                // File upload logic
                $fileName = $_FILES["profileImage"]["name"];
                $fileTmp = $_FILES["profileImage"]["tmp_name"];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowedExt = ["jpg", "jpeg", "png", "webp"];

                if (in_array($fileExtension, $allowedExt)) {
                    // Move uploaded file to desired location
                    $profileImage = uniqid() . "." . $fileExtension;
                    move_uploaded_file($fileTmp, "./employee_profile_image/" . $profileImage);
                } else {
                    $extErr = "The file extension '$fileExtension' is not allowed.";
                }
            } else {
                $extErr = "Please select a profile image.";
            }

            // Update employee information
            $employee->updateEmployee($_POST['employeeName'], $_POST['email'], $_POST['password'], $isAdmin,  $profileImage, $_POST['id']);
            header("Location: ./show_all_employee.php");
        } else {
            // Handle missing required fields
            echo "Please fill in all required fields.";
        }
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
                    <h1>employee</h1>
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
            <div class="card-body">
                <form action="./update_employee.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Update employee</label>
                            <input type="text" name="employeeName" class="form-control" id="exampleInputEmail1" value="<?php echo $selectedEmployeey['name'] ?>">
                            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : "" ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Update email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $selectedEmployeey['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Update password</label>
                            <input type="text" name="password" class="form-control" id="exampleInputEmail1" value="please enter the old password if you will not update you password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Update profile image</label>
                            <input type="file" name="profileImage" class="form-control" id="exampleInputEmail1">
                        </div>

                        <div>
                            <label for="exampleInputEmail1">Is admin</label>
                            <input type="checkbox" name="is_admin" id="exampleInputEmail1" value="<?php echo $selectedEmployeey['is_admin'] ?>">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <button type="submit" name="sub" class="btn btn-primary">Update</button>
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