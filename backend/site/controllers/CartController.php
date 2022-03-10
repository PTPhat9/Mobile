<?php 
class CartController {
    protected $cartStorage;
	function __construct() {
		$this->cartStorage = new CartStorage();
	}
    function index() {
        $cart = $this->cartStorage->fetch();
        $items = $cart->getItems();

        require "views/cart/cart.php";
    }

    function display() {
        $cart = $this->cartStorage->fetch();
        echo json_encode($cart->convertToArray());
    }

    function add() {
        $product_id = $_GET["product_id"];
        $qty = $_GET["qty"];
        $price = $_GET["price"];
        $color = $_GET["color"];
        $img = $_GET["img"];
        $product_code = $_GET["code"];
        $cart = $this->cartStorage->fetch();
        $productRepository = new ProductRepository();
		$product = $productRepository->find($product_id);

        $item = [
            "product_id" => $product_id,
            "img" => $img,
            "name" => $product->getName(),
            "qty" => $qty,
            "unit_price" => $price, 
            "color" => $color,
            "product_code" => $product_code,
        ];
        $cart->addProduct($product_code, $qty, $item);
        $this->cartStorage->store($cart);
        echo json_encode($cart->convertToArray());
    }

    function delete() {
        $product_id = $_GET["product_id"];
        $cart = $this->cartStorage->fetch();
        $cart->deleteProduct($product_id);
        $this->cartStorage->store($cart);
        $items = $cart->getItems();
        require "views/cart/cartItems.php";
    }

    function checkout() {
        $cart = $this->cartStorage->fetch();
        $provinceRepository = new ProvinceRepository();
        $provinces = $provinceRepository->getAll();
        $items = $cart->getItems();
        
        require "views/cart/checkout.php";
    }
    function order() {
        $cartStorage = new CartStorage();
        $customerRepository = new CustomerRepository();
        if(!!empty($_SESSION["email"])) {
            $_SESSION["error"] = "Vui lòng đăng nhập tài khoản";
            header("location: index.php");
            exit;
        }
        $customer = $customerRepository->findEmail($_SESSION["email"]);
        $customer_id = $customer->getId();
        $cart = $this->cartStorage->fetch();
        $items = $cart->getItems();
        $provinceRepository = new ProvinceRepository();
		$province = $provinceRepository->find($_POST["province"]);
        $shipping_fee = $province->getShippingFee();

        $orderItemRepository = new OrderItemRepository();
        $orderRepository = new OrderRepository();
        if($orderId = $orderRepository->save($customer_id, $_POST, $shipping_fee)) {
            foreach($items as $id => $item) {
                
                $orderItemRepository->save($orderId, $item);
            }
            $_SESSION["success"] = "Bạn đã đặt hàng thành công";
            $cartStorage->clear();
        }
        else {
            $_SESSION["error"] = $orderRepository->getError();
        };
        header("location: index.php");
    }
}
?>