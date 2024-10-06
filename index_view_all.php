<?php
session_start();

require "./lib/single_news.php";
require "./lib/single_news_images.php";
require "./lib/category.php";
require "./lib/employee.php";

$singleNewsObject = new singleNews;
$breakingNews = $singleNewsObject->showBreakingNews();
// $latestNews = $singleNewsObject->showLatestNews();
$featureNews = $singleNewsObject->showFeatureNews();
$latestNews = $singleNewsObject->showAllLatestNews();

$imagesPath = "./admin_dashboard/news/images/";
include "./header.php";

?>




<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 my-3">
    <div class="container">
        <div class="row align-items-center bg-dark">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 170px;">Breaking News</div>
                    <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 170px); padding-right: 90px;">
                        <?php foreach ($breakingNews as $singleBreakingNews) { ?>
                            <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href="./single.php?id=<?php echo $singleBreakingNews['singleNewsId'] ?>"> <?php echo $singleBreakingNews['title'] ?></a></div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breaking News End -->




<!-- News With Sidebar Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="./index_view_all.php">View All</a>
                        </div>
                    </div>

                    <?php foreach ($latestNews as $singleLatestNews) { ?>
                        <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="<?php echo $imagesPath . $singleLatestNews["urlMain"] ?>" style="object-fit: cover;">
                                <div class="bg-white border border-top-0 p-4">
                                    <div class="mb-2">
                                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href=""><?php echo $singleLatestNews["categoryName"] ?></a>
                                        <a class="text-body" href=""><small><?php echo $singleLatestNews["publish_date"] ?></small></a>
                                    </div>
                                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="./single.php?id=<?php echo $singleLatestNews['singleNewsId'] ?>"><?php echo substr($singleLatestNews["title"], 0, 20) ?>...</a>
                                    <p class="m-0"> <?php echo substr($singleLatestNews["body"], 0, 100) . "..." ?></p>
                                </div>
                                <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle mr-2" src="./admin_dashboard/employee/employee_profile_image/<?php echo $singleLatestNews["employeeImage"] ?>" width="25" height="25" alt="">
                                        <small><?php echo $singleLatestNews["employeeName"] ?></small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="ml-3"><i class="far fa-eye mr-2"></i>12345</small>
                                        <small class="ml-3"><i class="far fa-comment mr-2"></i>123</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>

            <?php
            include "./footer.php";
            ?>