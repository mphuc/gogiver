<?php
class ControllerAccountMail extends Controller {

	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
		};
		$this -> load -> model('account/customer');
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		

		$data['self'] = $this;
		$data['get_mail_admin_all'] = $this -> model_account_customer -> get_mail_admin_all($this -> customer -> getId());

		$this -> model_account_customer -> u_viewmail_admin($this -> session-> data['customer_id']);

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/mail.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/mail.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/mail.tpl', $data));
		}
	}
	
}
