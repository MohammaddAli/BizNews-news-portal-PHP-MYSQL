<?php
class singleNewsImage
{
    public function addNewSingleNewsImages($urlMain, $urlSub1, $urlSub2, $single_news_id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO single_news_images (urlMain, urlSub1, urlSub2, single_news_id) VALUES ('$urlMain', '$urlSub1', '$urlSub2', $single_news_id)";
        $result = mysqli_query($connect, $query);
    }

    //     public function SingleNewsImageExists($id)
    //     {
    //         $connect = mysqli_connect("localhost", "root", "", "biznews");
    //         $query = "SELECT * FROM single_news WHERE name = $id";
    //         $results = mysqli_query($connect, $query);
    //         // return mysqli_fetch_assoc($result) !== NULL; // Check if any row is returned
    //         return mysqli_num_rows($results) > 0;
    //     }
    //     public function showAllNews()
    //     {
    //         $connect = mysqli_connect("localhost", "root", "", "biznews");
    //         $query = "SELECT * FROM single_news";
    //         // echo $query;
    //         // die;
    //         $result = mysqli_query($connect, $query);
    //         $rowsArr = [];
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $rowsArr[] = $row;
    //         }
    //         return $rowsArr;
    //     }
    public function getSingleNewsImages($single_news_id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM single_news_images WHERE single_news_id=$single_news_id";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        // echo mysqli_fetch_assoc($result);
        // die;
        return mysqli_fetch_assoc($result);
    }


    public function updateSingleNewsImage($single_news_id, $urlMain, $urlSub1, $urlSub2)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "UPDATE single_news_images  SET urlMain='$urlMain', urlSub1='$urlSub1', urlSub2='$urlSub2' WHERE single_news_id=$single_news_id";
        mysqli_query($connect, $query);
    }

    public function deleteSingleNewsImage($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "DELETE FROM single_news_images WHERE id=$id";
        // echo $query;
        // die;
        mysqli_query($connect, $query);
    }
}
