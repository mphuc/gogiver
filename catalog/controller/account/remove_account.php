<?php

class ControllerAccountRemoveaccount extends Controller {

	public function index() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/remove_account.js');

		};
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));
		$data['self'] = $this;
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		$getGD_none_finish = $this -> model_account_customer -> getGD_none_finish($this -> session -> data['customer_id']);

		$getPD_none_finish = $this -> model_account_customer -> getPD_none_finish($this -> session -> data['customer_id']);

		if (intval($getGD_none_finish) == 1 || intval($getPD_none_finish) == 1) 
		{
			$this->response->redirect(HTTPS_SERVER . 'dashboard.html');
		}

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/remove_account.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/remove_account.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/remove_account.tpl', $data));
		}
	}

	public function get_sub_cwallet_parent($customer_id)
	{
		$this -> load -> model('account/customer');
		return $this -> model_account_customer -> sum_PD_finish($customer_id);
	}

	public function update_c_wallet_full($customer_id,$amount)
	{
		$this -> load -> model('account/customer');
		$this -> load -> model('account/block');

		$getC_Wallet = $this -> model_account_customer -> getC_Wallet($customer_id);
		$getGD_last = $this -> model_account_customer -> getGD_last($customer_id);

		if (count($getGD_last) > 0 && doubleval($getC_Wallet['amount']) < $amount && doubleval($getGD_last['amount']) > $amount)
		{
			$this -> model_account_block -> update_GD_amount($amount , $customer_id, $getGD_last['id']);
		}
		else
		{
			$this -> model_account_customer -> update_C_Wallet($amount, $customer_id);
		}
	}

	public function submit(){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
		};
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));
		$this -> load -> model('account/customer');
		if ($this -> customer -> isLogged() && $this -> request -> post['content'] && $this -> request -> post['Password2']) {
			$variablePasswd = $this -> model_account_customer -> getPasswdTransaction($this -> request -> post['Password2']);
			if ($variablePasswd['number'] != '0')
			{

				$customer = $this -> model_account_customer -> getCustomer($this-> session->data['customer_id']);

				$this -> model_account_customer -> create_reason($this-> session->data['customer_id'],$this -> request -> post['content']);
				$this -> model_account_customer -> up_status_removeaccount($this-> session->data['customer_id'],10);

				$this -> model_account_customer -> update_date_off($this-> session->data['customer_id']);

				$get_pnode = $this -> model_account_customer -> get_ml_customer($this-> session->data['customer_id'])['p_node'];
				
				$get_PD_customer_id = $this -> model_account_customer -> get_PD_customer_id($this-> session->data['customer_id']);

				if (intval($get_PD_customer_id) == 0)
				{
					$returnDate = $this -> update_c_wallet_full($get_pnode,500000);

					$this -> model_account_customer -> saveTranstionHistory(
						$get_pnode, 
						'C-wallet', 
						'- ' . number_format(500000) . ' VND', 
						"Reason: ".$customer['username']." Remove account",
						"Deduct 500.000"
					);
				}

				$get_sub_cwallet_parent = $this -> get_sub_cwallet_parent($this-> session->data['customer_id']);

				if (floatval($get_sub_cwallet_parent) > 0)
				{

					$this -> update_c_wallet_full($get_pnode,$get_sub_cwallet_parent*0.1);
					$this -> model_account_customer -> saveTranstionHistory(
						$get_pnode, 
						'C-wallet', 
						'- ' . number_format($get_sub_cwallet_parent*0.1) . ' VND', 
						"Reason: ".$customer['username']." Remove account",
						"Deduct ".number_format($get_sub_cwallet_parent*0.1).""
					);
				}

				$get_all_pnode = $this -> model_account_customer -> get_all_pnode($this-> session->data['customer_id']);
				foreach ($get_all_pnode as $value) {
					$this -> model_account_customer -> remove_account($value['customer_id'],$get_pnode);
				}
				/*$this -> model_account_customer -> remove_account($this-> session->data['customer_id'],0);*/

				

				$json['complete'] = 1;
				$this->event->trigger('pre.customer.logout');

				$this->customer->logout();
				$this->cart->clear();

				unset($this->session->data['wishlist']);
				unset($this->session->data['shipping_address']);
				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_address']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);
				unset($this->session->data['comment']);
				unset($this->session->data['order_id']);
				unset($this->session->data['coupon']);
				unset($this->session->data['reward']);
				unset($this->session->data['voucher']);
				unset($this->session->data['vouchers']);

				$this->event->trigger('post.customer.logout');
				$this -> response -> setOutput(json_encode($json));
			}
			else
			{
				$json['Password2'] = -1;
				$this -> response -> setOutput(json_encode($json));
			}
		}
	}
}