<?php 
class AuthController {
    function loginGoogle() {
        try {
            $clientID = GOOGLE_CLIENT_ID;
            $clientSecret = GOOGLE_CLIENT_SECRET;
            $redirectUri =  'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?c=auth&a=loginGoogle";
                
            // create Client Request to access Google API
            $client = new Google_Client();
            $client->setClientId($clientID);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri($redirectUri);
            $client->addScope("email");
            $client->addScope("profile");

            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token['access_token']);
            
                // get profile info
                $google_oauth = new Google_Service_Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();
                $email =  $google_account_info->email;
                $name =  $google_account_info->name;
                $this->createCustomerBySocial($email, $name, "google");
                $this->setupLoginEnv($email, $name);
                header("location: index.php");
            }
        }
        catch (Exception $e) {
			echo $e->getMessage();
		}
        

    }

    function createCustomerBySocial($email, $name, $type) {
		$customerRepository = new CustomerRepository();
		$customer = $customerRepository->findEmail($email);
	
		if (empty($customer)) {
			//create new customer
			$data = array(
				"fullname" => $name,
				"mobile" => "",
				"password" => "",
				"email" => $email,
				"ward_id" => null,
				"housenumber_street" => null,
				"login_by" => $type,
				"is_active" => 1
			);
			$customerRepository->save($data);
		}
	}
    function setupLoginEnv($email, $name, $remember_me = null) {
		$_SESSION["email"] = $email;
		$_SESSION["name"] = $name;
	}
}
?>