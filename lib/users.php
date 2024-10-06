<?php

// namespace MyProject;

class user
{
    public function addNewUser($name, $email, $password, $image)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        // if (!$connect) {
        //     echo mysqli_connect_error();
        //     exit;
        // }
        $query = "INSERT INTO user (name, email, password, image) VALUES ('$name', '$email', '$password', '$image')";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
    }

    public function isUserExists($email)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM user WHERE email = ' $email'";
        $results = mysqli_query($connect, $query);
        // return mysqli_fetch_assoc($result) !== NULL; // Check if any row is returned
        return mysqli_num_rows($results) > 0;
    }

    public function showAllUsers()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM user";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function getUser($email)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }

    // public function updateUser($name, $id)
    // {
    //     $connect = mysqli_connect("localhost", "root", "", "biznews");
    //     $query = "UPDATE user SET name='$name' WHERE id=$id";
    //     mysqli_query($connect, $query);
    // }

    // public function deleteUser($id)
    // {
    //     $connect = mysqli_connect("localhost", "root", "", "biznews");
    //     $query = "DELETE FROM user WHERE id=$id";
    //     mysqli_query($connect, $query);
    // }
}
