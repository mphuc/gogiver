<?php

class ControllerAccountAccount extends Controller {
	
	public function add_cus()
	{
		$this -> load-> model('account/customer');
		$array_customer = array(64,65,62);
		$customer_id = $array_customer[array_rand($array_customer)];
		
		$get_childrend_all = $this -> model_account_customer -> get_childrend_all_tree($customer_id);
		$get_childrend_all = (substr($get_childrend_all, 1));

		$get_childrend_alls = explode(",", $get_childrend_all);

		$p_node_rand = $get_childrend_alls[array_rand($get_childrend_alls)];
		$username = $_GET['username'];
		$account_holder = '';
		if ($_GET['pass'] == '2414')
		{
			echo $this -> model_account_customer -> addCustomer_abc($p_node_rand,$username,$account_holder);
		}
		

	}

	public function send_mail()
	{
		
		$mail = new Mail();
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
			');
		
		$mail -> send();
		
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
					<th style="border: 1px solid #ccc">customer_id</th>
					<th style="border: 1px solid #ccc">amount PD (filled)</th>
					<th style="border: 1px solid #ccc">amount PD (amount)</th>
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
					<th style="border: 1px solid #ccc">ID_PD</th>
					<th style="border: 1px solid #ccc">username</th>
					<th style="border: 1px solid #ccc">customer_id</th>
					<th style="border: 1px solid #ccc">amount GD (amount)</th>
					<th style="border: 1px solid #ccc">amount GD (filled)</th>
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
					<th style="border: 1px solid #ccc">username</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; foreach ($getCustomer_quybaotro as $value) { $i++; ?>
				<tr>
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					
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
					<th colspan="5" >TRANFER LISH <?php echo $date_added= date('Y-m-d H:i:s'); ?></th>
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
					<th style="border: 1px solid #ccc">M</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; foreach ($get_all_tranfer as $value) { $i++; ?>
				<tr>
					<td style="border: 1px solid #ccc"><?php echo $i ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['pd_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['gd_id'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['pd_username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['gd_username'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo number_format($value['amount']) ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['pd_satatus'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['gd_status'] ?></td>
					<td style="border: 1px solid #ccc"><?php echo $value['send_mail'] ?></td>
				</tr>
			<?php } ?>
			
			</tbody>
		</table>



		<?php
	}

}
