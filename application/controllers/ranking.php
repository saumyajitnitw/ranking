<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function index()
	{
		$this->_render_page('main_view');
	}


	function _render_page($view, $data=null, $render=false)
    {
        $view_html = array(
            $this->load->view('base/header', $data, $render),
            $this->load->view($view,$data, $render),
            $this->load->view('base/footer', $data, $render)
            );
        if (!$render) return $view_html;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */