<?php
session_start();
require "./lib/single_news.php";
require "./lib/single_news_images.php";
require "./lib/category.php";
require "./lib/employee.php";


$singleNewsObject = new singleNews;
$categoryObject = new category;

$allCategories = $categoryObject->showALLCategories();
// print_r($allCategories);
$imagesPath = "./admin_dashboard/news/images/";
include "./header.php";
?>

<!-- News With Sidebar Start -->
<div class="container-fluid mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php foreach ($allCategories as $category) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <img style="width: 100px; margin: 0; padding: 0;" src="<?php echo "./admin_dashboard/category/category_images/{$category['image']}" ?>" alt="" </img>
                                <h4 class="m-0 text-uppercase font-weight-bold">Category: <?php echo $category['name'] ?></h4>
                                <!-- <a class="text-secondary font-weight-medium text-decoration-none" href="./$category">View All</a> -->
                                <a class="text-secondary font-weight-medium text-decoration-none" href="./category_view_all.php?id=<?php echo $category['id'] ?>">View All</a>
                            </div>
                        </div>

                        <?php
                        $singleNews = $singleNewsObject->getSingleNewsByCategoryIdLimit($category['id']);
                        foreach ($singleNews as $singleCategoryNews) { ?>
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <img class="img-fluid w-100" src="<?php echo $imagesPath . $singleCategoryNews['urlMain'] ?>" style="object-fit: cover;">
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2" href=""><?php echo $category['name'] ?></a>
                                            <a class="text-body" href=""><small><?php echo $singleCategoryNews['publish_date'] ?></small></a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href=""><?php echo substr($singleCategoryNews['title'], 0, 70) ?></a>
                                        <p class="m-0"><?php echo substr($singleCategoryNews['body'], 0, 100) ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="./admin_dashboard/employee/employee_profile_image/<?php echo $singleCategoryNews["employeeImage"] ?>" width="25" height="25" alt="">
                                            <small><?php echo $singleCategoryNews["employeeName"] ?></small>
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
                <?php
                } ?>


            </div>

            <?php
            include "./footer.php";
            ?>