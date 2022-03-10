<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public/vendor/bootstrap/bootstrap-4.6.0-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/vendor/fontawesome/fontawesome-free-5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="public/vendor/bootstrap-star-rating/css/star-rating.min.css">
    <link rel="stylesheet" href="public/css/style.css" />
    <link rel="stylesheet" href="public/vendor/bootstrap-star-rating/themes/krajee-fa/theme.css">
    <script src="public/vendor/jquery/jquery-3.6.0.min.js"></script>
    <script src="public/js/script.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="public/vendor/jqueryvalidate/dist/jquery.validate.min.js"></script>
    <script src="public/vendor/bootstrap-star-rating/star-rating.min.js"></script>
    <script src="public/vendor/bootstrap-star-rating/themes/krajee-fa/theme.js"></script>
    <script src="public/vendor/bootstrap/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>

    <title>Mobile</title>
</head>

<body>
    <header>
        <div class="header container-fluid">
            <div class="row">
                <div class="col-md-2 header-logo">
                    <!-- <img class="" src="public/images/logo-mobile.png" alt="" /> -->
                    <p>PMobile</p>
                </div>
                <div class="col-md-7 form-search">
                    
                    <form action="" class="">
                        <div class="box-search">
                            <input type="search" name="search" class="search-input" placeholder="Tìm sản phẩm, danh mục hay thương hiệu mong muốn ..." value=""/>
                            <div class="search-button">
                                <button type="submit">
                                    <img src="public/images/icon-search.jpg" alt="">
                                    <span>Tìm kiếm</span>
                                </button>
                            </div>
                            <input type="hidden" name="c" value="product">
                            <div class="box-suggest">
                                
                                <?php require "views/layout/ajaxSearch.php" ?>
                            </div>
                        </div>
                    
                    </form>
                </div>
                <div class="col-md-3 header-about">
                    <div class="header-about-item-1 ">
                            <a href="index.php?c=cart" class="cart">
                                <img src="public/images/icon-cart.jpg" alt="">
                                <span class="cart-qty"></span>
                                <span>Giỏ hàng</span>
                            </a>
                    </div>
                    <div class="header-about-item-2 ">
                        <?php if(!empty($_SESSION["email"])): ?>
                            <a class="login-user">
                                <img src="public/images/icon-user.jpg" alt="">
                                <span>
                                <?=$_SESSION["email"]?>
                                <br>
                                <?=$_SESSION["name"]?>
                                </span>
                            </a>
                            <ul class="menu-account">
                                <li><a href="index.php?c=customer&a=info">Thông tin tài khoản</a></li>
                                <li><a href="index.php?c=order&a=index">Đơn hàng của tôi</a></li>
                                <li><a href="index.php?c=login&a=logout">Thoát</a></li>
                            </ul>
                        <?php else: ?>
                            <a class="user">
                                <img src="public/images/icon-user.jpg" alt="">
                                <span>
                                    Đăng nhập / Đăng ký
                                    <br>
                                    Tài khoản
                                </span>
                            </a>
                        <?php endif ?>
                            
                    </div>
                </div>
            </div>
        </div>
    </header>
