<?php
class ControllerPdPh extends Controller {
	public function index() {
				ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
		$this->document->setTitle('Provide Help');
		$this->load->model('sale/customer');
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 60;
		$start = ($page - 1) * 60;

		$ts_history = $this -> model_sale_customer -> get_count_ph();

		$ts_history = $ts_history['number'];
		
		$pagination = new Pagination();
		$pagination -> total = $ts_history;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text'; 
		$pagination -> url = $this -> url -> link('pd/ph', 'page={page}&token='.$this->session->data['token'].'', 'SSL');
		$data['load_pin_date'] = $this -> url -> link('pd/ph/load_pin_date&token='.$this->session->data['token']);
		$data['getaccount'] = $this->url->link('pd/ph/getaccount&token='.$this->session->data['token'], '', 'SSL');
		$data['show_gh_username'] = $this -> url -> link('pd/ph/show_gh_username&token='.$this->session->data['token']);
		$data['pin'] =  $this-> model_sale_customer->get_all_pd($limit, $start);

		$data['get_all_pd_lock'] = $this -> model_sale_customer -> get_all_pd_lock();

		$data['getPD7Before'] = $this -> model_sale_customer -> getPD7Before();
		
		$data['pagination'] = $pagination -> render();
		
		$data['export'] = $this -> url -> link('pd/ph/export&token='.$this->session->data['token']);

		$data['exporttt'] = $this -> url -> link('pd/ph/exporttt&token='.$this->session->data['token']);

		$data['self'] = $this;

		$data['token'] = $this->session->data['token'];
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('pd/list_ph.tpl', $data));
	}

	public function get_block_repd($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_block_repd($customer_id);

	}

	public function get_last_gd_customer($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_last_gd_customer($customer_id);
	}

	public function get_no_regd($customer_id)
	{
		$this->load->model('sale/customer');
		return $this -> model_sale_customer -> get_no_regd($customer_id);

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
		$this->load->model('sale/customer');
		$load_pin_date = $this -> model_sale_customer -> show_ph_username($username);
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
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                    if ($value['status'] == 1) {
                        echo "<span class='label label-info'>Matched</span>";
                    }
                    if ($value['status'] == 2) {
                        echo "<span class='label label-success'>Finish</span>";
                    }
                    if ($value['status'] == 3) {
                        echo "<span class='label label-danger'>Report</span>";
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
		<tr><td colspan="6" class="text-center">No data</td> </tr>
		<?php
		}
	}
	public function load_pin_date()
	{
		
		$date = date('Y-m-d',strtotime($this -> request ->post['date']));
		
		$this->load->model('sale/customer');
		$load_pin_date = $this -> model_sale_customer -> load_ph_date($date);
		$stt = 0;
		if (count($load_pin_date) > 0)
		{


			foreach ($load_pin_date as $value) { $stt++;$style = "";
            $get_no_regd = $this -> get_no_regd($value['customer_id']);
              if (count($get_no_regd) > 0) { 
                $style = "background: rgba(255, 235, 59, 0.58)";
              }
              $get_block_repd = $this -> get_block_repd($value['customer_id']);
              if (count($get_block_repd) > 0) { 
                $style = "background: rgba(244, 67, 54, 0.52);";
              }
          ?>
          <tr style="<?php echo $style ?>">
		        <td><?php echo $stt; ?></td>
				<td><?php echo $value['username'] ?></td>
				<td><?php echo $value['account_holder'] ?></td>
		        <td><?php echo number_format($value['filled']) ?> VNĐ</td>
		        <td><?php 
		         if ($value['status'] == 0) {
                        echo "<span class='label label-default'>Waiting</span>";
                    }
                    if ($value['status'] == 1) {
                        echo "<span class='label label-info'>Matched</span>";
                    }
                    if ($value['status'] == 2) {
                        echo "<span class='label label-success'>Finish</span>";
                    }
                    if ($value['status'] == 3) {
                        echo "<span class='label label-danger'>Report</span>";
                    }
		         ?></td>
		       
				<td><?php echo date('d/m/Y H:i',strtotime($value['date_added'])) ?></td>
				<td><span style="color:red; font-size:15px;" class="text-danger countdown" data-countdown="<?php echo $value['date_finish']; ?>">
                     </span> </td>

                  <td>
                       <?php 
                        $get_no_regd = $this -> get_no_regd($value['customer_id']);
                        if (count($get_no_regd) > 0) { ?>
                         
                       <span style="color:red; font-size:15px;" class="text-danger countdowns" data-countdowns="<?php echo $get_no_regd['date_finish']; ?>">
                     </span> 
                      <?php  } ?>
                     </td>

                     <td>
                       <?php 
                        $get_block_repd = $this -> get_block_repd($value['customer_id']);
                        if (count($get_block_repd) > 0) { 
                          $date_added= $get_block_repd['date'];
                          $date_finish = strtotime ( '+ 2 day' , strtotime ($date_added));
                          $date_finish= date('Y-m-d H:i:s',$date_finish) ;
                        ?>
                       
                       <span style="color:red; font-size:15px;" class="text-danger countdownss" data-countdownss="<?php echo $date_finish; ?>">
                     </span> 
                     <?php  } ?>
                     </td>
                     <td>
                       <?php 
                        if (count($this -> get_last_gd_customer($value['customer_id'])))
                        {
                          echo date('d/m/Y H:s',strtotime($this -> get_last_gd_customer($value['customer_id'])['date_added']))." | ".number_format($this -> get_last_gd_customer($value['customer_id'])['amount']);
                        }
                       ?>
                     </td>
			</tr>
	               
		<?php 
			}
		}
	
		else
		{
		?>
		<tr><td colspan="6" class="text-center">No data</td> </tr>
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
		$results = $this -> model_sale_customer -> getall_pd_date($start_date,$end_date);
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
		->setCellValue('F1', 'Amount')
		->setCellValue('G1', 'Status')
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
			//print_r($customer); die;
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n,$customer['account_holder']);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$customer['account_number']);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$customer['telephone']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n,number_format($customer['filled']));
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
		header('Content-Disposition: attachment;filename="LISH_PH'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

	public function exporttt(){
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

		$results = $this -> model_sale_customer -> getall_pd_datett($start_date,$end_date);
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
		->setCellValue('B1', 'Username PD')
		->setCellValue('C1', 'Telephone')
		->setCellValue('D1', 'Upline')
		->setCellValue('E1', 'Mid Upline')
		->setCellValue('F1', 'Big Upline')
		->setCellValue('G1', 'Date Create PD')	
		->setCellValue('H1', 'Date Matched PD')	
		->setCellValue('I1', 'Status PD')
		->setCellValue('J1', 'Date GD Finish')
		->setCellValue('K1', 'Date GD Watting');
         $objPHPExcel->getActiveSheet()->getStyle('A1:K1')
        ->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '00AE3F')
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
		$h=0;
		$n = 2;
		$i=0;
		foreach ($results as $customer) {
			//print_r($customer); die;
			$i++;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$n,$i);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$n," ".$customer['username']);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$n," ".$customer['telephone']);

			$p_node = $this -> model_sale_customer -> get_customer($customer['p_node']);


			$objPHPExcel->getActiveSheet()->setCellValue('D'.$n," ".$p_node['username']);

			
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$n," ".$this -> big_upline($customer['customer_id'])['middleline']);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$n," ".$this -> big_upline($customer['customer_id'])['bigupline']);

			$get_pd_id = $this -> get_pd_id($customer['pd_id']);

			$objPHPExcel->getActiveSheet()->setCellValue('G'.$n," ".date('d/m/Y H:i:s',strtotime($get_pd_id['date_added'])));

			$objPHPExcel->getActiveSheet()->setCellValue('H'.$n," ".date('d/m/Y H:i:s',strtotime($customer['date_added'])));
			if ($customer['pd_satatus'] == 0) $status = "Đang chờp";
			if ($customer['pd_satatus'] == 1) $status = "Hoàn thành";
			if ($customer['pd_satatus'] == 2) $status = "Báo cáo";
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$n,$status);

			$get_gd = $this -> get_gd_watting_finish($customer['customer_id']);
			
			if (count($get_gd['finish']) == 0)
			{
				$finish = "Không có";
			}
			else
			{
				$finish = date('d/m/Y H:i:s',strtotime($get_gd['finish']['date_added']));
			}

			$objPHPExcel->getActiveSheet()->setCellValue('J'.$n," ".$finish);


			if (count($get_gd['watting']) == 0)
			{
				$watting = "Không có";
			}
			else
			{
				$watting = date('d/m/Y H:i:s',strtotime($get_gd['watting']['date_added']));
			}

			$objPHPExcel->getActiveSheet()->setCellValue('K'.$n, " ".$watting);

			
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
		header('Content-Disposition: attachment;filename="LISH_TT_PD'.date('d').'_'.date('m').'_'.date('Y').'_'.date('H').'_'.date('i').'.xls"');
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

	public function get_pd_id($id_pd)
	{
		$this->load->language('sale/customer');
		return $this -> model_sale_customer -> get_pd_id($id_pd);
	}
	public function get_gd_watting_finish($customer_id)
	{
		$this->load->language('sale/customer');
		$getGD_bycustomer_watting = $this -> model_sale_customer -> getGD_bycustomer_watting($customer_id);

		$getGD_bycustomer_finish = $this -> model_sale_customer -> getGD_bycustomer_finish($customer_id);

		$join['watting'] = $getGD_bycustomer_watting;
		$join['finish'] = $getGD_bycustomer_finish;
		return $join;
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
		$results = $this -> model_sale_customer -> getall_pd_date_mail(date('Y-m-d'));
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