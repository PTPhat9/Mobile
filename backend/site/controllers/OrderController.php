<?php 
class OrderController {
    function index() {
        $customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($_SESSION["email"]);
        $orderRepository = new OrderRepository();
		$orders = $orderRepository->getByCustomerId($customer->getId());
        require "views/order/order.php";
    }
}
?>