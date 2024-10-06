<?php
class views
{
    public function userHasViewsOnSingleNews($singleNewsId, $useId)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM views WHERE single_news_id = $singleNewsId AND user_id = $useId";
        $result = mysqli_query($connect, $query);
        return mysqli_num_rows($result);
    }
    public function addUserViewsOnSingleNews($singleNewsId, $useId)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO views (single_news_id, user_id) VALUES($singleNewsId, $useId)";
        $result = mysqli_query($connect, $query);
    }
    public function getViewsOnSingleNews($singleNewsId)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM views WHERE single_news_id = $singleNewsId";
        $result = mysqli_query($connect, $query);
        return mysqli_num_rows($result);
    }
}
