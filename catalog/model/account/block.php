<?php
class ModelAccountBlock extends Model {

	public function get_block_id($id_customer){
		$query = $this -> db -> query("
			SELECT *
			FROM  ".DB_PREFIX."customer_block_id
			WHERE customer_id = '".$this -> db -> escape($id_customer)."'
		");
		return $query -> row;
	}
	public function get_gd_cwallet_id($id_customer){
		$query = $this -> db -> query("
			SELECT amount, id
			FROM  ".DB_PREFIX."customer_get_donation
			WHERE customer_id = '".$this -> db -> escape($id_customer)."' AND status = 0 AND type = 0
		");
		return $query -> row;
	}
	public function get_gd_rwallet_id($id_customer){
		$query = $this -> db -> query("
			SELECT amount, id
			FROM  ".DB_PREFIX."customer_get_donation
			WHERE customer_id = '".$this -> db -> escape($id_customer)."' AND status = 0 AND type = 1
		");
		return $query -> row;
	}
	public function getLevel_by_customerid($customer_id){
		$query =  $this -> db -> query("
			SELECT level
			FROM " . DB_PREFIX . "customer_ml
			WHERE customer_id = '".$customer_id."'");
		return $query -> row;
	}
	public function update_block($customer_id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_block_id SET
			total = total + 1
			WHERE customer_id = '".(int)$customer_id."'");
		return $query;
	}
	public function update_block_status($customer_id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_block_id SET
			status = 0
			WHERE customer_id = '".(int)$customer_id."'");
		return $query;
	}
	public function update_C_Wallet($amount , $customer_id){
		$query = $this -> db -> query("
		UPDATE " . DB_PREFIX . "customer_c_wallet SET
			amount = amount - ".floatval($amount)."
			WHERE customer_id = '".$customer_id."'
		");
		return $query === true ? true : false;
	}
	public function update_GD_amount($amount , $customer_id, $id){
		$query = $this -> db -> query("
		UPDATE " . DB_PREFIX . "customer_get_donation SET
			amount = amount - ".floatval($amount)."
			WHERE customer_id = '".$customer_id."' AND id= '".$id."'
		");
		return $query === true ? true : false;
	}
	public function updateRWallet($amount , $customer_id){
			
			$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_r_wallet SET
				amount = amount - ".floatval($amount)."
				WHERE customer_id = '".$customer_id."'
			");
			
		return $query === true ? true : false;
	}

	// Block ID GD
	public function get_block_id_gd($id_customer){
		$query = $this -> db -> query("
			SELECT *
			FROM  ".DB_PREFIX."customer_block_id_gd
			WHERE customer_id = '".$this -> db -> escape($id_customer)."'
		");
		return $query -> row;
	}
	public function get_block_id_gd_list($id_customer){
		$query = $this -> db -> query("
			SELECT *
			FROM  ".DB_PREFIX."customer_block_id_gd
			WHERE customer_id = '".$this -> db -> escape($id_customer)."'
		");
		return $query -> rows;
	}
	public function get_block_id_pd_list($id_customer){
		$query = $this -> db -> query("
			SELECT *
			FROM  ".DB_PREFIX."customer_block_id
			WHERE customer_id = '".$this -> db -> escape($id_customer)."'
		");
		return $query -> rows;
	}
	public function get_total_block_id_gd($id_customer){
		$query = $this -> db -> query("
			SELECT COUNT(*) as total
			FROM  ".DB_PREFIX."customer_block_id_gd
			WHERE customer_id = '".$this -> db -> escape($id_customer)."' AND status = 0
		");
		return $query -> row['total'];
	}
	public function get_total_block_id_pd($id_customer){
		$query = $this -> db -> query("
			SELECT total
			FROM  ".DB_PREFIX."customer_block_id
			WHERE customer_id = '".$this -> db -> escape($id_customer)."'
		");
		return $query -> row['total'];
	}
	public function update_block_gd($customer_id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_block_id_gd SET
			total = total + 1
			WHERE customer_id = '".(int)$customer_id."'");
		return $query;
	}
	public function update_block_id_gd($customer_id,$gd_id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_block_id_gd SET
			status = 0
			WHERE customer_id = '".(int)$customer_id."' LIMIT 1");
		return $query;
	}
	public function update_block_status_gd($customer_id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_block_id_gd SET
			status = 0
			WHERE customer_id = '".(int)$customer_id."' AND status = 1  LIMIT 1");
		return $query;
	}
	public function update_check_block_gd($id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_get_donation SET
			check_request_block = 1
			WHERE id = '".(int)$id."'");
		return $query;
	}
	public function update_check_gd($id){
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_get_donation SET
			check_gd = 1
			WHERE id = '".(int)$id."'");
		return $query;
	}

	public function get_rp_gd_no_fn(){
		$date_now= date('Y-m-d H:i:s');
		$query_row = $this -> db -> query("
			SELECT *
			FROM ". DB_PREFIX . "customer_get_donation
			WHERE DATE_ADD(date_finish,INTERVAL 12 HOUR) <= '".$date_now."'
				  AND STATUS = 1 AND check_request_block = 0
		");
		return $query_row -> rows;
	}
	public function insert_block_id_gd($id_customer,$description,$id_gd){
		$date_now= date('Y-m-d H:i:s');
		$query = $this -> db -> query("
			INSERT INTO " . DB_PREFIX . "customer_block_id_gd SET
			customer_id = '".$this -> db -> escape($id_customer)."',
			status = 1,
			description ='".$this -> db -> escape($description)."',
			date = '".$date_now."',
			id_gd ='" .$this -> db -> escape($id_gd). "'
		");
		return $query;
	}
	public function update_check_block_pd($id_customer,$description,$pd_id){
		$date_now= date('Y-m-d H:i:s');
		$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_block_id SET
			status = 1,
			description ='".$this -> db -> escape($description)."',
			date = '".$date_now."',
			pd_id ='" .$this -> db -> escape($pd_id). "'
			WHERE customer_id = '".$this -> db -> escape($id_customer)."'");
		return $query;
	}

	public function get_all_customer()
	{
		$query = $this -> db -> query("
			SELECT *
			FROM  ".DB_PREFIX."customer
		");
		return $query -> rows;
	}


	public function insert_block_id_pd_month($customer_id)
	{
		$querys = $this -> db -> query("
			SELECT count(*) as number FROM  " . DB_PREFIX . "customer_block_pd_month 
			WHERE customer_id = '".$customer_id."'
		");
		if ($querys -> row['number'] == 0)
		{
			$query = $this -> db -> query("
				INSERT INTO  " . DB_PREFIX . "customer_block_pd_month SET
				customer_id = '".$customer_id."'
			");
		}
	}

	public function get_count_pd($customer_id)
	{
		$query = $this -> db -> query("
			SELECT count(*) as number
			FROM  ".DB_PREFIX."customer_provide_donation
			WHERE customer_id = '".$customer_id."'
		");
		$result['count'] = $query -> row['number'];
		if ($result['count'] > 0)
		{
			$querys = $this -> db -> query("
				SELECT date_added
				FROM  ".DB_PREFIX."customer_provide_donation
				WHERE customer_id = '".$customer_id."' ORDER BY date_added ASC LIMIT 1
			");
			$date_added= $querys -> row['date_added'];
			$date_finish = strtotime ( '+ 30 day' , strtotime ($date_added));
			$date_finish = date('Y-m-d H:i:s',$date_finish) ;
			$result['date_added'] = $date_finish;
		}
		else
		{
			$result['date_added'] = '0000-00-00 00:00:00';
		}
		return $result;
	}

	public function update_block_id_pd_month($customer_id,$total_pd,$date_block)
	{
		$query = $this -> db -> query("
			UPDATE  " . DB_PREFIX . "customer_block_pd_month SET
			total_pd = '".$total_pd."',
			date_block = '".$date_block."'
			WHERE customer_id = '".$customer_id."'
			");
		return $query;
	}

	public function get_block_month_pd(){
		$date_added = date('Y-m-d H:i:s');
		$query = $this -> db -> query("
			SELECT *
			FROM  ".DB_PREFIX."customer_block_pd_month
			WHERE date_block <= '".$date_added."' AND total_pd > 0 AND status = 0
		");
		return $query -> rows;
	}

	public function get_level($customer_id){
		$query = $this -> db -> query("
			SELECT level
			FROM  ".DB_PREFIX."customer_ml
			WHERE customer_id = '".$customer_id."'
		");
		return $query -> row;
	}
	public function update_block_pd_month($customer_id,$description)
	{
		$date_added= date('Y-m-d H:i:s');
		$date_finish = strtotime ( '+ 30 day' , strtotime ($date_added));
		$date_finish = date('Y-m-d H:i:s',$date_finish) ;
			
		$query = $this -> db -> query("
			UPDATE  " . DB_PREFIX . "customer_block_pd_month SET
			date_block = '".$date_finish."',
			total_block = total_block + 1,
			total_pd = 0,
			description = '".$description."',
			status = 1
			WHERE customer_id = '".$customer_id."'
			");
		return $query;
	}

	public function update_block_pd_month_unlock($customer_id)
	{
		$query = $this -> db -> query("
			UPDATE  " . DB_PREFIX . "customer_block_pd_month SET
			status = 0
			WHERE customer_id = '".$customer_id."'
			");
		return $query;
	}

	public function update_block_none($customer_id,$total_pd)
	{	
		$date_added= date('Y-m-d H:i:s');
		$date_finish = strtotime ( '+ 30 day' , strtotime ($date_added));
		$date_finish = date('Y-m-d H:i:s',$date_finish) ;
		$query = $this -> db -> query("
			UPDATE  " . DB_PREFIX . "customer_block_pd_month SET
			date_block = '".$date_finish."',
			total_pd = '".$total_pd."'
			WHERE customer_id = '".$customer_id."'
			");
		return $query;
	}
}