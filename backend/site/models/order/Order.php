<?php 
class Order {
	protected $id;
	protected $created_date;
	protected $order_status_id;
	protected $customer_id;
	protected $shipping_fullname;
	protected $shipping_mobile;
	protected $payment_method;
	protected $shipping_ward_id;
	protected $shipping_housenumber_street;
	protected $shipping_fee;
	protected $delivered_date;

	function __construct($id, $created_date, $order_status_id, $customer_id, $shipping_fullname, $shipping_mobile, $payment_method, $shipping_ward_id, $shipping_housenumber_street, $shipping_fee, $delivered_date){
		$this->id = $id;
		$this->created_date = $created_date;
		$this->order_status_id = $order_status_id;
		$this->customer_id = $customer_id;
		$this->shipping_fullname = $shipping_fullname;
		$this->shipping_mobile = $shipping_mobile;
		$this->payment_method = $payment_method;
		$this->shipping_ward_id = $shipping_ward_id;
		$this->shipping_housenumber_street = $shipping_housenumber_street;
		$this->shipping_fee = $shipping_fee;
		$this->delivered_date = $delivered_date;
	}

	function getId() {
		return $this->id;
	}

	function getCreatedDate() {
		return $this->created_date;
	}

	function getStatusId() {
		return $this->order_status_id;
	}

	function getCustomerId() {
		return $this->customer_id;
	}

	function getShippingFullname() {
		return $this->shipping_fullname;
	}

	function getShippingMobile() {
		return $this->shipping_mobile;
	}

	function getPaymentMethod() {
		return $this->payment_method;
	}

	function getShippingWardId() {
		return $this->shipping_ward_id;
	}

	function getShippingHousenumberStreet() {
		return $this->shipping_housenumber_street;
	}

	function getShippingFee() {
		return $this->shipping_fee;
	}

	function getDeliveredDate() {
		return $this->delivered_date;
	}


	function getCustomer() {
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->find($this->customer_id);
		return $customer;
	}

	function getShippingWard() {
		$wardRepository = new WardRepository();
		$ward = $wardRepository->find($this->shipping_ward_id);
		return $ward;
	}

	function getOrderItems() {
		$orderItemRepository = new OrderItemRepository();
		$orderItems = $orderItemRepository->getByOrderId($this->id); 
		return $orderItems;
	}

	function getTotalPrice() {
		$totalPrice = 0;
		$orderItems = $this->getOrderItems();
        foreach($orderItems as $orderItem) {
            $totalPrice += $orderItem->getTotalPrice();
        }
        return $totalPrice;
	}
}
