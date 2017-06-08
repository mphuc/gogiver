<?php
class ControllerPdCreatepd extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$data['self'] = $this;

		$data['getaccount'] = $this->url->link('pd/ph/getaccount&token='.$this->session->data['token'], '', 'SSL');
		$data['show_gh_username'] = $this -> url -> link('pd/create_pd/show_gh_username&token='.$this->session->data['token']);
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/createpd.tpl', $data));
	}

	public function show_gh_username()
	{

		$username = $this -> request ->post['username'];
		$this->load->model('sale/customer');
		$load_pin_date = $this -> model_sale_customer -> get_customer_by_username($username);
		print_r($load_pin_date['customer_id']); die;
		
	}

	public function submit()
	{
		if ($this -> request -> post)
		{
			print_r($this -> request -> post);
			$customer_id = $this -> request -> post['customer_id'];
			$date = $this -> request -> post['date'];
			$send_pin = $this -> request -> post['send_pin'];
			$this->load->model('sale/customer');
			$createPD = $this -> model_sale_customer -> createPD($customer_id,$date);

			$this -> model_sale_customer -> saveHistoryPin(
				$customer_id,
				'- 1',
				$createPD['pd_number'],
				'PD',
				$createPD['pd_number'],
				$createPD['date_added']
			);

			$date_added = date('Y-m-d',strtotime($date))." ".$this -> randomDate();;
			$randdate = rand(1,5);
			$date_finish = strtotime ( '- '.$randdate.' day' , strtotime ($date_added));
			$date_finish= date('Y-m-d H:i:s',$date_finish) ;

			$this -> model_sale_customer -> saveHistoryPin(
				$customer_id,
				'+ 1', 
				'hidden description', 
				'Transfer', 
				$send_pin,
				$date_finish
			);
			$this -> session -> data['date_create_pd'] = $this -> request -> post['date'];
			$this -> session -> data['send_pin_pd'] = $this -> request -> post['send_pin'];
			$this -> session -> data['date_sussess'] = 1;
			$this->response->redirect($this->url->link('pd/create_pd', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	}

	public function randomDate()
	{
	    $date_added= date('Y-m-d H:i:s');

		$date_finish = strtotime ( '+ 30 day' , strtotime ($date_added));
		$date_finish= date('Y-m-d H:i:s',$date_finish) ;

	    $min = strtotime($date_added);
	    $max = strtotime($date_finish);

	    // Generate random number using above bounds
	    $val = rand($min, $max);

	    // Convert back to desired date format
	    return date('H:i:s', $val);
	}
}