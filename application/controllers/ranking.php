<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
		//echo "hello";
        $this->load->helper('url');
        //echo current_url();
        $this->ranking();
        //$this->load->view('base/header', $data, $render);
    }
    public function ranking()
    {
        $this->_render_page('main_view');
    }

    public function _render_page($view, $data=null, $render=false)
    {
        $this->load->helper('url');
        //echo current_url();
        $view_html = array(
            $this->load->view('base/header', $data, $render),
            $this->load->view($view,$data, $render),
            $this->load->view('base/footer', $data, $render)
            );
        if (!$render) return $view_html;
    }
    public function getAllRanks()
    {
        $aContext = array(
            'http' => array(
                'proxy' => 'tcp://172.30.0.15:3128',
                'request_fulluri' => true,
                'header' => "Proxy-Authorization: Basic auth",
                ),
            );
        $cxContext = stream_context_create($aContext);
        $username=strval($_POST["username"]);
        $urlForRating="http://codeforces.com/api/user.rating?handle=".$username;
        //echo $urlForRating;
        $jsondataRating=@file_get_contents($urlForRating,false,$cxContext);
        $objRating= json_decode($jsondataRating,true);
        //echo $jsondataRating;
        if($objRating['status']==="OK")
        {
            $rating=intval($objRating['result'][count($objRating['result'])-1]['newRating']);
            //echo count($objRating);
            $show=array($username,$rating);
            echo json_encode($show);
        }
        else
        {
            $n= array('null');
            echo json_encode($n);
        }
    }

    public function a()
    {
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */