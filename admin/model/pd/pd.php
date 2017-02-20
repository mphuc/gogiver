<?php
class ModelPdPd extends Model {
	public function getTotalCustomers() {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
	public function getTotalProvide($status) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_provide_donation WHERE status = '" . (int)$status . "'");
		return $query->row['total'];
	}
	public function getTotalStatusProvide($status, $customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_provide_donation WHERE status = '" . (int)$status . "' AND customer_id = '".(int)$customer_id."'");
		return $query->row['total'];
	}
	
	public function getAllProfitByType($type) {
		$query = $this->db->query("SELECT SUM(receive) AS total FROM " . DB_PREFIX . "profit WHERE  type_profit in (".$type.")");
		return $query->row['total'];
	}
	public function get_total_gd_current_date($status){
		$query = $this->db->query("SELECT COUNT(*) as total
			FROM ".DB_PREFIX."customer_get_donation WHERE date(date_added)=CURRENT_DATE AND status = ".$status."");
		return $query->row['total'];
	}
	public function get_all_gd_current_date($status){
		$date_added= date('Y-m-d H:i:s') ;
		$date_finish = strtotime ( '-1 day' , strtotime ( $date_added ) ) ;
			$date_finish= date('Y-m-d H:i:s',$date_finish) ;
		if ($status) {
			switch ($status) {
				case 1:
					$status = 0;
					break;
				case 2:
					$status = 1;
					break;
				default:
					$status = 2;
					break;
			}
			$query = $this->db->query("SELECT c.username, c.account_holder,c.quy_bao_tro as cstatus, gd.*
			FROM ".DB_PREFIX."customer_get_donation gd JOIN ".DB_PREFIX."customer  c
			ON gd.customer_id = c.customer_id WHERE gd.status = ".$status." and date_finish <= '".$date_finish."'");
		return $query->rows;
		}else{
			$query = $this->db->query("SELECT c.username, c.account_holder,c.quy_bao_tro as cstatus, gd.*
			FROM ".DB_PREFIX."customer_get_donation gd JOIN ".DB_PREFIX."customer  c
			ON gd.customer_id = c.customer_id and date_finish >= '".$date_finish."'");
		return $query->rows;
		}
		
	}

	public function get_total_pd_current_date($status){
		$query = $this->db->query("SELECT COUNT(*) as total
			FROM ".DB_PREFIX."customer_provide_donation WHERE date(date_added)=CURRENT_DATE AND status = ".$status."");
		return $query->row['total'];
	}
	
	public function total_btc(){
		$query = $this->db->query("SELECT SUM(filled) as total FROM `sm_customer_get_donation`
		 WHERE status = 2 and customer_id IN (SELECT customer_id FROM sm_customer WHERE status = 9)");
		return $query -> row['total'];
	}

	public function getTotalCustomersNewLast() {
		$date = strtotime(date('Y-m-d'));
		$year = date('Y',$date);
		$month = date('m',$date);
		if($month == 1){
			$year = $year - 1;
			$month = 12;
		}else{
			$month = $month - 1;
		}
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE YEAR(`date_added`) = '".$year."' AND MONTH(`date_added`) = '".$month."'";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getTotalCustomersNew() {
		$date = strtotime(date('Y-m-d'));
		$year = date('Y',$date);
		$month = date('m',$date);

		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE YEAR(`date_added`) = '".$year."' AND MONTH(`date_added`) = '".$month."'";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getTotalCustomersOff() {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE status = 8";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function onlineToday(){
		$date = date('Y-m-d');
		$total = 0;
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_activity` WHERE `key` = 'login' and `date_added` >= '".$date." 00:00:00' and `date_added` <='".$date." 23:59:59' GROUP BY customer_id");
		if (isset($query->rows)) {
			$total = count($query->rows);
		}
		return $total;
	}
	public function onlineYesterday(){
		$date = date('Y-m-d',strtotime( '-1 days' ));
		$total = 0;
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_activity` WHERE `key` = 'login' and `date_added` >= '".$date." 00:00:00' and `date_added` <='".$date." 23:59:59' GROUP BY customer_id");
		if (isset($query->rows)) {
			$total = count($query->rows);
		}
		return $total;
	}
	
	public function onlineAll(){
		$total = 0;
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_activity` WHERE `key` = 'login' GROUP BY customer_id");
		if (isset($query->rows)) {
			$total = count($query->rows);
		}
		return $total;
	}


	public function createPH($amount,$customer_id, $max_profit){
		$date_added= date('Y-m-d H:i:s') ;
		$date_finish = strtotime ( '+36 hour' , strtotime ( $date_added ) ) ;
		$date_finish= date('Y-m-d H:i:s',$date_finish) ;
		
		$this -> db -> query("
			INSERT INTO ". DB_PREFIX . "customer_provide_donation SET
			customer_id = '".$customer_id."',
			date_added = '".$date_added."',
			filled = '".$amount."',
			date_finish = '".$date_finish."',
			date_finish_forAdmin = '".$date_finish."',
			status = 0,
			check_R_Wallet = 1
		");
		//update max_profit and pd_number
		$pd_id = $this->db->getLastId();

		//$max_profit = (float)($amount * $this->config->get('config_pd_profit')) / 100;

		$pd_number = hexdec( crc32($pd_id) );
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_provide_donation SET
				max_profit = '".$max_profit."',
				pd_number = '".$pd_number."'
				WHERE id = '".$pd_id."'
			");
		$data['query'] = $query ? true : false;
		$data['pd_number'] = $pd_number;
		$data['pd_id'] = $pd_id;
		return $data;
	}
	public function get_ph($id){
		$query = $this -> db -> query("
			SELECT *
			FROM ". DB_PREFIX ."customer_provide_donation_tmp
			WHERE id = '". $id ."'
		");
		return $query -> row;
	}
	public function delete_ph_tmp($id){
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "customer_provide_donation_tmp WHERE id = '" . (int)$id . "'");
	}

}