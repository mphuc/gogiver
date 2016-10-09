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
		
		//get first GD
		$loop = true;
		// $count = 0;
		$i=1;
		while ($loop) {

			$gdList = $this -> model_account_auto -> getGD7Before();
			
			$pdList = $this -> model_account_auto -> getPD7Before();

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
					$this -> model_account_auto -> createTransferList($data);
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
					$this -> model_account_auto -> createTransferList($data);
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

					$this -> model_account_auto -> createTransferList($data);

					$this -> model_account_auto -> updateStatusGD($gdList['id'], 1);
					$this -> model_account_auto -> updateAmountPD($pdList['id'], $gdResiver);
					$this -> model_account_auto -> updateFilledGD($gdList['id'], $gdResiver);

					continue;
				}
			}

			echo $i.'<br>';
			$i++;
			
		}

		$get_PD_finish = $this->model_account_auto->get_PD_finish();
		
		foreach ($get_PD_finish as $value_gd) {
			$this->model_account_auto->updatePDcheck_R_Wallet($value_gd['id']);
			$this->model_account_auto->createGD($value_gd['customer_id'],'114400000');
		}
		//get GB_PD
		$getPD_GD = $this->model_account_auto -> getPD_GD();
		//print_r($getPD_GD); die;
		// create PD
		foreach ($getPD_GD as $value) {
			$this -> model_account_auto -> createPD('8800000',$value['customer_id']);
			$this -> model_account_auto -> update_check_gd($value['id']);
		}


	}
	public function thuongtructiep(){
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');
		$get_PD_finish = $this->model_account_auto -> get_PD_finish_thuong();
		foreach ($get_PD_finish as $key => $value) {
			//$this->model_account_auto->update_PD_finish_thuong($value['id']);
			$p_node = $this -> model_account_auto -> getusername($value['customer_id']);
			$this -> model_account_customer -> update_C_Wallet(2000000*0.05, $p_node['p_node'], $add = true);
			$this -> model_account_customer -> saveTranstionHistory($p_node['p_node'], 'Thưởng trực tiếp', '+ ' . (number_format(2000000*0.05)) . ' VNĐ', "5% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
			// thưởng quản lý
			$getlevel = $this -> model_account_customer -> getTableCustomerMLByUsername($p_node['p_node']);
			
			switch (intval($getlevel['level'])) {
			    case 2:
			        $percent = 1;
			        break;
			    case 3:
			        $percent = 2;
			        break;
			    case 4:
			        $percent = 3; 
			        break;
			   	case 5:
			        $percent = 4;
			        break;
			    case 6:
			        $percent = 5;
			        break;
			    default:
			        $percent = 0;
			}
			//print_r( $customer_pd); die;
			if ($percent > 0)
			{
				$this -> model_account_customer -> update_C_Wallet(2000000*$percent/100, $p_node['p_node'], $add = true);
				$this -> model_account_customer -> saveTranstionHistory($p_node['p_node'], 'Thưởng quản lý', '+ ' . (number_format(2000000*$percent/100)) . ' VNĐ', "".$percent."% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
			}
			// thưởng liên tầng
			$p_binary = $p_node['customer_id']; // get user gd
			$customer_p_binary = $this -> model_account_customer -> get_customer_by_binary($p_binary);
			//Tang 1
			$getlevel = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_p_binary['p_node']);
			//print_r($getlevel); die;
			if (intval(count($getlevel)) > 0) {
				switch (intval($getlevel['level'])) {
				    case 2:
				        $percent = 1;
				        break;
				    case 3:
				        $percent = 2;
				        break;
				    case 4:
				        $percent = 3; 
				        break;
				   	case 5:
				        $percent = 4;
				        break;
				    case 6:
				        $percent = 5;
				        break;
				    default:
				        $percent = 0;
				}
				
			if ($percent > 0){
				$this -> model_account_customer -> update_C_Wallet(2000000*$percent/100, $getlevel['customer_id'], $add = true);
					$this -> model_account_customer -> saveTranstionHistory($getlevel['customer_id'], 'Thưởng liên tầng', '+ ' . (number_format(2000000*$percent/100)) . ' VNĐ', "".$percent."% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
			}
				//Tang 2

				$customer_p_binary = $this -> model_account_customer -> get_customer_by_binary($customer_p_binary['p_node']);
				$getlevel = $this -> model_account_customer -> getTableCustomerMLByUsername($getlevel['p_node']);
						
				//print_r($customer_p_binary); die;
				if (intval(count($getlevel)) > 0) {
					switch (intval($getlevel['level'])) {
					    case 2:
					        $percent = 1;
					        break;
					    case 3:
					        $percent = 2;
					        break;
					    case 4:
					        $percent = 3; 
					        break;
					   	case 5:
					        $percent = 4;
					        break;
					    case 6:
					        $percent = 5;
					        break;
					    default:
					        $percent = 0;
					}
					if ($percent > 0){
						$this -> model_account_customer -> update_C_Wallet(2000000*$percent/100, $getlevel['customer_id'], $add = true);
					$this -> model_account_customer -> saveTranstionHistory($getlevel['customer_id'], 'Thưởng liên tầng', '+ ' . (number_format(2000000*$percent/100)) . ' VNĐ', "".$percent."% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
					}
					
					//Tang 3
					
						$getlevel = $this -> model_account_customer -> getTableCustomerMLByUsername($getlevel['p_node']);

					if (intval(count($getlevel)) > 0) {
						switch (intval($getlevel['level'])) {
						    case 4:
						        $percent = 3; 
						        break;
						   	case 5:
						        $percent = 4;
						        break;
						    case 6:
						        $percent = 5;
						        break;
						    default:
						        $percent = 0;
						}
						if ($percent > 0){
							$this -> model_account_customer -> update_C_Wallet(2000000*$percent/100, $getlevel['customer_id'], $add = true);
					$this -> model_account_customer -> saveTranstionHistory($getlevel['customer_id'], 'Thưởng liên tầng', '+ ' . (number_format(2000000*$percent/100)) . ' VNĐ', "".$percent."% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
						}
						
						//Tang 4
							$getlevel = $this -> model_account_customer -> getTableCustomerMLByUsername($getlevel['p_node']);
							
						if (intval(count($getlevel)) > 0) {
						switch (intval($getlevel['level'])) {
						   	case 5:
						        $percent = 4;
						        break;
						    case 6:
						        $percent = 5;
						        break;
						    default:
						        $percent = 0;
						}
					if ($percent > 0){
						$this -> model_account_customer -> update_C_Wallet(2000000*$percent/100, $getlevel['customer_id'], $add = true);
					$this -> model_account_customer -> saveTranstionHistory($getlevel['customer_id'], 'Thưởng liên tầng', '+ ' . (number_format(2000000*$percent/100)) . ' VNĐ', "".$percent."% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
					}
							
							//Tang 5
							
							$getlevel = $this -> model_account_customer -> getTableCustomerMLByUsername($getlevel['p_node']);
							
							if (intval(count($getlevel)) > 0 && $percent >= 4) {
								switch (intval($getlevel['level'])) {
								    case 6:
								        $percent = 5;
								        break;
								    default:
								        $percent = 0;
								}
					if ($percent > 0){
						$this -> model_account_customer -> update_C_Wallet(2000000*$percent/100, $getlevel['customer_id'], $add = true);
					$this -> model_account_customer -> saveTranstionHistory($getlevel['customer_id'], 'Thưởng liên tầng', '+ ' . (number_format(2000000*$percent/100)) . ' VNĐ', "".$percent."% từ PD ".$p_node['username']." (".number_format(2000000)." VNĐ)");
					}
						
							}
						}
					}
				}
			}


		}
	}
}
