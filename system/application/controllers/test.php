<?php

class Test extends Controller {

	function Test()
	{
		parent::Controller();

		$this->load->library('DX_Auth');
	}
	
	function index()
	{
		//show_404('profile');
		echo $this->config->system_url();
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
