<?php
class employee
{
    public function addNewEmployee($name, $email, $password, $is_admin, $image)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO employee (name, email, password, is_admin, image) VALUES ('$name', '$email', '$password', '$is_admin', '$image')";
        // echo $query;
        // die;
        return mysqli_query($connect, $query);
    }

    public function showAllEmployees()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM employee";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function getEmployee($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM employee WHERE id='$id'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }


    public function updateEmployee($name, $email, $password, $is_admin, $image, $id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "UPDATE employee SET name='$name', email = '$email', password = '$password', is_admin = $is_admin, image = '$image'  WHERE id=$id";
        mysqli_query($connect, $query);
    }
    public function deleteEmployee($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "DELETE FROM employee WHERE id=$id";
        mysqli_query($connect, $query);
    }
}
