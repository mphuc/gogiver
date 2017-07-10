<?php
class ControllerPdLock extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$data['selt'] = $this;
		$data['pin'] =  $this-> model_sale_customer->user_lock_repd();


		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 30;
		$start = ($page - 1) * 30;

		$ts_history = $this -> model_sale_customer -> get_lock_repd_finish();

		$ts_history = $ts_history['number'];

		$pagination = new Pagination();
		$pagination -> total = $ts_history;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text'; 
		$pagination -> url = $this -> url -> link('pd/lock', 'page={page}&token='.$this->session->data['token'].'', 'SSL');
		$data['pins'] =  $this-> model_sale_customer->get_lock_repd_finish_all($limit, $start);
		$data['pagination'] = $pagination -> render();


		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/lock.tpl', $data));
	}

	public function get_num_lock($customer_id)
	{
		$this->load->model('sale/customer');
		return $this-> model_sale_customer -> get_num_lock($customer_id);
		
	}
	/*public function big_upline($customer_id)
	{
		$this->load->language('sale/customer');
		$big_upline = $this -> model_sale_customer -> get_all_node($customer_id);

		$count = count($big_upline);
		
		if (($count-3) > 0)
		{
			$value = $big_upline[$count-3];
			$bigupline = $this -> model_sale_customer -> get_customer($value);

			return $bigupline['username'];
		}
		else
		{
			return "";
		}
		
	}*/

	public function get_all_child($customer_id)
	{
		$this->load->language('sale/customer');
		$getListIdChild = $this -> model_sale_customer -> getListIdChild($customer_id);
		return substr($getListIdChild,1);
	}

	public function get_user_customer($customer_id)
	{
		$this->load->language('sale/customer');
		$getListIdChild = $this -> model_sale_customer -> get_user_customer($customer_id);
		return $getListIdChild;
	}

	public function big_upline($customer_id)
	{
		$this->load->language('sale/customer');
		$big_upline = $this -> model_sale_customer -> get_all_node($customer_id);
		$middle_line = "";
		if (in_array(9, $big_upline))
		{
		  	$middle_line = "NUONGDO";
		}
		if (in_array(148, $big_upline))
		{
		  	$middle_line = "Rose";
		}
		if (in_array(1785, $big_upline))
		{
		  	$middle_line = "Manhnhanthinh";
		}
		if (in_array(34, $big_upline))
		{
		  	$middle_line = "nhiem63";
		}
		$json['middleline'] = $middle_line;
		$count = count($big_upline);
		
		if (($count-3) > 0)
		{
			$value = $big_upline[$count-3];
			$bigupline = $this -> model_sale_customer -> get_customer($value);

			$json['bigupline'] = $bigupline['username'];

			return $json;
		}
		else
		{
			$json['bigupline'] = "";
			return $json;
		}
		
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

	public function get_provine_16_04_date($customer_id,$start_date,$end_date)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_provine_16_04_date($customer_id,$start_date,$end_date);
	}



	public function exportlock(){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');
		require_once dirname(__FILE__) . '/PHPExcel.php';
		
		$this->load->language('sale/customer');
		$this->load->model('sale/customer');
		//update time show button

		/*$start_date = $this -> request -> get['start_date'];
		$end_date = $this -> request -> get['end_date'];
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));*/

		$results = $this -> model_sale_customer -> user_lock_repd();
		//print_r($results); die;



		!count($results) > 0 && die('no data!');

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Hoivien")
						 ->setLastModifiedBy("Hoivien")
						 ->setTitle("Office 2007 XLSX".$this->language->get('heading_title'))
						 ->setSubject("Office 2007 XLSX".$this->language->get('heading_title'))
						 ->setDescription($this->language->get('heading_title'))
						 ->setKeywords("office 2007 openxml php")
						 ->setCategory("Test result file");

		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', 'STT')
		->setCellValue('B1', 'Username')
		->setCellValue('C1', 'SĐT')
		->setCellValue('D1', 'Up line')
		->setCellValue('E1', 'Middle Upline')
		->setCellValue('F1', 'Big Upline')
		->setCellValue('G1', 'Date lock')
		->setCellValue('H1', 'Number lock')
		->setCellValue('I1', 'C Wallet')
		->setCellValue('J1', 'R Wallet')
		->setCellValue('K1', 'Reason');
		
		
         $objPHPExcel->getActiveSheet()->getStyle('A1:K1')
        ->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '0066FF')
                    )
                )
            );
            $styleArray = array(
                'font'  => array(
                    'bold'  => true,
                    'color' => array('rgb' => 'FFFFFF'),
                    'size'  => 12,
                    'name'  => 'Arial'
                ));
        $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(80);
		
		$h=0;
		$n = 2;
		$stt=0;
		$date_now = date('Y-m-d H:i:s');

		foreach ($results as $value) {
			
            $stt ++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$stt);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$value['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$value['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$value['upline']);

			$bigupline = $this -> big_upline($value['customer_id']);


			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$bigupline['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$bigupline['bigupline']);

			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".date('d/m/Y H:i:s',strtotime($value['date'])));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$this -> get_num_lock($value['customer_id']));
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$n," ".number_format($value['c_wallet'])." VND");
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n," ".number_format($value['r_wallet'])." VND");

			$objPHPExcel->getActiveSheet()->setCellValue('K'.$n," ".$value['description']);

			
			$n++;
			
			//print_r($objPHPExcel);die;
		}
		

		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'K'.$n)
		->applyFromArray(
			array('font'  => array(
				'bold'  => true,
				'size'  => 12,
				'name'  => 'Arial'
			))
		);
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle($this->language->get('heading_title'));


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="LIST_ALL_CUSTOMER_'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
}