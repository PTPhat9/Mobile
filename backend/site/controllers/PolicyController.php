<?php 
class PolicyController {
	function returnPolicy() {
        require "views/policy/returnPolicy.php";
    }

    function paymentPolicy() {
        require "views/policy/paymentPolicy.php";
    }

    function deliveryPolicy() {
        require "views/policy/deliveryPolicy.php";
    }
}