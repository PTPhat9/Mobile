<?php 
class LoginController {
    function form() {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if ($customer) {
            $password_hash = $customer->getPassword();
            if(password_verify($password, $password_hash)) {
                if($customer->getIsActive()) {
                    $_SESSION["success"] = "Đăng nhập thành công";
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $customer->getName();
                }
                else {
                    $_SESSION["error"] = "Vui lòng vào gmail đã đăng ký để kích hoạt tài khoản";
                }
                header("location:index.php");
                exit;
            }
        } 
        $_SESSION["error"] = "Vui lòng nhập lại tài khoản và mật khẩu";
        header("location:index.php");
    }
    function google() {
        
    }
    function facebook() {
            
    }

    function logout() {
        $client = new Google_Client();
		unset($token['access_token']);
		$client->revokeToken();
        session_destroy();
        header("location: index.php");
    }
}

?>