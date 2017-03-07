<?php
class Controllerpdsendmailcustomer extends Controller {
	public function index() {

		$this->document->setTitle('Send mail');
		$this->load->model('sale/customer');
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/sendmail_customer.tpl', $data));
	}

	public function submit(){
		if ($this-> request -> post){
			
			$this -> load -> model('pd/pd');
			$this -> model_pd_pd -> sendmail_admin($this-> request -> post);
			$this -> response -> redirect($this -> url -> link('pd/sendmail_customer&token='.$_GET['token'].'#suscces'));
		}
	}

}