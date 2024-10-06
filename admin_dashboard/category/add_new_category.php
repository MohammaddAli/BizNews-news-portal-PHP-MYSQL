<?php
require "../../lib/category.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["categoryName"]) && isset($_POST['name1']) && isset($_POST['name2'])) {
        $categoryName = $_POST["categoryName"];
        $name1 = $_POST["name1"];
        $name2 = $_POST["name2"];
        $categoryName = trim($categoryName);
        $name1 = trim($name1);
        $name2 = trim($name2);
        if ($_POST["name1"] === $_POST["name2"]) {
            $error = "name1 and name2 cannnot be identical";
        } else {
            $addcat = new category;
            print_r($_FILES["image"]);
            $imageName = $_FILES["image"]["name"];
            $imageTmp = $_FILES["image"]["tmp_name"];
            if (move_uploaded_file($imageTmp, "./category_images/$imageName")) {
                if (!($addcat->categoryExists($categoryName))) {
                    $addcat->addNewCategory($categoryName, $name1, $name2, $imageName);
                    header("Location: ./show_all_categories.php");
                } else {
                    echo "duplicated !";
                }
            }
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
                    <h1>Category</h1>
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
                <h3 class="card-title">Add Category</h3>
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-default-primary">
                        <p><?php echo $error ?></p>
                    </div>
                <?php } ?>
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
                <form action="./add_new_category.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add New Category</label>
                            <input type="text" name="categoryName" class="form-control" id="exampleInputEmail1" placeholder="Please enter the category name here ...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">name 1</label>
                            <input type="text" name="name1" class="form-control" id="exampleInputEmail1" placeholder="Please enter the category name here ...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">name 2</label>
                            <input type="text" name="name2" class="form-control" id="exampleInputEmail1" placeholder="Please enter the category name here ...">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category image</label>
                            <input type="file" name="image" class="form-control" id="exampleInputEmail1">
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