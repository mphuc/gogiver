<?php
class ControllerPdUser45 extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$data['selt'] = $this;
		$data['pin'] =  $this-> model_sale_customer->get_user_after45();

		$data['count_all_customer'] = $this-> model_sale_customer->count_all_customer();
		
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/user45.tpl', $data));
	}

	public function get_account_pin($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_account_pin45($customer_id);
	}

	public function get_level($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_level($customer_id);
	}

	public function get_provine_16_04($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_provine_16_04($customer_id);
	}
}