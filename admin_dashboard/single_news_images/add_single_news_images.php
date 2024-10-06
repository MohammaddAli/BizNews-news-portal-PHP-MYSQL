<?php
require "../../lib/single_news.php";
require "../../lib/single_news_images.php";

$SingleNewsObject = new SingleNews;
$news = $SingleNewsObject->showAllNews();
$extErr = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["mainCover"]) && isset($_FILES["firstSubCover"]) && isset($_FILES["secondSubCover"]) && isset($_POST["singleNewsTitle"])) {

        if (!file_exists("../news/images")) {
            mkdir("../news/images", 0777);
        }
        $images_dir = "../news/images/";
        $allowedExt = ["jpg", "jpeg", "png", "webp"];
        $urlMain = "";
        $urlSub1 = "";
        $urlSub2 = "";

        if ($_FILES["mainCover"]["error"] == 0) {
            $mainCoverName = basename($_FILES["mainCover"]["name"]);
            $mainCoverTmp = $_FILES["mainCover"]["tmp_name"];
            $fileParts = explode(".", $mainCoverName);
            $fileExtension1 = strtolower(end($fileParts));
            if (in_array($fileExtension1, $allowedExt)) {
                $urlMain = "main_" . uniqid() . "." . $fileExtension1;
                move_uploaded_file($mainCoverTmp, $images_dir . $urlMain);
            } else {
                $extErr = "the $fileExtension1 extention not allowed";
            }
        }

        if ($_FILES["firstSubCover"]["error"] == 0) {
            $firstSubCoverName = basename($_FILES["firstSubCover"]["name"]);
            $firstSubCoverTmp = $_FILES["firstSubCover"]["tmp_name"];
            $fileParts = explode(".", $firstSubCoverName);
            $fileExtension2 = strtolower(end($fileParts));
        }
        if (in_array($fileExtension2, $allowedExt)) {
            $urlSub1 = "firstSub_" . uniqid() . "." . $fileExtension2;
            move_uploaded_file($firstSubCoverTmp, $images_dir . $urlSub1);
        } else {
            $extErr .= " the $fileExtension2 extention not allowed";
        }

        if ($_FILES["secondSubCover"]["error"] == 0) {
            $secondSubCoverName = basename($_FILES["secondSubCover"]["name"]);
            $secondSubCoverTmp = $_FILES["secondSubCover"]["tmp_name"];
            $fileParts = explode(".", $secondSubCoverName);
            $fileExtension3 = strtolower(end($fileParts));
            if (in_array($fileExtension3, $allowedExt)) {
                $urlSub2 = "secondSub_" . uniqid() . "." . $fileExtension3;
                move_uploaded_file($secondSubCoverTmp, $images_dir . $urlSub2);
            } else {
                $extErr .= " the $fileExtension3 extention not allowed";
            }

            $SingleNewsImageObject = new singleNewsImage;
            $SingleNewsImageObject->addNewSingleNewsImages($urlMain, $urlSub1, $urlSub2, $_POST["singleNewsTitle"]);
            header("Location: ../news/show_all_single_news.php");
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
                    <h1>Single news images</h1>
                </div>
                <?php if (strlen($extErr) > 0) { ?>
                    <div class="alert alert-primary text-center" role="alert">
                        <?php echo $extErr ?>
                    </div>
                <?php } ?>
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
                <h3 class="card-title">Add single images</h3>

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
                <form action="./add_single_news_images.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-control">
                            <label for="exampleInputEmail1">Add the main cover</label>
                            <input type="file" name="mainCover" id="exampleInputEmail1">
                        </div>
                        <div class="form-control">
                            <label for="exampleInputEmail1">Add the first sub cover</label>
                            <input type="file" name="firstSubCover" id="exampleInputEmail1">
                        </div>
                        <div class="form-control">
                            <label for="exampleInputEmail1">Add the second sub cover</label>
                            <input type="file" name="secondSubCover" id="exampleInputEmail1">
                        </div>
                        <div class="card-body">
                            <div class="form-control">
                                <label for="exampleInputEmail1" class="ml-3">Choose the single news title</label>
                                <select name="singleNewsTitle" id="exampleInputEmail1">
                                    <?php foreach ($news as $SingleNews) {
                                    ?><option value="<?php echo $SingleNews["id"] ?>"><?php echo $SingleNews["title"] ?></option>
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