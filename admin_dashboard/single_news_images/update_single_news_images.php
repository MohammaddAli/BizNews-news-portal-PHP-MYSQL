<!-- updateSingleNews -->

<?php
require "../../lib/single_news_images.php";

$imagesobj = new singleNewsImage;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    if (isset($_FILES["mainCover"]) || isset($_FILES["firstSubCover"]) || isset($_FILES["secondSubCover"]) || isset($_POST["singleNewsTitle"])) {
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
        } else {
            $urlMain = $imagesobj->getSingleNewsImages($_POST['singleNewsId'])['urlMain'];
        }

        if ($_FILES["firstSubCover"]["error"] == 0) {
            $firstSubCoverName = basename($_FILES["firstSubCover"]["name"]);
            $firstSubCoverTmp = $_FILES["firstSubCover"]["tmp_name"];
            $fileParts = explode(".", $firstSubCoverName);
            $fileExtension2 = strtolower(end($fileParts));
            if (in_array($fileExtension2, $allowedExt)) {
                $urlSub1 = "firstSub_" . uniqid() . "." . $fileExtension2;
                move_uploaded_file($firstSubCoverTmp, $images_dir . $urlSub1);
            } else {
                $extErr .= " the $fileExtension2 extention not allowed";
            }
        } else {
            $urlSub1 = $imagesobj->getSingleNewsImages($_POST['singleNewsId'])['urlSub1'];
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
        } else {
            $urlSub2 = $imagesobj->getSingleNewsImages($_POST['singleNewsId'])['urlSub2'];
        }

        if (isset($_POST['singleNewsId'])) {
            // echo "id " . $_POST['singleNewsId'] . " 1 " . $urlMain . " 2 " . $urlSub1 . " 3 " . $urlSub2;
            // die;
            $imagesobj->updateSingleNewsImage($_POST['singleNewsId'], $urlMain, $urlSub1, $urlSub2);
            header("Location: ../news/show_all_single_news.php");
        }
    }
}

include "../header.php";
?>


<?php if (isset($_GET['singleNewsId'])) { ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <form action="./update_single_news_images.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Update the images</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <img style="max-width: 100%;" src="<?php echo  $imagesobj->getSingleNewsImages($_GET['singleNewsId'])['urlMain']; ?>" alt="Main image">
                                <div class="form-control">
                                    <label for="exampleInputEmail1">update the main cover</label>
                                    <input type="file" name="mainCover" id="exampleInputEmail1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo  $imagesobj->getSingleNewsImages($_GET['singleNewsId'])['urlSub1']; ?>" alt="Sub image1">
                                <div class="form-control">
                                    <label for="exampleInputEmail1">update the first sub cover</label>
                                    <input type="file" name="firstSubCover" id="exampleInputEmail1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo  $imagesobj->getSingleNewsImages($_GET['singleNewsId'])['urlSub2']; ?>" alt="Sub image2">
                                <div class="form-control">
                                    <label for="exampleInputEmail1">update the second sub cover</label>
                                    <input type="file" name="secondSubCover" id="exampleInputEmail1">
                                </div>
                            </td>
                        </tr>
                        <td><input type="hidden" name="singleNewsId" value="<?php echo isset($_GET['singleNewsId']) ? $_GET['singleNewsId'] : ""; ?>"></td>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-body">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php } ?>









<?php
include "../footer.php";
?>


<?php
// require "../../lib/single_news.php";
// require "../../lib/single_news_images.php";

// $SingleNewsObject = new SingleNews;
// $news = $SingleNewsObject->showAllNews();
// $extErr = "";





?>