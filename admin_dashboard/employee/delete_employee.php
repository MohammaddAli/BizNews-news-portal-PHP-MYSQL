<?php
require "../../lib/employee.php";

if (isset($_GET['id'])) {
    $employee = new employee;
    $employee->deleteEmployee($_GET['id']);
    header("Location: ./show_all_employee.php");
}
