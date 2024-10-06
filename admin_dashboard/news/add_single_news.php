<?php
require "../../lib/single_news.php";
require "../../lib/category.php";
require "../../lib/employee.php";

$categoryObject = new category;
$categories = $categoryObject->showALLCategories();
$employeeObject = new employee;
$employees = $employeeObject->showAllEmployees();
$errors = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["body"]) && isset($_POST["category"]) && isset($_POST["employee"])) {
        $title = addslashes(trim($_POST["title"]));
        $body = addslashes(trim($_POST["body"]));
        $category = $_POST["category"];
        $employee = $_POST["employee"];
        $isFeature = isset($_POST['isFeature']) ? 1 : 0;
        // filter_input(INPUT_POST,"singleNews", FILTER_SANITIZE_STRING);

        $addSingleNews = new singleNews;
        $addSingleNews->addNewSingleNews($title, $body, $isFeature, $category, $employee);
        header("Location: ../single_news_images/add_single_news_images.php");
    } else {
        $errors = "Please add valid data";
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
                    <h1>Single news</h1>
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
                <h3 class="card-title">Add single news</h3>
                <?php if (strlen($errors) > 0) { ?>
                    <div class="alert alert-primary text-center" role="alert">
                        <?php echo $errors ?>
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
                <form action="./add_single_news.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Please enter the single news tilte here ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Add body</label>
                            <textarea id="summernote" name="body" class="form-control" id="exampleInputEmail1" placeholder="Please enter the category name here ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Is feature</label>
                            <input type="checkbox" name="isFeature" id="exampleInputEmail1">
                        </div>
                        <div class="form-control">
                            <label for="exampleInputEmail1" class="ml-3">Choose category</label>
                            <select name="category" id="exampleInputEmail1">
                                <?php foreach ($categories as $category) {
                                ?><option value="<?php echo $category["id"] ?>"><?php echo $category["name"] ?></option>
                                <?php } ?>
                            </select>
                            <label for="exampleInputEmail1" class="ml-3">Choose imployee</label>
                            <select name="employee" id="exampleInputEmail1">
                                <?php foreach ($employees as $employee) {
                                ?><option value="<?php echo $employee["id"] ?>"><?php echo $employee["name"] ?></option>
                                <?php } ?>
                            </select>
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