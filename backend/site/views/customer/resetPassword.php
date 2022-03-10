<?php require "views/layout/header.php" ?>

<section id="maincontent" class="page-main">
<?php require "views/layout/navbar.php" ?>
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb container-fluid">
            <div class="row">
                <a href="index.php" class="breadcrumb-item"><span>Trang chủ</span></a>
                <span>
                    <i class="fa fa-angle-right"></i>
                </span>
                <a href="" class="breadcrumb-item"><span>Tài khoản</span></a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="clearfix"></div>
            <aside class="col-md-3">
                <div class="inner-aside">
                    <div class="category">
                        <ul>
                            <li class="active" style="font-weight: 700;">
                                <a href="" title="Thay đổi mật khẩu" target="_self">Khôi phục mật khẩu
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="col-md-9 account">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="home-title">Thay đổi mật khẩu</h4>
                    </div>
                    
                    <div class="col-md-6">
                        <form class="reset-password" action="index.php?c=customer&a=updatePassword" method="POST" role="form">
                            <input type="hidden" name="code" value="<?=$code?>">
                            <div class="form-group">
                                Email: <?=$email?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" oninvalid="this.setCustomValidity('Mật khẩu ít nhất 8 ký tự, bao gồm chữ và số ')" oninput="this.setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu mới" autocomplete="off" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require "views/layout/footer.php" ?>