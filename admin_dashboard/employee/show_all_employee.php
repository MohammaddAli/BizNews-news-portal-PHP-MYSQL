<?php
require "../../lib/employee.php";
$employeeObj = new employee;
$allEmployees = $employeeObj->showAllEmployees();
include "../header.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <a href="./add_new_employee.php" class="btn btn-success">Add new employee</a>
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Employees</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Is admin</th>
                                    <th class="text-right">Update</th>
                                    <th class="text-right">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allEmployees as $element) { ?>
                                    <tr>
                                        <td><?php echo $element["id"] ?></td>
                                        <td><?php echo $element["name"] ?></td>
                                        <td><?php echo $element["email"] ?></td>
                                        <td><?php echo $element["is_admin"] ? 'Admin' : 'Not admin'; ?></td>
                                        <td class="text-right"> <a href="update_employee.php?id=<?php echo $element["id"] ?>" class="btn btn-primary">update</a></td>
                                        <td class="text-right"><a href="delete_employee.php?id=<?php echo $element["id"] ?>" class="btn btn-danger">delete</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
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