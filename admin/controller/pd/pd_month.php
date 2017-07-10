<?php
class Controllerpdpdmonth extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$maao = $this -> model_sale_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);
		$data['pin'] =  $this-> model_sale_customer->get_all_pd_month($maao);

		$data['pd_user_all'] = $this-> model_sale_customer->pd_user_all($maao);

		$data['pd_user_all_node'] = $this-> model_sale_customer->pd_user_all_node($maao);
		

		$data['load_pin_date'] = $this -> url -> link('pd/matched/load_pin_date&token='.$this->session->data['token']);
		$data['show_gh_username'] = $this -> url -> link('pd/gh/show_gh_username&token='.$this->session->data['token']);
		$data['export'] = $this -> url -> link('pd/gh/export&token='.$this->session->data['token']);

		$data['exports'] = $this -> url -> link('pd/pd_month/export_tab2&token='.$this->session->data['token']);

		$data['seft'] = $this;
		
		$data['getaccount'] = $this->url->link('pd/gh/getaccount&token='.$this->session->data['token'], '', 'SSL');
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/pd_month.tpl', $data));
	}

	public function get_date_add_customer($customer_id)
	{
		$this->load->model('sale/customer');
		$customer =  $this -> model_sale_customer -> getcustomer_id($customer_id);

		$date_added= $customer['date_added'];
		$date_finish = strtotime ( '+ 7 day' , strtotime ($date_added));
		$date_finish= date('Y-m-d H:i:s',$date_finish) ;
		return $date_finish;
	}

	public function subdate($date_lock)
	{
		$now = date('Y-m-d H:i:s');
		$first_date = strtotime($now);
		$second_date = strtotime($date_lock);
		$datediff = abs($first_date - $second_date);
		return floor($datediff / (60*60*24));
	}

	public function export_tab2(){
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
		$maao = $this -> model_sale_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);

		$num_date = intval($_GET['num_day']);
		//echo $num_date; die;

		$results = $this -> model_sale_customer -> pd_user_all($maao);
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
		->setCellValue('E1', 'Middle line')
		->setCellValue('F1', 'Big Upline')
		->setCellValue('G1', 'Number PD')
		->setCellValue('H1', 'Max PD')
		->setCellValue('I1', 'Date PD not match')	
		->setCellValue('J1', 'Date Lock');		
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			if (intval($this -> subdate($customer['date_block'])) <= $num_date)
			{
			$get_level = $this -> get_level($customer['customer_id']);
			switch ($get_level['level']) {
              case 1:
                $num_pd = 3;
                break;
              case 2:
                $num_pd = 4;
                break;
              case 3:
                $num_pd = 7;
                break;
              case 4:
                $num_pd = 9;
                break;
              case 5:
                $num_pd = 1;
                break;
              case 6:
                $num_pd = 13;
                break;
            }
            if ($customer['total_pd'] < $num_pd) {
                       
				$i++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$customer['telephone']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['upline']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$this -> big_upline($customer['customer_id'])['middleline']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$this -> big_upline($customer['customer_id'])['bigupline']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".$customer['total_pd']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$num_pd);

				$get_pd_not_macth = $this -> get_pd_not_macth($customer['customer_id']);
				$mang = "";
                foreach ($get_pd_not_macth as $value_pd) {
                	$mang .= date('d/m/Y H:i:s',strtotime($value_pd['date_added']))." ,";
                }

				$objPHPExcel->getActiveSheet()->setCellValue('I'.$n," ".$mang);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$n, " ".date('d/m/Y H:i',strtotime($customer['date_block'])));
				$n++;
			}
		}
	}
		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'I'.$n)
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


	public function export_tab3(){
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
		$maao = $this -> model_sale_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);

		$results = $this -> model_sale_customer -> pd_user_all_node($maao);
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
		->setCellValue('E1', 'Middle line')
		->setCellValue('F1', 'Big Upline')
		->setCellValue('G1', 'Number PD')
		->setCellValue('H1', 'Max PD')
		->setCellValue('I1', 'Date Lock');		
         $objPHPExcel->getActiveSheet()->getStyle('A1:I1')
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {

			$get_level = $this -> get_level($customer['customer_id']);
			switch ($get_level['level']) {
              case 1:
                $num_pd = 3;
                break;
              case 2:
                $num_pd = 4;
                break;
              case 3:
                $num_pd = 7;
                break;
              case 4:
                $num_pd = 9;
                break;
              case 5:
                $num_pd = 1;
                break;
              case 6:
                $num_pd = 13;
                break;
            }
            if ($customer['total_pd'] < $num_pd) {
                       
				$i++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$customer['telephone']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['upline']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$this -> big_upline($customer['customer_id'])['middleline']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$this -> big_upline($customer['customer_id'])['bigupline']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".$customer['total_pd']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$num_pd);

				$objPHPExcel->getActiveSheet()->setCellValue('I'.$n, " ".$this->get_date_add_customer($customer['customer_id']));
				$n++;
			}
		}

		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'I'.$n)
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

	public function export_tab1(){
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
		$maao = $this -> model_sale_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_sale_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);

		$results = $this -> model_sale_customer -> get_all_pd_month($maao);
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
		->setCellValue('E1', 'Middle line')
		->setCellValue('F1', 'Big Upline')
		->setCellValue('G1', 'Number PD')
		->setCellValue('H1', 'Max PD')
		->setCellValue('I1', 'Date PD not match')	
		->setCellValue('J1', 'Date Lock');		
         $objPHPExcel->getActiveSheet()->getStyle('A1:I1')
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {

			$get_level = $this -> get_level($customer['customer_id']);
			switch ($get_level['level']) {
              case 1:
                $num_pd = 3;
                break;
              case 2:
                $num_pd = 4;
                break;
              case 3:
                $num_pd = 7;
                break;
              case 4:
                $num_pd = 9;
                break;
              case 5:
                $num_pd = 1;
                break;
              case 6:
                $num_pd = 13;
                break;
            }
            if ($customer['total_pd'] < $num_pd) {
                       
				$i++;
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$customer['telephone']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['upline']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$this -> big_upline($customer['customer_id'])['middleline']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$this -> big_upline($customer['customer_id'])['bigupline']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".$customer['total_pd']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$num_pd);

				$get_pd_not_macth = $this -> get_pd_not_macth($customer['customer_id']);
				$mang = "";
                foreach ($get_pd_not_macth as $value_pd) {
                	$mang .= date('d/m/Y H:i:s',strtotime($value_pd['date_added']))." ,";
                }

				$objPHPExcel->getActiveSheet()->setCellValue('I'.$n," ".$mang);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$n, " ".date('d/m/Y H:i',strtotime($customer['date_block'])));
				$n++;
			}
		}

		$objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'I'.$n)
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

	public function get_level($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_level($customer_id);
	}


	public function get_pd_not_macth($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_pd_not_macth($customer_id);
	}

	public function getaccount() {
		if ($this -> request -> post['keyword']) {
			$this->load->model('sale/customer');
			$tree = $this -> model_sale_customer -> getCustomLikes($this -> request -> post['keyword']);
			
			if (count($tree) > 0) {
				foreach ($tree as $value) {
					 echo '<li class="list-group-item" onClick="selectU(' . "'" . $value['name']  . "'" . ');">' . $value['name']."-".$value['account_holder'] . '</li>';
				}
			}
		}
	}

	public function show_gh_username()
	{
		$username = $this -> request ->post['username'];
		echo $username;die;
		$this->load->model('sale/customer');
		$load_pin_date = $this -> model_sale_customer -> show_matchings_username($username);
		$stt = 0;
		if (count($load_pin_date) > 0)
		{


			foreach ($load_pin_date as $value) { $stt++;?>
		?>
			<tr>
		        <td><?php echo $stt; ?></td>
				<td><?php echo $value['username'] ?></td>
				<td><?php echo $value['account_holder'] ?></td>
		        <td><?php echo number_format($value['filled']) ?> VNĐ</td>
		        <td><?php 
		         if ($value['status'] == 0) {
                        echo "<span class='label label-default'>Đang chờ</span>";
                    }
                    if ($value['status'] == 1) {
                        echo "<span class='label label-info'>Khớp lệnh</span>";
                    }
                    if ($value['status'] == 2) {
                        echo "<span class='label label-success'>Hoàn thành</span>";
                    }
                    if ($value['status'] == 3) {
                        echo "<span class='label label-danger'>Báo cáo</span>";
                    }
		         ?></td>
		       
				<td><?php echo date('d/m/Y H:i',strtotime($value['date_added'])) ?></td>
				<td><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo $value['date_finish']; ?>">
                     </span> </td>
			</tr>
	        <script type="text/javascript" src="view/javascript/pd/countdown.js"></script>
		<?php 
			}
		}
	
		else
		{
		?>
		<tr><td colspan="6" class="text-center">Không có dữ liệu</td> </tr>
		<?php
		}
	}

	public function load_pin_date()
	{
		$date = date('Y-m-d',strtotime($this -> request ->post['date']));
		$this->load->model('sale/customer');
		$load_pin_date = $this -> model_sale_customer -> show_matchings_username($date);
		$stt = 0;
		if (count($load_pin_date) > 0)
		{


			foreach ($load_pin_date as $value) { $stt++;?>
		?>
			<tr>
                    <td><?php echo $stt; ?></td>
                    
                    <td><?php echo $value['pd_username'] ?></td>
                    <td><?php echo $value['gd_username'] ?></td>
                    <td><?php echo number_format($value['amount']) ?> VNĐ</td>
                    <td><?php 

                    if ($value['pd_satatus'] == 0) {
                        echo "<span class='label label-default'>Watting</span>";
                    }
                    if ($value['pd_satatus'] == 1) { ?>
                       <span style="cursor: pointer;" class='label label-success' data-toggle="modal" data-target="#myModalPD<?php echo $value['transfer_code'] ?>" >Finish</span> 
                    <?php } 
                    if ($value['pd_satatus'] == 2) {
                        echo "<span class='label label-danger'>Report</span>";
                    }
                    ?> </td>
                    
                    <td><?php 

                    if ($value['gd_status'] == 0) {
                        echo "<span class='label label-default'>Watting</span>";
                    }
                   
                    if ($value['gd_status'] == 1) {
                        echo "<span class='label label-success' >Finish</span>";
                    } 
                    if ($value['gd_status'] == 2) {?> 
                        <span style="cursor: pointer;" class='label label-danger' data-toggle="modal" data-target="#myModalGD<?php echo $value['transfer_code'] ?>" >Report</span> 
                   <?php }
                    ?> </td>
                   
                    <td><?php echo date('d/m/Y H:i',strtotime($value['date_added'])) ?></td>
                    
                </tr>  
              
               <div class="modal fade" id="myModalPD<?php echo $value['transfer_code'] ?>" role="dialog">
                  <div class="modal-dialog">
                  
                   
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="myModalLabelSTAR2017040554482">PD Finish <?php echo $value['pd_username'] ?> | <?php echo number_format($value['amount']) ?> VNĐ</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row-fluid">
                            <img style="width: 100%" src="<?php echo $value['image'];?>">
                           
                        </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     
                    </div>
                    
                  </div>

              
               <div class="modal fade" id="myModalGD<?php echo $value['transfer_code'] ?>" role="dialog">
                  <div class="modal-dialog">
                  
                   
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="">GD Report <?php echo $value['gd_username'] ?> | <?php echo number_format($value['amount']) ?> VNĐ</h4>
                      </div>
                      <div class="modal-body">

                        <div class="row-fluid">
                            <p style="margin-bottom: 20px;">
                            
                            <?php echo ($value['text_report'] == "no_money") ? "Lý do: tôi chưa nhận được tiền" : "Lý do: ".$value['text_report']; ?>
                            </p>
                            <img style="width: 100%" src="<?php echo $value['image'];?>">
                           
                        </div>
                        </div>
                      </div>
                      <div class="clearfix"></div>
                     
                    </div>
                    
                  </div>

	               
		<?php 
			}
		}
	
		else
		{
		?>
		<tr><td colspan="6" class="text-center">Không có dữ liệu</td> </tr>
		<?php
		}
	}

	public function get_popup()
	{
		$date = date('Y-m-d',strtotime($this -> request ->post['date']));
		$this->load->model('sale/customer');
		$load_pin_date = $this -> model_sale_customer -> show_matchings_username($date);
		$stt = 0;
		
		foreach ($load_pin_date as $value) { $stt++;?>
		?>
       <div class="modal fade" id="myModalPD<?php echo $value['transfer_code'] ?>" role="dialog">
          <div class="modal-dialog">
          
           
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="myModalLabelSTAR2017040554482">PD Finish <?php echo $value['pd_username'] ?> | <?php echo number_format($value['amount']) ?> VNĐ</h4>
              </div>
              <div class="modal-body">
                <div class="row-fluid">
                    <img style="width: 100%" src="<?php echo $value['image'];?>">
                   
                </div>
                </div>
              </div>
              <div class="clearfix"></div>
             
            </div>
            
          </div>

      
       <div class="modal fade" id="myModalGD<?php echo $value['transfer_code'] ?>" role="dialog">
          <div class="modal-dialog">
          
           
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="">GD Report <?php echo $value['gd_username'] ?> | <?php echo number_format($value['amount']) ?> VNĐ</h4>
              </div>
              <div class="modal-body">

                <div class="row-fluid">
                    <p style="margin-bottom: 20px;">
                    
                    <?php echo ($value['text_report'] == "no_money") ? "Lý do: tôi chưa nhận được tiền" : "Lý do: ".$value['text_report']; ?>
                    </p>
                    <img style="width: 100%" src="<?php echo $value['image'];?>">
                   
                </div>
                </div>
              </div>
              <div class="clearfix"></div>
             
            </div>
            
          </div>
	               
		<?php 
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
		$start_date = $this -> request -> get['start_date'];
		$end_date = $this -> request -> get['end_date'];
		$start_date = date('Y-m-d', strtotime($start_date));
		$end_date = date('Y-m-d', strtotime($end_date));
		$this->load->language('sale/customer');
		$this->load->model('sale/customer');
		//update time show button
		$results = $this -> model_sale_customer -> getall_gd_date($start_date,$end_date);
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
		->setCellValue('C1', 'Name bank account')
		->setCellValue('D1', 'Account number')
		->setCellValue('E1', 'Telephone')
		->setCellValue('F1', 'Status')
		->setCellValue('G1', 'Amount')
		->setCellValue('H1', 'Date Add');
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n,$customer['account_holder']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['account_number']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$customer['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n,number_format($customer['amount']));
			if ($customer['status'] == 0) $status = "Watting";
			if ($customer['status'] == 1) $status = "Matched";
			if ($customer['status'] == 2) $status = "Finish";
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n,$status);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n, " ".date('d/m/Y H:i',strtotime($customer['date_added'])));
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
		header('Content-Disposition: attachment;filename="LISH_GH'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

	public function export_mail(){
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
		$results = $this -> model_sale_customer -> getall_gd_date_mail(date('Y-m-d'));
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
		->setCellValue('C1', 'Name bank account')
		->setCellValue('D1', 'Account number')
		->setCellValue('E1', 'Telephone')
		->setCellValue('F1', 'Status')
		->setCellValue('G1', 'Amount')
		->setCellValue('H1', 'Date Add');
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n,$customer['account_holder']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['account_number']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$customer['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n,number_format($customer['amount']));
			if ($customer['status'] == 0) $status = "Watting";
			if ($customer['status'] == 1) $status = "Matched";
			if ($customer['status'] == 2) $status = "Finish";
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n,$status);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n, " ".date('d/m/Y H:i',strtotime($customer['date_added'])));
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
		

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('../system/kfjsdkfkjkakgvqbkhkaakjsdksadkas.xls');
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = 'mmocoimax@gmail.com';
		$mail->smtp_hostname = 'ssl://smtp.gmail.com';
		$mail->smtp_username = 'mmocoimax@gmail.com';
		$mail->smtp_password = 'ibzfqpduhwajikwx';
		$mail->smtp_port = '465';
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		
		$mail->setTo('trungdoanict@gmail.com');
		$mail->addAttachment('../system/kfjsdkfkjkakgvqbkhkaakjsdksadkas.xls');
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject('Pin '.date('d/m/Y H:i:s').'');
		$mail->setText(date('d/m/Y H:i:s'));
		$mail->send();
	}
}