<?php
class ControllerAccountDashboard extends Controller {

	public function index() {
		
		// $mail = new Mail();	
		// $mail->protocol = $this->config->get('config_mail_protocol');
		// $mail->parameter = $this->config->get('config_mail_parameter');
		// $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		// $mail->smtp_username = $this->config->get('config_mail_smtp_username');
		// $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		// $mail->smtp_port = $this->config->get('config_mail_smtp_port');
		// $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		// $mail->setTo('phucnguyen@icsc.vn');
		// $mail->setFrom($this->config->get('config_email'));
		// $mail->setSender(html_entity_decode("test test", ENT_QUOTES, 'UTF-8'));
		// $mail->setSubject("asd11111111fssd");
		// $mail->setText("fddsasfsffsds");
		// $mail->send();

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/dashboard/dashboard.js');
			$self -> document -> addScript('catalog/view/javascript/jquery.marquee.js');
			$self -> document -> addScript('catalog/view/javascript/canvasjs.min.js');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
			$self -> load -> model('simple_blog/article');
		};
		
		
		!call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
		call_user_func_array("myConfig", array($this));

		

		$block_id_gd = $this -> check_block_id_gd();

		if (intval($block_id_gd) !== 0) $this->response->redirect(HTTPS_SERVER . 'lockgd.html');

		
		
		//language
		$this -> load -> model('account/customer');
		$this -> model_account_customer -> update_login($this -> session -> data['customer_id']);

		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$data['language']= $getLanguage;
		$language = new Language($getLanguage);
		$language -> load('account/dashboard');
		
		$data['lang'] = $language -> data;
		$checkM_Wallet = $this -> model_account_customer -> checkM_Wallet($this -> customer -> getId());
		if(intval($checkM_Wallet['number'])  === 0){
			if(!$this -> model_account_customer -> insert_M_Wallet($this -> customer -> getId())){
				die();
			}
		}
		$time = $this -> model_account_customer -> get_M_Wallet($this -> customer -> getId());
		
		$data['date'] = $time['date'];
		//method to call function

	
		//data render website
		//start load country model

		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}
		$data['customer_code'] = $this -> model_account_customer -> getCustomer($this -> customer -> getId());

		$data['customer_code'] = $data['customer_code']['username'];
		$data['base'] = $server;
		$data['self'] = $this;
		$data['regulations'] = $this -> config -> get('config_regulations');
		$data['regulations1'] = $this -> config -> get('config_regulations_1');
		$data['regulations2'] = $this -> config -> get('config_regulations_2');
		$data['regulations3'] = $this -> config -> get('config_regulations_3');
		// getArticles
		$page = isset($this->request->get['page']) ? $this->request->get['page'] : 1;      

		$limit = 10;
		$start = ($page - 1) * 10;
		$article_total = $this->model_simple_blog_article->getTotalArticle();

		$pagination = new Pagination();
		$pagination->total = $article_total;
		$pagination->page = $page;
		$pagination->limit = $limit; 
		$pagination->num_links = 5;
		//$pagination->text = 'text';
		$pagination->url = $this->url->link('account/dashboard', 'page={page}#anouncenment', 'SSL');
		if ($getLanguage == 'vietnamese') {
			$Language_id = 2;
		}else{
			$Language_id = 1;
		}
		$data['article_limit'] = $this -> model_simple_blog_article -> getArticleLimit($limit,$start, $Language_id);
		
		$data['onlineToday'] = $this -> model_account_customer ->onlineToday();
		$data['pagination'] = $pagination->render();

		$data['pd_march'] = $this->model_account_customer->getPDMarch($this -> customer -> getId());

		///All GD
		$pages = isset($this -> request -> get['pages']) ? $this -> request -> get['pages'] : 1;

		//$data['pds'] = $this -> model_account_customer -> getAllPD($limit, $start);
		$data['self'] = $this;
		//thong bao RE PD
		$data['repd'] = $data['pd_user'] = array();
		$getGD_user = $this -> model_account_customer -> getGD_user($this->session->data['customer_id']);
		
		if (intval($getGD_user) > 0 ){
			$data['repd'] = $this-> model_account_customer ->repd($this->session->data['customer_id']);
		}
		
		

		//get thong bao het chu ky (3)

		$data['chu_ky'] = $this -> model_account_customer ->  checkChuky($this -> customer -> getId());

		$data['getPDfinish_child'] = $this -> model_account_customer ->getPDfinish_child($this -> customer -> getId());

		$data['get_tranfer_12h'] = $this -> model_account_customer -> get_tranfer_12h($this -> customer -> getId());
		

		$get_childrend = $this -> model_account_customer -> get_childrend($this->session->data['customer_id']);
		
		$data['get_childrend'] = $get_childrend;

		$get_childrend_all = $this -> model_account_customer -> get_childrend_all($this->session->data['customer_id']);

		$data['get_childrend_all'] = $get_childrend_all;
		/*$data['get_customer_by_id_inss'] = $this -> model_account_customer ->get_customer_by_id_in($get_childrend_all,);*/

		$data['get_customer_by_id_in'] = $this -> model_account_customer ->get_customer_by_id_in_new();
		$get_childrend_customer = $this -> model_account_customer -> get_childrend_customer($this->session->data['customer_id']);
		
		$date_finish = strtotime ( '+ 45 day' , strtotime ($get_childrend_customer) ) ;
		$data['date_finish'] = date('Y-m-d H:i:s',$date_finish); // 45 ngày tạo user
		
		$date_pd = $this -> model_account_customer -> date_pd($this->session->data['customer_id']);
		$data['date_pd'] = ($date_pd); 
		//print_r($data['date_pd']);die;

		
		// user 45 ngay block
		$data['get_45_block'] = $this -> model_account_customer -> get_45_block($this->session->data['customer_id']);

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/dashboard.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/dashboard.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/login.tpl', $data));
		}
		
	}

	public function getusername($code){
		$this->load->model('account/customer');
		$customer = $this -> model_account_customer -> get_customer_by_id($code);
		return $customer;
	}

	public function child_gd(){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
			$self -> load -> model('simple_blog/article');
		};
		
		
		!call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
		call_user_func_array("myConfig", array($this));

		$block_id = $this -> check_block_id();
		
		if (intval($block_id) !== 0) $this->response->redirect(HTTPS_SERVER . 'lock.html');


		$this->load->model('account/customer');
		$data['customer'] = $customer = $this -> model_account_customer -> get_customer_by_code($_GET['token']);
		count($customer) === 0 && $this->response->redirect(HTTPS_SERVER . 'dashboard.html');;
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		$data['self'] = $this;
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;
		$limit = 10;
		$start = ($page - 1) * 10;
		$pd_total = $this -> model_account_customer -> tatol_GD_customer($_GET['token']);
		if (count($pd_total) > 0) {
			$pd_total = $pd_total['number'];
		}else{
			$pd_total = 0;
		}
		
		
		$pagination = new Pagination();
		$pagination -> total = $pd_total;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = $this -> url -> link('account/dashboard/child_gd', 'page={page}', 'SSL');

		$data['gds'] = $this -> model_account_customer -> get_GD_customer($_GET['token'], $limit, $start);
		
		$data['pagination'] = $pagination -> render();
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/child_gd.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/child_gd.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/login.tpl', $data));
		}
	}
	public function child_pd(){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
			$self -> load -> model('simple_blog/article');
		};
		
		
		!call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
		call_user_func_array("myConfig", array($this));

		$block_id = $this -> check_block_id();
		
		if (intval($block_id) !== 0) $this->response->redirect(HTTPS_SERVER . 'lock.html');

		$this->load->model('account/customer');
		$data['customer'] = $customer = $this -> model_account_customer -> get_customer_by_code($_GET['token']);
		count($customer) === 0 && $this->response->redirect(HTTPS_SERVER . 'dashboard.html');;
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 10;
		$start = ($page - 1) * 10;
		
		$pd_total = $this -> model_account_customer -> tatol_PD_customer($_GET['token']);

		$pd_total = $pd_total['number'];

		$pagination = new Pagination();
		$pagination -> total = $pd_total;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = $this -> url -> link('account/phf', 'page={page}', 'SSL');

		$data['pds'] = $this -> model_account_customer -> get_PD_customer($_GET['token'], $limit, $start);

		$data['pagination'] = $pagination -> render();
		
		$data['pagination'] = $pagination -> render();
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/child_pd.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/child_pd.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/login.tpl', $data));
		}
	}

	public function check_block_id(){
		$this->load->model('account/customer');
		$block_id = $this -> model_account_customer -> get_block_id($this -> customer -> getId());
		
		return intval($block_id['status']);

	}
	public function check_block_id_gd(){
		$this->load->model('account/customer');
		$block_id = $this -> model_account_customer -> get_block_id_gd($this -> customer -> getId());
		
		return intval($block_id);
	}

	public function check_block_pd_month(){
		$this->load->model('account/customer');
		$block_id = $this -> model_account_customer -> get_block_pd_month($this -> customer -> getId());
		return intval($block_id['status']);
	}

function replace_injection($str, $filter){
	foreach($filter as $key => $value)
	$str = str_replace($filter[$key], "", $str);
	return $str;
}
	public function insurance_fund(){
		$filter2 = Array(',');
		$this->load->model('account/customer');
		include('simple_html_dom.php');
		$html = file_get_html('http://www.xe.com/currencyconverter/convert/?From=USD&To=VND');
		$response ='';
		foreach($html->find('.uccResultAmount') as $e){
			 $response .= $e->innertext;
		}

		$response = strip_tags($response);

		$response = replace_injection($response, $filter2);
		
		// echo "<pre>"; print_r($response); echo "</pre>"; die();
			$insurance_fund = $this->model_account_customer->get_insurance_fund();
		// $data = file_get_contents("http://www.vietcombank.com.vn/exchangerates/ExrateXML.aspx");
		// $p = explode("<Exrate ", $data);
		// for($a = 1; $a<count($p); $a++) {
		// 	if(strpos($p[$a],'USD')) {
		//         $posBuy = strrpos($p[$a],'Buy="')+5;
		//         $priceBuy = floatval(substr( $p[$a], $posBuy, 8));
		//     }
		// }
		$insurance = intval($insurance_fund);
		// $insurance = number_format($priceBuy*$insurance);
		$insurance = number_format(floatval($response)*$insurance);
		return $insurance;
		
	}
	
	public function RequestGD(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllGD(7, 0, 0);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['amount']/100000000).' BTC</span>'.substr($value['username'], 0, 3).'<b> ...</b></p>';
		}
		

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function RequestGDMarch(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllGD(7, 0, 1);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['amount']/100000000).' BTC</span>'.substr($value['username'], 0, 3).'<b> ...</b></p>';
		}
	

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function RequestGDFinish(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllGD(7, 0, 2);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['amount']/100000000).' BTC</span>'.substr($value['username'], 0, 3).'<b> ...</b></p>';
		}
		

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function RequestPD(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllPD(7, 0,0);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['filled']/100000000).' BTC</span>'.substr($value['username'], 0, 3).'<b> ...</b></p>';
		}
	

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function RequestPDMarch(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllPD(7, 0, 1);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['filled']/100000000).' BTC</span>'.substr($value['username'], 0, 3).'<b> ...</b></p>';
		}
		

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function RequestPDFinish(){
		$this->load->model('account/customer');
		$gds = $this -> model_account_customer -> getAllPD(7, 0, 2);
		$html = '';
		
		foreach ($gds as $key => $value) {
			$html .= '<p class="list-group-item"><span class="badge">'.($value['filled']/100000000).' BTC</span>'.substr($value['username'], 0, 3).'<b> ...</b></p>';
		}
		

		$json['html'] = $html;
		$html = null;
		$this -> response -> setOutput(json_encode($json));
	}
	public function viewBlogs(){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/dashboard/dashboard.js');
			$self -> load -> model('simple_blog/article');
		};
		

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$data['language']= $getLanguage;
		$language = new Language($getLanguage);
		$language -> load('account/dashboard');
		
		$data['lang'] = $language -> data;

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		//data render website
		//start load country model

		if ($this -> request -> server['HTTPS']) {
			$server = $this -> config -> get('config_ssl');
		} else {
			$server = $this -> config -> get('config_url');
		}

		$data['base'] = $server;
		$data['self'] = $this;
			//method to call function

			!$this -> request -> get['token']  && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
			$id_ = $this -> request -> get['token'];

if ($getLanguage == 'vietnamese') {
			$Language_id = 2;
		}else{
			$Language_id = 1;
		}
			$this->load->model('simple_blog/article');
			$data['detail_articles'] = $this->model_simple_blog_article->getArticlesBlogs($id_, $Language_id);        	
		
			if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/showblog.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/showblog.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/showblog.tpl', $data));
		}
		}

	public function changeLange(){
		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');
			$json['success'] = $this -> model_account_customer -> updateLanguage( $this -> customer -> getId(), $this -> request -> get['lang'] ) ;
			$this -> session->data['language_id'] = $this -> request -> get['lang'];
			$this -> response -> setOutput(json_encode($json));
		}
	}

	/*
	 *
	 * ajax count total tree member
	 */
	public function totaltree() {
		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');

			$total =  $this -> model_account_customer -> getCountTreeCustom($this -> customer -> getId());
		return intval($total);
			// $this -> response -> setOutput(json_encode($json));
		}
	}
	public function total_binary_left(){
		$this -> load -> model('account/customer');

		$count = $this -> model_account_customer ->  getCustomer_ML($this -> customer -> getId());
		if(intval($count['left']) === 0){
			$json['success'] = 0;
		}else{
			$count = $this -> model_account_customer -> getCountBinaryTreeCustom($count['left']);
			$count = (intval($count) + 1);
			$json['success'] = $count;
		}

		$this -> response -> setOutput(json_encode($json));
		

	}

	public function total_binary_right(){
		$this -> load -> model('account/customer');

		$count = $this -> model_account_customer ->  getCustomer_ML($this -> customer -> getId());
		if(intval($count['right']) === 0){
			$json['success'] = 0;
		}else{
			$count = $this -> model_account_customer -> getCountBinaryTreeCustom($count['right']);
			$count = (intval($count) + 1);
			$json['success'] = $count;
		}


		$this -> response -> setOutput(json_encode($json));


	}


	public function total_pd_left(){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getCustomer($this -> customer -> getId());
		if(intval($count['total_pd_left']) === 0){
			$json['success'] = 0;
		}else{
			$json['success'] = $count['total_pd_left'] / 100000000;

		}

		$this -> response -> setOutput(json_encode($json));

	}
	public function total_pd_right(){
		$this -> load -> model('account/customer');
		$count = $this -> model_account_customer ->  getCustomer($this -> customer -> getId());

		if(intval($count['total_pd_right']) === 0){
			$json['success'] = 0;
		}else{
			$json['success'] = $count['total_pd_right'] / 100000000;

		}
		$this -> response -> setOutput(json_encode($json));
	}
	public function totalpin() {
		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');
			$pin = $this -> model_account_customer -> getCustomer($this -> customer -> getId());
			$pin = $pin['ping'];
			return $json['success'] = intval($pin);
			// $pin = null;
			// $this -> response -> setOutput(json_encode($json));
		}
	}

	public function analytics() {

		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');
			$json['success'] = intval($this -> model_account_customer -> getCountLevelCustom($this -> customer -> getId(), $this -> request -> get['level']));
			
			if ($this -> session -> data['customer_id']  == 2 && intval($this -> request -> get['level']) ==1 )
			{
				$json['success'] = $json['success'] + 1000;
			}
			
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function countPD(){
		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');
			$total = $this -> model_account_customer -> getTotalPD($this -> customer -> getId());
			$total = $total['number'];
			return $json['success'] = intval($total);
			// $total = null;
			// $this -> response -> setOutput(json_encode($json));
		}
	}


	public function countGD(){
		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');
			$total = $this -> model_account_customer -> getTotalGD($this -> customer -> getId());
			$total = $total['number'];
			return $json['success'] = intval($total);
			// $total = null;
			// $this -> response -> setOutput(json_encode($json));
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
	public function getMWallet(){

		if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
			$this -> load -> model('account/customer');

			// $checkM_Wallet = $this -> model_account_customer -> checkM_Wallet($this -> customer -> getId());
			// if(intval($checkM_Wallet['number'])  === 0){
			// 	if(!$this -> model_account_customer -> insert_M_Wallet($this -> customer -> getId())){
			// 		die();
			// 	}
			// }
			$total = $this -> model_account_customer -> get_M_Wallet($this -> customer -> getId());
			$total = count($total) > 0 ? $total['amount'] : 0;
			
			$json['success'] = $total;
			
			$total = null;
			$json['success'] = number_format($json['success']);
			$this -> response -> setOutput(json_encode($json));
		}
	}

	// public function email(){

	// 	if ($this -> customer -> isLogged() && $this -> customer -> getId()) {
	// 		$mail = new Mail();
	// 		$mail->protocol = $this->config->get('config_mail_protocol');
	// 		$mail->parameter = $this->config->get('config_mail_parameter');
	// 		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
	// 		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
	// 		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
	// 		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
	// 		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

	// 		$mail->setTo('hotro72pays@gmail.com');
	// 		$mail->setFrom($this->config->get('config_email'));
	// 		$mail->setSender(html_entity_decode("72pays.com email support", ENT_QUOTES, 'UTF-8'));
	// 		$mail->setSubject($this -> request -> post ['sub']);
	// 		$mail->setText($this -> request -> post ['text']);
	// 		$mail->send();
	// 	}

	// }

}
