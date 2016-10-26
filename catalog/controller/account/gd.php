<?php
class ControllerAccountGd extends Controller {

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
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$data['language'] = $getLanguage;
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 10;
		$start = ($page - 1) * 10;

		$gd_total = $this -> model_account_customer -> getTotalGD($this -> session -> data['customer_id']);

		$gd_total = $gd_total['number'];


		$pagination = new Pagination();
		$pagination -> total = $gd_total;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = $this -> url -> link('account/gd', 'page={page}', 'SSL');

		$data['gds'] = $this -> model_account_customer -> getGDById($this -> session -> data['customer_id'], $limit, $start);
		$data['pagination'] = $pagination -> render();

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/gd.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/gd.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/gd.tpl', $data));
		}
	}
	public function getAccountHolder($customer_id){
		$this -> load -> model('account/customer');
		$cus_id =0;
		if (intval($customer_id)===0) {
			$cus_id = 1;
		}else{
			$cus_id = $customer_id;
		}
		$parrent = $this -> model_account_customer ->getAccount_holder($cus_id);

		return $parrent;
	}
	public function getParrent($customer_id){
		$this -> load -> model('account/customer');
		if (intval($customer_id)===0) {
			$cus_id = 1;
		}else{
			$cus_id = $customer_id;
		}
		return $parrent = $this -> model_account_customer ->getParrent($cus_id);
	}
	public function getPhone($customer_id){
		$this -> load -> model('account/customer');
		if (intval($customer_id)===0) {
			$cus_id = 1;
		}else{
			$cus_id = $customer_id;
		}
		$phone = $this -> model_account_customer ->getPhone($cus_id);
		return $phone;
	}
	public function getMessages($transfer_id){
		$this->load->model('account/customer');
		$message = $this-> model_account_customer -> getMessage($transfer_id);
		$html ='';
		foreach ($message as $key => $value) {
			$html .= '<h5 class="text-warning">
'.$this->getParrent($value['customer_id']).'
<span class="text-muted pull-right" style="font-size:12px;"><i class="fa fa-calendar-o"> </i> '.$value['date_added'].'</span>
</h5>';
			
			$html.= '<p>';
			$html .= $value['message'];
			$html .= '</p>';
		}
		return $html;
	}
	public function confirm_submit($customer_id){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
			$self -> load -> model('account/customer');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
		call_user_func_array("myConfig", array($this));
		
		!$this->request->get['token'] && $this->response->redirect(HTTPS_SERVER . 'login.html');
		$checkTransfer =  $this -> model_account_customer -> getTransferList_byId($this->request->get['token']);
		intval($checkTransfer['number']) === 0  && $this->response->redirect(HTTPS_SERVER . 'login.html');
		$this-> model_account_customer -> updateStatusGDTransferList($this->request->get['token']);
		$Customer_Tranferlist = $this -> model_account_customer -> getPDByTranferID($this -> request -> get['token']);
		$GDCustomer = $Customer_Tranferlist['gd_id'];
		
		$countNotGDFinish = $this -> model_account_customer -> countStatusGDTransferList($GDCustomer);
		if(count($countNotGDFinish) > 0 && intval($countNotGDFinish['number']) === 0){
			$this -> model_account_customer -> updateStusGD($GDCustomer);
		}

		$this->response->redirect(HTTPS_SERVER . 'getdonation.html#success');
	}
	public function report_submit($customer_id){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
			$self -> load -> model('account/customer');
		};
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this->response->redirect(HTTPS_SERVER . 'login.html');
		call_user_func_array("myConfig", array($this));
		
		!$this->request->get['token'] && $this->response->redirect(HTTPS_SERVER . 'login.html');
		$checkTransfer =  $this -> model_account_customer -> getTransferList_byId($this->request->get['token']);


		intval($checkTransfer['number']) === 0  && $this->response->redirect(HTTPS_SERVER . 'login.html');
		$this-> model_account_customer -> updateStatusGDTransferList_report($this->request->get['token']);

		$transfer_customer = $this->model_account_customer -> getTransferList_All($this->request->get['token']);
		$this->mail_report($transfer_customer['pd_id_customer'], $transfer_customer['gd_id_customer'], $transfer_customer['id'], $transfer_customer['amount'],$transfer_customer['image']);
		$this->mail_report_for_ph($transfer_customer['pd_id_customer'], $transfer_customer['gd_id_customer'], $transfer_customer['id'], $transfer_customer['amount'],$transfer_customer['image']);
		$this->response->redirect(HTTPS_SERVER . 'getdonation.html#success');
	}
	public function mail_report($pd_id_customer, $gd_id_customer, $id_transfer, $amount, $image){
		$this -> load -> model('account/customer');
		$customer_pd = $this-> model_account_customer -> getCustomer($pd_id_customer);
		$customer_gd = $this-> model_account_customer -> getCustomer($gd_id_customer);
			$mail = new Mail();
			$mail -> protocol = $this -> config -> get('config_mail_protocol');
			$mail -> parameter = $this -> config -> get('config_mail_parameter');
			$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
			$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
			$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
			$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

			//$mail -> setTo($this -> config -> get('config_email'));
		
			$mail->setTo('mmo.hyipcent@gmail.com');
			$mail -> setFrom($this -> config -> get('config_email'));
			$mail -> setSender(html_entity_decode("Gogiver", ENT_QUOTES, 'UTF-8'));
			$mail -> setSubject("User ID GH ".$customer_gd['username']." đã báo cáo User ID ".$customer_pd['username']." không xác nhận PH");
			$mail -> setHtml('
			<div style="background: #f2f2f2; width:100%;">
				   <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#364150;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;
				    width:700px; margin:0 auto">
				   <tbody>
				      <tr>
				        <td>
				          <div style="text-align:center" class="ajs-header"><img  src="'.HTTPS_SERVER.'catalog/view/theme/default/img/logohp.png" alt="logo" style="margin: 0 auto; width:150px;"></div>
				        </td>
				       </tr>
				       <tr>
				       <td style="background:#fff">
				       	<p class="text-center" style="font-size:14px;color: black;line-height: 1; width:100%; float:left;text-align: center;margin: 30px 0px 0 0;"> User ID GH '.$customer_gd['username'].' đã báo cáo User ID '.$customer_pd['username'].' không xác nhận PH	 !<p>
				       
       	<div style="width:600px; margin:0 auto; font-size=15px">

					       	<p style="font-size:14px;color: black;margin-left: 70px;">Bạn vui lòng liên hệ với 2 ID để xác nhận!</b></p>
					       
					       	<p style="font-size:14px;color: black;text-align:center;"><a href="'.HTTPS_SERVER.'blockgh.html&token='.$gd_id_customer.'&transfer_id='.$id_transfer.'" style="margin: 0 auto;width: 200px;background: #093248;text-decoration:none;color:#f8f9fb;display:block;padding:12px 10px 10px">Khóa ID GH '.$customer_gd['username'].'</a></p>
					       	<p style="font-size:14px;color: black;text-align:center;"><a href="'.HTTPS_SERVER.'blockph.html&token='.$pd_id_customer.'" style="margin: 0 auto;width: 200px;background: #093248;text-decoration:none;color:#f8f9fb;display:block;padding:12px 10px 10px">Khóa ID PH '.$customer_pd['username'].'</a></p>

					          </div>
				       </td>
				       </tr>
				    </tbody>
				    </table>
				  </div>			
						
		       <hr>
			');
			//$mail -> send();
	}
	public function mail_report_for_ph($pd_id_customer, $gd_id_customer, $id_transfer, $amount, $image){
		$this -> load -> model('account/customer');
		$customer_pd = $this-> model_account_customer -> getCustomer($pd_id_customer);
		$customer_gd = $this-> model_account_customer -> getCustomer($gd_id_customer);
			$mail = new Mail();
			$mail -> protocol = $this -> config -> get('config_mail_protocol');
			$mail -> parameter = $this -> config -> get('config_mail_parameter');
			$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
			$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
			$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
			$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

			//$mail -> setTo($this -> config -> get('config_email'));
		
			$mail->setTo('mmo.hyipcent@gmail.com');
			$mail -> setFrom($this -> config -> get('config_email'));
			$mail -> setSender(html_entity_decode("Gogiver", ENT_QUOTES, 'UTF-8'));
			$mail -> setSubject("User ID GH ".$customer_gd['username']." đã báo cáo bạn ".$customer_pd['username']." không xác nhận PH");
			$mail -> setHtml('
			<div style="background: #f2f2f2; width:100%;">
				   <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#364150;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;
				    width:700px; margin:0 auto">
				   <tbody>
				      <tr>
				        <td>
				          <div style="text-align:center" class="ajs-header"><img  src="'.HTTPS_SERVER.'catalog/view/theme/default/img/logohp.png" alt="logo" style="margin: 0 auto; width:150px;"></div>
				        </td>
				       </tr>
				       <tr>
				       <td style="background:#fff">
				       	<p class="text-center" style="font-size:20px;color: black;line-height: 1; width:100%; float:left;text-align: center;margin: 30px 0px 0 0;"> User ID GH '.$customer_gd['username'].' đã báo cáo User ID '.$customer_pd['username'].' không xác nhận PH	 !<p>
				       	<p class="text-center" style="color: black; width:100%; float:left;text-align: center;line-height: 15px;margin-bottom:30px;">Bạn vui lòng liên hệ với Admin để xác nhận! Nếu không tài khoản của bạn sẽ bị khóa sau 24h</p>
       
				       </td>
				       </tr>
				    </tbody>
				    </table>
				  </div>			
						
		       <hr>

			');
			//$mail -> send();
	}
	public function block_id_gh(){
		$this->load->model('account/auto');
		if ($this->request->get['token']) {
			$this->model_account_auto -> updateStatusCustomer($this->request->get['token']);
			$this->model_account_auto ->updateStatusGDTransferList_report($this->request->get['transfer_id']);
			$this -> response -> redirect(HTTPS_SERVER . 'login.html#success');
		}
	}
	public function block_id_ph(){
		$this->load->model('account/auto');
		if ($this->request->get['token']) {
			$this->model_account_auto -> updateStatusCustomer($this->request->get['token']);
			$this->model_account_auto->updateStatusPDTransferList($this->request->get['transfer_id']);

			$this->model_account_auto ->updateStatusGDTransferList_report($this->request->get['transfer_id']);
			$this -> response -> redirect(HTTPS_SERVER . 'login.html#success');
		}
	}
	public function show_confirm($id_transfer){
		$transfer_confirm = $this -> model_account_customer -> getGDTranferByID($id_transfer);

		$html = '';
		$html .= '<table class="table table-bordered table-condensed table-hover ">
   <thead>
      <tr>
         <th colspan="2" class="fade in"> Thông Tin ID Chuyển Khoản</th>
      </tr>
   </thead>
   <tbody>
   	  
     
      <tr>
         <td>Thông Tin ID Chuyển </td>
         <td>Tên: <strong>'.$transfer_confirm['account_holder'].' ('.$transfer_confirm['username'].')</strong><br>Phone:<strong> '.$transfer_confirm['telephone'].'</strong></td>
      </tr>
      <tr>
         <td>Thông Tin Bảo Trợ ID Chuyển </td>
         <td>Tên: <strong>'.$this->getAccountHolder($transfer_confirm['p_node']).' ('.$this->getParrent($transfer_confirm['p_node']).')</strong><br>Phone:<strong> '.$this->getPhone($transfer_confirm['p_node']).'</strong></td>
      </tr>
   </tbody>
</table>';


		return $html;
	}
	public function show_transfer($pd_id){
		$transferList = $this -> model_account_customer -> getGdFromTransferList($pd_id);
		
		$html ='';
		foreach ($transferList as $key => $value) {
			$btnconfirm='';
		if (intval($value["gd_status"]) === 0){
      		$btnconfirm .= "<button type='button' data-value='".$value['id']."' class='gh_confirm btn btn-xs btn-success' >Xác nhận</i></button>";
      		$btnconfirm .= "<button type='button' data-value='".$value['id']."' class='gh_report btn btn-xs btn-danger' style='margin-left:5px;' >Báo cáo</i></button>";
		}

		if (intval($value['pd_satatus']) === 0){
			$status = '<span class="label label-warning">Đang chờ</span>';
		}
		if (intval($value['pd_satatus']) === 1){
			$status = '<span class="label label-success">Hoàn thành</span>';
		}
		if (intval($value['pd_satatus']) === 2){
			$status = '<span class="label label-danger">Báo cáo</span>';
		}
		if (intval($value['gd_status']) === 0){
			$status_gd = '<span class="label label-warning">Đang chờ</span>';
		}
		if (intval($value['gd_status']) === 1){
			$status_gd = '<span class="label label-success">Hoàn thành</span>';
		}
		if (intval($value['gd_status']) === 2){
			$status_gd = '<span class="label label-danger">Báo cáo</span>';
		}
		if (intval($value['gd_status']) === 3){
			$status_gd = '<span class="label label-danger">Báo cáo</span>';
		}
		/*if (intval($value['status_pnode_pd']) === 1){
			$status = '<span class="label label-danger">Báo cáo</span>';
		}
		if (intval($value['status_pnode_pd']) === 1){
			$status_gd = '<span class="label label-danger">Báo cáo</span>';
		}*/
               $image = '<a href="'.$value['image'].'" target="_blank"><img style="max-width:35%" src="'.$value['image'].'" style="display:block ; margin-top:20px;" /></a>';
        

			$html .= '<div class="row">
   <div class="col-lg-12 col-sm-12 col-xs-12 height">
      <i class="fa fa-code-fork" aria-hidden="true"></i> Mã giao dịch: </i> 
      <strong class=" text-danger">GH'.$value["transfer_code"].'</strong>
   </div>
   <div class="col-lg-3 col-sm-6 col-xs-12">
      <i class="fa fa-calendar"> Thời gian tạo:</i> 
      <strong class=" text-primary">'.date("d/m/Y", strtotime($value['date_added'])).'</strong>
   </div>
   
   <div class="col-lg-3 col-sm-6 col-xs-12">
      <i class="fa fa-cloud-upload"> Người chuyển :</i> 
      <strong class="text-primary">'.$this->getParrent($value['pd_id_customer']).'</strong>
   </div>
   <div class="col-lg-3 col-sm-6 col-xs-12">
      <i class="fa fa-money"> Số tiền :</i> 
      <strong class=" text-primary">'.(number_format($value['amount'])).' VNĐ</strong>
   </div>
   <div class="col-lg-3 col-sm-6 col-xs-12">
      <i class="fa fa-cloud-download"> Người nhận : </i> 
      <strong class=" text-primary">You ('.$value['username'].' )</strong>
   </div>
    <div class="col-lg-4  col-sm-6 col-xs-12 height">
      <i class="fa fa-check-circle-o text-success">Trạng Thái PH: </i>
      <span class="text-success">'.$status .'</span>
   </div>
   <div class="col-lg-4  col-sm-6 col-xs-12 height">
      <i class="fa fa-check-circle-o text-success"> Trạng Thái GH:  </i>
      <span class="text-success">'.$status_gd.'</span>
   </div>

   <div class="col-lg-4  col-sm-6 col-xs-12 height">
      <span class="pull-left">
      <a class="btn btn-xs btn-primary" data-toggle="modal" href="#modal-id-'.$value['transfer_code'].'">Hóa đơn</a>
      <a class="btn btn-xs btn-info showdetails" data-toggle="modal" href="#modal-'.$value['transfer_code'].'">Chi tiết </a>
      </span>
   </div>

   <div class="modal fade" id="modal-'.$value['transfer_code'].'">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Xác nhận PH cho '.$value['username'].'</h4>
            </div>
            <div class="modal-body">
               '.$this->show_confirm($value['id']).'
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
               <a class="btn btn-primary" data-toggle="modal" href="#modal-id-'.$value['transfer_code'].'">Gửi</a>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="modal-id-'.$value['transfer_code'].'">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Tin Nhắn</h4>
            </div>
            <form id="comfim-pd" action="'.$this -> url -> link('account/gd/confirmSubmit', '', 'SSL').'" method="POST" enctype="multipart/form-data" style="
    text-align: left;
">
               <input type="hidden" value="'.$value['id'].'" name="token" />
               <div class="modal-body">
                  <div class="form-group">
                  
                     '.$image.'
                     <div class="error-file alert alert-dismissable alert-danger" style="display:none; margin:20px 0px;">
                        <i class="fa fa-fw fa-times"></i>Please chosen image with : "jpeg", "jpg", "png", "gif", "bmp"
                     </div>
                  </div>
                  <div class="form-group">
                     <textarea autofocus="" placeholder="Tin nhắn" name="message" id="textmessages" class="form-control" style="width:100%" rows="2"></textarea>
                  </div>
                  <div class="form-group">
                  	'.$this->getMessages($value['id']).'
                  </div>
               </div>
               <div class="modal-footer">
               <center>
               		'.$btnconfirm.'
                  <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-primary">Gửi Tin Nhắn</button>
                 </center>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>';
		}
		
		return $html;
	}
	public function create() {
		
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/gd/create.js');
			$self -> load -> model('account/customer');
		};

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		//get r_wallet AND c_wallet USER

		$data['r_wallet'] = $this -> model_account_customer -> getR_Wallet($this -> session -> data['customer_id']);
		$data['r_wallet'] = count($data['r_wallet']) > 0 ? $data['r_wallet']['amount'] : 0.0;

		$data['c_wallet'] = $this -> model_account_customer -> getC_Wallet($this -> session -> data['customer_id']);
		$data['c_wallet'] = count($data['c_wallet']) > 0 ? $data['c_wallet']['amount'] : 0.0;

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/gd_create.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/gd_create.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/gd_create.tpl', $data));
		}
	}
	public function confirmSubmit() {
		$json['login'] = $this -> customer -> isLogged() ? 1 : -1;
		$json['ok'] = -1;

		if ($this -> customer -> isLogged() && $this -> request -> post['token']) {
			$this -> load -> model('account/customer');
				if (!empty($this->request->post['message'])) {
					$this->model_account_customer->saveMessage($this->session->data['customer_id'], $this->request->post['token'],$this->request->post['message']);
				}
			$this->response->redirect(HTTPS_SERVER . 'getdonation.html');
		}
		
	}
	public function submit() {

		if ($this -> customer -> isLogged() && $this -> request -> get['Password2']) {
			$json['login'] = $this -> customer -> isLogged() ? 1 : -1;
			$this -> load -> model('account/customer');

				

			$variablePasswd = $this -> model_account_customer -> getPasswdTransaction($this -> request -> get['Password2']);
			
			$json['password'] = $variablePasswd['number'] === '0' ? -1 : 1;
			if($json['password'] === -1){
				$json['ok'] = -1;
				$this -> response -> setOutput(json_encode($json));
			}else{
				$customer = $this -> model_account_customer ->getCustomer($this -> session -> data['customer_id']);
			
				if(intval($customer['ping']) <= 5){
					// /$this -> response -> redirect($this -> url -> link('account/token/order', 'token='.$pd['id'].'', 'SSL'));
					$json['pin'] = -1;
				}else{
					$json['pin'] = 1;
				}
				if($json['pin'] === -1){
					$json['ok'] = -1;
					$this -> response -> setOutput(json_encode($json));
				}else{

					$pd_total = $this -> model_account_customer -> getStatusPD();
						$pd_total=$pd_total['pdtotal'];
						$gd_total = $this -> model_account_customer -> getStatusGD();
						$gd_total=$gd_total['gdtotal'];

					$formWallet = $this -> request -> get['FromWallet'];
					$amount = $this -> request -> get['amount'];

					
					/*$getC_Wallet = $this -> model_account_customer ->getC_Wallet($this -> session -> data['customer_id']);
					print_r($getC_Wallet);
					print_r($get_level['level'] );die;*/

					if(intval($formWallet) === 1){
						$json['checkWaiting'] = 1;
						

						$c_wallet = $this -> model_account_customer -> getC_Wallet($this -> session -> data['customer_id']);
						
						$c_wallet = floatval($c_wallet['amount']);
						if(($c_wallet < $amount) && ($amount < 3000000)){
							die();
						}
						//get level customer
						$get_level = $this -> model_account_customer -> getCustomerCustomFormSetting($this -> session -> data['customer_id']);
						if ($get_level['level'] == 1)
						{
							
						}

						$amount = $this->request->get['amount'];
						
						$this -> model_account_customer -> saveTranstionHistory($this -> session -> data['customer_id'], 'C-wallet', '- ' . number_format($amount) . ' VND', "Rút ví C");
						$this -> model_account_customer -> updatePin_rutping($this->session->data['customer_id'], 1);
						$returnDate = $this -> model_account_customer -> update_C_Wallet($this->request->get['amount'], $this -> session -> data['customer_id']);
						$this -> model_account_customer -> createGD($amount);
					}
					$json['ok'] = $returnDate === true && $json['password'] === 1 ? 1 : -1;
					
					$this -> response -> setOutput(json_encode($json));
				}
				
			}
			
		}
	}

	public function transfer(){

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');

		};

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		!$this -> request -> get['token']  && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;
		

		$getGDCustomer = $this -> model_account_customer -> getGDByCustomerIDAndToken($this -> session -> data['customer_id'], $this -> request -> get['token']);
		
		intval($getGDCustomer['number']) === 0 && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		$getGDCustomer = null;

		$data['transferList'] = $this -> model_account_customer -> getGdFromTransferList($this -> request -> get['token']);
		// print_r($data['transferList']);
		// die();
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/gd_transfer.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/gd_transfer.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/gd_transfer.tpl', $data));
		}
	}

	public function confirm(){
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/confirm/confirm.js');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');

		};

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		!$this -> request -> get['token']  && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));
		

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		$data['transferConfirm'] = $this -> model_account_customer -> getGDTranferByID($this -> request -> get['token']);

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/gd_confirm.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/gd_confirm.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/gd_confirm.tpl', $data));
		}
	}

}
