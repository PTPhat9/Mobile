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
                                <a href="index.php?c=customer&a=info" title="Thông tin tài khoản" target="_self">Thông tin tài khoản
                                </a>
                            </li>
                            <li class="">
                                <a href="index.php?c=order&a=index" target="_self">Đơn hàng của tôi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="col-md-9 account">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="home-title">Thông tin tài khoản</h4>
                    </div>
                    
                    <div class="col-md-6">
                        <form class="info-account" action="index.php?c=customer&a=updateInfo" method="POST" role="form">
                            <div class="form-group">
                                <input type="text" value="<?=$customer->getName()?>" class="form-control" name="fullname" placeholder="Họ và tên" required="" >
                            </div>
                            <div class="form-group">
                                <input type="tel" value="<?=$customer->getMobile()?>" class="form-control" name="mobile" placeholder="Số điện thoại">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="current_password" placeholder="Mật khẩu hiện tại" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                                oninvalid="this.setCustomValidity('Vui lòng nhập ít nhất 8 ký tự: số, chữ hoa, chữ thường')"
                                oninput="this.setCustomValidity('')">
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