<?php 
class Customer
{
	protected $id;
	protected $name;
	protected $password;
	protected $mobile;
	protected $email;
	protected $login_by;
	protected $ward_id;
	protected $housenumber_street;
	protected $is_active;

	function __construct($id, $name, $password, $mobile, $email, $login_by, $ward_id, $housenumber_street, $is_active){
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->mobile = $mobile;
		$this->email = $email;
		$this->login_by = $login_by;
		$this->ward_id = $ward_id;
		$this->housenumber_street = $housenumber_street;
		$this->is_active = $is_active;
		
	}

	function getId(){
		return $this->id;
	}

	function getName(){
		return $this->name;
	}

	function getPassword() {
		return $this->password;
	}

	function getMobile() {
		return $this->mobile;
	}

	function getEmail() {
		return $this->email;
	}

	function getLoginBy() {
		return $this->login_by;
	}

	function getWardId() {
		return $this->ward_id;
	}

	function getHousenumberStreet() {
		return $this->housenumber_street;
	}

	function getIsActive() {
		return $this->is_active;
	}

	function setIsActive($is_active) {
		$this->is_active = $is_active;
		return $this;
	}
	
	function getWard() {
		$wardRepository = new WardRepository();
		$ward = $wardRepository->find($this->ward_id);
		return $ward;
	}

	function getAddress() {
		$address = "";
		if ($this->housenumber_street) {
			$address = $this->getHousenumberStreet();
		}

		if ($this->ward_id) {
			$ward = $this->getWard();
			$district = $ward->getDistrict();
			$province = $district->getProvince();
			$address .= ", " . $ward->getName() . ", " . $district->getName() . ", " . $province->getName();
		}
		return $address;
	}

	function setName($name) {
		$this->name = $name;
		return $this;
	}
	function setMobile($mobile) {
		$this->mobile = $mobile;
		return $this;
	}
	function setPassword($password) {
		$this->password = $password;
		return $this;
	}
}