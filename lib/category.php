<?php
class category
{
    public function addNewCategory($name, $name1, $name2, $image)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO category (name, name1, name2, image) VALUES ('$name', '$name1', '$name2', '$image')";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
    }

    public function categoryExists($name)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM category WHERE name = '" . $name . "'";
        // echo $query;
        // die;
        $results = mysqli_query($connect, $query);
        // return mysqli_fetch_assoc($result) !== NULL; // Check if any row is returned
        return mysqli_num_rows($results) > 0;
    }
    public function showALLCategories()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM category";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function getCategory($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM category WHERE id='$id'";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }


    public function updateCategory($name, $name1, $name2, $image, $id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "UPDATE category SET name='$name', name1='$name1', name2='$name2', image='$image' WHERE id=$id";
        mysqli_query($connect, $query);
    }
    public function deleteCategory($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "DELETE FROM category WHERE id=$id";
        mysqli_query($connect, $query);
    }

    public function categoryWithNews()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT category.id AS categoryID, category.name, single_news.title, single_news_images.urlMain FROM Category 
        LEFT JOIN single_news on category.id = single_news.category_id
        LEFT JOIN single_news_images on single_news.category_id = single_news_images.single_news_id";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
}
