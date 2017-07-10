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

			/*$this -> model_sale_customer -> saveHistoryPin(
				$customer_id,
				'- 1',
				$createPD['pd_number'],
				'PD',
				$createPD['pd_number'],
				$createPD['date_added']
			);*/

			$date_added = date('Y-m-d',strtotime($date))." ".$this -> randomDate();;
			$randdate = rand(1,5);
			$date_finish = strtotime ( '- '.$randdate.' day' , strtotime ($date_added));
			$date_finish= date('Y-m-d H:i:s',$date_finish) ;

			/*$this -> model_sale_customer -> saveHistoryPin(
				$customer_id,
				'+ 1', 
				'hidden description', 
				'Transfer', 
				$send_pin,
				$date_finish
			);*/

			//update xoa lock
			$this -> model_sale_customer -> delete_lock_customer($customer_id);

			// update c_wallet
			$this -> model_sale_customer -> update_C_Wallet(0,$customer_id);

			// update r_wallet
			$this -> model_sale_customer -> update_R_Wallet(0,$customer_id);

			// update status
			$this -> model_sale_customer -> update_status(1,$customer_id);
			
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
	public function downline_all()
	{
		$this->load->model('sale/customer');
		$username = $this -> request -> get['username'];
		$customer_id = $this -> model_sale_customer -> getusername_customer($username);

		$maao = $customer_id;
		$maao .= $this -> model_sale_customer -> get_childrend_all_tree($customer_id);

		$results = explode(",", $maao);

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');
		require_once dirname(__FILE__) . '/PHPExcel.php';
		
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
		->setCellValue('D1', 'Account Holder')
		->setCellValue('E1', 'Status')
		->setCellValue('F1', 'Upline')
		->setCellValue('G1', 'GD Finish')
		->setCellValue('H1', 'GD Watting')
		->setCellValue('I1', 'PD Finish')
		->setCellValue('J1', 'PD Watting')
		->setCellValue('K1', 'Mid Upline')
		->setCellValue('L1', 'Big Upline')
		;
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(185);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(115);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(185);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(155);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(26);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $val) {
			$i++;
			$customer = $this -> model_sale_customer -> getCustomerss($val);
			
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n,"".$customer['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$customer['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n,$customer['account_holder']);

			$status = "Đang hoạt động";
			if ($customer['status'] == 8)
			{
				$status = "Khóa";
			}
			if ($customer['status'] == 10)
			{
				$status = "Xóa tài khoản";
			}


			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n,$status);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$customer['upline']);
			
			$get_gd_fn = $this -> model_sale_customer -> get_gd_customer_id($val,2);
			$gd_fn = "";
			foreach ($get_gd_fn as $value) {
				$gd_fn .= number_format($value['amount'])." - ".date('d/m/Y H:i',strtotime($value['date_added']))."        ";
			}

			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n,$gd_fn);

			$get_gd_wt = $this -> model_sale_customer -> get_gd_customer_id($val,1);
			$get_wt = "";
			foreach ($get_gd_wt as $value) {
				$get_wt .= number_format($value['amount'])." - ".date('d/m/Y H:i',strtotime($value['date_added']))."        ";
			}

			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n,$get_wt);

			$get_pd_fn = $this -> model_sale_customer -> get_pd_customer_id($val,2);
			$pd_fn = "";
			foreach ($get_pd_fn as $value) {
				$pd_fn .= number_format($value['filled'])." - ".date('d/m/Y H:i',strtotime($value['date_added']))."        ";
			}

			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n,$pd_fn);

			$get_pd_wt = $this -> model_sale_customer -> get_pd_customer_id($val,1);
			$get_pwt = "";
			foreach ($get_pd_wt as $value) {
				$get_pwt .= number_format($value['filled'])." - ".date('d/m/Y H:i',strtotime($value['date_added']))."        ";
			}

			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n,$get_pwt);

			$big_upline = $this -> big_upline($val);

			$objPHPExcel->getActiveSheet()->setCellValue('K'.$n,$big_upline['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$n,$big_upline['bigupline']);

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
		header('Content-Disposition: attachment;filename="'.$username.'_downline_'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

		foreach ($customer as $value) {
			
		}

	}
}