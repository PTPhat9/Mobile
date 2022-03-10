<?php 
use Firebase\JWT\JWT;
class CustomerController {
    function info() {
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($_SESSION["email"]);
        require "views/customer/info.php";
    }
    function updateInfo() {
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($_SESSION["email"]);
        $customer->setName($_POST["fullname"]);
		$customer->setMobile($_POST["mobile"]);
        $currentPassword = $_POST["current_password"];
        $password = $customer->getPassword();
        $newPassword = $_POST["password"];
        if ($currentPassword ) {   
            if (password_verify($currentPassword, $password)) {
                if($newPassword != "") {
                    $encodePassword = password_hash($newPassword, PASSWORD_BCRYPT);
                    $customer->setPassword($encodePassword);
                }
			}
			else {
				$_SESSION["error"] = "Mật khẩu hiện tại không đúng.";
				header("location: index.php?c=customer&a=info");
				exit;
			}
        }

        if ($customerRepository->update($customer)) {
			$_SESSION["name"] = $customer->getName();
			$_SESSION["success"] = "Đã cập nhật thông tin tài khoản thành công";
		}
		else {
			$_SESSION["error"] = $customerRepository->getError();
		}
		header("location: index.php?c=customer&a=info");
    }

    function forgotPassword() {
        $email = $_POST["email"];
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
		if (!$customer) {
			$_SESSION["error"] = "$email không tồn tại";
			header("location: index.php");
			exit;
		}
        $mailServer = new MailService();
        $key = JWT_KEY;
        $payload = array(
            "email" => $email,
        );
        $code_jwt = JWT::encode($payload, $key, 'HS256');

        $activeUrl = DOMAIN . "/site/index.php?c=customer&a=resetPassword&code=$code_jwt";
        $content = "
        Chào $email, <br>
        Vui lòng click vào click vào link bên dưới để tạo mật khẩu <br>
        <a href='$activeUrl'>Active Account</a>
        ";
        $mailServer->send($email, "Reset Password", $content);
        $_SESSION["success"] = "Vui lòng vào email để reset password";
        header("location:index.php");
    }

    function resetPassword() {
		$code = $_GET["code"];
        try {
            $decoded = JWT::decode($code, JWT_KEY, array('HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
            if (!$customer) {
                $_SESSION["error"] = "Email $email không tồn tại";
                header("location: /");
            }
            require "views/customer/resetPassword.php";
			
        }
        catch(Exception $e) {
            echo "You try hack!";
        }
	}
    function updatePassword() {
		$code = $_POST["code"];
        try {
            $decoded = JWT::decode($code, JWT_KEY, array('HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
			$newPassword = $_POST["password"];
			$hashNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $customer->setPassword($hashNewPassword);
			$customerRepository->update($customer);
			$_SESSION["success"] = "Đặt lại mật khẩu thành công";
			header("location: index.php");
        }
        catch(Exception $e) {
            echo "You try hack!";
        }
	} 

    
}
?>