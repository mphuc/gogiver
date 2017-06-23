<?php
class ControllerPdUser45 extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		
		$data['selt'] = $this;
		$data['seft'] = $this;

		$data['pin'] =  $this-> model_sale_customer->get_user_after45();

		$data['count_all_customer'] = $this-> model_sale_customer->count_all_customer();
		
		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/user45.tpl', $data));
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

	public function get_gd_customer($customer_id)
	{
		$this->load->language('sale/customer');
		return $this -> model_sale_customer -> get_gd_customer($customer_id);
	}

	public function get_gd_customers($customer_id)
	{
		$this->load->language('sale/customer');
		return $this -> model_sale_customer -> get_gd_customers($customer_id);
	}

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

	public function getPD_last($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> getPD_last($customer_id);
	}

	public function exportafter_all(){
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
		//$results = $this -> model_sale_customer -> get_user_after45();
		//print_r($results); die;
		//!count($results) > 0 && die('no data!');

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
		->setCellValue('G1', 'Trạng thái');
		
         $objPHPExcel->getActiveSheet()->getStyle('A1:G1')
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		
		$array = array(3,4,5,7,485,1319);
		$h=0;
		$n = 2;
		$stt=0;
		$date_now = date('Y-m-d H:i:s');
		foreach ($array as  $item) {

			$user = $this -> get_all_child($item);
            $user = explode(",",$user);
            $iii = 0;
            foreach ($user as $values) {
	            $iii++; 
	            $value = $this -> get_user_customer($values);
	            $objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$iii);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$value['username']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$value['telephone']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$value['upline']);

				$big_upline = $this -> big_upline($value['customer_id']);

				$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$big_upline['middleline']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$big_upline['bigupline']);
				if ($value['status'] == 1 || $value['status'] == 2) $status =  "Hoạt động";
                if ($value['status'] == 8)
                {
                    $status = "Bị khóa";
                }
                if ($value['status'] == 10)
                {
                    $status = "Đã xóa";
                }
                $objPHPExcel->getActiveSheet()->setCellValue('G'.$n,$status);
	            $n++;
	        }
	        $n++;
	        $objPHPExcel->getActiveSheet()->setCellValue('A'.$n,"");
	        $objPHPExcel->getActiveSheet()->setCellValue('B'.$n,"");
	        $objPHPExcel->getActiveSheet()->setCellValue('C'.$n,"");
	        $objPHPExcel->getActiveSheet()->setCellValue('D'.$n,"");
	        $objPHPExcel->getActiveSheet()->setCellValue('E'.$n,"");
	        $objPHPExcel->getActiveSheet()->setCellValue('F'.$n,"");
	        $objPHPExcel->getActiveSheet()->setCellValue('G'.$n,"");
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
		header('Content-Disposition: attachment;filename="TRANG_THAI_USER'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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


	public function exportafter45(){
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
		$results = $this -> model_sale_customer -> get_user_after45();
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
		->setCellValue('G1', 'Số F1 kích pin')
		->setCellValue('H1', 'Thời gian bắt đầu kích pin')
		->setCellValue('I1', 'Số ngày chưa tạo ra F1')
		->setCellValue('J1', 'Số lần đã GD')
		->setCellValue('K1', 'GD đang chờ')
		->setCellValue('L1', 'GD kết thúc')
		->setCellValue('M1', 'PD lâu nhất chưa khớp');
		
         $objPHPExcel->getActiveSheet()->getStyle('A1:M1')
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
        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
		$h=0;
		$n = 2;
		$stt=0;
		$date_now = date('Y-m-d H:i:s');
		foreach ($results as $value) {
			$get_account_pin = $this -> get_account_pin($value['customer_id']);
            $day = strtotime($date_now) - strtotime($value['date_added']);
            $day = floor($day/86400);
            if ($day >= 45 && count($get_account_pin) == 0) {
                $stt ++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$stt);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$value['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$value['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$value['upline']);

			$big_upline = $this -> big_upline($value['customer_id']);

			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$big_upline['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$big_upline['bigupline']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n,count($get_account_pin));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n,date('d/m/Y H:i:s',strtotime($value['date_added'])));
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n,$day);
			$get_gd_customer =($this -> get_gd_customers($value['customer_id'])); 

			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n,$get_gd_customer['total']);
			$chuoi = "";
			if (count($get_gd_customer['sum_watting']) > 0) {  
				$chuoi = date('d/m/Y H:i',strtotime($get_gd_customer['sum_watting']['date_added']))." - ".number_format($get_gd_customer['sum_watting']['amount']);
			}

			$objPHPExcel->getActiveSheet()->setCellValue('K'.$n,$chuoi);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$n,number_format($get_gd_customer['sum_finish']));

			$string = "";
			if (count($this -> getPD_last($value['customer_id'])) > 0) {
                $string = date('d/m/Y H:i:s',strtotime($this -> getPD_last($value['customer_id'])['date_added']));
            }

			$objPHPExcel->getActiveSheet()->setCellValue('M'.$n,$string);

			$n++;
			}
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
		header('Content-Disposition: attachment;filename="LIST_ID_F1_KHONG_KICH_PIN_'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

	public function exportall_customer(){
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

		$results = $this -> model_sale_customer -> count_all_customer();
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
		->setCellValue('G1', 'Số PD đã kích')
		->setCellValue('H1', 'PD tối thiểu')
		->setCellValue('I1', 'Các PD đã kích');
		
		
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(100);
		
		$h=0;
		$n = 2;
		$stt=0;
		$date_now = date('Y-m-d H:i:s');

		foreach ($results as $value) {
			$get_level = $this -> get_level($value['customer_id']);

            switch ($get_level['level']) {
                case 1:
                    $num_pd = 3;
                    break;
                  case 2:
                    $num_pd = 4;
                    break;
                  case 3:
                    $num_pd = 5;
                    break;
                  case 4:
                    $num_pd = 7;
                    break;
                  case 5:
                    $num_pd = 10;
                    break;
                  case 6:
                    $num_pd = 11;
                    break;
          }

          $get_provine_16_04 = $this -> get_provine_16_04_date($value['customer_id'],$start_date,$end_date);

          if (count($get_provine_16_04) < $num_pd) {
           
			
                $stt ++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$stt);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$value['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$value['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$value['upline']);

			$big_upline = $this -> big_upline($value['customer_id']);

			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$big_upline['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$big_upline['bigupline']);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n,count($get_provine_16_04));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n,$num_pd);

			$get_provine_16_04 = $this -> get_provine_16_04($value['customer_id']);
			//print_r($get_provine_16_04);die;
			if (count($get_provine_16_04) == 0)
			{
				$chuoi_pd = "";
			}
			else
			{
				$chuoi_pd = "";
				foreach ($get_provine_16_04 as $value_pd) { 
					$chuoi_pd .= ",".date('d/m/Y H:i:s',strtotime($value_pd['date_added']));
				}
				$chuoi_pd = substr($chuoi_pd,1);
			}
			
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n,$chuoi_pd);

			
			$n++;
			
		}
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
		header('Content-Disposition: attachment;filename="LIST_ID_CHUA_KICH_DU_PIN_TU_16_04_'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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


	public function exportall_customers(){
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

		$results = $this -> model_sale_customer -> count_all_customers($start_date,$end_date);
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
		->setCellValue('G1', 'Email')
		->setCellValue('H1', 'Số tài khoản')
		->setCellValue('I1', 'Tên tài khoản')
		->setCellValue('J1', 'Thời gian tạo')
		->setCellValue('K1', 'Trạng thái');
		
		
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
		
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
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".$value['email']);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".$value['account_number']);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n," ".$value['account_holder']);

			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n,date('d/m/Y H:i:s',strtotime($value['date_added'])));

			if ($value['status'] == 1 || $value['status'] == 2)
			{
				$status = "Hoạt động";
			}
			else
			{
				$status = "Đã khóa";
			}

			$objPHPExcel->getActiveSheet()->setCellValue('K'.$n,$status);
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