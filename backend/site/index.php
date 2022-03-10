<?php 
session_start();
require "../config.php";
require "../connectDB.php";
require "models/base/BaseRepository.php";
require "models/brand/Brand.php";
require "models/brand/BrandRepository.php";
require "models/category/Category.php";
require "models/category/CategoryRepository.php";
require "models/product/Product.php";
require "models/product/ProductRepository.php";
require "models/productColor/ProductColor.php";
require "models/productColor/ProductColorRepository.php";
require "models/productCapacity/ProductCapacity.php";
require "models/productCapacity/ProductCapacityRepository.php";
require "models/comment/Comment.php";
require "models/comment/CommentRepository.php";
require "models/customer/Customer.php";
require "models/customer/CustomerRepository.php";
require "models/province/Province.php";
require "models/province/ProvinceRepository.php";
require "models/district/District.php";
require "models/district/DistrictRepository.php";
require "models/ward/Ward.php";
require "models/ward/WardRepository.php";
require "models/transport/Transport.php";
require "models/transport/TransportRepository.php";
require "models/cart/Cart.php";
require "models/cart/CartStorage.php";
require "models/order/Order.php";
require "models/order/OrderRepository.php";
require "models/orderItem/OrderItem.php";
require "models/orderItem/OrderItemRepository.php";

// recaptcha
require "../vendor/autoload.php";

require "service/MailService.php";

$c = $_GET["c"] ?? "home";
$a = $_GET["a"] ?? "index";
$controllerName = ucfirst($c) ."Controller";
require "controllers/" .$controllerName .".php";
$controller = new $controllerName();
$controller->$a();
?>