<?php
class ControllerAccountSupport extends Controller {

	public function index() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));


		//language
		
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;


		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		//language
		$this -> load -> model('account/customer');
		
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/support.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/support.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/support.tpl', $data));
		}
	}
	
	public function sendmail(){
		if ($this->request->post && $this -> customer -> isLogged())
		{
			if ($this->request->post['capcha'] != $_SESSION['cap_code']) {
					
					$this -> response -> redirect("support.html#error");
		    }

			$this -> load -> model('account/customer');
			$getCustomer = $this -> model_account_customer -> getCustomer($this->session->data['customer_id']);

			if ($this->request->post)
			{
				$this -> model_account_customer -> create_sendmail_account($this->session->data['customer_id'],$this->request->post['name'],$this->request->post['content'],$this->request->post['Image']);
			}
			$this -> response -> redirect("support.html#success");
		}
	}

}
