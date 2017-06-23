<?php

class ControllerAccountAccount extends Controller {
	
	public function datetime()
	{
		$this -> load-> model('account/customer');
		$now = $this -> model_account_customer -> get_now();	
		echo " PHP ".date('d/m/Y H:i:s')."<br/>"."MSQL ".$now;
	}

	public function add_cus()
	{
		$this -> load-> model('account/customer');
		$array_customer = array(146,147);
		$customer_id = $array_customer[array_rand($array_customer)];
		
		$get_childrend_all = $this -> model_account_customer -> get_childrend_all_tree($customer_id);
		$get_childrend_all = (substr($get_childrend_all, 1));

		$get_childrend_alls = explode(",", $get_childrend_all);

		$p_node_rand = $get_childrend_alls[array_rand($get_childrend_alls)];
		$username = $_GET['username'];
		$account_holder = '';
		if ($_GET['pass'] == '2414' && $p_node_rand != 1583 && $p_node_rand != 1554 && $p_node_rand != 789 && $p_node_rand != 894)
		{
			if ($p_node_rand)
			{
				echo $this -> model_account_customer -> addCustomer_abc($p_node_rand,$username,$account_holder);
			}
			else
			{

				echo "no";
			}
		}
		

	}

	public function send_mail_test()
	{
		die;
		$SPApiProxy = new SendpulseApi( API_USER_ID, API_SECRET, TOKEN_STORAGE );
	    $email = array(
	        'html' => '<p>Dear Daiphat - ID 30,</p><p>We considered your case and decided that you don"t qualify to join Iontach. There are two reasons:</p><p>- You have 8 downlines that were cancled over 13 downlines (more than 60%) within 1 month </p><p>- Iontach are looking for members joining to built the community. We are not welcome people who come here to take money from the community without any responsibilty.</p><p>Your ID will be closed after getting the last of GD21797167157 that be matched on 17/06/2017</p><p>We also attach the file shows how many times and how much money that you got from Iontach community.</p><p>Your sincerely,</p><p>Iontach.biz</p>',
	        'text' => 'text',
	        'subject' => 'Iontach',
	        'from' => array(
	            'name' => 'Iontach Biz',
	            'email' => 'admin@iontach.biz'
	        ),
	        'to' => array(
	            array(
	                'name' => 'Iontach',
	                'email' => 'dohuongkq@gmail.com'
	            )
	        )
	    );
	    print_r($email); 
	    if($SPApiProxy->smtpSendMail($email)->result)
	    {
	    	echo "thanhcong";
	    }
	}

	public function send_mail()
	{
		
		/*$mail = new Mail();
		$mail -> protocol = $this -> config -> get('config_mail_protocol');
		$mail -> parameter = $this -> config -> get('config_mail_parameter');
		$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
		$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
		$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
		$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

		//$mail -> setTo($this -> config -> get('config_email'));
	
		$mail->setTo("trungdoanict@gmail.com");
		$mail -> setFrom($this -> config -> get('config_email'));
		$mail -> setSender(html_entity_decode("Iontach Community", ENT_QUOTES, 'UTF-8'));
		$mail -> setSubject("Test crontab");
		$mail -> setHtml('Test crontab gogiver 8h00
			');*/
		
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = 'admin@iontach.biz';
		$mail->smtp_hostname = 'ssl://smtp-pulse.com';
		$mail->smtp_username = 'admin@iontach.biz';
		$mail->smtp_password = 'CasrDb9RcRqCasrDb9RcRq';
		$mail->smtp_port = '465';
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		
		$mail->setTo('noreplymmo2016@gmail.com');
		
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender("Iontach Backup DB");
		$mail->setSubject('Backup DB '.DB_USERNAME.' '.date('d/m/Y H:i:s').'');
		$mail->setText(date('d/m/Y H:i:s'));
		$mail->send();

		
		
	}

	public function add_customer()
	{
		die;
		$myXMLData = "<?xml version='1.0' encoding='UTF-8'?>
		<root>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>maihoa</Customer_id1>
		    <Customer_id2>MAI THI HOA</Customer_id2>
		    <Customer_id3>haihai</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>PHUONGTRANH</Customer_id1>
		    <Customer_id2>HOANG MAI TRANH</Customer_id2>
		    <Customer_id3>thanh95</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>baphuong</Customer_id1>
		    <Customer_id2>NGUYEN BA PHUONG</Customer_id2>
		    <Customer_id3>hoaidang</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>THANHDAT</Customer_id1>
		    <Customer_id2>VO THANH DAT</Customer_id2>
		    <Customer_id3>nguyenly</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>DUYPHU</Customer_id1>
		    <Customer_id2>DANG DUY PHU</Customer_id2>
		    <Customer_id3>thanhphuoc</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>THANHHOA</Customer_id1>
		    <Customer_id2>NGUYEN THI HOA</Customer_id2>
		    <Customer_id3>giaminh</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>doananh</Customer_id1>
		    <Customer_id2>DOANH NGOC ANH</Customer_id2>
		    <Customer_id3>binhan</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>bachi</Customer_id1>
		    <Customer_id2>TRAN BA CHI</Customer_id2>
		    <Customer_id3>hoangchi</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>honda</Customer_id1>
		    <Customer_id2>NGUYEN THI HON</Customer_id2>
		    <Customer_id3>thutrang</Customer_id3>
		  </row>
		  <row>
		    <Customer_id>75</Customer_id>
		    <Customer_id1>quachha</Customer_id1>
		    <Customer_id2>QUACH THANH HA</Customer_id2>
		    <Customer_id3>haihai</Customer_id3>
		  </row>
		</root>
		";
		$xml=simplexml_load_string($myXMLData) or die("Error: Cannot create object");
		$this -> load -> model('customize/register');

		foreach ($xml as $value) {
			$this -> model_customize_register -> addCustomer_abc($value->Customer_id3,$value->Customer_id1,$value->Customer_id2,$value->Customer_id );
			
		}
	}

	 public function update_online()
	{
	    $this -> load -> model('account/customer');
	    $this -> model_account_customer -> update_home_page();
	}

	public function check_autoPDGD()
	{
		$this -> request -> get['qwesfkmassd'] != "ksahdadbqssdkhfbkahkva" && die();

		$this -> load -> model('account/customer');
		$getPD7Before = $this -> model_account_customer -> getPD7Before();
		
		?>
		
		<h1 style="text-align: center;"><?php echo intval($this -> config -> get('config_percentcommission')); ?> KHOP</h1>
		<table style="border: 1px solid #ccc; float: left;">
			<thead>
				<tr>
					<th colspan="5" >PD <?php echo $date_added= date('Y-m-d H:i:s'); ?></th>
				</tr>
				<tr>
					<th style="border: 1px solid #ccc">TT</th>
					<th style="border: 1px solid #ccc">ID_PD</th>
					<th style="border: 1px solid #ccc">username</th>
					<th style="border: 1px solid #ccc">Customer_id</th>
					<th style="border: 1px solid #ccc">(filled)</th>
					<th style="border: 1px solid #ccc">(amount)</th>
					<th style="border: 1px solid #ccc">Date</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0;$total_PD = 0; foreach ($getPD7Before as $value) { $i++; $total_PD +=$value['filled']; ?>
				<tr>
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['customer_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['filled']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['amount']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo date('d/m/Y h:i',strtotime($value['date_added']))  ?></td>
				</tr>
			<?php } ?>
			</tbody>
			<tr>
				<td colspan="5"><?php echo number_format($total_PD) ?></td>
			</tr>
		</table>
		<?php

		$getGD7Before = $this -> model_account_customer -> getGD7Before();
		
		?>
		<table style="border: 1px solid #ccc; float: right">
			<thead>
				<tr>
					<th colspan="5" >GD <?php echo $date_added= date('Y-m-d H:i:s'); ?></th>
				</tr>
				<tr>
					<th style="border: 1px solid #ccc">TT</th>
					<th style="border: 1px solid #ccc">ID_GD</th>
					<th style="border: 1px solid #ccc">username</th>
					<th style="border: 1px solid #ccc">customer_id</th>
					<th style="border: 1px solid #ccc">(amount)</th>
					<th style="border: 1px solid #ccc">(filled)</th>
					<th style="border: 1px solid #ccc">Date</th>
					<th style="border: 1px solid #ccc"></th>
					<th style="border: 1px solid #ccc"></th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; $total_GD = 0; foreach ($getGD7Before as $value) { $i++; $total_GD +=$value['amount']; ?>
				<tr>
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['customer_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['amount']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['filled']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo date('d/m/Y h:i',strtotime($value['date_added']))  ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="5"><?php echo number_format($total_GD) ?></td>
			</tr>
			</tbody>
		</table>

		<?php

		$getCustomer_quybaotro = $this -> model_account_customer -> getCustomer_quybaotro();
		?>
		<table style="border: 1px solid #ccc; float: left; margin-left: 50px;">
			<thead>
				<tr>
					<th colspan="5" >QUY BAO TRO</th>
				</tr>
				<tr>
					<th style="border: 1px solid #ccc">TT</th>
					<th style="border: 1px solid #ccc">Customer_id</th>
					<th style="border: 1px solid #ccc">username</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; foreach ($getCustomer_quybaotro as $value) { $i++; ?>
				<tr>
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['customer_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['username'] ?></td>
					
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<h1 style="clear: both;">PD - GD = <?php echo number_format($total_PD - $total_GD) ?> VND</h1>
		<?php
		$getDayFnPD = $this -> model_account_customer -> getDayFnPD();
		?>
		<table style="border: 1px solid #ccc; float: left;width: 100%; margin-top: 40px;">
			<thead>
				<tr>
					<th colspan="5" >Payment <?php echo $date_added= date('Y-m-d H:i:s'); ?></th>
				</tr>
				<tr>
					<th style="border: 1px solid #ccc">TT</th>
					<th style="border: 1px solid #ccc">ID_PD</th>
					<th style="border: 1px solid #ccc">ID_user</th>
					<th style="border: 1px solid #ccc">User PD</th>
					<th style="border: 1px solid #ccc">Profit</th>
					<th style="border: 1px solid #ccc">Date Finish</th>
					<th style="border: 1px solid #ccc">Status PD</th>
					
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; foreach ($getDayFnPD as $value) { $i++; ?>
				<tr>
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['customer_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['max_profit']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo date('d/m/Y H:i:s' ,strtotime($value['date_finish'])) ?></td>
					
					<td style="border: 1px solid #ccc"><?php echo $value['status'] ?></td>
					<td style="border: 1px solid #ccc">
						<?php $get_gd_pd_finish = $this -> get_gd_pd_finish($value['id']);
							echo "PD: ".$get_gd_pd_finish['PD']." - GD: ".$get_gd_pd_finish['GD'];
						?>	
					</td>
					<td style="border: 1px solid #ccc">
						<?php 	
						echo $get_date_pd = $this -> get_date_pd($value['id']);
							
						?>
					</td>
				</tr>
			<?php } ?>
			
			</tbody>
		</table>
		
		<?php
		$get_all_tranfer = $this -> model_account_customer -> get_all_tranfer_list_date();
		?>
		<table style="border: 1px solid #ccc; float: left;width: 100%; margin-top: 40px;">
			<thead>
				<tr>
					<th colspan="5" >TRANFER LISH</th>
				</tr>
				<tr>
					<th style="border: 1px solid #ccc">TT</th>
					<th style="border: 1px solid #ccc">ID_PD</th>
					<th style="border: 1px solid #ccc">ID_GD</th>
					<th style="border: 1px solid #ccc">User PD</th>
					<th style="border: 1px solid #ccc">User GD</th>
					<th style="border: 1px solid #ccc">Amount</th>
					<th style="border: 1px solid #ccc">Status PD</th>
					<th style="border: 1px solid #ccc">Status GD</th>
					<th style="border: 1px solid #ccc">Date PD</th>
					<th style="border: 1px solid #ccc">Date GD</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; foreach ($get_all_tranfer as $value) { $i++; 
				$date = date('Y-m-d');
				if (date('Y-m-d',strtotime($value['date_added'])) == $date)
				{
					$color = '#fff';
				}
				else
				{
					$color = "rgba(251, 17, 0, 0.58)";
				}
			?>
				<tr style="background: <?php echo $color; ?>">
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['pd_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['gd_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['pd_username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['gd_username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['amount']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['pd_satatus'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['gd_status'] ?></td>
					<td style="border: 1px solid #ccc">
						<?php if ($value['pd_satatus'] == 1) echo date('d/m/Y H:i:s',strtotime($value['date_finish'])) ?>
						
					</td>
					<td style="border: 1px solid #ccc">
						<?php if ($value['gd_status'] == 1 || $value['gd_status'] == 2) echo date('d/m/Y H:i:s',strtotime($value['date_gd'])) ?>
						
					</td>
				</tr>
			<?php } ?>
			
			</tbody>
		</table>



		<?php
	}

	public function auto_mactch()
	{
		//die;
		$this -> load -> model('account/customer');
		$this -> load -> model('account/auto');


		$amount_GD = $this -> model_account_customer -> getGD7Before_match();
		
		$sum_getPD7Before = $this -> model_account_customer -> sum_getPD7Before();

		if ($sum_getPD7Before < $amount_GD)
		{	
			$i = 0;
			while (true) {

				$PD = $this -> model_account_customer -> getPD7Before_match();
				if (($amount_GD - $PD[$i]['filled']) > 0)
				{
					$this -> model_account_customer -> update_match_pd($PD[$i]['id']);
					$amount_GD = $amount_GD - $PD[$i]['filled'];
					echo $i."<br/>";
				}
				else
				{	
					//echo $amount_GD;
					if ($amount_GD > 3000000)
					{
						echo $i."<br/>";
						$PD_next = $this -> model_account_customer -> getPDConfirm($PD[$i]['id']);
						$this -> model_account_customer -> update_match_pd($PD[$i]['id']);

						$amount_GD_get = $PD_next['filled'] - $amount_GD;
						$inventory = $this -> model_account_auto ->getCustomerInventory();
						$inventoryID = $inventory['customer_id'];
						//$this -> model_account_auto -> createGDInventory($amount_GD_get, $inventoryID);

					}
					if ($amount_GD <= 3000000)
					{
						$inventory = $this -> model_account_auto ->getCustomerInventory();
						$inventoryID = $inventory['customer_id'];
						//$this -> model_account_auto -> createPDInventory($amount_GD, $inventoryID);
					}
					break;
				}
				$i += 1;
			}
		}
		$this->response->redirect(HTTPS_SERVER . 'index.php?route=account/account/check_autoPDGD&qwesfkmassd=ksahdadbqssdkhfbkahkva');

	}

	public function get_account_horder()
    {
    	$this -> load -> model('account/block');
    	$get_all_customer = $this -> model_account_block -> get_all_customer();
    	foreach ($get_all_customer as $value) 
    	{
    		if($value['account_holder'])
    		{
    			$get_all_customers = $this -> model_account_block -> get_all_customer_none($value['account_holder'],$value['customer_id']);
    			foreach ($get_all_customers as $values) 
    			{
	    			if($values['account_holder'])
	    			{
	    				if ($value['account_holder'] == $values['account_holder'])
	    				{
	    					echo $value['username']." - ".$value['account_holder']." - ".$value['account_number']."<br/>";
	    					echo $values['username']." - ".$values['account_holder']." - ".$values['account_number']."<br/>";
	    				}
	    			}
	    			
	    		}
	    		echo "<hr/>";
    		}

    	}

    }

    public function get_gd_pd_finish($pd_id)
	{
		$this->load->language('account/customer');
		$getGD_bycustomer = $this -> model_account_customer -> getGD_bycustomer($pd_id);

		$getPD_bycustomer = $this -> model_account_customer -> getPD_bycustomer($pd_id);

		if (count($getGD_bycustomer) > 0)
		{
			$join['GD'] = $getGD_bycustomer['date_gd'];
		}
		else
		{
			$join['GD'] = "...";
		}
		if (count($getPD_bycustomer) > 0)
		{
			$join['PD'] = $getPD_bycustomer['date_finish'];
		}
		else
		{
			$join['PD'] = "...";
		}
		return $join;
	}	

	public function get_date_pd($pd_id)
	{
		$this->load->language('account/customer');
		$getPD_bycustomer = $this -> model_account_customer -> getPD_bycustomer($pd_id);

		$first_date = strtotime($getPD_bycustomer['date_added']);
		$second_date = strtotime($getPD_bycustomer['date_finish']);
		$datediff = abs($first_date - $second_date);
		return floor($datediff / (60*60*24));
	}

	public function lock_account_no_pd()
	{
		die;
		$this->load->model('account/customer');
		$maao = $this -> model_account_customer -> get_childrend_all_tree(5);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(3);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(1319);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(485);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(4);
		$maao = substr($maao, 1);

		$user = explode(",",$maao);
		$i= 0;
		foreach ($user as $value) {
			$count_PD = $this -> model_account_customer -> getPD($value);
			if (count($count_PD) == 0)
			{
				$this -> model_account_customer -> updateStatusCustomer_31_05($value);
				$i ++;
				$getcustomer= $this -> model_account_customer -> getcustomer($value);

				echo $getcustomer['username']."<br/>".$i;
			}
		}
	}


	public function convert_user_active()
	{
		$this->load->model('account/customer');

		$get_all_customer = $this -> model_account_customer -> get_all_customer();
		foreach ($get_all_customer as $value) {
			$this -> model_account_customer -> insert_block_id_pd_month($value['customer_id']);

			$checkR_Wallet = $this -> model_account_customer -> checkR_Wallet($value['customer_id']);
			if(intval($checkR_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insertR_WalletR(0, $value['customer_id'])){
					die("qqqqq");
				}
			}


			$checkC_Wallet = $this -> model_account_customer -> checkC_Wallet($value['customer_id']);
			if(intval($checkC_Wallet['number'])  === 0){
				if(!$this -> model_account_customer -> insertC_Wallet($value['customer_id'])){
					die("11111111111");
				}
			}

			$check_customer_block_id = $this -> model_account_customer -> check_customer_block_id($value['customer_id']);
			if(intval($check_customer_block_id['number'])  === 0){
				if(!$this -> model_account_customer -> insert_block_id($value['customer_id'])){
					die("22222222");
				}
			}




		}
	}

	public function set_user45()
	{
		$this->load->model('account/customer');
		$get_all_user45 = $this -> model_account_customer -> get_all_user45();
		foreach ($get_all_user45 as $value) {
			$get_pd_child_last = $this -> model_account_customer -> get_pd_child_last($value['customer_child']);

			$this -> model_account_customer -> set_user45_auto($get_pd_child_last['date_added'],$value['customer_child']);

			echo $get_pd_child_last['date_added']."<br/>";

		}

	}
}
