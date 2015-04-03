<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->helper('url');
        $this->ranking();
    }
    public function ranking()
    {
        $this->_render_page('main_view');
    }

    public function _render_page($view, $data=null, $render=false)
    {
        $view_html = array(
            $this->load->view('base/header', $data, $render),
            $this->load->view($view,$data, $render),
            $this->load->view('base/footer', $data, $render)
            );
        if (!$render) return $view_html;
    }
    public function getAllRanks()
    {
        $pass=array();
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
        $jsondataRating=@file_get_contents($urlForRating,false,$cxContext);
        $objRating= json_decode($jsondataRating,true);
        if($objRating['status']==="OK")
        {
            $rating=intval($objRating['result'][count($objRating['result'])-1]['newRating']);
            $show=array($username,$rating);
            $pass['cf']=$show;
        }
        else
        {
            $n= array('null');
            $pass['cfe']=$n;
        }
        $urlForRating="http://codechef.com/users/".$username;
        $html=@file_get_contents($urlForRating,false,$cxContext);
        $needle="<hx>";
        $lastPos=0;
        $positions=array();
        while (($lastPos = strpos($html, $needle, $lastPos))!== false)
        {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($needle);
        }
        for($i=0;$i<count($positions);$i++)
        {
            $positions[$i]+=4;
        }
        $needle="</hx>";
        $lastPos=0;
        $positions1=array();
        while (($lastPos = strpos($html, $needle, $lastPos))!== false)
        {
            $positions1[] = $lastPos;
            $lastPos = $lastPos + strlen($needle);
        }
        $cc=array();
        array_push($cc, $username);
        for($i=0;$i<count($positions);$i++)
        {
            array_push($cc,substr($html,$positions[$i],($positions1[$i]-$positions[$i])));
        }
        if(count($positions)!=0)
            $pass['cc']=$cc;
        if(count($positions)==0)
        {
            $n= array('null');
            $pass['cce']=$n;
        }
        echo json_encode($pass);
    }
}