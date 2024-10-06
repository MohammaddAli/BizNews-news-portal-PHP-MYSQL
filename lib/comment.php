<?php
class comment
{
    public function addNewComment($message, $single_news_id, $user_id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO comment (message, single_news_id, user_id) VALUES ('$message', $single_news_id, $user_id)";
        mysqli_query($connect, $query);
        $lastId = mysqli_insert_id($connect);
        // echo $lastId;
        // die;
        mysqli_close($connect);
        return $lastId;
    }

    public function getAllComments()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM comment ORDER BY comment_date";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function getAllSingleNewsComments($singleNewsId)
    {
        // echo $singleNewsId;
        // die;
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT comment.id AS commentId, comment.message, comment.comment_date, single_news.id AS singleNewsId,
         single_news.title, user.id AS userId, user.name AS username, user.image AS userImage FROM comment 
        INNER JOIN single_news ON comment.single_news_id = single_news.id 
        INNER JOIN user ON comment.user_id = user.id 
        WHERE comment.single_news_id = $singleNewsId
        ORDER BY comment.comment_date";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function getComment($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT comment.id AS commentId, comment.message, comment.comment_date, single_news.id AS singleNewsId,
        single_news.title, user.id AS userId, user.name AS username, user.image AS userImage FROM comment 
        INNER JOIN single_news ON comment.single_news_id = single_news.id 
        INNER JOIN user ON comment.user_id = user.id 
        WHERE comment.id=$id";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }


    // public function updateComment($message, $id)
    // {
    //     $connect = mysqli_connect("localhost", "root", "", "biznews");
    //     $query = "UPDATE comment SET message='$message' WHERE id=$id";
    //     mysqli_query($connect, $query);
    // }
    // public function deleteComment($id)
    // {
    //     $connect = mysqli_connect("localhost", "root", "", "biznews");
    //     $query = "DELETE FROM comment WHERE id=$id";
    //     mysqli_query($connect, $query);
    // }
    public function showTrendingNews()
    { //count + groupby + limit or >/<
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT count(comment.id) AS commentsCount, comment.single_news_id, single_news.title, single_news.body, single_news.publish_date, category.name AS categoryName, single_news_images.urlMain, single_news_images.urlSub1, single_news_images.urlSub2
        FROM comment   
        INNER JOIN single_news ON single_news.id = comment.single_news_id
        INNER JOIN category ON single_news.category_id = category.id
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id
        GROUP BY comment.single_news_id
        HAVING commentsCount >5";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
}
