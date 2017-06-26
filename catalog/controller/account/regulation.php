<?php

class ControllerAccountRegulation extends Controller {

	public function index() {
		function myCheckLoign($self) {
			return $self -> customer -> isLogged() ? true : false;
		};

		function myConfig($self) {
			
		};
		
		$data['self'] = $this;

		if (file_exists(DIR_TEMPLATE . $this -> config -> get('config_template') . '/template/account/regulation.tpl')) {
			$this -> response -> setOutput($this -> load -> view($this -> config -> get('config_template') . '/template/account/regulation.tpl', $data));
		} else {
			$this -> response -> setOutput($this -> load -> view('default/template/account/regulation.tpl', $data));
		}
	}
}