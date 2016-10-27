<?php

class ControllerAccountAuto extends Controller {

	public function auto_create_pd_new_user(){
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');
		$users = $this -> model_account_auto -> new_user_pd();

		foreach ($users as $key => $value) {
			$amount = 2000000;
			$max_profit = 3000000;
			$customer_id = $value['customer_id'];

			$pd_ID = $this -> model_account_auto-> create_PD($amount, $value['customer_id'] , $max_profit);
		
			$pd_number = hexdec( crc32($pd_ID) );

			$this -> model_account_auto-> update_pd_number($pd_ID, $pd_number);

			$quy_bo_tro = $this -> model_account_auto ->get_gd_quy_bo_tro();

			//update date quy_bao_tro theo vong

			$this -> model_account_auto -> update_date_last(intval($quy_bo_tro['customer_id']));

			$id_gd = $this -> model_account_auto -> create_GD($quy_bo_tro['customer_id'], $amount, $amount);

			$getPD = $this -> model_account_auto -> getPD_all($customer_id);


			$getGD = $this -> model_account_auto -> getGD_all($id_gd);

			$this -> model_account_auto -> create_tranfer_list(
				$getPD['id'],$getGD['id'],
				$getPD['customer_id'],
				$getGD['customer_id'],
				$getPD['amount'],
				$getPD['status'],
				$getGD['status']
			);

			$this -> model_account_auto -> updateCryle($customer_id, 2);

			$title = "PD - Cho Leader";
			$sub = $value['username'] ." PD - Cho " .$quy_bo_tro['username'];

			$mess = "ID [".$value['username'] ."] đã khớp lệnh với [". $quy_bo_tro['username']."] mời vào website để xem hóa đơn của người PH - Cho";

			$this -> emailQuyBaoTro($title  , $sub , $mess);

		}
		
	}


	function emailQuyBaoTro($title ,$sub, $mess){
		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo('phucnguyen@icsc.vn');
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($title, ENT_QUOTES, 'UTF-8'));
		$mail->setSubject($sub);
		$mail->setText($mess);
		$mail->send();
	}


	public function autoPDGD() {
		$this -> load -> model('account/auto');
		$this -> load -> model('customize/register');
		$this -> load -> model('account/pd');
		$this -> load -> model('account/customer');

		$loop = true;
		
		// $count = 0;
		$i=1;
		while ($loop) {

			$gdList = $this -> model_account_auto -> getGD7Before();
			//echo "<pre>"; print_r($gdList); echo "</pre>"; die();
			$pdList = $this -> model_account_auto -> getPD7Before();
		 //echo "<pre>"; print_r($pdList); echo "</pre>"; die();
			if(count($gdList) === 0 && count($pdList) > 0){

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

				if ($pdSend === $gdResiver) {

					$data['pd_id'] = $pdList['id'];
					$data['gd_id'] = $gdList['id'];
					$data['pd_id_customer'] = $pdList['customer_id'];
					$data['gd_id_customer'] = $gdList['customer_id'];
					$data['amount'] = $pdSend;
					$id_transfer = $this -> model_account_auto -> createTransferList($data);
					$this -> model_account_auto -> updateTransferList($id_transfer);
					
					$this -> model_account_auto -> updateStatusPD($pdList['id'], 1);
					$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $pdSend);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $pdSend);
					continue;
				}

				if ($pdSend < $gdResiver) {
					$data['pd_id'] = $pdList['id'];
					$data['gd_id'] = $gdList['id'];
					$data['pd_id_customer'] = $pdList['customer_id'];
					$data['gd_id_customer'] = $gdList['customer_id'];
					$data['amount'] = $pdSend;
					$id_transfer = $this -> model_account_auto -> createTransferList($data);
					$this -> model_account_auto -> updateTransferList($id_transfer);
					$this -> model_account_auto -> updateStatusPD($pdList['id'], 1);
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $pdSend);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $pdSend);
					continue;

				}

				if ($pdSend > $gdResiver) {

					$data['pd_id'] = $pdList['id'];
					$data['gd_id'] = $gdList['id'];
					$data['pd_id_customer'] = $pdList['customer_id'];
					$data['gd_id_customer'] = $gdList['customer_id'];
					$data['amount'] = $gdResiver;

					$id_transfer = $this -> model_account_auto -> createTransferList($data);
					$this -> model_account_auto -> updateTransferList($id_transfer);

					$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $gdResiver);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $gdResiver);

					continue;
				}
			}
			die();
			echo $i.'<br>';
			$i++;
			
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
	 	 // $this -> model_account_customer -> DeleteCustomer($arrUsername);
	 	 // $this -> model_account_customer -> DeleteCustomerML($arrUsername);
			
		
		
	}
	public function autoAdd_R_walet() {

		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');

		$allPD = $this -> model_account_auto -> getDayFnPD();
		

		$tmp = null;
		$tmp_count = 1;
		
		foreach ($allPD as $key => $value) {
				//check and update level
		
			$this -> get_p_node($value['customer_id']);
				$this->model_account_auto->update_PD_finish_thuong($value['id']);
				if ($tmp != $value['customer_id']) {

					$this -> model_account_auto -> update_R_Wallet($value['max_profit'], $value['customer_id']);
					$this -> model_account_customer -> saveTranstionHistory($value['customer_id'], 'R-wallet', '+ ' . number_format($value['max_profit']) . ' VND', "Your PD" . $value['pd_number'])." finish", "Finish PD";
				}
					$this -> update_commission($value['customer_id'], $value['filled'], $value['pd_number']);


		}
		// echo $tmp_count;
	}
	public function update_commission($customer_id, $amount, $pd_number){
		
		$this->load->model('account/customer');
   		$this->load->model('account/auto');
        $customer = $this -> model_account_customer -> getCustomerCustom($customer_id);
        $partent = $this -> model_account_customer -> getCustomerCustom($customer['p_node']);
        $checkC_Wallet = $this -> model_account_customer -> checkC_Wallet($partent['customer_id']);

			if (intval($checkC_Wallet['number']) === 0) {
				if (!$this -> model_account_customer -> insertC_Wallet($partent['customer_id'])) {
					die();
				}
			}	

			$price = ($amount * 10) / 100;

			$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
			$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . number_format($price) . ' VND', "Direct bonus of 10% from ".$customer['username']." finish PD" . $pd_number." (".number_format($amount)." VND)", "Direct Bonus");
	        $priceCurrent = $amount; 
	        $levelCustomer = intval($customer['level']);
	        $pNode_ID = $partent['customer_id'];
	        //F1
	        $customerGET = $this->model_account_customer->getCustomerCustom($pNode_ID);
			$customer_first = true ;
			if(intval($customerGET['p_node']) !== 0){
				while (true) {
					//lay thang cha trong ban Ml
					$customer_p_node = $this -> model_account_customer -> getCustomerCustom($pNode_ID);

					if (intval($customer_p_node['level']) >= 2) {
							
						switch (intval($customer_p_node['level'])) {
							case 2 :
								$percent = 0.2;
								$percentcommission =0.2/100;
								$this -> model_account_auto -> update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
								$this -> model_account_customer -> saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "".$customerGET['username']." Earn ".$percent." % commission  from - ".$customer['username']." finish PD" . $pd_number." (".number_format($amount)." VND)", "Indirect Bonus");
								break;
							case 3 :	
								
								$percent = 0.5;
								$percentcommission =0.5/100;
								$this -> model_account_auto -> update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
								$this -> model_account_customer -> saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "".$customerGET['username']." Earn ".$percent." % commission  from - ".$customer['username']." finish PD" . $pd_number." (".number_format($amount)." VND)", "Indirect Bonus");
								
								break;
							case 4 :	
								
								$percent = 3;
								$percentcommission =3/100;
								$this -> model_account_auto -> update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
								$this -> model_account_customer -> saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "".$customerGET['username']." Earn ".$percent." % commission  from - ".$customer['username']." finish PD" . $pd_number." (".number_format($amount)." VND)", "Indirect Bonus");
							
								break;
							case 5 :	
								
								$percent = 5;
								$percentcommission =5/100;
								$this -> model_account_auto -> update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
								$this -> model_account_customer -> saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "".$customerGET['username']." Earn ".$percent." % commission  from - ".$customer['username']." finish PD" . $pd_number." (".number_format($amount)." VND)", "Indirect Bonus");
								
								break;
							case 6 :	
								
								$percent = 7;
								$percentcommission =7/100;
								$this -> model_account_auto -> update_C_Wallet($priceCurrent * $percentcommission, $customer_p_node['customer_id']);
								$this -> model_account_customer -> saveTranstionHistory($customer_p_node['customer_id'], 'C-wallet', '+ ' . number_format($priceCurrent * $percentcommission) . ' VND', "".$customerGET['username']." Earn ".$percent." % commission  from - ".$customer['username']." finish PD" . $pd_number." (".number_format($amount)." VND)", "Indirect Bonus");
								
								break;
							
						}

					}
					if(intval($customer_p_node['customer_id']) === 1){
						break;
					}
					//lay tiep customer de chay len tren lay thang cha
					$pNode_ID = $customerGET['p_node'];
					$customerGET = $this->model_account_customer->getCustomerCustom($pNode_ID);


				} 
			}
	}
	
	// sau 3 ngày hoàn thành GH mà không tạo PH sẽ khóa tài khoản
	public function re_pd(){
		$this -> load -> model('account/auto');
		$re_pd = $this-> model_account_auto -> re_pd();
		
		foreach ($re_pd as $value) {

			$this -> model_account_auto -> update_status_customer($value['customer_id']);
			
		}
	}

	// public function thuongtructiep_bk(){
	// 	$this -> load -> model('account/auto');
	// 	$this -> load -> model('account/customer');
	// 	$get_PD_finish = $this->model_account_auto -> get_PD_finish_thuong();
	// 	foreach ($get_PD_finish as $key => $value) {
	// 		$this->model_account_auto->update_PD_finish_thuong($value['id']);
	// 		$p_node = $this -> model_account_auto -> getusername($value['customer_id']);
	// 		$this -> model_account_customer -> update_C_Wallet(8800000*0.1, $p_node['p_node'], $add = true);
	// 		$this -> model_account_customer -> saveTranstionHistory($p_node['p_node'], 'Thưởng trực tiếp', '+ ' . (number_format(8800000*0.1)) . ' VNĐ', "10% từ PD ".$p_node['username']." (".number_format(8800000)." VNĐ)");
	// 	}
	// }
}


