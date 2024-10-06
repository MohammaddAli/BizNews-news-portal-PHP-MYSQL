<?php
session_start();
require "./lib/category.php";
require "./lib/comment.php";
require "./lib/comment_reply.php";
require "./lib/employee.php";
require "./lib/single_news.php";
require "./lib/single_news_images.php";
// require_once "./lib/users.php";
require "./lib/views.php";

$singleNewsObject = new singleNews;
$viewsObject = new views;
$singleNews = "";
$singleNewsId = "";
$userId = $_SESSION["id"];
$commentObject = new comment;

$allComments = "";
$breakingNews = $singleNewsObject->showBreakingNews();
$latestNews = $singleNewsObject->showLatestNews();
$featureNews = $singleNewsObject->showFeatureNews();
$imagesPath = "./admin_dashboard/news/images/";

include "./header.php";
?>



<!-- Main News Slider Start -->
<div class="container-fluid">
    <div class="row">


        <div class="col-lg-7 px-0">
            <div class="owl-carousel main-carousel position-relative">

                <?php foreach ($breakingNews as $singleBreakingNews) {
                ?>
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="<?php echo $imagesPath . $singleBreakingNews['urlMain'] ?>">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href=""><?php echo $singleBreakingNews['categoryName'] ?></a>
                                <a class="text-white" href=""><?php echo $singleBreakingNews['publish_date'] ?></a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="./single.php?id=<?php echo $singleBreakingNews['singleNewsId'] ?>"><?php echo $singleBreakingNews['title'] ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-lg-5 px-0">
            <div class="row mx-0">

                <?php foreach ($featureNews as $singleFeatureNews) { ?>
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="<?php echo $imagesPath . $singleFeatureNews["urlMain"] ?>" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href=""><?php echo $singleFeatureNews["categoryName"] ?></a>
                                    <a class="text-white" href=""><small><?php echo $singleFeatureNews["publish_date"] ?></small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="./single.php?id=<?php echo $singleFeatureNews['singleNewsId'] ?>"><?php echo substr($singleFeatureNews['title'], 0, 30) ?>...</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

    </div>
</div>
<!-- Main News Slider End -->


<!-- Breaking News Start -->
<div class="container-fluid bg-dark py-3 mb-3">
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

<!-- Featured News Slider Start -->
<div class="container-fluid pt-5 mb-3">
    <div class="container">
        <div class="section-title">
            <h4 class="m-0 text-uppercase font-weight-bold">Featured News</h4>
        </div>
        <div class="owl-carousel news-carousel carousel-item-4 position-relative">

            <?php foreach ($featureNews as $singleFeatureNews) { ?>
                <div class="position-relative overflow-hidden" style="height: 300px;">
                    <img class="img-fluid h-100" src="<?php echo $imagesPath . $singleFeatureNews["urlMain"] ?>" style="object-fit: cover;">
                    <div class="overlay">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href=""><?php echo $singleFeatureNews['categoryName'] ?></a>
                            <a class="text-white" href=""><small><?php echo $singleFeatureNews['publish_date'] ?></small></a>
                        </div>
                        <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="./single.php?id=<?php echo $singleFeatureNews['singleNewsId'] ?>"><?php echo substr($singleFeatureNews['title'], 0, 30) ?>...</a>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
</div>
<!-- Featured News Slider End -->


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

                    <?php foreach ($latestNews as $singleLatestNews) {
                        $allComments = $commentObject->getAllSingleNewsComments($singleLatestNews['singleNewsId']);

                        $rowsNum = $viewsObject->userHasViewsOnSingleNews($singleLatestNews['singleNewsId'], $userId);
                        if ($rowsNum == 0) {
                            $viewsObject->addUserViewsOnSingleNews($singleLatestNews['singleNewsId'], $userId);
                        }
                        $viewsCount = $viewsObject->getViewsOnSingleNews($singleLatestNews['singleNewsId']); ?>
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
                                        <small class="ml-3"><i class="far fa-eye mr-2"></i><?php echo $viewsCount ?></small>
                                        <small class="ml-3"><i class="far fa-comment mr-2"></i><?php echo count($allComments); ?></small>
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