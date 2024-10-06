<?php
require "../../lib/single_news.php";
require "../../lib/single_news_images.php";

if (isset($_GET['id'])) {
    $singleNewsObject = new singleNews;
    $singleNewsImageObject = new singleNewsImage;
    //delete images first because the single news foreign key depend on single news images
    $singleNewsImageObject->deleteSingleNewsImage($_GET['imagesId']);
    $singleNewsObject->deleteSingleNews($_GET['id']);
    header("Location: ./show_all_single_news.php");
}
