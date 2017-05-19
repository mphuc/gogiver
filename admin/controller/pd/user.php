<?php
class ControllerPdUser extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$data['seft'] = $this;
		
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 10;
		$start = ($page - 1) * 10;

		$ts_history = $this -> model_sale_customer -> get_count_customer_holder();

		$ts_history = $ts_history['number'];

		$pagination = new Pagination();
		$pagination -> total = $ts_history;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text'; 
		$pagination -> url = $this -> url -> link('pd/user', 'page={page}&token='.$this->session->data['token'].'', 'SSL');

		$data['pagination'] = $pagination -> render();



		$data['pin'] =  $this-> model_sale_customer->get_all_customer_holder($limit, $start);
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/user.tpl', $data));
	}

	public function get_account_hoder($customer_id,$account_holder)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_customer_holder($customer_id,$account_holder);
	}

}