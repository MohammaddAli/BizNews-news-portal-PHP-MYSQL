<?php
require "../../lib/category.php";
require "../../lib/employee.php";
require "../../lib/single_news.php";
require "../../lib/single_news_images.php";
$categoryObject = new category;
$categories = $categoryObject->showALLCategories();
$employeeObject = new employee;
$employees = $employeeObject->showAllEmployees();
$singeNewsObj = new singleNews;
$selectedSingleNews = "";
$errors = "";

if (isset($_GET['id'])) {
    $selectedSingleNews = $singeNewsObj->getSingleNews($_GET['id']);
    $imagesobj = new singleNewsImage;
} elseif (isset($_POST['submit'])) {
    if (isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["body"]) && isset($_POST["category"]) && isset($_POST["employee"])) {
        $title = addslashes(trim($_POST["title"]));
        $body = addslashes(trim($_POST["body"]));
        $category = $_POST["category"];
        $employee = $_POST["employee"];
        // filter_input(INPUT_POST,"singleNews", FILTER_SANITIZE_STRING);
        $singleNewsId = $_POST['id'];
        $isFeature = isset($_POST['isFeature']) ? 1 : 0;
        $singeNewsObj->updateSingleNews($singleNewsId, $title, $body, $isFeature, $category, $employee);
        header("Location: ../single_news_images/update_single_news_images.php?singleNewsId=$singleNewsId");
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
                <h3 class="card-title">Update single news</h3>
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
                <form action="./update_single_news.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">update Title</label>
                            <input type="text" name="title" value="<?php echo $selectedSingleNews['title']; ?>" class="form-control" id="exampleInputEmail1>
                        </div>
                        <div class=" form-group">
                            <label for="exampleInputEmail1">update body</label>
                            <textarea id="summernote" name="body" value="<?php echo $selectedSingleNews['body']; ?>" class="form-control" id="exampleInputEmail1"></textarea>
                        </div>
                        <div class=" form-group">
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
                        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : "" ?>">
                    </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
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