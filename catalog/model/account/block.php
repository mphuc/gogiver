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
	public function updateRWallet($amount , $customer_id){
			
			$query = $this -> db -> query("
			UPDATE " . DB_PREFIX . "customer_r_wallet SET
				amount = amount - ".floatval($amount)."
				WHERE customer_id = '".$customer_id."'
			");
			
		return $query === true ? true : false;
	}

}