<?php 
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class RegisterController {
    function create() {   
        $secret = GOOGLE_RECAPTCHA_SECRET;
        $remoteIp = '127.0.0.1';
        $gRecaptchaResponse = $_POST["g-recaptcha-response"];
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->setExpectedHostname(DOMAIN)
                        ->verify($gRecaptchaResponse, $remoteIp);
        if ($resp->isSuccess()) {
            // Verified!
        } else {
            $errors = $resp->getErrorCodes();
        }

        $customerRepository = new CustomerRepository();
        $login_by = "form";
        if($customerRepository->save($_POST, $login_by)){
            $_SESSION["success"] = "Tạo tài khoản thành công";
            //Gửi mail active
            $email = $_POST["email"];
            $mailServer = new MailService();

            $key = JWT_KEY;
            $payload = array(
                "email" => $email,
            );
            $code_jwt = JWT::encode($payload, $key, 'HS256');

            $activeUrl = DOMAIN . "/site/index.php?c=register&a=active&code=$code_jwt";
            $content = "
            Chào $email, <br>
            Vui lòng click vào click vào link bên dưới để kích hoạt tài khoản <br>
            <a href='$activeUrl'>Active Account</a>
            ";
            $mailServer->send($email, "Active account", $content);
        }
        else { 
            $_SESSION["error"] = $customerRepository->getError();
        };
        header("location:index.php");
    }

    function active() {
        $code_jwt = $_GET["code"];
        try {
            $decoded = JWT::decode($code_jwt, new Key(JWT_KEY, 'HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);
            $customer->setIsActive(1);
            $customerRepository->update($customer);
            $_SESSION["success"] = "Tài khoản của bạn đã được active";
            //Cho phép login luôn
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $customer->getName();
            header("location:index.php");
        }
        catch (Exception $e) {
            echo "You try hack";
        }
    }

    function existingEmail() {
        $email = $_GET["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if(!$customer) {
            echo "true";
            return;
        };
        echo "false";
        return;
    }

}

?>