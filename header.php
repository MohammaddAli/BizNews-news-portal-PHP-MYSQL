<?php
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    require_once "./lib/single_news.php";
    require_once "./lib/category.php";
    require_once "./lib/comment.php";
    require_once "./lib/comment_reply.php";
    require_once "./lib/employee.php";
    require_once "./lib/single_news_images.php";
    // require_once "./lib/users.php";
    require_once "./lib/validation.php";

    $singleNewsObject = new singleNews;
    $searchedResult = $singleNewsObject->search($_POST["search"]);
    if ($searchedResult) {
        header("Location: ./single.php?id={$searchedResult['singleNewsId']}");
    } else {
        $error = "new results match what you entered";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BizNews - Free News Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="./design_assets/front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./design_assets/front/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center bg-dark px-lg-5">
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-n2">
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#"><?php echo date("D, F n, Y"); ?></a>
                        </li>
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#">Advertise</a>
                        </li>
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="./contact.php"">Contact</a>
                        </li>
                        <?php if (isset($_SESSION["email"])) { ?>
                            <li class=" nav-item">
                                <a class="nav-link text-body small" href="./logout.php">Logout</a>
                        </li>
                    <?php } else { ?>
                        <li class=" nav-item">
                            <a class="nav-link text-body small" href="./register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body small" href="./login.php">Login</a>
                        </li>
                    <?php } ?>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 text-right d-none d-md-block">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-auto mr-n2">
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-twitter"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-facebook-f"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-linkedin-in"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-instagram"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-google-plus-g"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-youtube"></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row align-items-center bg-white py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="index.php" class="navbar-brand p-0 d-none d-lg-block">
                    <h1 class="m-0 display-4 text-uppercase text-primary">Biz<span class="text-secondary font-weight-normal">News</span></h1>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-4 text-uppercase text-primary">Biz<span class="text-white font-weight-normal">News</span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php $isActive = ""; ?>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="index.php" class="nav-item nav-link <?php echo $isActive = ($_SERVER['REQUEST_URI'] == "/BizNews/index.php") ? "active" : "" ?>">Home</a>
                    <a href="category.php" class="nav-item nav-link <?php echo $isActive = ($_SERVER['REQUEST_URI'] == "/BizNews/category.php") ? "active" : "" ?>">Category</a>
                    <a href="single.php" class="nav-item nav-link <?php echo $isActive = ($_SERVER['REQUEST_URI'] == "/BizNews/single.php") ? "active" : "" ?>">Single News</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#" class="dropdown-item">Menu item 1</a>
                            <a href="#" class="dropdown-item">Menu item 2</a>
                            <a href="#" class="dropdown-item">Menu item 3</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link <?php echo $isActive = ($_SERVER['REQUEST_URI'] == "/BizNews/contact.php") ? "active" : "" ?>">Contact</a>
                </div>
                <form action="./header.php" method="post">
                    <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                        <input type="text" name="search" class="form-control border-0" placeholder="Keyword">
                        <div class="input-group-append">
                            <button type="submit" name="submit" class="input-group-text bg-primary text-dark border-0 px-3"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    <?php if (strlen($error) > 0) { ?>
        <div class="alert alert-primary text-center" role="alert">
            <?php echo $error ?>
        </div>
    <?php } ?>