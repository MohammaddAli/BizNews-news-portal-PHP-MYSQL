<?php
require "../../lib/single_news.php";
require "../../lib/category.php";
require "../../lib/single_news_images.php";

$singeNewsObj = new singleNews;
$allNews = $singeNewsObj->showAllNews();
$imagesobj = new singleNewsImage;
// print_r($allNews);
// die;
$imagesPath = "./images/";
include "../header.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <a href="./add_single_news.php" class="btn btn-success">Add new single news</a>
        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All news</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#ID</th>
                                    <th>title</th>
                                    <th>body</th>
                                    <th>images</th>
                                    <th class="text-right">Update</th>
                                    <th class="text-right">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($allNews as $singleNews) { ?>
                                    <tr>
                                        <td><?php echo $singleNews["id"] ?></td>
                                        <td><?php echo $singleNews["title"] ?></td>
                                        <td><?php echo $singleNews["body"] ?></td>
                                        <td>
                                            <img class="mw-100" src="<?php echo  $imagesPath . $imagesobj->getSingleNewsImages($singleNews["id"])['urlMain']; ?>" alt="Main image">
                                            <img class="mw-100" src="<?php echo  $imagesPath . $imagesobj->getSingleNewsImages($singleNews["id"])['urlSub1']; ?>" alt="Sub image1">
                                            <img class="mw-100" src="<?php echo  $imagesPath . $imagesobj->getSingleNewsImages($singleNews["id"])['urlSub2']; ?>" alt="Sub image2">
                                        </td>
                                        <td class="text-right"> <a href="update_single_news.php?id=<?php echo $singleNews["id"] ?>" class="btn btn-primary">update</a></td>
                                        <td class="text-right"><a href="delete_single_news.php?id=<?php echo $singleNews["id"] ?>&imagesId=<?php echo $imagesobj->getSingleNewsImages($singleNews["id"])["id"]; ?>" class="btn btn-danger">delete</a></td>
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