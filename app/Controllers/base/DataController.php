<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\DashboardModel;
use App\Libraries\RouterosAPI;

class DataController extends Controller
{
    public function __construct() {
        $this->DashboardModel = new DashboardModel();
        $this->ros = new RouterosAPI();
		$this->request = \Config\Services::request();
        $this->uri = $this->request->uri;
        $this->key = new \App\Libraries\Key();
    }

    public function get_scheduler_by_name() {
        $name = $this->uri->getSegment(5);
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $getprofile = $this->ros->comm("/system/scheduler/print", array("?name" => "$name"));
        $this->ros->disconnect;
        return json_encode($getprofile);
    }

    public function get_ppp_active_by_name() {
        $name = $this->uri->getSegment(5);
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $getprofile = $this->ros->comm("/ppp/active/print", array("?name" => "$name"));
        $this->ros->disconnect;
        return json_encode($getprofile);
    }

}