<?php
class ControllerAccountMember extends Controller {
	private $error = array();
	
	public function index() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));

			$this->document->addScript('catalog/view/javascript/refferal/refferal.js');
			$this->document->addScript('catalog/view/javascript/personal/personal.js');

//die('Sever Update');

		//language
		$this -> load -> language('account/personal');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/personal');
		$data['lang'] = $language -> data;

		//start load country model
		$this -> load -> model('customize/country');
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;

		$data['country'] = $this -> model_customize_country -> getCountry();
		//end load country model

		//data render website
		$data['self'] = $this;

		//error validate
		$data['error'] = $this -> error;
		$data['p_binary'] = false;
		$data['has_register'] = false;
		$data['member_f1'] = array();

		$data['ulr_getdetail_user'] =  HTTPS_SERVER . 'index.php?route=account/member/getdetalis_user';
		$this -> load -> model('account/member');


		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 25;
		$start = ($page - 1) * $limit;

		$pagination = new Pagination();
		$pagination -> total = $this -> model_account_member -> countMember($this -> customer -> getId());
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = $this -> url -> link('account/member', 'page={page}', 'SSL');

		$data['member_f1'] = $this -> model_account_member -> getmember($this -> customer -> getId(),  $limit, $start);
		$data['pagination'] = $pagination -> render();

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/member.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/member.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/member.tpl', $data));
		}

	}
	public function getdetalis_user(){
		$this -> load ->model('account/member');
		$getusermember = $this -> model_account_member -> getusermember($_POST['customer_id']);
		$getchild = $this -> model_account_member -> getchild($_POST['customer_id']);

		$getchild_ = $this -> model_account_member -> getusermember($getchild['p_node']);
	?>
		<!-- <div id="detals">
		  <div class="col-md-6 col-xs-12">
		      <label for="">ID nhận</label>
		      <input  readonly="readonly"  id="id_nhan" value="<?php echo $getusermember['customer_id']; ?>">
		  </div>
		  <div class="col-md-6  col-xs-12">
		      <label for="">Cấp bậc</label>
		      <input type="text" readonly="readonly" value="<?php echo $getusermember['level']; ?>" id="level">
		  </div>
		  <div class="col-md-6  col-xs-12">
		      <label for="">Email</label>
		      <input type="text" readonly="readonly" value="<?php echo $getusermember['email']; ?>" id="email">
		  </div>
		  <div class="col-md-6  col-xs-12">
		      <label for="">Tên đầy đủ</label>
		      <input type="text" readonly="readonly" value="<?php echo $getusermember['account_holder']; ?>" id="full_name">
		  </div>
		  <div class="col-md-6  col-xs-12">
		      <label for="">TK ngân hàng</label>
		      <input type="text" readonly="readonly" value="<?php echo $getusermember['account_number']; ?>" id="tk_bank">
		  </div>
		  <div class="col-md-6  col-xs-12">
		      <label for="">Điện thoại</label>
		      <input type="text" readonly="readonly" value="<?php echo $getusermember['telephone']; ?>" id="phone_number">
		  </div>
		  <div class="col-md-6  col-xs-12">
		      <label for="">Cây hệ thống</label><div class="child"><?php echo $getchild_['username'];?> >> <?php echo $getusermember['username']; ?></div>
		  </div>
		  <div class="clearfix"></div>
		</div> -->
	<?php
		//echo json_encode($getusermember); die;
	}
	public function form_footer(){
		if ($this ->request ->post)
		{
			$this -> load -> model('account/member');
			$this -> model_account_member -> insert_messmage($this ->request ->post['title'],$this ->request ->post['content']);
		}
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
			$json['success'] = intval($this -> model_customize_register -> checkExitEmail($this -> request -> get['email'])) < 11 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}
	public function checkphone() {
		if ($this -> request -> get['phone']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitPhone($this -> request -> get['phone'])) < 11 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function checkcmnd() {
		if ($this -> request -> get['cmnd']) {
			$this -> load -> model('customize/register');
			$json['success'] = intval($this -> model_customize_register -> checkExitCMND($this -> request -> get['cmnd'])) < 11 ? 0 : 1;
			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function getCountry($id){
		$this->load->model('account/customer');
		$country = $this->model_account_customer->getCountryByID($id);
		return 'VN';

	}
	
	public function getlevel(){
		if($this->customer->isLogged() && $this -> request -> get['id'] ) {
			$this->load->model('account/customer');
			$json['success'] = intval($this->model_account_customer->getCountLevelCustom($this -> request -> get['id'] , $this -> request -> get['level']));
			$this -> response -> setOutput(json_encode($json));
		}
	}


	public function countFloor($limit, $offset){

		$this -> load -> model('account/customer');
		$floor = $this->model_account_customer->getCountFloor($this -> session -> data['customer_id']);
				//Level 2
		if(!empty($floor1)){
			$data['floor1'] = count($floor1);
			$arrId='';
			foreach ($floor1 as $value) {
				$arrId .= ','.$value['customer_id'];
			}
			$arrId = substr($arrId, 1);
			$json['customerFloor1'] = $this -> model_account_customer -> getCustomerFloor($arrId, $limit, $offset);
			$json['arrId1'] = $arrId;
			$floor2 = $this->model_account_customer->getCountFloor($arrId);
			$data['floor2'] = count($floor2);
		}
		$totalFloor = intval($this -> sumFloor());
		
		for ($i=1; $i <= $totalFloor; $i++) { 

			if(!empty($floor)){
				$data['floor'.$i] = count($floor);
				$arrId='';
				foreach ($floor as $value) {
					$arrId .= ','.$value['customer_id'];
				}
				$arrId = substr($arrId, 1);
				$json['customerFloor'.$i] = $this -> model_account_customer -> getCustomerFloor($arrId, $limit, $offset);
				$json['arrId'.$i] = $arrId;
				$floor = $this->model_account_customer->getCountFloor($arrId);
				$data['floor'.$i] = count($floor);
			}
		}
		
		return $json;
	}
	public function getParrent($customer_id){
		$this -> load -> model('account/customer');
		$parrent = $this -> model_account_customer ->getParrent($customer_id);
		return $parrent;
	}
	public function checkPD($customer_id){
		$this->load->model('account/customer');
		$rows = $this -> model_account_customer -> checkPD($customer_id);
		$count = count($rows) > 0 ? 1 : 2;
		return $count;
	}
	public function getPD($customer_id){
		$this->load->model('account/customer');
		$rows = $this -> model_account_customer -> getPDLimit1($customer_id);
		if (!empty($rows)) {
			$PD = $rows['filled']/100000000;
		}else{
			$PD = 0;
		}
		
		return $PD;
	}
	public function sumFloor(){
		$this->load->model('account/customer');
		$floor = $this -> model_account_customer -> getSumFloor($this -> session -> data['customer_id']);
		$floor = intval($floor);
		return $floor;
	}
	public function customerFloor(){
		$this -> load -> language('account/personal');
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/personal');
		$lang = $language -> data;

		$limits = 10;
		
		if (isset($this -> request -> get['prev'])) {
			$limits = intval($this -> request -> get['prev'])-10;
		}
		if (isset($this -> request -> get['next'])) {
			$limits = intval($this -> request -> get['next'])+10;
		}
		if ($limits == 0) {
			$limits = 10;
		}

		$page = intval($limits)/10;
		
		$limit = 10;
		
		$start = ($page - 1) * 10;
		
		$customerFloor = $this -> countFloor($limit,$start);
		if ($this->request->get['floor']) {
			$floor = $this -> request -> get['floor'];
		}else{
			$floor = $floor1;
		}
		
		$totalFloor = intval($this -> sumFloor());
		for ($i=1; $i <= $totalFloor; $i++) { 
			if ($floor == 'floor'.$i) {
				$arrId = $customerFloor['arrId'.$i];
			}
		}

		
		$ts_floor = $this -> model_account_customer -> getTotalCustomerFloor($arrId);
		$ts_floor = $ts_floor['number'];
		
		//Floor 1
		for ($i=1; $i <=	 $totalFloor; $i++) { 
			if ($floor == 'floor'.$i) {
				if (!empty($customerFloor['customerFloor'.$i])) {
					
					$fl = 0;
					
					$customerFloor = $customerFloor['customerFloor'.$i];

					//echo "<pre>"; print_r($customerFloor1); echo "</pre>"; die();
					$fl = $fl.$i;
					$fl = '';
					$fl .=' <h3 class="panel-title" style="
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #ffffff;
    margin-bottom: 10px;
">Thành Viên F'.$i.' ('.$ts_floor.' Thành Viên)</h3>';
					$fl .= '<table id="" class="table table-striped table-bordered " >';
			        $fl .= '   <thead>';
			        $fl .= '      <tr  class="header">';
					$fl .= '       	<th>'.$lang['No'].'</th>
                           <th>'.$lang['id_hethong'].'</th>
                           <th>'.$lang['full_name'].'</th>
                           
                           <th>Pin</th>
                           <th>'.$lang['Guardian'].'</th>
                           <th>'.$lang['status'].'</th>';
			        $fl .= '      </tr>';
			        $fl .= '       </thead>';
					$fl .= '<tbody>';
					$count = 1;
					foreach ($customerFloor as $key => $value) {
						$fl .= '<tr>';
						$fl .= '<td data-title="STT" align="center">'.$count.'</td>';
						$fl .= '<td data-title="ID Hệ Thống">'.$value['name'].'</td>';
						$fl .= '<td data-title="Họ Tên">'.$value['account_holder'].'</td>';
						
						// $fl .= '<td data-title="Mail">'.$value['email'].'</td>';
						$fl .= '<td data-title="Pin">'.$value['ping'].'</td>';
						$fl .= '<td data-title="Người Bảo Trợ">'.$this -> getParrent($value['p_node']).'</td>';
						// $fl .= '<td data-title="Investment">'.$this -> getPD($value['customer_id']).' BTC </td>';
						
						$fl .= '<td data-title="Trạng Thái PH">'.(intval($this -> checkPD($value['customer_id'])) === 1 ? '<span class="text-success">Kích hoạt</span>' : '<span class="text-warning">'.$lang['Waiting'].'	</span>').'</td>';
						 // $fl .= '<td data-title="Country">'.$this -> getCountry($value['country_id']).'</td>';
					
						$fl .= '</tr>';
						$count++;
					}
					$fl .= '</tbody>';
					$fl .= '</table>';
					$fl .= '<button id="Prev" type="button" class="btn btn-primary">'.$lang['trang_truoc'].'</button>'; 
					$fl .= '<input id="next_page" type="hidden" name="next" value="'.$limits.'">
						<button id="Next" type="button" class="btn btn-primary">'.$lang['trang_sau'].'</button>'; 
					
					$json['fl'.$i] = $fl;
					$fl = null;
				}
			}
		}
	
		$this -> response -> setOutput(json_encode($json));
	}



}
