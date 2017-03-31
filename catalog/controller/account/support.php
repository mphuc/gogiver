<?php
class ControllerAccountSupport extends Controller {

	public function index() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			$self -> load -> model('account/customer');
			
			$self -> document -> addScript('catalog/view/javascript/support/support.js');
		};

		//method to call function
		!call_user_func_array("myCheckLoign", array($this)) && $this -> response -> redirect($this -> url -> link('account/login', '', 'SSL'));
		call_user_func_array("myConfig", array($this));


		//language
		
		$getLanguage = $this -> model_account_customer -> getLanguage($this -> session -> data['customer_id']);
		$language = new Language($getLanguage);
		$language -> load('account/gd');
		$data['lang'] = $language -> data;
		$data['getLanguage'] = $getLanguage;


		$server = $this -> request -> server['HTTPS'] ? $server = $this -> config -> get('config_ssl') : $server = $this -> config -> get('config_url');
		$data['base'] = $server;
		$data['self'] = $this;

		//language
		$this -> load -> model('account/customer');
		
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/support.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/support.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/support.tpl', $data));
		}
	}
	
	public function sendmail(){
		if ($this->request->post && $this -> customer -> isLogged())
		{
			if ($this->request->post['capcha'] != $_SESSION['cap_code']) {
					
					$this -> response -> redirect("support.html#error");
		    }



			$this -> load -> model('account/customer');
			$getCustomer = $this -> model_account_customer -> getCustomer($this->session->data['customer_id']);

			if ($this->request->post)
			{
				$cus_id = $this -> model_account_customer -> create_sendmail_account($this->session->data['customer_id'],$this->request->post['name'],$this->request->post['content']);

				$file = $this -> avatar($this -> request -> files, $cus_id);
			}
			$this -> response -> redirect("support.html#success");
		}
	}

	public function avatar($file,$cus_id){
		$this->load->model('account/customer');
		
		
		$imagename = $_FILES['avatar']['name'];
		$size = $_FILES['avatar']['size'];
		
		$ext = strtolower($this->getExtension($imagename));
		
		
		$actual_image_name = time().".".$ext;
		$uploadedfile = $_FILES['avatar']['tmp_name'];
		$path = "system/upload/";
		$newwidth = 200;
		$filename = $this -> compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth);
		

		$server = $this -> request -> server['HTTPS'] ? $this -> config -> get('config_ssl') :  $this -> config -> get('config_url');
		
		$linkImage = $server.$filename;
		
		$this -> model_account_customer -> up_img_sendmail_account($linkImage,$cus_id);

		
	}
	public function getExtension($str)
	{
		$i = strrpos($str,".");
		if (!$i)
		{
		return "";
		}
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	public function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
	{

		if($ext=="jpg" || $ext=="jpeg" )
		{
		$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($ext=="png")
		{
		$src = imagecreatefrompng($uploadedfile);
		}
		else if($ext=="gif")
		{
		$src = imagecreatefromgif($uploadedfile);
		}
		else
		{
		$src = imagecreatefrombmp($uploadedfile);
		}

		list($width,$height)=getimagesize($uploadedfile);
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$filename = $path.$newwidth.'_'.$actual_image_name.md5(mt_rand()); //PixelSize_TimeStamp.jpg
		imagejpeg($tmp,$filename,100);
		imagedestroy($tmp);
		return $filename;
		}
}
