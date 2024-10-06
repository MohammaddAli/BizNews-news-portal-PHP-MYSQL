<?php
require "../../lib/category.php";
$category = new category;
$selectedCategory = "";
if (isset($_GET['id'])) {
    $selectedCategory = $category->getCategory($_GET['id']);
    // print_r($selectedCategory);
} elseif (isset($_POST['sub'])) {
    if (isset($_POST['categoryName']) && isset($_POST['id']) && isset($_FILES["image"])) {

        $category->updateCategory($_POST['categoryName'], $_POST['categoryName1'], $_POST['categoryName2'], $_FILES["image"]["name"], $_POST['id']);
        header("Location: ./show_all_categories.php");
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
            <div class="card-body">
                <form action="./update_category.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Update Category name</label>
                            <input type="text" name="categoryName" class="form-control" id="exampleInputEmail1" value="<?php echo $selectedCategory[0]['name'] ?>">
                            <label for="exampleInputEmail1">Update Category name1</label>
                            <input type="text" name="categoryName1" class="form-control" id="exampleInputEmail1" value="<?php echo $selectedCategory[0]['name1'] ?>">
                            <label for="exampleInputEmail1">Update Category name2</label>
                            <input type="text" name="categoryName2" class="form-control" id="exampleInputEmail1" value="<?php echo $selectedCategory[0]['name2'] ?>">
                            <label for="exampleInputEmail1">Update Category image</label>
                            <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : "" ?>">
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