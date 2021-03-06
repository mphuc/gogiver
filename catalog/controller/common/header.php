<?php
class ControllerCommonHeader extends Controller {
	public function index() {

		$data['title'] = $this->document->getTitle();
		if (!isset($_SESSION['language_id'])) {
			$this -> session -> data['language_id'] = "vietnamese";
        }
		$this -> load -> model('account/customer');

		if(isset($this -> session -> data['customer_id'])){

			$data['customer'] = $this -> model_account_customer ->  getCustomer($this -> session -> data['customer_id']);
		
			$data['date_auto'] = $this -> model_account_customer ->  getDateAuto($this -> session -> data['customer_id']);
			$data['date_auto'] =  $data['date_auto']['date_auto'];
			$this -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');

			$gd_march = $this -> model_account_customer -> getAllTotalGD_Status($this -> session -> data['customer_id']);
			$data['gd_march'] = intval($gd_march['number']);
			$pd_march = $this -> model_account_customer -> getAllTotalPD_Status($this -> session -> data['customer_id']);
			$data['pd_march'] = intval($pd_march['number']);
			$data['get_mail_admin'] = $this -> model_account_customer -> get_mail_admin($this -> session -> data['customer_id']);
				
			//print_r($_GET['route']); die;
			
			if ($data['customer']['customer_code'] == "")
			{
				if (isset($_GET['_route_']))
				{
					if ($_GET['_route_'] != "dashboard.html" && $_GET['_route_'] != "provide-donation.html" && $_GET['_route_'] != "getdonation.html" && $_GET['_route_'] != "setting.html" && $_GET['_route_'] != "support.html" && $_GET['_route_'] != "lockgd.html")
					{
						$this->response->redirect(HTTPS_SERVER . 'dashboard.html');
					}	
				}

				if (isset($_GET['route']))
				{
					if ($_GET['route'] == "account/commission" || $_GET['route'] == "account/commissionhistory")
					{
						$this->response->redirect(HTTPS_SERVER . 'dashboard.html');
					}
				}
				
			}

			

		}
		if (!isset($this -> session->data['language_id']))
		{
			$this -> session->data['language_id'] = "vietnamese";
		}
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		$data['changelanguage'] = $this->url->link('account/dashboard/changeLange', '', 'SSL');
		$data['base'] = $server;
		
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['self'] = $this;
		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = $server . 'image/logo.png';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');
		$this->load->language('common/footer');
		if (!isset($this -> session -> data['customer_id']))
		{
			$id_login = 1;
		}
		else
		{
			$id_login = $this->session->data['customer_id'];
		}
		$getLanguage = $this -> model_account_customer -> getLanguage($id_login);
		$language = new Language($getLanguage);
		$language -> load('common/header');

		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		
		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');
		$data['text_contact'] = $this->language->get('text_contact');

		$data['home'] = $this->url->link('account/login');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['account_edit'] = $this->url->link('account/edit', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');

		$this->load->language('account/login');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['button_login'] = $this->language->get('button_login');
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}
		$data['action_login'] = $this->url->link('account/login', '', 'SSL');

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		/*
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		*/

		// KDung add
		$this->load->model('simple_blog/article');
		$data['categories'] = array();
		$categories = $this->model_simple_blog_article->getCategories(0);
		foreach ($categories as $category) {
			$data['categories'][] = array(
					'simple_blog_category_id' => $category['simple_blog_category_id'],
					'name'     => $category['name'],
					'href'     => $this->url->link('simple_blog/category', 'simple_blog_category_id=' . $category['simple_blog_category_id'])
				);
		}
		// End KDung add

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');
		$data['content_top'] = $this->load->controller('common/content_top');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}

	public function getRWallet(){
		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');
			$checkR_Wallet = $this -> model_account_customer -> checkR_Wallet($this -> customer -> getId());
			if(intval($checkR_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insertR_Wallet($this -> customer -> getId())){
					die();
				}
			}
			$total = $this -> model_account_customer -> getR_Wallet($this -> customer -> getId());
			$total = count($total) > 0 ? $total['amount'] : 0;
			$json['success'] = $total;
			$total = null;

			$checkR_Wallet = $this -> model_account_customer -> checkR_Wallet($this -> customer -> getId());
			if(intval($checkR_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insertR_Wallet($this -> customer -> getId())){
					die();
				}
			}
			//get r-wallet of user received
			//$customerReceived = $this->model_account_customer->getCustomer($this -> customer -> getId());
			$getRwallet = $this -> model_account_customer -> getR_Wallet($this -> customer -> getId());
			$getGDRecived = $this -> model_account_customer -> getTotalGD($this -> customer -> getId());
			// if(intval($getGDRecived['number']) === 0 && intval($getRwallet['amount']) === 0 && intval($customerReceived['ping']) >= 6){
			// 	$this -> model_account_customer -> updateR_Wallet($customerReceived['customer_id'] , 3840000);
			// 	$this -> model_account_customer -> updateCheckNEwuser($customerReceived['customer_id']);
			// }
			$total = $this -> model_account_customer -> getR_Wallet($this -> customer -> getId());
			$total = count($total) > 0 ? $total['amount'] : 0;
			$json['success'] = $total;
			return $json['success'] = number_format($json['success']);
			// $this -> response -> setOutput(json_encode($json));
		}
	}

	public function getCWallet(){

		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');

			$checkC_Wallet = $this -> model_account_customer -> checkC_Wallet($this -> customer -> getId());


			if(intval($checkC_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insertC_Wallet($this -> customer -> getId())){
					die();
				}
			}
			$total = $this -> model_account_customer -> getC_Wallet($this -> customer -> getId());
			$total = count($total) > 0 ? $total['amount'] : 0;
			$json['success'] = $total;
			$total = null;
			return  $json['success'] = number_format($json['success']);
			// $this -> response -> setOutput(json_encode($json));
		}
	}
}