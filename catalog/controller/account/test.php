<?php
class ControllerAccountTest extends Controller {
	private $error = array();

	public function index() {
		$data =array();

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/test.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/test.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/test.tpl', $data));
		}

	}

	public function sendfile(){
		$check_files = (file_exists($_FILES['avatar']['tmp_name']));
		$file = $this -> avatar($this -> request -> files);
	}

	public function avatar($file){
	$this->load->model('account/customer');
	
		$filename = html_entity_decode($this->request->files['avatar']['name'], ENT_QUOTES, 'UTF-8');
		
		$filename = str_replace(' ', '_', $filename);
		if(!$filename || !$this->request->files){
			die();
		}

		$file = $filename . '.' . md5(mt_rand()) ;

		
		$imagename = $this->request->files['avatar']['name'];
              $source = $this->request->files['avatar']['tmp_name'];
              $target = "test/".$imagename;
              move_uploaded_file($source, $target);

              $imagepath = $imagename;
              $save = "test/" . $imagepath; //This is the new file you saving
              $file = "test/" . $imagepath; //This is the original file

              list($width, $height) = getimagesize($file) ;

              $modwidth = 500;

              $diff = $width / $modwidth;

              $modheight = $height / $diff;
              $tn = imagecreatetruecolor($modwidth, $modheight) ;
              $image = imagecreatefromjpeg($file) ;
              imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

              imagejpeg($tn, $save, 100) ;

            echo "Large image: <img src='test/".$imagepath."'><br>";die;


		move_uploaded_file($this->request->files['avatar']['tmp_name'], "test/" . $file);


		//save image profile
		$server = $this -> request -> server['HTTPS'] ? $this -> config -> get('config_ssl') :  $this -> config -> get('config_url');
		
		$linkImage = $server . 'test/'.$file;
	
		echo $linkImage;

		
	}

}
