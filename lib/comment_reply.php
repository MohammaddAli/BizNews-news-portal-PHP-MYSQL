<?php
class commentReply
{
    public function addNewCommentReply($message, $comment_id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO comment_reply (message, comment_id) VALUES ('$message', $comment_id)";
        // echo $query;
        // die;
        mysqli_query($connect, $query);
        $lastId = mysqli_insert_id($connect);
        mysqli_close($connect);
        return $lastId;
    }

    public function showAllCommentReplys()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM comment_reply";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function getCommentReply($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM comment_reply WHERE id=$id";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }


    // public function updatecomment-reply($message, $id)
    // {
    //     $connect = mysqli_connect("localhost", "root", "", "biznews");
    //     $query = "UPDATE comment-reply SET message='$message' WHERE id=$id";
    //     mysqli_query($connect, $query);
    // }
    // public function deletecomment-reply($id)
    // {
    //     $connect = mysqli_connect("localhost", "root", "", "biznews");
    //     $query = "DELETE FROM comment-reply WHERE id=$id";
    //     mysqli_query($connect, $query);
    // }
}
