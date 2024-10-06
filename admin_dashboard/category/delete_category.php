<?php
require "../../lib/category.php";

if (isset($_GET['id'])) {
    $category = new category;
    $category->deleteCategory($_GET['id']);
    header("Location: ./show_all_categories.php");
}
