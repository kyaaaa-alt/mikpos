<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\DashboardModel;
use CodeIgniter\I18n\Time;
use App\Libraries\RouterosAPI;


class PPPController extends Controller
{
    public function __construct() {
        $this->DashboardModel = new DashboardModel();
        $this->ros = new RouterosAPI();
		$this->request = \Config\Services::request();
        $this->key = new \App\Libraries\Key();
    }
    public function ppp_profile() {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));

        $data['profile'] = $this->ros->comm("/ppp/profile/print", array());
        $data['pool'] = $this->ros->comm("/ip/pool/print", array());
        $data['pqueue'] = $this->ros->comm("/queue/simple/print", array("?dynamic" => "no"));
        
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-list"></i>';
        $data['title'] = 'PPP Profiles';
        $data['view'] = 'base/dashboard/pppprofiles';
        return view('base/dashboard/layout', $data);
    }

    public function ppp_secret() {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $data['ros'] = $this->ros;

        $data['profile'] = $this->ros->comm("/ppp/profile/print", array());
        // $data['pppactive'] = $this->ros->comm("/ppp/active/print", array());
        $data['secrets'] = $this->ros->comm("/ppp/secret/print", array());
        // $data['sch'] = $this->ros->comm("/system/scheduler/print", array());

        $this->ros->disconnect;

        date_default_timezone_set('Asia/Jakarta');
        $data['today'] = strtolower(date('M/d/Y'));
        
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-list"></i>';
        $data['title'] = 'PPP Secrets';
        $data['view'] = 'base/dashboard/pppsecrets';
        return view('base/dashboard/layout', $data);
    }

}