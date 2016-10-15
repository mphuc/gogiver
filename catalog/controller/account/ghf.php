<?php
class ControllerAccountGhf extends Controller {

	public function index() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
		};
		$this -> load -> model('account/customer');
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		$customer = $this -> model_account_customer -> getCustomer($this -> customer -> getId());



		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;
		$page = isset($this -> request -> get['page']) ? $this -> request -> get['page'] : 1;

		$limit = 10;
		$start = ($page - 1) * 10;
		$pd_total = $this -> model_account_customer -> tatol_GD_child($this -> customer -> getId());
		$pd_total = $pd_total['number'];
		
		$pagination = new Pagination();
		$pagination -> total = $pd_total;
		$pagination -> page = $page;
		$pagination -> limit = $limit;
		$pagination -> num_links = 5;
		$pagination -> text = 'text';
		$pagination -> url = $this -> url -> link('account/ghf', 'page={page}', 'SSL');

		$data['gds'] = $this -> model_account_customer -> get_GD_child($this -> customer -> getId(), $limit, $start);
		
		$data['pagination'] = $pagination -> render();

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/ghf.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/ghf.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/ghf.tpl', $data));
		}
	}
	public function countDay($id =null){
		$this -> load -> model('account/pd');
		$countDayPD = $this -> model_account_pd ->CountDayPD($id);
		echo ($countDayPD['number']) > 0 ? 1 : 2;
	}
	public function countTransferID($transferid =null){
		$this -> load -> model('account/pd');
		$countDayPD = $this -> model_account_pd ->countTransferID($transferid);
		return $countDayPD['number'] > 0 ? 1 : 2;
	}

	public function payconfirm() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
		};

		!$this -> request -> get['token'] && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		$getPDCustomer = $this -> model_account_customer -> getPDByCustomerIDAndToken($this -> customer -> getId(), $this -> request -> get['token']);

		$getPDCustomer['number'] == 0 && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		$getPDCustomer = null;

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;
		$data['pd_id'] = $this -> request -> get['token'];

		$data['PdUser'] = $this -> model_account_customer -> getPDConfirm($this -> request -> get['token']);

		$data['wallet'] = $this -> config -> get('config_wallet');
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/pay_confirm.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/pay_confirm.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/pay_confirm.tpl', $data));
		}

	}

	public function PayconfirmSubmit() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};
		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> load -> model('account/pd');
		};
		//method to call function

		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));
		!array_key_exists('amount', $this -> request -> get) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		//language

		//check count customer
		$count_invoice = $this -> model_account_pd -> countPD($this -> customer -> getId());

		$count_invoice = $count_invoice['number'];
		$data['notCreate'] = false;

		if ($count_invoice > 5)
			$data['notCreate'] = true;
		//save invoice
		if (!$data['notCreate']) {
			$secret = substr(hash_hmac('ripemd160', hexdec(crc32(md5(microtime()))), 'secret'), 0, 16);

			$transferId = $this->request->get['transferid'];
			$amount = $this->request->get['amount'];

			$invoice_id = $this -> model_account_pd -> saveInvoice($this -> customer -> getId(), $secret, $amount,$transferId);

			$invoice_id === -1 && die('Server error , Please try again !!!!');
			$invoice_id_hash = hexdec(crc32(md5($invoice_id)));
			//create API Blockchainapi.org
			$my_address = $this -> request -> get['wallet'];
			//$my_address = '1KG1VBpb6LPCwUkV2DBHfMSTY5t2xSkdXX';

			//$my_address = '16uhQ2AW5beXwKj8uGXhci51r7emBhaV7N';
			$my_callback_url = HTTPS_SERVER . 'index.php?route=account/pd/callback&invoice_id=' . $invoice_id_hash . '&secret=' . $secret;
			$api_base = 'https://blockchainapi.org/api/receive';
			$response = $api_base . '?method=create&address=' . $my_address . '&callback=' . urlencode($my_callback_url);
			$fcontents = implode('', file($response));
			$object = json_decode($fcontents);
			//update input address and fee_percent
			!$this -> model_account_pd -> updateInaddressAndFree($invoice_id, $invoice_id_hash, $object -> input_address, $object -> fee_percent, $object -> destination) && die('Server Error !!!!');
			$data['wallet'] = $object -> input_address;
			//setup and check show qr code
			$data['bitcoin'] = $amount;
			!intval($data['bitcoin']) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
			$data['bitcoin'] = intval($data['bitcoin']);
		       $data['self'] = $this;
            $json['link'] = HTTPS_SERVER . 'index.php?route=account/pd/show_invoice&invoice_hash=' . $invoice_id_hash;

            $this->response->setOutput(json_encode($json));
        } else {
            $data['invoice'] = $this->model_account_pd->getAllInvoiceByCustomer_notCreateOrder($this->session->data['customer_id']);
            $json['link']    = HTTPS_SERVER . 'index.php?route=account/pd/show_invoice_pending';
            $this->response->setOutput(json_encode($json));
        }

	}

	public function show_invoice_pending()
    {
        function myCheckLoign($self)
        {
            return $self->customer->isLogged() ? true : false;
        }
        ;
        function myConfig($self)
        {
            $self->load->model('account/customer');
            $self->load->model('account/pd');
        }
        ;
        //method to call function
        !call_user_func_array("myCheckLoign", array(
            $this
        )) && $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        call_user_func_array("myConfig", array(
            $this
        ));
        $data['notCreate'] = true;
        $data['invoice']   = $this->model_account_pd->getAllInvoiceByCustomer_notCreateOrder($this->session->data['customer_id']);
        $data['self']      = $this;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/confirmPending.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/confirmPending.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/confirmPending.tpl', $data));
        }
    }
	 public function show_invoice()
    {

        function myCheckLoign($self)
        {
            return $self->customer->isLogged() ? true : false;
        }
        ;
        function myConfig($self)
        {
            $self->load->model('account/customer');
            $self->load->model('account/pd');
        }

        //method to call function
        !call_user_func_array("myCheckLoign", array(
            $this
        )) && $this->response->redirect($this->url->link('account/login', '', 'SSL'));
        call_user_func_array("myConfig", array(
            $this
        ));

        !array_key_exists('invoice_hash', $this->request->get) && die();
        $invoice_hash = $this->request->get['invoice_hash'];

        $invoice      = $this->model_account_pd->getInvoceFormHash($invoice_hash, $this->session->data['customer_id']);

        !$invoice && $this->response->redirect($this->url->link('account/login', '', 'SSL'));

        $count_invoice     = $this->model_account_pd->countPD($this->session->data['customer_id']);
        $count_invoice     = $count_invoice['number'];
        $data['notCreate'] = false;
        if ($count_invoice > 6) {
            $data['notCreate'] = true;
            $data['invoice']   = $this->model_account_token->getAllInvoiceByCustomer_notCreateOrder($this->session->data['customer_id']);
        } else {
            $data['bitcoin'] = $invoice['amount'];
            $data['wallet']  = $invoice['input_address'];
        }
        $this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;

        $data['self'] = $this;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/checkConfirmPd.tpl')) {
            $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/account/checkConfirmPd.tpl', $data));
        } else {
            $this->response->setOutput($this->load->view('default/template/account/checkConfirmPd.tpl', $data));
        }
    }

	public function callback() {

		$this -> load -> model('account/pd');
		$this -> load -> model('account/auto');
		$this -> load -> model('account/customer');

		$invoice_id_hash = array_key_exists('invoice_id', $this -> request -> get) ? $this -> request -> get['invoice_id'] : "Error";
		$secret = array_key_exists('secret', $this -> request -> get) ? $this -> request -> get['secret'] : "Error";
		$value_in_satoshi = array_key_exists('value', $this -> request -> get) ? $this -> request -> get['value'] : "Error";
		$confirmations = array_key_exists('confirmations', $this -> request -> get) ? $this -> request -> get['confirmations'] : "Error";
		$input_address = array_key_exists('input_address', $this -> request -> get) ? $this -> request -> get['input_address'] : "Error";
		$transaction_hash = array_key_exists('transaction_hash', $this -> request -> get) ? $this -> request -> get['transaction_hash'] : "Error";
		$input_transaction_hash = array_key_exists('input_transaction_hash', $this -> request -> get) ? $this -> request -> get['input_transaction_hash'] : "Error";
		//check invoice

		$invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id_hash, $secret, $input_address);

		count($invoice) === 0 && die();

		$received = intval($invoice['received']) + intval($value_in_satoshi);
		$this -> model_account_pd -> updateReceived($value_in_satoshi, $invoice_id_hash);
		$invoice = $this -> model_account_pd -> getInvoiceByIdAndSecret($invoice_id_hash, $secret, $input_address);
		$received = intval($invoice['received']);



		if ($received >= intval($invoice['amount'])) {
			//update Pin User
			//Update total amount PD
			//$this -> model_account_customer ->update_total_pd($invoice['customer_id'], $invoice['amount']);
			//update confirm

			//========================================
			$this -> model_account_pd -> updateConfirm($invoice_id_hash, $confirmations, $transaction_hash, $input_transaction_hash);
			//update Pin User
			// $this -> model_account_pd -> updateStatusPDTransfer10Percent($invoice['transfer_id'],$invoice['link_hash']);
			$this -> model_account_customer -> updateStatusPDTransferList($invoice['transfer_id'], $transaction_hash, $input_transaction_hash);
			$Customer_Tranferlist = $this -> model_account_customer -> getPDByTranferID($invoice['transfer_id']);
			$PDCustomer = $Customer_Tranferlist['pd_id'];
			//count PD status tu transfer list check xem con dong du lieu nao chua finish
			//neu chua finish thi chua cho finish
			$GDCustomer = $Customer_Tranferlist['gd_id'];
			$PDDetail = $this -> model_account_customer -> getPDConfirm($PDCustomer);
			$customer = $this -> model_account_customer ->getCustomer($invoice['customer_id']);

			$partent = $this -> model_account_customer ->getCustomer($customer['p_node']);
			$partent_node = $this -> model_account_customer -> getCustomerCustom($partent['customer_id']);
			//get PdGD
			$getPD = $this -> model_account_customer -> getAllPDByTranferID($PDCustomer);
			$getGD = $this -> model_account_customer -> getAllGDByTranferID($GDCustomer);

			$checkPD = (intval($getPD['filled']) == intval($getPD['amount'])) ? 1 : -1;
			$checkGD = (intval($getGD['amount']) == intval($getGD['filled'])) ? 1 : -1;
			//count status
			$countNotPDFinsh = $this -> model_account_customer -> countStatusPDTransferList($PDCustomer);

			$countNotGDFinish = $this -> model_account_customer -> countStatusGDTransferList($GDCustomer);


			if(count($countNotPDFinsh) > 0 && intval($countNotPDFinsh['number']) === 0 && $checkPD == 1) {

				// Hoa hồng bảo trợ F1
				if (intval($PDDetail['cycle']) == 0 && count($partent) > 0 && intval($partent_node['level'] == 2)) {
					$checkC_Wallet = $this -> model_account_customer -> checkC_Wallet($partent['customer_id']);

					if (intval($checkC_Wallet['number']) === 0) {
						if (!$this -> model_account_customer -> insertC_Wallet($partent['customer_id'])) {
							die();
						}
					}


					$dataPD = $this -> model_account_customer -> getPD($partent['customer_id']);

					$parrent_Amount_PD = $this -> model_account_customer -> getAmountPD($partent['customer_id']);

					$parrent_Amount_PD = intval($parrent_Amount_PD);
					$amountPD = $getPD['filled'];

					if ($parrent_Amount_PD == (0.5*100000000)) {
							$price = $amountPD;
							$price=$price*0.05;
							$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
							$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . ($price/100000000) . ' BTC', "Sponsor 5% for ".$customer['username']." finish PD" . $invoice['transfer_id']." (".doubleval($amountPD/100000000)." BTC)");


					} elseif ($parrent_Amount_PD >= (1*100000000) && $parrent_Amount_PD <= (4.5*100000000)) {

						if ($amountPD == (0.5*100000000)) {
							$price = $amountPD;
							$price=$price*0.05;
							$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
							$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . ($price/100000000) . ' BTC', "Sponsor 5% for ".$customer['username']." finish PD" . $invoice['transfer_id']." (".doubleval($amountPD/100000000)." BTC)");
						}
						if ($amountPD >= (1*100000000) && $amountPD <= (5*100000000)) {
							$price = $amountPD;
							$price=$price*0.1;
							$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
							$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . ($price/100000000) . ' BTC', "Sponsor 10% for ".$customer['username']." finish PD" . $invoice['transfer_id']." (".doubleval($amountPD/100000000)." BTC)");
						}

					} else {

						if ($amountPD == (0.5*100000000)) {
							$price = $amountPD;
							$price=$price*0.05;
							$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
							$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . ($price/100000000) . ' BTC', "Sponsor 5% for ".$customer['username']." finish PD" . $invoice['transfer_id']." (".doubleval($amountPD/100000000)." BTC)");
						}
						if ($amountPD >= (1*100000000) && $amountPD <= (4.5*100000000)) {
							$price = $amountPD;
							$price=$price*0.1;
							$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
							$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . ($price/100000000) . ' BTC', "Sponsor 10% for ".$customer['username']." finish PD" . $invoice['transfer_id']." (".doubleval($amountPD/100000000)." BTC)");
						}
						if ($amountPD == (5*100000000)) {
							$price = $amountPD;
							$price=$price*0.2;
							$this -> model_account_auto -> update_C_Wallet($price, $partent['customer_id']);
							$this -> model_account_customer -> saveTranstionHistory($partent['customer_id'], 'C-wallet', '+ ' . ($price/100000000) . ' BTC', "Sponsor 20% for ".$customer['username']." finish PD" . $invoice['transfer_id']." (".doubleval($amountPD/100000000)." BTC)");
						}

					}

				}

				$this -> model_account_customer ->updateLevel($invoice['customer_id'], 2);
				$this -> model_account_customer -> updateStusPDActive($PDCustomer);
				$this -> model_account_customer -> updateCheck_R_WalletPD($PDCustomer);
				$this -> model_account_customer -> updateStusGDActive($GDCustomer);

				//=======================update maxprofit==============
				$percent = floatval($this -> config -> get('config_percentcommission'));
				$percentcommission = floatval($percent / 100);

				$PD = $this -> model_account_pd -> getPD($PDCustomer);
				$max_profit = $PD['filled'] * $percentcommission;
				$this -> model_account_pd -> updateDatefinishPD($PDCustomer, $max_profit);


				//update pd left and right
				//get customer_ml p_binary
				$customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($invoice['customer_id']);
				$customer_first = true ;
				if(intval($customer_ml['p_binary']) !== 0){
					while (true) {

						//lay thang cha trong ban Ml
						$customer_ml_p_binary = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_ml['p_binary']);

						if($customer_first){
							//kiem tra la customer dau tien vi day la gia tri callback mac dinh
							if(intval($customer_ml_p_binary['left']) === intval($invoice['customer_id']) )  {
								//nhanh trai
								$this -> model_account_customer -> update_pd_binary(true, $customer_ml_p_binary['customer_id'], $PD['filled'] );

							}else{
								//nhanh phai
								$this -> model_account_customer -> update_pd_binary(false, $customer_ml_p_binary['customer_id'], $PD['filled'] );
							}
							$customer_first = false;
						}else{

							if(intval($customer_ml_p_binary['left']) === intval($customer_ml['customer_id']) ) {
								//nhanh trai
								$this -> model_account_customer -> update_pd_binary(true, $customer_ml_p_binary['customer_id'], $PD['filled'] );

							}else{
								//nhanh phai
								$this -> model_account_customer -> update_pd_binary(false, $customer_ml_p_binary['customer_id'], $PD['filled'] );
							}
						}



						if(intval($customer_ml_p_binary['customer_id']) === 1){
							break;
						}
						//lay tiep customer de chay len tren lay thang cha
						$customer_ml = $this -> model_account_customer -> getTableCustomerMLByUsername($customer_ml_p_binary['customer_id']);

					}
				}

			}
			if (count($countNotGDFinish) > 0 && intval($countNotGDFinish['number']) === 0 && $checkGD == 1) {
				$this -> model_account_customer -> updateStusGD($GDCustomer);
			}
			//==============================
		}
	}

	public function create() {

		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> document -> addScript('catalog/view/javascript/pd/create.js');
			$self -> load -> model('account/customer');

		};

		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		$CheckPDUpdate = $this -> model_account_customer -> getCheckPD($this -> customer -> getId());

		$data['count'] = $CheckPDUpdate['check_PD'];

		 $customer = $this->model_account_customer->getCustomer($this->session->data['customer_id']);

        $data['wallet'] = $customer['wallet'] !== '';


		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/pd_create.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/pd_create.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/pd_create.tpl', $data));
		}
	}

	public function submit() {

		$json['login'] = $this -> customer -> isLogged() ? 1 : -1;

		if ($this -> customer -> isLogged() && $this -> request -> get['amount'] && $this -> request -> get['Password2']) {
			$this -> load -> model('account/customer');
			$this -> load -> model('account/pd');
			$variablePasswd = $this -> model_account_customer -> getPasswdTransaction($this -> request -> get['Password2']);

			$json['password'] = $variablePasswd['number'] === '0' ? -1 : 1;

			// $checkgd = $this -> model_account_customer -> getTotalGD($this -> customer -> getId());
			// $json['checkgd'] = $checkgd['number'] === '0' ? -1 : 1;

			// $checkpd = $this -> model_account_customer -> getTotalPD($this -> customer -> getId());
			// $json['checkpd'] = ($checkpd['number'] > 0) ? -1 : 1;

			$customer = $this -> model_account_customer -> getCustomer($this -> customer -> getId());

			$checkAccount_holder = $customer['account_holder'];

			if (intval($customer['ping']) <= 2) {
				// /$this -> response -> redirect($this -> url -> link('account/token/order', 'token='.$pd['id'].'', 'SSL'));
				$json['pin'] = -1;
			} else {
				$json['pin'] = 1;
			}

			//khong check pin cho Pd
			$json['pin'] = 1;

			$pd_total = $this -> model_account_customer -> getStatusPD();
			$pd_total = $pd_total['pdtotal'];

			$json['checkWaiting'] = $pd_total > 0 ? -1 : 1;
			$json['checkCountDay'] = 1;

			if ($json['password'] === 1 && $json['pin'] === 1 && $json['checkCountDay'] === 1 && $json['checkWaiting'] === 1) {

				$amount = $this -> request -> get['amount'];
				$amount = $amount * 100000000;

				if($amount == 50000000){
					$amountPin = 1;
				}
				if($amount >= 100000000 && $amount <= 450000000){
					$amountPin = 2;
				}

				if($amount >= 500000000){
					$amountPin = 5;
				}
				if (intval($customer['ping']) < $amountPin) {
					$json['pin'] = -1;
					$json['ok'] = -1;
				}else{
					$max_profit = 0;
					// $subPin = intval($customer['ping']) - 1;
					$this -> model_account_customer -> updatePin($this -> customer -> getId(), intval($customer['ping']) - intval($amountPin));
					$pd_query = $this -> model_account_customer -> createPD($amount, $max_profit);
					$id_history = $this -> model_account_customer -> saveHistoryPin($this -> customer -> getId(), '-' . $amountPin, 'Used pin for PD' . $pd_query['pd_number'], 'PD', 'Used pin for PD' . $pd_query['pd_number']);

					// UP date Cycle IN tbl sm_Customer
					$this->model_account_customer->ResetCycleAddCustomer($this -> customer -> getId());
					//====================================================================
					//20% cho cong dong
					//$pdsendCommon = ($amountPD*20)/100;
					// $gdList = $this -> model_account_pd -> getGDBefore();
					$loop = true;
					while ($loop) {
						$pdList = $this -> model_account_pd -> getPDNow($pd_query['pd_id']);
						$gdList = $this -> model_account_pd -> getGDBefore();
						if ($pdList['filled'] === $pdList['amount']) {
							$loop = false;
							break;
						}
						if (count($gdList) === 0) {
							//get customer in inventory
							$inventory = $this -> model_account_pd -> getCustomerInventory();
							$pdSend = intval($pdList['filled'] - $pdList['amount']);
							$inventoryID = $inventory['customer_id'];
							//create GD cho inventory
							$inventoryGD = $this -> model_account_pd -> createGDInventory($pdSend, $inventoryID);
							$data['pd_id'] = $pd_query['pd_id'];
							$data['gd_id'] = $inventoryGD['gd_id'];
							$data['pd_id_customer'] = $pdList['customer_id'];
							$data['gd_id_customer'] = $inventoryID;
							$data['amount'] = $pdSend;

							$id_transfer = $this -> model_account_pd -> createTransferList($data);
							$this -> model_account_pd -> updateTransferList($id_transfer);



							$this -> model_account_pd -> updateTotalAmountPD($pdList['id'], $pdSend);
							$this -> model_account_pd -> updateFilledGD($inventoryGD['gd_id'], $pdSend);
							$this -> model_account_pd -> updateStatusGD($inventoryGD['gd_id'], 1);
						}

						if ($gdList) {
							$pdSend = intval($pdList['filled'] - $pdList['amount']);
							$gdResiver = intval($gdList['amount'] - $gdList['filled']);
							if ($pdSend === $gdResiver) {
								$data['pd_id'] = $pdList['id'];
								$data['gd_id'] = $gdList['id'];
								$data['pd_id_customer'] = $pdList['customer_id'];
								$data['gd_id_customer'] = $gdList['customer_id'];
								$data['amount'] = $pdSend;

								$id_transfer = $this -> model_account_pd -> createTransferList($data);
								$this -> model_account_pd -> updateTransferList($id_transfer);

								$this -> model_account_pd -> updateStatusGD($gdList['id'], 1);

								$this -> model_account_pd -> updateTotalAmountPD($pdList['id'], $pdSend);
								$this -> model_account_pd -> updateFilledGD($gdList['id'], $pdSend);
							}
							if ($pdSend < $gdResiver) {
								$data['pd_id'] = $pdList['id'];
								$data['gd_id'] = $gdList['id'];
								$data['pd_id_customer'] = $pdList['customer_id'];
								$data['gd_id_customer'] = $gdList['customer_id'];
								$data['amount'] = $pdSend;

								$id_transfer = $this -> model_account_pd -> createTransferList($data);
								$this -> model_account_pd -> updateTransferList($id_transfer);

								$this -> model_account_pd -> updateTotalAmountPD($pdList['id'], $pdSend);

								$this -> model_account_pd -> updateFilledGD($gdList['id'], $pdSend);
							}
							if ($pdSend > $gdResiver) {
								$data['pd_id'] = $pdList['id'];
								$data['gd_id'] = $gdList['id'];
								$data['pd_id_customer'] = $pdList['customer_id'];
								$data['gd_id_customer'] = $gdList['customer_id'];
								$data['amount'] = $gdResiver;

								$id_transfer = $this -> model_account_pd -> createTransferList($data);
								$this -> model_account_pd -> updateTransferList($id_transfer);

								$this -> model_account_pd -> updateStatusGD($gdList['id'], 1);
								$this -> model_account_pd -> updateTotalAmountPD($pdList['id'], $gdResiver);

								$this -> model_account_pd -> updateFilledGD($gdList['id'], $gdResiver);

							}
						}

					}
					//====================================================================

						$json['data_link']= $this->url->link('account/pd/trade&token='.$pd_query['pd_id'].'');
						$json['ok'] = 1;
				}

			} else{
				$json['ok'] = -1;
			}

			$this -> response -> setOutput(json_encode($json));
		}
	}

	public function transfer() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
		};

		!$this -> request -> get['token'] && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));

		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;

		$getPDCustomer = $this -> model_account_customer -> getPDByCustomerIDAndToken($this -> customer -> getId(), $this -> request -> get['token']);

		$getPDCustomer['number'] === 0 && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		$getPDCustomer = null;

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		//get pd form transfer list
		$PdUser = $this -> model_account_customer -> getPD($this -> customer -> getId());

		$checkPdOfUser = null;
		foreach ($PdUser as $key => $value) {
			if ($value['id'] === $this -> request -> get['token']) {
				$checkPdOfUser = true;
				break;
			}
		}

		!$checkPdOfUser && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));

		$data['transferList'] = $this -> model_account_customer -> getPdFromTransferList($this -> request -> get['token']);

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/pd_transfer.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/pd_transfer.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/pd_transfer.tpl', $data));
		}
	}

	public function confirm() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
			$self -> document -> addScript('catalog/view/javascript/pd/confirm.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));
		//language
		$this -> load -> model('account/customer');
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		//get image

		!$this -> request -> get['token'] && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));

		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		$data['transferConfirm'] = $this -> model_account_customer -> getPDTranferByID($this -> request -> get['token']);

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/pd_confirm.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/pd_confirm.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/pd_confirm.tpl', $data));
		}
	}

	public function confirmSubmit() {
		$json['login'] = $this -> customer -> isLogged() ? 1 : -1;
		$json['ok'] = -1;

		if ($this -> customer -> isLogged() && $this -> request -> post['token']) {
			$this -> load -> model('account/customer');

			$filename = html_entity_decode($this -> request -> files['avatar']['name'], ENT_QUOTES, 'UTF-8');

			$filename = str_replace(' ', '_', $filename);
			if (!$filename || !$this -> request -> files) {
				die();
			}

			$file = $this -> request -> post['token'] . '_' . $filename . '.' . md5(mt_rand());

			move_uploaded_file($this -> request -> files['avatar']['tmp_name'], DIR_UPLOAD . $file);

			//save image profile
			$server = $this -> request -> server['HTTPS'] ? $this -> config -> get('config_ssl') : $this -> config -> get('config_url');
			$linkImage = $server . 'system/upload/' . $file;

			$this -> model_account_customer -> updateStatusPDTransferList($this -> request -> post['token'], $linkImage);
			// die('999');
			//get PDID
			$Customer_Tranferlist = $this -> model_account_customer -> getPDByTranferID($this -> request -> post['token']);

			$PDCustomer = $Customer_Tranferlist['pd_id'];
			//count PD status tu transfer list check xem con dong du lieu nao chua finish
			//neu chua finish thi chua cho finish
			$GDCustomer = $Customer_Tranferlist['gd_id'];

			//count status
			$countNotPDFinsh = $this -> model_account_customer -> countStatusPDTransferList($PDCustomer);

			$countNotGDFinish = $this -> model_account_customer -> countStatusGDTransferList($GDCustomer);

			if (count($countNotPDFinsh) > 0 && intval($countNotPDFinsh['number']) === 0) {

				$this -> model_account_customer -> updateStusPD($PDCustomer);
				$this -> model_account_customer -> updateCheck_R_WalletPD($PDCustomer);
			}
			if (count($countNotGDFinish) > 0 && intval($countNotGDFinish['number']) === 0) {
				$this -> model_account_customer -> updateStusGD($GDCustomer);
			}
			$json['ok'] = 1;
		}

		$this -> response -> setOutput(json_encode($json));
	}
	public function get_invoice_transfer_id($transfer_id){

		$this -> load -> model('account/pd');
		$transfer_id = $this->model_account_pd -> countTransferID($transfer_id);
		$transfer_id = $transfer_id['number'];
		return $transfer_id;
	}
	public function trade() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};
		function myConfig($self) {
			$self -> load -> model('account/customer');
			$self -> load -> model('account/pd');
			$self -> document -> addScript('catalog/view/javascript/countdown/jquery.countdown.min.js');
			$self -> document -> addScript('catalog/view/javascript/pd/countdown.js');
			$self -> document -> addScript('catalog/view/javascript/pd/confirm.js');
		};
		!$this -> request -> get['token'] && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));
		if (isset($this -> session -> data['success'])) {
			$data['success'] = 'Create provide donation successfull!';
			unset($this -> session -> data['success']);
		} else {
			$data['success'] = '';
		}

		$getLanguage = $this -> model_account_customer -> getLanguage($this -> customer -> getId());
		$language = new Language($getLanguage);
		$language -> load('account/pd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;
		$data['priceBTC'] = (float)$this -> config -> get('config_price_btc_now');
		$data['wallet'] = $this -> config -> get('config_wallet');

		$getPDCustomer = $this -> model_account_customer -> getPDByCustomerIDAndToken($this -> customer -> getId(), $this -> request -> get['token']);
		$getPDCustomer['number'] === 0 && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));
		$getPDCustomer = null;
		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;
		//get pd form transfer list
		$data['invoice']   = $this->model_account_pd->getAllInvoiceByCustomer_notCreateOrder($this->session->data['customer_id']);

		$PdUser = $this -> model_account_customer -> getPD($this -> customer -> getId());

		$checkPdOfUser = null;
		foreach ($PdUser as $key => $value) {
			if ($value['id'] === $this -> request -> get['token']) {
				$checkPdOfUser = true;
				break;
			}
		}
		!$checkPdOfUser && $this -> response -> redirect($this -> url -> link('account/dashboard', '', 'SSL'));

		$data['transferList'] = $this -> model_account_customer -> getPdFromTransferList($this -> request -> get['token']);


		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/pd_trade.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/pd_trade.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/pd_trade.tpl', $data));
		}
	}

}
