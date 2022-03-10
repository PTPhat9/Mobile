<footer>
        <div class="footer container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h4>Danh mục nổi bật</h4>
                    <?php 
                        $categoryRepository = new CategoryRepository();
                        $categories = $categoryRepository->fetchAll();
                    ?>
                    <ul>
                        <?php foreach(array_splice($categories, 0, 6) as $category): ?>
                        <li><a href="index.php?c=product&category_id=<?=$category->getId()?>"><?=$category->getName()?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Liên kết</h4>
                    <ul>
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="index.php?c=product">Sản phẩm</a></li>
                        <li><a href="index.php?c=policy&a=returnPolicy">Chính sách đổi trả</a></li>
                        <li><a href="index.php?c=policy&a=paymentPolicy">Chính sách thanh toán</a></li>
                        <li><a href="index.php?c=policy&a=deliveryPolicy">Chính sách giao hàng</a></li>
                        <li><a href="index.php?c=contact">Liên hệ</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h4>Liên hệ</h4>
                    <ul>
                        <li>CN: 237 Hòa Bình, Tân Phú</li>
                        <li>Phone: 0903556692</li>
                        <li>E-mail: phantanphat09@gmail.com</li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    
    <!-- REGISTER DIALOG -->
    <div class="modal fade" id="modal-register" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="modal-title ">Đăng ký</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-register" action="index.php?c=register&a=create" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" name="mobile" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                               autocomplete="off"  >
                        </div>
                        <div class="form-group g-recaptcha" data-sitekey="<?=GOOGLE_RECAPTCHA_SITE?>"></div>
                        <!-- dummy input -->
                        <input type="text" name="hiddenRecaptcha" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;">
                        <input type="hidden" name="reference" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- LOGIN DIALOG -->
    <div class="modal fade" id="modal-login" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="modal-title text-center">Đăng nhập</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <!-- Google login -->
                    <!-- Google login -->
                    <?php
                        // init configuration
                        $clientID = GOOGLE_CLIENT_ID;
                        $clientSecret = GOOGLE_CLIENT_SECRET;
                        $redirectUri =  'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?c=auth&a=loginGoogle";
                          
                        // create Client Request to access Google API
                        $client = new Google_Client();
                        $client->setClientId($clientID);
                        $client->setClientSecret($clientSecret);
                        $client->setRedirectUri($redirectUri);
                        $client->addScope("email");
                        $client->addScope("profile");
                        $loginUrl = $client->createAuthUrl();
                        
                    ?>

                    <div class="text-center">
                        <a class="btn btn-sm btn-primary google-login" href="<?=$loginUrl?>"><i class="fab fa-google"></i></i> Đăng nhập bằng
                            Google</a>
                        <!-- Facebook login -->
                        <a class="btn btn-sm btn-primary facebook-login" href="#"><i class="fab fa-facebook-f"></i> Đăng nhập bằng
                            Facebook</a>
                    </div>
                </div>
                <form action="index.php?c=login&a=form" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                        <input type="hidden" name="reference" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                        <div class="text-left ">
                            <a href="javascript:void(0)" class="btn-register">Bạn chưa là thành viên? Đăng kí ngay!</a>
                            <br>
                            <a href="javascript:void(0)" class="btn-forgot-password">Quên Mật Khẩu?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FORTGOT PASSWORD DIALOG -->
    <div class="modal fade" id="modal-forgot-password" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="modal-title text-center">Quên mật khẩu</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="index.php?c=customer&a=forgotPassword" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="reference" value="">
                        <button type="submit" class="btn btn-primary">GỬI</button><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="public/vendor/bootstrap/popper.min.js"></script>
</body>

</html>
