<?php
class singleNews
{
    public function addNewSingleNews($title, $body, $is_feature, $category_id, $employee_id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "INSERT INTO single_news (title, body, is_feature, category_id, employee_id) VALUES ('$title', '$body', $is_feature, $category_id, $employee_id)";
        return mysqli_query($connect, $query);
    }

    public function singleNewsExists($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM single_news WHERE name = $id";
        $results = mysqli_query($connect, $query);
        // return mysqli_fetch_assoc($result) !== NULL; // Check if any row is returned
        return mysqli_num_rows($results) > 0;
    }
    public function showAllNews()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM single_news";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function getSingleNews($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM single_news WHERE id='$id'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }
    public function getSingleNewsByTitle($title)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT * FROM single_news WHERE title='$title'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }


    public function updateSingleNews($id, $title, $body, $isFeature, $category_id, $employee_id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "UPDATE single_news SET title='$title', body='$body', is_feature=$isFeature, category_id=$category_id, employee_id=$employee_id WHERE id=$id";
        mysqli_query($connect, $query);
    }

    public function deleteSingleNews($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "DELETE FROM single_news WHERE id=$id";
        // echo $query;
        // die;
        mysqli_query($connect, $query);
    }

    public function showBreakingNews()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, category.name as categoryName, employee.name as employeeName
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id 
        WHERE publish_date > CURDATE() - 1";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function showLatestNews()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, 
        single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, 
        single_news_images.*, category.name as categoryName, employee.name as employeeName, 
        employee.image as employeeImage 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE single_news.publish_date > CURDATE() - 7 LIMIT 4";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function showAllLatestNews()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, 
        single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, 
        single_news_images.*, category.name as categoryName, employee.name as employeeName, 
        employee.image as employeeImage
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE single_news.publish_date > CURDATE() - 7";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function showFeatureNews()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, category.name as categoryName, employee.name as employeeName 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE single_news.is_feature = 1";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function singleNewsPage($id)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, 
        single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, 
        single_news_images.*, category.name as categoryName, employee.name as employeeName, 
        employee.image as employeeImage, comment.message as commentMessage 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        LEFT JOIN comment ON single_news.id = comment.single_news_id
        WHERE single_news.id = $id";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function showCategoryNews($category)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, category.name as categoryName, employee.name as employeeName 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE category.name = '$category' LIMIT 2";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function showAllGategoryNews($category)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, single_news.publish_date, single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, category.name as categoryName, employee.name as employeeName 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE category.name = '$category'";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function showAllNewsCategories()
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT category.name as categoryName
        FROM single_news
        INNER JOIN category ON single_news.category_id = category.id";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }

    public function getSingleNewsByCategoryId($categoryId)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.publish_date, 
        single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, 
        category.name as categoryName, category.image as categoryImage, employee.name as employeeName, employee.image as employeeImage 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE category.id = '$categoryId'";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function getSingleNewsByCategoryIdLimit($categoryId)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, single_news.publish_date, 
        single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, 
        category.name as categoryName, employee.name as employeeName, employee.image as employeeImage 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE category.id = '$categoryId' Limit 2";
        $result = mysqli_query($connect, $query);
        $rowsArr = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rowsArr[] = $row;
        }
        return $rowsArr;
    }
    public function search($searchedTitle)
    {
        $connect = mysqli_connect("localhost", "root", "", "biznews");
        $query = "SELECT single_news.id AS singleNewsId, single_news.title, single_news.body, single_news.publish_date, 
        single_news.is_feature, single_news.category_id, single_news.employee_id, single_news_images.*, 
        category.name as categoryName, employee.name as employeeName, employee.image as employeeImage 
        FROM single_news 
        INNER JOIN single_news_images ON single_news.id = single_news_images.single_news_id 
        INNER JOIN category ON single_news.category_id = category.id 
        INNER JOIN employee ON single_news.employee_id = employee.id
        WHERE single_news.title LIKE '%$searchedTitle%'";
        // echo $query;
        // die;
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }
}
