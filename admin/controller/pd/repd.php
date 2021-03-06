<?php
class ControllerPdRepd extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$data['seft'] = $this;

		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 50;
		$start = ($page - 1) * 50;

		$ts_history = $this -> model_sale_customer -> get_count_repd();

		$ts_history = $ts_history['number'];

		$pagination = new Pagination();
		$pagination -> total = $ts_history;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text'; 
		$pagination -> url = $this -> url -> link('pd/repd', 'page={page}&token='.$this->session->data['token'].'', 'SSL');

		$data['pagination'] = $pagination -> render();

		$data['pin'] =  $this-> model_sale_customer->get_all_repd_date_rp($limit, $start);

		
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/repd.tpl', $data));
	}


	public function lock_repd()
	{
		$this->load->model('sale/customer');
		$this -> model_sale_customer -> update_check_gd($this -> request -> get['id']);
		$this->response->redirect($this->url->link('pd/repd', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

	public function export(){
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
		$results = $this -> model_sale_customer -> get_all_repd_date_rp_all();
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
		->setCellValue('C1', 'Telephone')
		->setCellValue('D1', 'Upline')
		->setCellValue('E1', 'Middle Upline')
		->setCellValue('F1', 'Big Upline')
		->setCellValue('G1', 'GD')
		->setCellValue('H1', 'Date End Re PD');
         $objPHPExcel->getActiveSheet()->getStyle('A1:H1')
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			//print_r($customer); die;
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n,$customer['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['upline']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$this -> big_upline($customer['customer_id'])['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$this -> big_upline($customer['customer_id'])['bigupline']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," GD#".($customer['gd_number']));
			
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n, " ".date('d/m/Y H:i',strtotime($customer['date_finish'])));
			$n++;
			}
		

		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'H'.$n)
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
		header('Content-Disposition: attachment;filename="LISH_REPD'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

		$start_date = $this -> request -> get['start_date'];
		$end_date = $this -> request -> get['end_date'];
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));

		$results = $this -> model_sale_customer -> getCustomers_forzenss($start_date,$end_date);
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
		->setCellValue('C1', 'Date Create')
		->setCellValue('D1', 'Date Lock')
		->setCellValue('E1', 'Telephone')
		->setCellValue('F1', 'Upline')
		->setCellValue('G1', 'Middle Upline')
		->setCellValue('H1', 'Big Upline')
		->setCellValue('I1', 'Số lần đã GD')
		->setCellValue('J1', 'Số tiền đã GD')
		->setCellValue('K1', 'Lý do');
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(60);
		
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			//print_r($customer); die;
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);

			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".date('d/m/Y H:i:s', strtotime($customer['date_added'])));
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".date('d/m/Y H:i:s', strtotime($customer['date_off'])));

			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$customer['telephone']);

			if (count($this->get_pnode($customer['p_node'])) > 0)
            {
              $upline =  $this->get_pnode($customer['p_node'])['username']; 
            }
            else
            {
            	$upline = "";
            }

			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$upline);

			if ($customer['status'] <> 10)
            {
              $big_upline =  $this -> big_uplines($customer['customer_id']);
            }
            else
            {
            	$big_upline = "";
            }
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".$big_upline['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$big_upline['bigupline']);
			$get_gd_customer =($this -> get_gd_customer($customer['customer_id'])); 
                      

			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n," ".$get_gd_customer['total']);
			
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n, " ".number_format($get_gd_customer['sum']));
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$n, " ".($customer['wallet']));
			$n++;
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
		header('Content-Disposition: attachment;filename="LISH_CUSTOMER_LOCK'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

	public function exportlock10(){
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

		$start_date = $this -> request -> get['start_date'];
		$end_date = $this -> request -> get['end_date'];
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));

		$results = $this -> model_sale_customer -> getCustomers_forzen_ss($start_date,$end_date);
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
		->setCellValue('C1', 'Date Create')
		->setCellValue('D1', 'Date Lock')
		->setCellValue('E1', 'Telephone')
		->setCellValue('F1', 'Upline')
		->setCellValue('G1', 'Middle Upline')
		->setCellValue('H1', 'Big Upline')
		->setCellValue('I1', 'Số lần đã GD')
		->setCellValue('J1', 'Số tiền đã GD');
         $objPHPExcel->getActiveSheet()->getStyle('A1:J1')
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			//print_r($customer); die;
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);

			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".date('d/m/Y H:i:s', strtotime($customer['date_added'])));
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".date('d/m/Y H:i:s', strtotime($customer['date_off'])));

			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$customer['telephone']);

			if (count($this->get_pnode($customer['p_node'])) > 0)
            {
              $upline =  $this->get_pnode($customer['p_node'])['username']; 
            }
            else
            {
            	$upline = "";
            }

			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$upline);

			
              $big_upline =  $this -> big_uplines($customer['customer_id']);
            
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".$big_upline['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$big_upline['bigupline']);
			$get_gd_customer =($this -> get_gd_customer($customer['customer_id'])); 
                      

			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n," ".$get_gd_customer['total']);
			
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n, " ".number_format($get_gd_customer['sum']));
			$n++;
			}
		

		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'J'.$n)
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
		header('Content-Disposition: attachment;filename="LISH_CUSTOMER_LOCK'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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
	public function get_pnode($customer_id){
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_customer($customer_id);
	}
	public function big_uplines($customer_id)
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

	public function get_gd_customer($customer_id)
	{
		$this->load->language('sale/customer');
		return $this -> model_sale_customer -> get_gd_customer($customer_id);
	}
}