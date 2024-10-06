<?php
require "../../lib/category.php";
$categoryObj = new category;
$allCategories = $categoryObj->showALLCategories();
include "../header.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <a href="./add_new_category.php" class="btn btn-success">Add new category</a>
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Categories</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#ID</th>
                                    <th>Name</th>
                                    <th>Name1</th>
                                    <th>Name2</th>
                                    <th class="text-right">Update</th>
                                    <th class="text-right">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allCategories as $element) { ?>
                                    <tr>
                                        <td><?php echo $element["id"] ?></td>
                                        <td><?php echo $element["name"] ?></td>
                                        <td><?php echo $element["name1"] ?></td>
                                        <td><?php echo $element["name2"] ?></td>
                                        <!-- <td class="text-right"> <a href="update_category.php/?id=<?php echo $element["id"] ?>" class="btn btn-primary">update</a></td> -->
                                        <!-- <td class="text-right"><a href="delete_category.php/?id=<?php echo $element["id"] ?>" class="btn btn-danger">delete</a></td> -->
                                        <td class="text-right"> <a href="update_category.php?id=<?php echo $element["id"] ?>" class="btn btn-primary">update</a></td>
                                        <td class="text-right"><a href="delete_category.php?id=<?php echo $element["id"] ?>" class="btn btn-danger">delete</a></td>
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