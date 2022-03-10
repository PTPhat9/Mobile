<?php 
    require "views/layout/header.php"; 
    require "views/layout/navbar.php";
?>
<main id="maincontent" class="page-main">
    <div class="breadcrumb-wrapper">
        <div class="breadcrumb container-fluid">
            <div class="row">
                <a href="index.php" class="breadcrumb-item"><span>Trang chủ</span></a>
                <span>
                    <i class="fa fa-angle-right"></i>
                </span>
                <a href="" class="breadcrumb-item"><span>Liên hệ</span></a>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row contact">
            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.508923114722!2d106.62306731701706!3d10.772279095933985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752c1f70e64c4d%3A0x10ce49395412d80c!2zMjM3IEjDsmEgQsOsbmgsIEhp4buHcCBUw6JuLCBUw6JuIFBow7osIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1646233477125!5m2!1svi!2s"
                    width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <div class="col-md-6">
                <h4>Thông tin liên hệ</h4>
                <form class="form-contact" action="index.php?c=contact&a=send" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" required 
                        oninvalid="this.setCustomValidity('Vui lòng nhập tên của bạn')"
                            oninput="this.setCustomValidity('')">
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <input type="email" class="form-control" name="email" placeholder="Email" required
                            oninvalid="this.setCustomValidity('Vui lòng nhập Email')"
                            oninput="this.setCustomValidity('')">
                        </div>
                        <div class="form-group col-sm-6">
                            <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại" required 
                            pattern="[0][0-9]{9,}" oninvalid="this.setCustomValidity('Vui lòng nhập 10 con số bắt đầu là 0')"
                            oninput="this.setCustomValidity('')">
                        </div>

                        <div class="form-group col-sm-12">

                            <textarea class="form-control" placeholder="Nội dung" name="content" rows="10"
                                required></textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <div class="alert alert-success message d-none"> A</div>
                        </div>
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary float-right">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</main>

<?php require "views/layout/footer.php" ?>