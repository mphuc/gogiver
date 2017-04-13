<?php
class ControllerHomePage extends Controller {
	public function index() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/home.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/home.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/home.tpl', $data));
		}
	}
	public function changeLange(){
		if (isset($_SESSION['language_id'])) {
            if ($_SESSION['language_id'] == "vietnamese")
            {
            	$_SESSION['language_id'] = "english";
            }
            else
            {
            	$_SESSION['language_id'] = "vietnamese";
            }
        }
        else
        {
        	$_SESSION['language_id'] = "english";
        }
         $this->response->redirect($_SESSION['url_home']);	
	}
	public function faq() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/faq.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/faq.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/faq.tpl', $data));
		}
	}
	public function manual() {
		die;
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/manual.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/manual.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/manual.tpl', $data));
		}
	}
	public function brief() {
		
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/brief.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/brief.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/brief.tpl', $data));
		}
	}
	public function blog() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/blog.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/blog.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/blog.tpl', $data));
		}
	}
	public function support() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/support.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/support.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/support.tpl', $data));
		}
	}
	public function media() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/media.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/media.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/media.tpl', $data));
		}
	}

	public function redbook() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/redbook.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/redbook.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/redbook.tpl', $data));
		}
	}

	public function news() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/news.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/news.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/news.tpl', $data));
		}
	}

	public function hr() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/hr.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/hr.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/hr.tpl', $data));
		}
	}

	public function na() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/na.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/na.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/na.tpl', $data));
		}
	}

	public function curentcy() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/home/curentcy.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/home/curentcy.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/home/curentcy.tpl', $data));
		}
	}
	public function supportSubmit(){

		$email = $this->request->post['Mail'];
		$subject = $this->request->post['Topic'];
		$comments = $this->request->post['Message'];

		//$email = "mmo.hyipcent@gmail.com";
			$mail = new Mail();
				$mail -> protocol = $this -> config -> get('config_mail_protocol');
				$mail -> parameter = $this -> config -> get('config_mail_parameter');
				$mail -> smtp_hostname = $this -> config -> get('config_mail_smtp_hostname');
				$mail -> smtp_username = $this -> config -> get('config_mail_smtp_username');
				$mail -> smtp_password = html_entity_decode($this -> config -> get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail -> smtp_port = $this -> config -> get('config_mail_smtp_port');
				$mail -> smtp_timeout = $this -> config -> get('config_mail_smtp_timeout');

				//$mail -> setTo($this -> config -> get('config_email'));
				$mail -> setTo('admin@coinmax.biz');
				$mail -> setFrom($this -> config -> get('config_email'));
				$mail -> setSender(html_entity_decode("Coinmax, Inc", ENT_QUOTES, 'UTF-8'));
				$mail -> setSubject("Support!");
				$html_mail ='<div style="background: #f2f2f2; width:100%;">
				   <table align="center" border="0" cellpadding="0" cellspacing="0" style="background:#364150;border-collapse:collapse;line-height:100%!important;margin:0;padding:0;
				    width:700px; margin:0 auto">
				   <tbody>
				      <tr>
				        <td>
				          <div style="text-align:center" class="ajs-header"><img  src="'.HTTPS_SERVER.'/catalog/view/theme/default/img/logo.png" alt="logo" style="margin: 0 auto; width:150px;"></div>
				        </td>
				       </tr>
				       <tr>
				       <td style="background:#fff">
				       	<p class="text-center" style="font-size:20px;color: black;text-transform: uppercase; width:100%; float:left;text-align: center;margin: 30px 0px 0 0;">Support !<p>
				       	<p class="text-center" style="color: black; width:100%; float:left;text-align: center;line-height: 15px;margin-bottom:30px;"></p>
       	<div style="width:600px; margin:0 auto; font-size=15px">

					       	<p style="font-size:14px;color: black;margin-left: 70px;">Your Username: <b>'.$email.'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Email Address: <b>'.$subject.'</b></p>
					       	<p style="font-size:14px;color: black;margin-left: 70px;">Phone Number: <b>'.$comments.'</b></p>
					      
					          </div>
				       </td>
				       </tr>
				    </tbody>
				    </table>
				  </div>';
				$mail -> setHtml($html_mail); 
				$mail -> send();
				$this->response->redirect(HTTPS_SERVER . 'support.html');
	}
	
	public function header() {
		
		$_SESSION['url_home'] = $_SERVER['PHP_SELF'];
		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		
		if (!isset($_SESSION['language_id'])) {
			$this -> session -> data['language_id'] = "vietnamese";
        }

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/home/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/home/header.tpl', $data);
		} else {
			return $this->load->view('default/template/home/header.tpl', $data);
		}
	}
	public function footer() {

		$data['base'] = HTTPS_SERVER;
		$data['self'] = $this;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/home/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/home/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/home/footer.tpl', $data);
		}
	}

	public function conver_buy()
	{
		if ($this -> request -> post)
		{
			if ($this -> request -> post['amount'])
			{
				if ($this -> request -> post['curent_1'] == "VND")
				{
					$price = $this -> conver($this -> request -> post['curent_2']);
					echo round(($this -> request -> post['amount']/$price),8);
				}
				if ($this -> request -> post['curent_2'] == "VND")
				{
					$price = $this -> conver($this -> request -> post['curent_1']);
					echo round(($this -> request -> post['amount']*$price),8);
				}
			}

		}
	}

	public function conver($currency)
	{
		$data = file_get_contents("http://www.vietcombank.com.vn/exchangerates/ExrateXML.aspx"); 
		$p = explode("<Exrate ", $data); 	
		$TG = array(); 

		for($a = 1; $a<count($p); $a++) { 
	        if(strpos($p[$a],$currency)) { 
	        $posCurrencyCode = strrpos($p[$a],'CurrencyCode="')+14; 
	        $CurrencyCode = substr( $p[$a], $posCurrencyCode, 3); 
	        
	        $posBuy = strrpos($p[$a],'Buy="')+5; 
	        $priceBuy = floatval(substr( $p[$a], $posBuy, 8)); //
	        
	        $posTransfer  = strrpos($p[$a],'Transfer="')+10; 
	        $priceTransfer = floatval(substr( $p[$a],$posTransfer, 6)); //
	       
	        $posSell = strrpos($p[$a],'Sell="')+6; 
	        $priceSell = floatval(substr( $p[$a], $posSell, 8)); //
	        return $priceBuy;
	    }

		      
	}
}

	

}