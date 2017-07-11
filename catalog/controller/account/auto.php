<?php

class ControllerAccountAuto extends Controller {

	public function sendmail_khoplenh($emails,$subject,$content)
	{
		$emails = 'trungdoanict@gmail.com';
		$SPApiProxy = new SendpulseApi( API_USER_ID, API_SECRET, TOKEN_STORAGE );
	    $email = array(
	        'html' => $content,
	        'text' => 'text',
	        'subject' => $subject,
	        'from' => array(
	            'name' => 'Iontach Community',
	            'email' => 'noreply@iontach.biz'
	        ),
	        'to' => array(
	            array(
	                'name' => 'Iontach Community',
	                'email' => $emails
	            )
	        )
	    );
	    return $SPApiProxy->smtpSendMail($email);
		
		
		/*$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = 'iontach.noreply@gmail.com';
		$mail->smtp_hostname = 'ssl://smtp.gmail.com';
		$mail->smtp_username = 'iontach.noreply@gmail.com';
		$mail->smtp_password = 'ihghzqlhbalcmyqc';
		$mail->smtp_port = '465';
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		
		$mail->setTo($emails);
		
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender("Iontach Community");
		$mail->setSubject($subject);
		$mail->setHtml($content);
		$mail->send();
		print_r($mail); */
		
	}

	public function sendmail_tranferlis()
	{
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');
		// send mail send_mail == 0
		$customer_sendmail_pd = $this -> model_account_auto -> get_customer_sendmail_pd();
	
		foreach ($customer_sendmail_pd as $value) {
			// customer_id PD
			$getCustomer_PD = $this -> model_account_customer -> getCustomer($value['customer_id']);
			if ($getCustomer_PD['email'] != "")
			{
				$subject = 'Your PD #'.$value['pd_number'].' has been matched';
				$content = '<p>Dear '.$getCustomer_PD['username'].'</p><p>Congratulations, Your <b>PD #'.$value['pd_number'].'</b> has been matched. Please log on to your account and complete this PD within 72 hours</p><p>If you have any question please email <a>admin@iontach.biz</a></p><p>Best regards,</p><p>iontach.biz.</p>';

				$send_mail = $this -> sendmail_khoplenh($getCustomer_PD['email'],$subject,$content);
				print_r($send_mail); die;
				if($send_mail->result)
			    {
			    	$this -> model_account_auto -> update_customer_sendmail_finish_pd($value['id']);

			    	die("111111111111");
			    }

			}
			
		}

		$customer_sendmail_gd = $this -> model_account_auto -> get_customer_sendmail_gd();
		
		foreach ($customer_sendmail_gd as $value) {
			// customer_id GD
			$getCustomer_GD = $this -> model_account_customer -> getCustomer($value['customer_id']);
			if ($getCustomer_GD['email'] != "")
			{
				$subject = 'Your GD #'.$value['gd_number'].' has been matched';
				$content = '<p>Dear '.$getCustomer_GD['username'].'</p><p>Congratulations, Your <b>GD #'.$value['gd_number'].'</b> has been matched. Please log on to your account to review your bank account, ensure it correct. Please approve the transactions for sender whenever you recived money as soon as possible.</p><p>If you have any question please email <a>admin@iontach.biz</a></p><p>Best regards,</p><p>iontach.biz.</p>';
				$this -> sendmail_khoplenh($getCustomer_GD['email'],$subject,$content);
			}
			$this -> model_account_auto -> update_customer_sendmail_finish_gd($value['id']);
		}
	}

	public function get_pd($pd_id)
	{
		$this -> load -> model('account/auto');
		return $this -> model_account_auto -> getPD_id($pd_id);
	}
	public function get_gd($gd_id)
	{
		$this -> load -> model('account/auto');
		return $this -> model_account_auto -> getGD_id($gd_id);
	}

	public function autoPDGD() {

		//die;

		$hour_run = date('H:i');

		if ( ($hour_run > "08:05" || $hour_run < "08:00") && HTTP_SERVER != "http://localhost/iontach/")
		{
			die("no run");
		}
		//die("1111111111111");
		$this -> load -> model('account/auto');
		$this -> load -> model('customize/register');
		$this -> load -> model('account/pd');
		$this -> load -> model('account/customer');

		$loop = true;
		
		$numday = intval($this -> config -> get('config_percentcommission'));

		$count_auto = 0;
		while ($loop) {
			
			$gdList = $this -> model_account_auto -> getGD7Before(); //date finish
			//echo "<pre>"; print_r($gdList); echo "</pre>"; die();
			$pdList = $this -> model_account_auto -> getPD7Before(); //date finish
			//echo "<pre>"; print_r($pdList); echo "</pre>"; die();
			
			if(count($gdList) === 0 && count($pdList) > 0){
				print_r($gdList);echo "<br/>";
				
				//get customer in inventory
				$inventory = $this -> model_account_auto ->getCustomerInventory();
				
				
				$pdSend = floatval($pdList['filled'] - $pdList['amount']);
				
					$inventoryID = $inventory['customer_id'];

					//create GD cho inventory
					
					$this -> model_account_auto -> createGDInventory($pdSend, $inventoryID);
					
					// continue;
				
				
				
			}

			if(count($pdList) === 0 && count($gdList) > 0){

				$gdResiver = floatval($gdList['amount'] - $gdList['filled']);

				
					$inventory = $this -> model_account_auto ->getCustomerInventory();
					// lay id ao cho phan du
					$inventoryID = $inventory['customer_id'];

					$this -> model_account_auto -> createPDInventory($gdResiver, $inventoryID);
					// continue;
					// die('2');
				
				
			}
			
			if (count($pdList) === 0 && count($gdList) === 0) {
				
				$loop = false;
				break;
			}

			if ($pdList && $gdList) {

				$pdSend = intval($pdList['filled'] - $pdList['amount']);
				$gdResiver = intval($gdList['amount'] - $gdList['filled']);
				echo $pdSend." ------------ ".$gdResiver."<br/>";
				if ($pdSend === $gdResiver) {

					$data['pd_id'] = $pdList['id'];
					$data['gd_id'] = $gdList['id'];
					$data['pd_id_customer'] = $pdList['customer_id'];
					$data['gd_id_customer'] = $gdList['customer_id'];

					if ($pdSend > 4000000)
					{
						$pdSend = 4000000;
					}
					if ($pdSend < 4000000)
					{
						$pdSend = $pdSend;
					}

					$data['amount'] = $pdSend;
					$id_transfer = $this -> model_account_auto -> createTransferList($data);
					$this -> model_account_auto -> updateTransferList($id_transfer);
					if ($pdSend < 4000000)
					{
						echo "PD-GD"."<br/>";
						$this -> model_account_auto -> updateStatusPD($pdList['id'], 1);
						$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);

						$count_auto ++;


					}
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $pdSend);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $pdSend);
					
					$getPD_id = $this -> model_account_auto -> getPD_id($pdList['id']);

					if (intval($getPD_id['filled']) - intval($getPD_id['amount']) == 0)
					{
						$this -> model_account_auto -> updateStatusPD($pdList['id'], 1);
						$count_auto ++;
						
					}
					$getGD_id = $this -> model_account_auto -> getGD_id($gdList['id']);
					
					if (intval($getGD_id['amount']) - intval($getGD_id['filled']) == 0)
					{
						$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);
					}

					echo "bang<br/>";
					continue;
				}

				if ($pdSend < $gdResiver) {
					$data['pd_id'] = $pdList['id'];
					$data['gd_id'] = $gdList['id'];
					$data['pd_id_customer'] = $pdList['customer_id'];
					$data['gd_id_customer'] = $gdList['customer_id'];

					if ($pdSend > 4000000)
					{
						$pdSend = 4000000;
					}
					if ($pdSend < 4000000)
					{
						$pdSend = $pdSend;
					}

					$data['amount'] = $pdSend;
					$id_transfer = $this -> model_account_auto -> createTransferList($data);
					$this -> model_account_auto -> updateTransferList($id_transfer);
					if ($pdSend < 4000000)
					{	
						echo "PD"."<br/>";
						$this -> model_account_auto -> updateStatusPD($pdList['id'], 1);

						$count_auto ++;

						

					}
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $pdSend);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $pdSend);
					
					$getPD_id = $this -> model_account_auto -> getPD_id($pdList['id']);

					if (intval($getPD_id['filled']) - intval($getPD_id['amount']) == 0)
					{
						$this -> model_account_auto -> updateStatusPD($pdList['id'], 1);

						$count_auto ++;

						

					}

					echo "pd < gd<br/>";
					continue;
				}

				if ($pdSend > $gdResiver) {

					$data['pd_id'] = $pdList['id'];
					$data['gd_id'] = $gdList['id'];
					$data['pd_id_customer'] = $pdList['customer_id'];
					$data['gd_id_customer'] = $gdList['customer_id'];

					if ($gdResiver > 4000000)
					{
						$gdResiver = 4000000;
					}
					if ($gdResiver < 4000000)
					{
						$gdResiver = $gdResiver;
					}

					$data['amount'] = $gdResiver;

					$id_transfer = $this -> model_account_auto -> createTransferList($data);
					$this -> model_account_auto -> updateTransferList($id_transfer);
					if ($gdResiver < 4000000)
					{
						echo "GD"."<br/>";
						$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);
					}
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $gdResiver);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $gdResiver);

					$getGD_id = $this -> model_account_auto -> getGD_id($gdList['id']);
					
					if (intval($getGD_id['amount']) - intval($getGD_id['filled']) == 0)
					{
						$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);
					}

					
					echo "pd > gd<br/>";

					continue;
				}


			}
			
			echo "Count PD ".$count_auto."<br/>";
			
		}


	}
public function updateLevel_listID($customer_id){	
		$this -> load -> model('account/customer');
		$this -> load -> model('account/auto');
		$customer_level = $this -> model_account_auto -> get_customer_update_level($customer_id);

		foreach ($customer_level as $key => $value) {
			$customer_id = $value['customer_id'];
			$customer = $this -> model_account_customer -> getCustomerCustom($customer_id);
			//level 0 
			if(intval($customer['level']) === 1){
			
			$rows =  $this -> model_account_customer ->getPNode($customer_id);

			if(count($rows) >= 6){
					//uupdate level 2;
					$this -> model_account_customer ->updateLevel($customer_id, 2);
					
				}
			}
			//level 1
			if(intval($customer['level']) === 2){
			
				$getLevel = $this -> model_account_customer ->getLevel($customer_id, 2);
			
				if(count($getLevel) >= 4){

					$this -> model_account_customer ->updateLevel($customer_id, 3);
					
				}
			}
			//level 2
			if(intval($customer['level']) === 3){
				$getLevel = $this -> model_account_customer ->getLevel($customer_id, 3);

				if(count($getLevel) >= 4){
					$this -> model_account_customer ->updateLevel($customer_id, 4);
					
				}
			}
			//level 3
			if(intval($customer['level']) === 4){
				$getLevel = $this -> model_account_customer ->getLevel($customer_id, 4);
				if(count($getLevel) >= 4){
					$this -> model_account_customer ->updateLevel($customer_id, 5);
					
				}
			}
			//level 4
			if(intval($customer['level']) === 5){
				$getLevel = $this -> model_account_customer ->getLevel($customer_id, 5);
				if(count($getLevel) >= 4){
					$this -> model_account_customer ->updateLevel($customer_id, 6);
				}
			}
			//level 5
			if(intval($customer['level']) === 6){
				$getLevel = $this -> model_account_customer ->getLevel($customer_id, 6);
				if(count($getLevel) >= 4){
					$this -> model_account_customer ->updateLevel($customer_id, 7);
				}
			}
		}
	}
	public function updateLevel($customer_id){
	
		$this -> load -> model('account/customer');
		$customer = $this -> model_account_customer -> getCustomerCustom($customer_id);
		
		//level 0 
		if(intval($customer['level']) === 1){
			
			$rows =  $this -> model_account_customer ->getPNode($customer_id);

			if(count($rows) >= 6){
				//uupdate level 2;
				$this -> model_account_customer ->updateLevel($customer_id, 2);
				
			}
		}
		//level 1
		if(intval($customer['level']) === 2){
		
			$getLevel = $this -> model_account_customer ->getLevel($customer_id, 2);
		
			if(count($getLevel) >= 4){

				$this -> model_account_customer ->updateLevel($customer_id, 3);
				
			}
		}
		//level 2
		if(intval($customer['level']) === 3){
			$getLevel = $this -> model_account_customer ->getLevel($customer_id, 3);

			if(count($getLevel) >= 4){
				$this -> model_account_customer ->updateLevel($customer_id, 4);
				
			}
		}
		//level 3
		if(intval($customer['level']) === 4){
			$getLevel = $this -> model_account_customer ->getLevel($customer_id, 4);
			if(count($getLevel) >= 4){
				$this -> model_account_customer ->updateLevel($customer_id, 5);
				
			}
		}
		//level 4
		if(intval($customer['level']) === 5){
			$getLevel = $this -> model_account_customer ->getLevel($customer_id, 5);
			if(count($getLevel) >= 4){
				$this -> model_account_customer ->updateLevel($customer_id, 6);
			}
		}
		//level 5
		if(intval($customer['level']) === 6){
			$getLevel = $this -> model_account_customer ->getLevel($customer_id, 6);
			if(count($getLevel) >= 4){
				$this -> model_account_customer ->updateLevel($customer_id, 7);
			}
		}
	}
	
	public function get_p_node($customer_id){

		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');
		$CustomerOfNode = $this -> model_account_auto -> getCustomOfNode($customer_id);
		
	
		$arrId = $customer_id.','.substr($CustomerOfNode, 1);
		
		$this -> updateLevel_listID($arrId);
	 	
	}
	public function autoAdd_R_walet() {

		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');

		$allPD = $this -> model_account_auto -> getDayFnPD();
		
		//print_r($allPD);die;

		$tmp = null;
		$tmp_count = 1;
		
		foreach ($allPD as $key => $value) {
				//check and update level
		
				$this -> get_p_node($value['customer_id']);
				$this->model_account_auto->update_PD_finish_thuong($value['id']);
				if ($tmp != $value['customer_id']) {

					$this -> model_account_auto -> update_R_Wallet($value['max_profit'], $value['customer_id']);
					$this -> model_account_customer -> saveTranstionHistory($value['customer_id'], 'R-wallet', '+ ' . number_format($value['max_profit']) . ' VND', "Your PD" . $value['pd_number']." finish", "Finish PD");
				}
					$this -> update_commission($value['customer_id'], $value['filled'], $value['pd_number']);


		}
		
	}


	public function contab_auto()
	{
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');
		// echo $tmp_count;
		$this -> model_account_customer -> update_show_gd();
		// neu het so luot PD thi khong rePD nua
		$this -> set_repd_node();
		
		// crontab ko repd sau 48 gio khoa tai khoan
		$this -> croll_tab_check_no_re_pd();

		//khong mo khoa repd trong 48h thi khoa
		$this -> lock_repd_48h();

		//dang ky qua 7 ngay ma ko kich pin khoa tai khoan
		$this -> lock_user_regsister_7_day();

		//khoa ko du pd/month
		$this -> croll_tab_check_no_pd_month();

	}

	//khong mo khoa repd trong 48h thi khoa

	public function lock_repd_48h()
	{
		$this -> load -> model('account/customer');
		$this -> load -> model('account/auto');
		$get_repd_gd = $this -> model_account_customer -> get_block_id_gd_all();
		//print_r($get_repd_gd); die;
		foreach ($get_repd_gd as $value) {
			$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Can not open lock 48h".$value['id_gd']."");
			echo $value['customer_id']."<br/>";
		}
	}

	// dang ky qua 7 ngay ma ko kich pin khoa tai khoan
	public function lock_user_regsister_7_day()
	{
		$this -> load -> model('account/customer');
		$this -> load -> model('account/auto');

		$user = $this -> model_account_auto -> lock_user_regsister_7_day();
		//print_r($user);die;
		foreach ($user as $value) {
			
			$customer = $this -> model_account_customer -> getCustomer($value['customer_id']);
			//print_r($customer['p_node']); die;
			$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"7 days without PD");

			$this -> update_c_wallet_full($customer['p_node'],500000);
			
			$this -> model_account_customer -> saveTranstionHistory(
				$customer['p_node'], 
				'C-wallet', 
				'- ' . number_format(500000) . ' VND', 
				"Reason: ".$customer['username']." did not create PD within 07 days",
				"Deduct 500.000"
			);

			echo $value['customer_id']."<br/>";
		}

	}


	public function set_repd_node()
	{
		$this -> load -> model('account/customer');
		$get_repd_gd = $this -> model_account_customer -> get_repd_gd();

		foreach ($get_repd_gd as $value) {
			$level = $this -> model_account_customer -> getTableCustomerMLByUsername($value['customer_id']);
			switch (intval($level['level'])) {
				case 1:
					$number_pd_day = 2;
					$number_pd_month = 4;
					break;
				case 2:
					$number_pd_day = 2;
					$number_pd_month = 8;
					break;
				case 3:
					$number_pd_day = 3;
					$number_pd_month = 10;
					break;
				case 4:
					$number_pd_day = 4;
					$number_pd_month = 15;
					break;
				case 5:
					$number_pd_day = 4;
					$number_pd_month = 20;
					break;
				default:
					$number_pd_day = 5;
					$number_pd_month = 25;
					break;
			}

			$GDTMP = $this -> model_account_customer ->getPDByIdssss($value['customer_id'], 1, 0);
			if (count($GDTMP) > 0) {
				$check_full_pd = $this -> model_account_customer ->check_full_pd($number_pd_month,$value['customer_id']);
				//print_r($check_full_pd); die;
				if (count($check_full_pd) == 0)
				{
					$this -> model_account_customer -> update_check_gd($value['id']);
				}
			}
		}
	}

	public function update_commission($customer_id, $amount, $pd_number)
	{
		$this->load->model('account/customer');
		$this->load->model('account/auto');
		$customer = $this->model_account_customer->getCustomerCustom($customer_id);
		$partent = $this->model_account_customer->getCustomerCustom($customer['p_node']);
		$checkC_Wallet = $this->model_account_customer->checkC_Wallet($partent['customer_id']);
		if (intval($checkC_Wallet['number']) === 0) {
			if (!$this->model_account_customer->insertC_Wallet($partent['customer_id'])) {
				die();
			}
		}

		$price = ($amount * 10) / 100;
		$this->model_account_auto->update_C_Wallet($price, $partent['customer_id']);
		$this->model_account_customer->saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . number_format($price) . ' VND', "Direct commission of 10% from " . $customer['username'] . " finish PD" . $pd_number . " (" . number_format($amount) . " VND)", "Direct commission");
		$priceCurrent = $amount;
		$levelCustomer = intval($customer['level']);
		$pNode_ID = $partent['customer_id'];

		// F1
		$child_min_id = $customer_id;
		$child_ID = $customer_id;
		$parrent_id = $partent['customer_id'];
		$customerGET = $this->model_account_customer->getCustomerCustom($pNode_ID);
		$customer_first = true;
		if (intval($customerGET['p_node']) !== 0) {
			while (true) {

				// lay thang cha trong ban Ml

				$customer_child = $this->model_account_customer->getCustomerCustom($child_ID);

				$customer_p_node = $this->model_account_customer->getCustomerCustom($pNode_ID);

				$levelPnode = intval($customer_p_node['level']);
				$levelChild = intval($customer_child['level']);
				echo ($levelChild-1) .'-'.$customer_child['username'].'======'.($levelPnode-1).'-'.$customer_p_node['username'].'<br>';
				$levelChild = $this -> get_max_level_child_node($pNode_ID, $child_min_id);

				switch ($levelPnode) {
					case 2:
						
						if ($levelPnode <= $levelChild) {
							$percent = 0;
							$percentcommission = 0 / 100;
						}
						else {
							if ($levelChild == 1) {
								$percent = 0.1;
								$percentcommission = 0.1 / 100;
							}
						}

						if ($percent > 0) {
							$this->model_account_auto->update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
							$this->model_account_customer->saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "" . $customerGET['username'] . " get " . $percent . " % commission  from - " . $customer['username'] . " finish PD" . $pd_number . " (" . number_format($amount) . " VND)", "Network commission");
						}

						break;

					case 3:
						if ($levelPnode <= $levelChild) {
							$percent = 0;
							$percentcommission = 0 / 100;
						}
						else {
							if ($levelChild == 2) {
								$percent = 0.4;
								$percentcommission = 0.4 / 100;
							}

							if ($levelChild == 1) {
								$percent = 0.5;
								$percentcommission = 0.5 / 100;
							}
						}

						if ($percent > 0) {
							$this->model_account_auto->update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
							$this->model_account_customer->saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "" . $customerGET['username'] . " Earn " . $percent . " % commission  from - " . $customer['username'] . " finish PD" . $pd_number . " (" . number_format($amount) . " VND)", "Network commission");
						}

						break;

					case 4:
						if ($levelPnode <= $levelChild) {
							$percent = 0.5;
							$percentcommission = 0.5 / 100;
						}
						else {
							if ($levelChild == 3) {
								$percent = 0.5;
								$percentcommission = 0.5 / 100;
							}
							if ($levelChild == 2) {
								$percent = 0.9;
								$percentcommission = 0.9 / 100;
							}

							if ($levelChild == 1) {
								$percent = 1;
								$percentcommission = 1 / 100;
							}
						}
						if ($percent > 0) {
							$this->model_account_auto->update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
							$this->model_account_customer->saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "" . $customerGET['username'] . " Earn " . $percent . " % commission  from - " . $customer['username'] . " finish PD" . $pd_number . " (" . number_format($amount) . " VND)", "Network commission");
						}
						break;

					case 5:
						if ($levelPnode <= $levelChild) {
							$percent = 0.5;
							$percentcommission = 0.5 / 100;
						}
						else {
							if ($levelChild == 4) {
								$percent = 2;
								$percentcommission = 2 / 100;
							}

							if ($levelChild == 3) {
								$percent = 2.5;
								$percentcommission = 2.5 / 100;
							}

							if ($levelChild == 2) {
								$percent = 2.9;
								$percentcommission = 2.9 / 100;
							}

							if ($levelChild == 1) {
								$percent = 3;
								$percentcommission = 3 / 100;
							}
						}

						$this->model_account_auto->update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
						$this->model_account_customer->saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "" . $customerGET['username'] . " Earn " . $percent . " % commission  from - " . $customer['username'] . " finish PD" . $pd_number . " (" . number_format($amount) . " VND)", "Network commission");
						break;

					case 6:
						if ($levelPnode <= $levelChild) {
							$percent = 0.5;
							$percentcommission = 0.5 / 100;
						}
						else {
							if ($levelChild == 5) {
								$percent = 2;
								$percentcommission = 2 / 100;
							}
							if ($levelChild == 4) {
								$percent = 4;
								$percentcommission = 4 / 100;
							}

							if ($levelChild == 3) {
								$percent = 4.5;
								$percentcommission = 4.5 / 100;
							}

							if ($levelChild == 2) {
								$percent = 4.9;
								$percentcommission = 4.9 / 100;
							}

							if ($levelChild == 1) {
								$percent = 5;
								$percentcommission = 5 / 100;
							}
						}

						$this->model_account_auto->update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
						$this->model_account_customer->saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "" . $customerGET['username'] . " Earn " . $percent . " % commission  from - " . $customer['username'] . " finish PD" . $pd_number . " (" . number_format($amount) . " VND)", "Network commission");
						break;
				}

				if (intval($customer_p_node['customer_id']) === 1) {
					break;
				}

				// lay tiep customer de chay len tren lay thang cha

				$pNode_ID = $customer_p_node['p_node'];
				$customerGET = $this->model_account_customer->getCustomerCustom($pNode_ID);
				$child_ID = $customer_child['p_node'];
				$customer_child = $this->model_account_customer->getCustomerCustom($child_ID);

			}
		}
	}

	
	public function get_max_level_child_node($p_node, $p_child){
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');

		// array child node
		$array_child_node = $this -> model_account_customer -> get_child_node($p_node);
		$array_child_node=explode(',', $array_child_node);
		unset($array_child_node[0]);
		// array p_node
		$array_p_node = $this -> model_account_customer -> get_p_node_from_node($p_child);
		$array_p_node=explode(',', $array_p_node);
		unset($array_p_node[0]);
		
		$array_intersect = array_intersect ($array_child_node, $array_p_node);
		array_push ($array_intersect, $p_child);
		

		// array customer_id
		$arrId = '';
		foreach ($array_intersect as $value) {
			$arrId .= ','.$value;
		}
		$arrId = substr($arrId, 1);
		$max_level_child = $this -> model_account_auto -> getMaxLevel($arrId);
		return intval($max_level_child);
		
	}
	public function get_customer_id_node(){
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');
		$CustomerOfNode = $this -> model_account_customer -> get_p_node_from_node(542);
		$CustomerOfNode=explode(',', $CustomerOfNode);
		
		unset($CustomerOfNode[0]);

		return $CustomerOfNode;
		
		// foreach ($CustomerOfNode as $value) {
		// 	$arrUsername .= ','.$value;
		// }
		// $arrUsername = substr($arrUsername, 1);
		
			
		
		
	}
	
	// sau 2 ngày hoàn thành GH mà không tạo PH sẽ khóa tài khoản
	public function croll_tab_check_no_re_pd(){
		
		$this -> load -> model('account/auto');
		$re_pd = $this-> model_account_auto -> re_pd();
		$this -> load -> model('account/block');
		$this -> load -> model('account/customer');
		
		foreach ($re_pd as $value) {

			$this -> model_account_block -> update_check_block_gd($value['id']);

			$total = $this -> model_account_block -> get_total_block_id_gd($value['customer_id']);
			if (intval($total) < 3) {
				$description ='You did not complete Re-PD';

				$return_wallet_gd = $this -> return_wallet_gd($value['customer_id']);
				//echo "<pre>"; print_r($return_wallet_gd); echo "</pre>"; die();

	        	$this -> model_account_block -> insert_block_id_gd($value['customer_id'], $description, $value['gd_number'],$return_wallet_gd['c_wallet'],$return_wallet_gd['r_wallet']);
	        	
	        	$this -> model_account_block -> update_check_gd($value['id']);
        	}
        	if (intval($total) === 3) {
        		$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Không RePD 3 lần");

        		$get_sub_cwallet_parent = $this -> get_sub_cwallet_parent($value['customer_id']);

        		$getCustomer = $this -> model_account_customer -> getCustomer($value['customer_id']);

				if (floatval($get_sub_cwallet_parent) > 0)
				{

					$this -> update_c_wallet_full($getCustomer['p_node'],$get_sub_cwallet_parent*0.1);

					$this -> model_account_customer -> saveTranstionHistory(
						$getCustomer['p_node'], 
						'C-wallet', 
						'- ' . number_format($get_sub_cwallet_parent*0.1) . ' VND', 
						"Reason: ".$getCustomer['username']." Locked account",
						"Deduct ".number_format($get_sub_cwallet_parent*0.1).""
					);
				}


        	}
        	echo $value['customer_id']."<br/>";
		}
	}

	// Khong xac nhan pd
	public function croll_tab_check_pd_no_confirm_pd() {

        //find and up status pd = 3
        $this -> load -> model('account/auto');
        $this -> load -> model('account/block');
        $this -> load -> model('account/customer');
        $query_rp = $this -> model_account_auto -> get_rp_pd();
      
        foreach ($query_rp as $key => $value) {
 			$total = $this -> model_account_block -> get_total_block_id_gd($value['customer_id']);
 			if (intval($total) < 2) {
	        	$return_wallet_pd = $this -> return_wallet_pd($value['customer_id']);
	        	
	        	$description ='You did not complete PD';

	        	$this -> model_account_block -> insert_block_id_gd($value['customer_id'], $description, "",$return_wallet_pd['c_wallet'],$return_wallet_pd['r_wallet']);

	        	$this -> model_account_auto -> update_status_report_pd($value['id']);
	        	echo $value['customer_id']."<br/>";
	        }

	        if (intval($total) >= 2) {
	        	$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Không xác nhận PD");

	        	$get_sub_cwallet_parent = $this -> get_sub_cwallet_parent($value['customer_id']);

        		$getCustomer = $this -> model_account_customer -> getCustomer($value['customer_id']);

				if (floatval($get_sub_cwallet_parent) > 0)
				{

					$this -> update_c_wallet_full($getCustomer['p_node'],$get_sub_cwallet_parent*0.1);

					$this -> model_account_customer -> saveTranstionHistory(
						$getCustomer['p_node'], 
						'C-wallet', 
						'- ' . number_format($get_sub_cwallet_parent*0.1) . ' VND', 
						"Reason: ".$getCustomer['username']." Locked account",
						"Deduct ".number_format($get_sub_cwallet_parent*0.1).""
					);
				}
	        	
	        }

	    }
    }

    
    public function croll_tab_check_no_confirm_gd() {

        $this -> load -> model('account/auto');
        $this -> load -> model('account/block');
        $this -> load -> model('account/customer');
        $query_rp = $this -> model_account_block -> get_confirm_gd_no();
      	//echo "<pre>"; print_r($query_rp); echo "</pre>"; die();
        foreach ($query_rp as $key => $value) {
        	
			$total = $this -> model_account_block -> get_total_block_id_gd($value['customer_id']);
			if (intval($total) < 3) {

				$description ='You did not complete GD';
				$return_wallet_gd = $this -> return_wallet_gd($value['customer_id']);
				
	        	$this -> model_account_block -> insert_block_id_gd($value['customer_id'], $description, $value['gd_number'],$return_wallet_gd['c_wallet'],$return_wallet_gd['r_wallet']);

	        	$this -> model_account_block -> update_check_block_gd($value['gd_id']);
        	}
        	if (intval($total) === 3) {
        		$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Không xác nhận GD 3 lần");

        		$get_sub_cwallet_parent = $this -> get_sub_cwallet_parent($value['customer_id']);

        		$getCustomer = $this -> model_account_customer -> getCustomer($value['customer_id']);

				if (floatval($get_sub_cwallet_parent) > 0)
				{

					$this -> update_c_wallet_full($getCustomer['p_node'],$get_sub_cwallet_parent*0.1);

					$this -> model_account_customer -> saveTranstionHistory(
						$getCustomer['p_node'], 
						'C-wallet', 
						'- ' . number_format($get_sub_cwallet_parent*0.1) . ' VND', 
						"Reason: ".$getCustomer['username']." Locked account",
						"Deduct ".number_format($get_sub_cwallet_parent*0.1).""
					);
				}

        	}
        	echo $value['customer_id']."<br/>";
        }       
       
    }

    // khoa sau 45 ngay ko tao duoc f1 chay ngay 31/07/2017
    public function lock_user45_day()
    {
    	die;
    	$this -> load -> model('account/block');
    	$this -> load -> model('account/auto');
    	$this -> load -> model('account/customer');

    	$maao = $this -> model_account_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);

		$get_user_45 = $this -> model_account_auto -> get_user_45_after($maao);



		foreach ($get_user_45 as $value) {

			$chec_lock_user45 = $this -> model_account_auto -> chec_lock_user45($value['customer_id']);


			if (intval($chec_lock_user45) == 0)
			{
				
				$total = $this -> model_account_block -> get_total_block_id_gd($value['customer_id']);
				if (intval($total) < 3) {
					$description ='Did not have a new member within 45 days';

					$return_wallet_gd = $this -> return_wallet_gd($value['customer_id']);
					

		        	$this -> model_account_block -> insert_block_id_gd($value['customer_id'], $description, "",$return_wallet_gd['c_wallet'],$return_wallet_gd['r_wallet']);
		        	
		        	$this -> model_account_auto -> update_lock_user45($value['customer_id']);

	        	}
	        	if (intval($total) === 3) {
	        		$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Không RePD 3 lần");


	        		$get_sub_cwallet_parent = $this -> get_sub_cwallet_parent($value['customer_id']);

	        		$getCustomer = $this -> model_account_customer -> getCustomer($value['customer_id']);

					if (floatval($get_sub_cwallet_parent) > 0)
					{
						

						$this -> update_c_wallet_full($getCustomer['p_node'],$get_sub_cwallet_parent*0.1);

						$this -> model_account_customer -> saveTranstionHistory(
							$getCustomer['p_node'], 
							'C-wallet', 
							'- ' . number_format($get_sub_cwallet_parent*0.1) . ' VND', 
							"Reason: ".$getCustomer['username']." Locked account",
							"Deduct ".number_format($get_sub_cwallet_parent*0.1).""
						);
					}


	        	}
	        	echo $value['customer_id']."<br/>";
			}
		}
    }


    // f1 sau 55 ngay ko tao PD bi khoa   
    public function f1_50_pd(){
    	$this -> load -> model('account/block');
    	$this -> load -> model('account/auto');
    	$this -> load -> model('account/customer');

    	$maao = $this -> model_account_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);

		$f1_50_pd = $this -> model_account_auto -> f1_50_pd($maao);
		
		foreach ($f1_50_pd as $value) {

			$check_f1_customer_id = $this -> model_account_auto -> check_f1_customer_id($value['customer_id']);
			
			if (intval($check_f1_customer_id) == 0 && $value['customer_id'] != 1474)
			{

				
				$total = $this -> model_account_block -> get_total_block_id_gd($value['customer_id']);
				if (intval($total) < 3) {
					$description ='Did not have a new member within 45 days';

					$return_wallet_gd = $this -> return_wallet_gd($value['customer_id']);
					

		        	$this -> model_account_block -> insert_block_id_gd($value['customer_id'], $description,$value['customer_id'],$return_wallet_gd['c_wallet'],$return_wallet_gd['r_wallet']);
		        	
	        	}
	        	if (intval($total) === 3) {
	        		$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Did not have a new member within 45 days 3");
	        	}

	        	echo $value['customer_id']."<br/>";
	        	
			}

		}
    }


    // khoa trong 1 tháng ko đạt đủ số lượng PD

    public function croll_tab_check_no_pd_month()
    {
    	//die;
    	$this -> load -> model('account/block');
    	$this -> load -> model('account/auto');
    	$this -> load -> model('account/customer');
    	/*$get_all_customer = $this -> model_account_block -> get_all_customer();
    	foreach ($get_all_customer as $value) {
    		//add all user
    		$this -> model_account_block -> insert_block_id_pd_month($value['customer_id']);

    		// add count_pd
    		$get_count_pd = $this -> model_account_block -> get_count_pd($value['customer_id']);
    		print_r($get_count_pd); 
    		$this -> model_account_block -> update_block_id_pd_month($value['customer_id'],$get_count_pd['count'],$get_count_pd['date_added']);

    	}*/

    	
    	$get_block_month_pd = $this -> model_account_block -> get_block_month_pd();
    	


    	foreach ($get_block_month_pd as $value) {
    		$get_level = $this -> model_account_block -> get_level($value['customer_id']);
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
            
            if ($value['total_pd'] < $num_pd)
            {
            	$this -> model_account_block -> update_block_pd_month($value['customer_id']);

            	//phat thang cha 500 vnd
            	$customer = $this -> model_account_customer -> getCustomer($value['customer_id']);
				
				$returnDate = $this -> model_account_customer -> update_C_Wallet(500000, $customer['p_node']);

				$this -> update_c_wallet_full($customer['p_node'],500000);


				$this -> model_account_customer -> saveTranstionHistory(
					$customer['p_node'], 
					'C-wallet', 
					'- ' . number_format(500000) . ' VND', 
					"Reason: ".$customer['username']." Did not complete minimum PD within a month",
					"Deduct 500.000"
				);

            	$total = $this -> model_account_block -> get_total_block_id_gd($value['customer_id']);
				if (intval($total) < 3) {
					$description ='Change status from ACTIVE to FROZEN Reason: Did not complete minimum PD within a month';

					$return_wallet_gd = $this -> return_wallet_gd($value['customer_id']);
					//echo "<pre>"; print_r($return_wallet_gd); echo "</pre>"; die();

		        	$this -> model_account_block -> insert_block_id_gd($value['customer_id'], $description, "",$return_wallet_gd['c_wallet'],$return_wallet_gd['r_wallet']);
		        	
		        	$this -> model_account_block -> update_check_gd($value['id']);
	        	}
	        	if (intval($total) === 3) {
	        		$this -> model_account_auto -> updateStatusCustomer($value['customer_id'],"Không đủ PD/tháng 3 lần");

	        		$get_sub_cwallet_parent = $this -> get_sub_cwallet_parent($value['customer_id']);

	        		$getCustomer = $this -> model_account_customer -> getCustomer($value['customer_id']);

					if (floatval($get_sub_cwallet_parent) > 0)
					{
						
						$this -> update_c_wallet_full($getCustomer['p_node'],$get_sub_cwallet_parent*0.1);

						$this -> model_account_customer -> saveTranstionHistory(
							$getCustomer['p_node'], 
							'C-wallet', 
							'- ' . number_format($get_sub_cwallet_parent*0.1) . ' VND', 
							"Reason: ".$getCustomer['username']." Locked account",
							"Deduct ".number_format($get_sub_cwallet_parent*0.1).""
						);
					}

	        	}

	        	echo "user block ".$value['customer_id']."<br/>";
            }
            else
            {
            	//$this -> model_account_block -> update_block_none($values['customer_id'],$values['total_pd']-$num_pd);
            	$this -> model_account_block -> update_block_none($value['customer_id'],0);
            	//echo "user not block " .$values['customer_id']."<br/>";
            }
    	}

    }

    // thong bao truoc 10 ngay neu ko du so PD trong vong 1 thang
    public function send_mail_sms_pd()
    {
    	die;
    	$this -> load -> model('account/block');
    	$this -> load -> model('account/customer');
    	$maao = $this -> model_account_customer -> get_childrend_all_tree(64);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(65);

		$maao .= $this -> model_account_customer -> get_childrend_all_tree(62);
		$maao = substr($maao, 1);
		$get_all_pd_month =  $this-> model_account_customer->get_all_pd_month($maao);

		$mang_sms = array();
		$thutu = 0;
		foreach ($get_all_pd_month as $values) {
    		$get_level = $this -> model_account_block -> get_level($values['customer_id']);
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
            if ($values['total_pd'] < $num_pd) {
            	$thutu += 1;
            	$mang_sms[$thutu]['number_pd'] = $values['total_pd'];
            	$mang_sms[$thutu]['max_pd'] = $num_pd;
            	$mang_sms[$thutu]['customer_id'] = $values['customer_id'];

            }

    	}
    	foreach ($mang_sms as $value_sms) {

    		$customer = $this -> model_account_customer -> getCustomer($value_sms['customer_id']);
    		if ($customer['email'])
    		{
    			$subject = "Notice the number of PD not enough in a month";
    			$content = '<p>Dear '.$customer['username'].'</p><p>You have '.$value_sms['max_pd'].' PD times per month, please add '.($value_sms['max_pd'] - $value_sms['number_pd']).' PD to not freezing or locking your account</p><p>If you have any question please email <a>admin@iontach.biz</a></p><p>Best regards,</p><p>iontach.biz.</p>';
    			/*$SPApiProxy = new SendpulseApi( API_USER_ID, API_SECRET, TOKEN_STORAGE );
			    $email = array(
			        'html' => $content,
			        'text' => 'text',
			        'subject' => $subject,
			        'from' => array(
			            'name' => 'Iontach Community',
			            'email' => 'admin@iontach.biz'
			        ),
			        'to' => array(
			            array(
			                'name' => 'Iontach Community',
			                'email' => $customer['email']
			            )
			        )
			    );
			    print_r($SPApiProxy->smtpSendMail($email));
				print_r($content);*/
				echo $content;
    		}
    	}
    }


    public function return_wallet_gd($customer_id){
		
        $this -> load -> model('account/block');
        $this -> load -> model('account/customer');
     
        $level = $this -> model_account_block ->getLevel_by_customerid($customer_id);
        $total_block_id_gd = $this -> model_account_customer -> get_block_id_gd_total($customer_id);		
        if (intval($total_block_id_gd) === 0) {
        	switch (intval($level['level'])) {
				case 1:
					$r_wallet = 700000;
					$c_wallet = 500000;
					break;
				case 2:
					$r_wallet = 1400000;
					$c_wallet = 1000000;
					break;
				case 3:
					$r_wallet = 2800000;
					$c_wallet = 2000000;
					break;
				case 4:
					$r_wallet = 4200000;
					$c_wallet = 4000000;
					break;
				case 5:
					$r_wallet = 7000000;
					$c_wallet = 8000000;
					break;
				case 6:
					$r_wallet = 11200000;
					$c_wallet = 16000000;
					break;
			}
		}    
        if (intval($total_block_id_gd) == 1) {
        	switch (intval($level['level'])) {
				case 1:
					$r_wallet = 2000000;
					$c_wallet = 2000000;
					break;
				case 2:
					$r_wallet = 4000000;
					$c_wallet = 4000000;
					break;
				case 3:
					$r_wallet = 7000000;
					$c_wallet = 8000000;
					break;
				case 4:
					$r_wallet = 11000000;
					$c_wallet = 16000000;
					break;
				case 5:
					$r_wallet = 16000000;
					$c_wallet = 32000000;
					break;
				case 6:
					$r_wallet = 22000000;
					$c_wallet = 64000000;
					break;
			}
        }
        if (intval($total_block_id_gd) == 2) {
        	switch (intval($level['level'])) {
				case 1:
					$r_wallet = 4000000;
					$c_wallet = 4000000;
					break;
				case 2:
					$r_wallet = 8000000;
					$c_wallet = 8000000;
					break;
				case 3:
					$r_wallet = 14000000;
					$c_wallet = 16000000;
					break;
				case 4:
					$r_wallet = 22000000;
					$c_wallet = 32000000;
					break;
				case 5:
					$r_wallet = 32000000;
					$c_wallet = 64000000;
					break;
				case 6:
					$r_wallet = 44000000;
					$c_wallet = 128000000;
					break;
			}
        }
        
        // end status = 3
        $data['r_wallet'] = $r_wallet;
        $data['c_wallet'] = $c_wallet;
       	$data['total_block_id_gd'] = intval($total_block_id_gd);
       return $data;
       
	}

	public function return_wallet_pd($customer_id){
        $this -> load -> model('account/block');
        $this -> load -> model('account/customer');
        
        $level = $this -> model_account_block ->getLevel_by_customerid($customer_id);
       	$total_block_id_gd = $this -> model_account_customer -> get_block_id_gd_total($customer_id);
        
    	if (intval($total_block_id_gd) === 0) {
    		switch (intval($level['level'])) {
				case 1:
					$r_wallet = 2000000;
					$c_wallet = 2000000;
					break;
				case 2:
					$r_wallet = 4000000;
					$c_wallet = 4000000;
					break;
				case 3:
					$r_wallet = 7000000;
					$c_wallet = 8000000;
					break;
				case 4:
					$r_wallet = 11000000;
					$c_wallet = 16000000;
					break;
				case 5:
					$r_wallet = 16000000;
					$c_wallet = 32000000;
					break;
				case 6:
					$r_wallet = 22000000;
					$c_wallet = 64000000;
					break;
			}
    	}
    	if (intval($total_block_id_gd) === 1) {

    		switch (intval($level['level'])) {
				case 1:
					$r_wallet = 4000000;
					$c_wallet = 4000000;
					break;
				case 2:
					$r_wallet = 8000000;
					$c_wallet = 8000000;
					break;
				case 3:
					$r_wallet = 14000000;
					$c_wallet = 16000000;
					break;
				case 4:
					$r_wallet = 22000000;
					$c_wallet = 32000000;
					break;
				case 5:
					$r_wallet = 32000000;
					$c_wallet = 64000000;
					break;
				case 6:
					$r_wallet = 44000000;
					$c_wallet = 128000000;
					break;
			}
    		
    	}
        	
        // end status = 3
        $data['r_wallet'] = $r_wallet;
        $data['c_wallet'] = $c_wallet;
        $data['total_block_id_gd'] = intval($total_block_id_gd);
       	return $data;
        
	}

	public function get_sub_cwallet_parent($customer_id)
	{
		$this -> load -> model('account/customer');
		return $this -> model_account_customer -> sum_PD_finish($customer_id);
	}

	public function update_c_wallet_full($customer_id,$amount)
	{
		$this -> load -> model('account/customer');
		$this -> load -> model('account/block');

		$getC_Wallet = $this -> model_account_customer -> getC_Wallet($customer_id);
		$getGD_last = $this -> model_account_customer -> getGD_last($customer_id);

		if (count($getGD_last) > 0 && doubleval($getC_Wallet['amount']) < $amount && doubleval($getGD_last['amount']) > $amount)
		{
			$this -> model_account_block -> update_GD_amount($amount , $customer_id, $getGD_last['id']);
		}
		else
		{
			$this -> model_account_customer -> update_C_Wallet($amount, $customer_id);
		}
	}
}


