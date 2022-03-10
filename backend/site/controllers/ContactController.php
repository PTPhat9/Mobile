<?php 
class ContactController {
    function index() {
        require "views/contact/form.php";
    }

    function send() {
        $mailService = new MailService();
        $to = "phantanphat09@gmail.com";
        $subject = "Pmobile: Khách hàng liên hệ";
        $name = $_POST["fullname"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $message = $_POST["content"];
        $content = "
        Hi shop owner,<br>
        Customer contact info:<br>
        Name: $name <br>
        Email: $email <br>
        Mobile: $mobile <br>
        Message: $message <br>
        ========xxx=====<br>
        ";
        $mailService->send($to, $subject, $content);
    }
}
?>