<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\DashboardModel;
use App\Models\base\ROSModel;
use CodeIgniter\I18n\Time;
use App\Libraries\RandomizeHelper;
use App\Libraries\RouterosAPI;

class DashboardController extends Controller
{
    public function __construct() {

        $this->session = session();
        $this->DashboardModel = new DashboardModel();
        $this->ROSModel = new ROSModel();
		$this->request = \Config\Services::request();
        $this->uri = $this->request->uri;
        $this->ros = new RouterosAPI();
        $this->key = new \App\Libraries\Key();
        $this->db  = \Config\Database::connect(); 
    }

    public function do_auth()
    {
        $data['username'] = $this->request->getPost('username');
        $data['password'] = md5($this->request->getPost('password'));
        $getuser = $this->DashboardModel->get_user($data);

        if(count($getuser) > 0)
        {
            // set session
            $sess_data = array('ownerlogged' => TRUE, 'uname' => $getuser[0]->username, 'id' => $getuser[0]->id);
            $this->session->set($sess_data);
            return redirect()->to(base_url('router/list'));

        }
        else
        {
            $this->session->setFlashdata('errors', ['Username/Password Salah']);
            return redirect()->to(base_url('/'));
        }

    }

    public function index() 
    {
        if(session()->has('ownerlogged'))
        {
        	return redirect()->to(base_url('router/list'));
        }

        $data['title'] = 'Login';
        return view('base/dashboard/login', $data);
    }

    public function router()
    {
        if(session()->has('routerlogged'))
        {
            return redirect()->to(base_url('u/dashboard'));
        }
        $data['router'] = $this->DashboardModel->get_router_by_user_id();


        $data['title'] = 'Router';
        $data['view'] = 'base/dashboard/router/router';
        return view('base/dashboard/router/layout', $data);
    }

    public function add_router()
    {
        if(session()->has('routerlogged'))
        {
            return redirect()->to(base_url('u/dashboard'));
        }

        $data['title'] = 'Add Router';
        $data['view'] = 'base/dashboard/router/addrouter';
        return view('base/dashboard/router/layout', $data);
    }

    public function do_add_router()
    {
        $userid = $_SESSION['id'];
        $key = new \App\Libraries\Key();

        $this->ros->connect($this->request->getPost('router_host'), $this->request->getPost('router_user'), $this->request->getPost('router_pass'));
        $getntp = $this->ros->comm("/system/clock/print", array());
        $router_ntp = $getntp[0]['time-zone-name'];
        $this->ros->disconnect;

        $saverouter = [
            'user_id' => $userid,
            'router_name' => $this->request->getPost('router_name'),
            'router_dns' => $this->request->getPost('router_dns'),
            'router_host' => $this->request->getPost('router_host'),
            'router_user' => $this->request->getPost('router_user'),
            'router_pass' => $key->en($this->request->getPost('router_pass')),
            'router_ntp' => $router_ntp,
            'traffic_interface' => $this->request->getPost('traffic_interface'),
        ];
        $save = $this->DashboardModel->do_add_router($saverouter);
        $routerid = $this->db->insertID();
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'QRISC',
            'nama' => 'QRIS',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'QRIS',
            'nama' => 'QRIS (ShopeePay)',
            'status' => '0',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'QRISD',
            'nama' => 'QRIS (Dana)',
            'status' => '0',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'BCAVA',
            'nama' => 'BCA Virtual Account',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'BNIVA',
            'nama' => 'BNI Virtual Account',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'BRIVA',
            'nama' => 'BRI Virtual Account',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'BSIVA',
            'nama' => 'BSI Virtual Account',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'MANDIRIVA',
            'nama' => 'Mandiri Virtual Account',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'MUAMALATVA',
            'nama' => 'Muamalat Virtual Account',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'ALFAMART',
            'nama' => 'Alfamart',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'ALFAMIDI',
            'nama' => 'Alfamidi',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        $paymentmethod = [
            'user_id' => $userid,
            'router_id' => $routerid,
            'kode' => 'INDOMARET',
            'nama' => 'Indomaret',
            'status' => '1',
        ];
        $this->DashboardModel->add_payment_method($paymentmethod);
        
        if ($save) {
            $this->session->setFlashdata('success', ['Router Berhasil ditambahkan']);
            return redirect()->to(base_url('router/list'));
        } else {
            $this->session->setFlashdata('error', ['Router gagal ditambahkan']);
            return redirect()->to(base_url('router/addrouter'));
        }
    }

    public function do_edit_router()
    {
        $router_id = $this->request->getPost('router_id');
        $key = new \App\Libraries\Key();
        $this->ros->connect($this->request->getPost('router_host'), $this->request->getPost('router_user'), $this->request->getPost('router_pass'));
        $getntp = $this->ros->comm("/system/clock/print", array());
        $router_ntp = $getntp[0]['time-zone-name'];
        $this->ros->disconnect;
        $data = [
            'router_name' => $this->request->getPost('router_name'),
            'router_dns' => $this->request->getPost('router_dns'),
            'router_host' => $this->request->getPost('router_host'),
            'router_user' => $this->request->getPost('router_user'),
            'router_pass' => $key->en($this->request->getPost('router_pass')),
            'router_ntp' => $router_ntp,
            'traffic_interface' => $this->request->getPost('traffic_interface'),
        ];
        $save = $this->DashboardModel->edit_router($data,$router_id);
        if ($save) {
            $this->session->setFlashdata('success', ['Router Berhasil Di Edit']);
            return redirect()->to(base_url('router/list'));
        } else {
            $this->session->setFlashdata('error', ['Gagal']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function do_update_user()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password')),
        ];
        $save = $this->DashboardModel->update_user($data);
        if ($save) {
            $this->session->setFlashdata('success', ['User berhasil diubah!']);
            return redirect()->to(base_url('router/list'));
        } else {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function do_delete_router()
    {
        $router_id = $this->request->getPost('router_id');
        $save = $this->DashboardModel->delete_router($router_id);
        if ($save) {
            $this->session->setFlashdata('success', ['Router dihapus!']);
            return redirect()->to(base_url('router/list'));
        } else {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function do_auth_router()
    {
        $data['id'] = $this->request->getPost('router_id');
        $get = $this->DashboardModel->auth_router($data);

        if(count($get) > 0)
        {
            // set session
            $sess_data = array(
                'routerlogged' => TRUE,
                'router_id' => $get[0]->id,
                'traffic_interface' => $get[0]->traffic_interface,
            );
            $this->session->set($sess_data);

            return redirect()->to(base_url('/u/dashboard'));

        }
        else
        {
            $this->session->setFlashdata('error', ['Username/Password Salah']);
            return redirect()->to(base_url('list'));
        }
    }

    public function do_unauth_router()
    {
        $data = ['routerlogged', 'router_id'];
        $this->session->remove($data);
        return redirect()->to(base_url('/router/list'));
    }

    public function do_unauth_owner(){
        $this->session->destroy();
        return redirect()->to(base_url('/'));
	}

    public function dashboard()
    {
        $data['dashboard'] = $this->ROSModel->dashboard();
        $data['total_profit_bulanan'] = $this->DashboardModel->get_total_profit_month();
        $data['total_profit_harian'] = $this->DashboardModel->get_total_profit_day();
        $data['total_profit'] = $this->DashboardModel->get_total_profit();
        $data['last_month'] = $this->DashboardModel->profit_last_month();
        $data['last_day'] = $this->DashboardModel->profit_last_day();
        
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['title'] = 'Dashboard';
        $data['view'] = 'base/dashboard/dashboard';
        return view('base/dashboard/layout', $data);
    }

    public function extendexpire()
    {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $users = $this->ros->comm("/ip/hotspot/user/print", array());
        $this->ros->disconnect;
        date_default_timezone_set($rosauth[0]->router_ntp);
 
        $count = 1;
        foreach ($users as $row){
            $uid = $row['.id'];
            $tgl = ucfirst($row['comment']);
            $nama = $row['name'];
            $profile = $row['profile'];
            $limituptime = $row['limit-uptime'];
            $expdate = str_replace('/', '-', $tgl);

            if (strtotime($expdate) > strtotime('-1 day')) {
                $items[] =[
                    'exp' => strtotime($expdate),
                    'uid'=> $uid,
                    'tanggal' => date('m/d/y H:i', strtotime($expdate)),
                    'name' => $nama,
                    'profile' => $profile,
                    'limituptime' => $limituptime
                ];
                $total = $count++;
            }
        }
        $data['totalitems'] = $total;
        foreach ($items as $key => $node) {
            $timestamps[$key]    = $node['exp'];
        }
        array_multisort($timestamps, SORT_ASC, $items);
        $jsonres = json_encode($items);

        $data['result'] = json_decode($jsonres);
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-clock"></i>';
        $data['title'] = 'Perpanjang User';
        $data['view'] = 'base/dashboard/extendexpire';
        return view('base/dashboard/layout', $data);
    }

    public function do_change_expire() {
        $uid = $this->request->getPost('uid');
        $ulimit = $this->request->getPost('ulimit');
        $p1 = $this->request->getPost('p1');
        $p2 = $this->request->getPost('p2');
        $get = $this->ROSModel->get_user_by_uid($uid);
        //validasi
        if (isset($get[0]['.id'])) {
            $comment = ucfirst($get[0]['comment']);
            $expdate = str_replace('/', '-', $comment);
            $add = strtotime($p1 . ' ' . $p2, strtotime($expdate));
            $ucomment = strtolower(date('M/d/Y H:i:s', $add));
            $this->ROSModel->change_expire($uid,$ucomment,$ulimit);
            $this->session->setFlashdata('success', ['Masa aktif berhasil diubah!']);
            return 'ok';
        } else {
            $this->session->setFlashdata('error', ['Gagal! User tidak ditemukan.']);
        }
    }

    public function userlist()
    {
       
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $data['ser'] = $this->ros->comm("/ip/hotspot/print", array());
        $data['pro'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
        $data['user'] = $this->ros->comm("/ip/hotspot/user/print", array());
        $this->ros->disconnect;

        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-list"></i>';
        $data['title'] = 'User List';
        $data['view'] = 'base/dashboard/userlist';
        return view('base/dashboard/layout', $data);
    }

    public function traffic() {
        $getinterfacetraffic = $this->ROSModel->monitor();
        
        $rows = array(); $rows2 = array();
    
        $ftx = $getinterfacetraffic[0]['tx-bits-per-second'];
        $frx = $getinterfacetraffic[0]['rx-bits-per-second'];
    
        $rows['name'] = 'Tx';
        $rows['data'][] = $ftx;
        $rows2['name'] = 'Rx';
        $rows2['data'][] = $frx;
        $result = array();   
        array_push($result,$rows);
        array_push($result,$rows2);
        print json_encode($result);
    }

    public function userprofiles() {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        
        $data['profile'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
        $data['sch'] = $this->ros->comm("/system/scheduler/print", array());
        $data['pool'] = $this->ros->comm("/ip/pool/print", array());
        $data['pqueue'] = $this->ros->comm("/queue/simple/print", array("?dynamic" => "no"));

        $this->ros->disconnect;

        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-list"></i>';
        $data['title'] = 'User Profiles';
        $data['view'] = 'base/dashboard/userprofiles';
        return view('base/dashboard/layout', $data);
    }

    public function paymentreport() {
        $data['transaksi'] = $this->DashboardModel->get_transaksi();
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-list"></i>';
        $data['title'] = 'Payment Report';
        $data['view'] = 'base/dashboard/paymentreport';
        return view('base/dashboard/layout', $data);
    }

    public function paymentsettings() {
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['pmethod'] = $this->DashboardModel->get_payment_method();

        $data['icon'] = '<i class="fe fe-settings"></i>';
        $data['title'] = 'Payment Settings';
        $data['view'] = 'base/dashboard/paymentsettings';
        return view('base/dashboard/layout', $data);
    }

    public function do_update_pm() {
        $status = $this->request->getPost('status');
        $kode = $this->request->getPost('kodepm');
        $update = $this->DashboardModel->update_payment_method($status, $kode);
        if($update){
            echo 'success';
            $this->session->setFlashdata('success', ['Berhasil diubah!']);
        }else{
            echo 'gagal';
        }
    }

    public function paymentpage() {
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-bookmark"></i>';
        $data['title'] = 'Payment Page';
        $data['view'] = 'base/dashboard/paymentpage';
        return view('base/dashboard/layout', $data);
    }

    public function do_remove_pppsecret() {
        $sid = $this->request->getPost('sid');
        $schid = $this->request->getPost('schid');
        $q = $this->ROSModel->remove_pppsecret($sid);
        if (isset($q["after"]))
        {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppsecrets'));
        } else {
            $this->session->setFlashdata('hapuss', ['PPP Secret berhasil dihapus!']);
            $this->ROSModel->remove_scheduler($schid);
            return redirect()->to(base_url('u/pppsecrets'));
        }
    }

    public function do_disable_pppsecret() {
        $sid = $this->request->getPost('sid');
        $this->ROSModel->disable_pppsecret($sid);
        $this->session->setFlashdata('error', ['PPP Secret disabled!']);
        return redirect()->to(base_url('u/pppsecrets'));
    }

    public function do_enable_pppsecret() {
        $sid = $this->request->getPost('sid');
        $this->ROSModel->enable_pppsecret($sid);
        $this->session->setFlashdata('success', ['PPP Secret enabled!']);
        return redirect()->to(base_url('u/pppsecrets'));
    }

    public function do_add_pppsecret() {
        $namewithspace = $this->request->getPost('sname');
        $sname = str_replace(' ', '', $namewithspace);
        $spass = $this->request->getPost('spass');
        $mainprofile = $this->request->getPost('mainprofile');
        $fupprofile = $this->request->getPost('fupprofile');
        $localaddress = $this->request->getPost('localaddress');
        $remoteadress = $this->request->getPost('remoteadress');
        $validity = $this->request->getPost('validity');
        $graceperiod = $this->request->getPost('graceperiod');
        $startdate = $this->request->getPost('startdate');
        $harga = $this->request->getPost('harga');
        if (substr($validity, -1) == "d" & strlen($validity) > 3) {
            $addtime = ((substr($validity, 0, -1) * 7) + substr($validity, 2, 1)) . " Days";
        } else if (substr($validity, -1) == "d") {
            $addtime = substr($validity, 0, -1) . " Days";
        } else if (substr($validity, -1) == "h") {
            $addtime = substr($validity, 0, -1) . " Hours";
        } else if (substr($validity, -1) == "w") {
            $addtime = (substr($validity, 0, -1) * 7) . " Days";
        } 
        $startdate2 = ucfirst($startdate);
        $expdate = str_replace('/', '-', $startdate2);
        $add = strtotime('+' . $addtime, strtotime($expdate));
        $enddate = strtolower(date('M/d/Y', $add));

        $onevent = ':put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$validity.','.$startdate.','.$enddate.','.$sname.','.$harga.',");/ppp secret set [find where name="'.$sname.'"] profile='.$fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$sname.'"]; /sys sch set [find where name="'.$sname.'"] interval='.$graceperiod.' on-event={:put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$validity.','.$startdate.','.$enddate.','.$sname.','.$harga.',"); /ppp secret set [find where name="'.$sname.'"] disabled=yes ; /sys sch set [find where name="'.$sname.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$sname.'"];}';

        $add = $this->ROSModel->add_ppp_secret($sname,$spass,$localaddress,$remoteadress,$mainprofile);
        if (!empty($add['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppsecrets'));
        } else {
            $this->session->setFlashdata('success', ['PPP Secret disimpan!']);
            $this->ROSModel->add_ppp_scheduler($sname,$startdate,$validity,$onevent);
            return redirect()->to(base_url('u/pppsecrets'));
        }

    }

    public function do_convert_ppp_secret() {
        $convert_name = $this->request->getPost('convert_name');
        $convert_secretid = $this->request->getPost('convert_secretid');
        $pppactiveid = $this->request->getPost('convert_pppactiveid');
        $schid = $this->request->getPost('convert_schid');
        $convert_mainprofile = $this->request->getPost('convert_mainprofile');
        $convert_fupprofile = $this->request->getPost('convert_fupprofile');
        $convert_validity = $this->request->getPost('convert_validity');
        $convert_gperiod = $this->request->getPost('convert_gperiod');
        $convert_startdate = $this->request->getPost('convert_startdate');
        $convert_harga = $this->request->getPost('convert_harga');
        
        $q = $this->ROSModel->convert_ppp_secret($convert_secretid,$convert_mainprofile);
        if (!empty($q['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppsecrets'));
        } else {
            $rmvsch = $this->ROSModel->remove_scheduler($schid);
            if (!empty($rmvsch['after']['message'])) {
                $removeactive = $this->ROSModel->remove_ppp_active($pppactiveid);
                if (!empty($removeactive['after']['message'])) {
                    if (substr($convert_validity, -1) == "d" & strlen($convert_validity) > 3) {
                        $addtime = ((substr($convert_validity, 0, -1) * 7) + substr($convert_validity, 2, 1)) . " Days";
                    } else if (substr($convert_validity, -1) == "d") {
                        $addtime = substr($convert_validity, 0, -1) . " Days";
                    } else if (substr($convert_validity, -1) == "h") {
                        $addtime = substr($convert_validity, 0, -1) . " Hours";
                    } else if (substr($convert_validity, -1) == "w") {
                        $addtime = (substr($convert_validity, 0, -1) * 7) . " Days";
                    } 
                    $startdate = ucfirst($convert_startdate);
                    $expdate = str_replace('/', '-', $startdate);
                    $add = strtotime('+' . $addtime, strtotime($expdate));
                    $enddate = strtolower(date('M/d/Y', $add));
                    $onevent = ':put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',");/ppp secret set [find where name="'.$convert_name.'"] profile='.$convert_fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$convert_name.'"]; /sys sch set [find where name="'.$convert_name.'"] interval='.$convert_gperiod.' on-event={:put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',"); /ppp secret set [find where name="'.$convert_name.'"] disabled=yes ; /sys sch set [find where name="'.$convert_name.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$convert_name.'"];}';
                    $this->ROSModel->convert_ppp_scheduler($convert_name,$convert_startdate,$convert_validity,$onevent);
                    $this->session->setFlashdata('success', ['PPP Secret convert berhasil!']);
                    return redirect()->to(base_url('u/pppsecrets'));
                } else {
                    if (substr($convert_validity, -1) == "d" & strlen($convert_validity) > 3) {
                        $addtime = ((substr($convert_validity, 0, -1) * 7) + substr($convert_validity, 2, 1)) . " Days";
                    } else if (substr($convert_validity, -1) == "d") {
                        $addtime = substr($convert_validity, 0, -1) . " Days";
                    } else if (substr($convert_validity, -1) == "h") {
                        $addtime = substr($convert_validity, 0, -1) . " Hours";
                    } else if (substr($convert_validity, -1) == "w") {
                        $addtime = (substr($convert_validity, 0, -1) * 7) . " Days";
                    } 
                    $startdate = ucfirst($convert_startdate);
                    $expdate = str_replace('/', '-', $startdate);
                    $add = strtotime('+' . $addtime, strtotime($expdate));
                    $enddate = strtolower(date('M/d/Y', $add));
                    $onevent = ':put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',");/ppp secret set [find where name="'.$convert_name.'"] profile='.$convert_fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$convert_name.'"]; /sys sch set [find where name="'.$convert_name.'"] interval='.$convert_gperiod.' on-event={:put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',"); /ppp secret set [find where name="'.$convert_name.'"] disabled=yes ; /sys sch set [find where name="'.$convert_name.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$convert_name.'"];}';
                    $this->ROSModel->convert_ppp_scheduler($convert_name,$convert_startdate,$convert_validity,$onevent);
                    $this->session->setFlashdata('success', ['PPP Secret convert berhasil!']);
                    return redirect()->to(base_url('u/pppsecrets'));
                }
            } else {
                $removeactive = $this->ROSModel->remove_ppp_active($pppactiveid);
                if (!empty($removeactive['after']['message'])) {
                    if (substr($convert_validity, -1) == "d" & strlen($convert_validity) > 3) {
                        $addtime = ((substr($convert_validity, 0, -1) * 7) + substr($convert_validity, 2, 1)) . " Days";
                    } else if (substr($convert_validity, -1) == "d") {
                        $addtime = substr($convert_validity, 0, -1) . " Days";
                    } else if (substr($convert_validity, -1) == "h") {
                        $addtime = substr($convert_validity, 0, -1) . " Hours";
                    } else if (substr($convert_validity, -1) == "w") {
                        $addtime = (substr($convert_validity, 0, -1) * 7) . " Days";
                    } 
                    $startdate = ucfirst($convert_startdate);
                    $expdate = str_replace('/', '-', $startdate);
                    $add = strtotime('+' . $addtime, strtotime($expdate));
                    $enddate = strtolower(date('M/d/Y', $add));
                    $onevent = ':put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',");/ppp secret set [find where name="'.$convert_name.'"] profile='.$convert_fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$convert_name.'"]; /sys sch set [find where name="'.$convert_name.'"] interval='.$convert_gperiod.' on-event={:put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',"); /ppp secret set [find where name="'.$convert_name.'"] disabled=yes ; /sys sch set [find where name="'.$convert_name.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$convert_name.'"];}';
                    $this->ROSModel->convert_ppp_scheduler($convert_name,$convert_startdate,$convert_validity,$onevent);
                    $this->session->setFlashdata('success', ['PPP Secret convert berhasil!']);
                    return redirect()->to(base_url('u/pppsecrets'));
                } else {
                    if (substr($convert_validity, -1) == "d" & strlen($convert_validity) > 3) {
                        $addtime = ((substr($convert_validity, 0, -1) * 7) + substr($convert_validity, 2, 1)) . " Days";
                    } else if (substr($convert_validity, -1) == "d") {
                        $addtime = substr($convert_validity, 0, -1) . " Days";
                    } else if (substr($convert_validity, -1) == "h") {
                        $addtime = substr($convert_validity, 0, -1) . " Hours";
                    } else if (substr($convert_validity, -1) == "w") {
                        $addtime = (substr($convert_validity, 0, -1) * 7) . " Days";
                    } 
                    $startdate = ucfirst($convert_startdate);
                    $expdate = str_replace('/', '-', $startdate);
                    $add = strtotime('+' . $addtime, strtotime($expdate));
                    $enddate = strtolower(date('M/d/Y', $add));
                    $onevent = ':put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',");/ppp secret set [find where name="'.$convert_name.'"] profile='.$convert_fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$convert_name.'"]; /sys sch set [find where name="'.$convert_name.'"] interval='.$convert_gperiod.' on-event={:put (",'.$convert_mainprofile.','.$convert_fupprofile.','.$convert_gperiod.','.$convert_validity.','.$convert_startdate.','.$enddate.','.$convert_name.','.$convert_harga.',"); /ppp secret set [find where name="'.$convert_name.'"] disabled=yes ; /sys sch set [find where name="'.$convert_name.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$convert_name.'"];}';
                    $this->ROSModel->convert_ppp_scheduler($convert_name,$convert_startdate,$convert_validity,$onevent);
                    $this->session->setFlashdata('success', ['PPP Secret convert berhasil!']);
                    return redirect()->to(base_url('u/pppsecrets'));
                }
            }
        }
    }

    public function do_edit_pppsecret() {
        $eid = $this->request->getPost('eid');
        $ename = $this->request->getPost('ename');
        $epass = $this->request->getPost('epass');
        $elocaladdress = $this->request->getPost('elocaladdress');
        $eremoteaddress = $this->request->getPost('eremoteaddress');
        $q = $this->ROSModel->edit_ppp_secret($eid,$ename,$epass,$elocaladdress,$eremoteaddress);
        if (!empty($q['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppsecrets'));
        } else {
            $this->session->setFlashdata('success', ['PPP Secret berhasil diubah!']);
            return redirect()->to(base_url('u/pppsecrets'));
        }
    }

    public function do_extend_pppsecret() {
        $sid = $this->request->getPost('sid');
        $sname = $this->request->getPost('sname');
        $schid = $this->request->getPost('schid');
        $startdate = $this->request->getPost('startdate');
        $enddate = $this->request->getPost('enddate');
        $mainprofile = $this->request->getPost('mainprofile');
        $fupprofile = $this->request->getPost('fupprofile');
        $masaktif = $this->request->getPost('masaktif');
        $graceperiod = $this->request->getPost('graceperiod');
        $pppactiveid = $this->request->getPost('pppactiveid');
        $harga = $this->request->getPost('exharga');

        $getrotuer = $this->DashboardModel->get_router_by_router_id();
        date_default_timezone_set($getrotuer[0]->router_ntp);
        $myTime = Time::today($getrotuer[0]->router_ntp, 'id_ID');
        $tudey = date('d-m-Y', strtotime($myTime));
        $now = strtotime($tudey);
        $d2 = str_replace('/', '-', $enddate);
        $d3 = strtotime($d2);
        $d4 = date('d-m-Y', $d3);
        $exp_date = strtotime($d4);
        $formula = $now - $exp_date;
        $datediff = round($formula / (60 * 60 * 24));

        if ($exp_date < $now) {
            $enddate2 = ucfirst($enddate);
            $enddate3 = str_replace('/', '-', $enddate2);
            $add = strtotime('+' . $datediff . ' days', strtotime($enddate3));
            $newstartdate =  strtolower(date('M/d/Y', $add));

            if (substr($masaktif, -1) == "d" & strlen($masaktif) > 3) {
                $addtime = ((substr($masaktif, 0, -1) * 7) + substr($masaktif, 2, 1)) . " Days";
            } else if (substr($masaktif, -1) == "d") {
                $addtime = substr($masaktif, 0, -1) . " Days";
            } else if (substr($masaktif, -1) == "h") {
                $addtime = substr($masaktif, 0, -1) . " Hours";
            } else if (substr($masaktif, -1) == "w") {
                $addtime = (substr($masaktif, 0, -1) * 7) . " Days";
            } 

            $newstartdate2 = ucfirst($newstartdate);
            $newstartdate3 = str_replace('/', '-', $newstartdate2);
            $add2 = strtotime('+' . $addtime, strtotime($newstartdate3));
            $newenddate =  strtolower(date('M/d/Y', $add2));
        } else {
            $newstartdate = $enddate;

            if (substr($masaktif, -1) == "d" & strlen($masaktif) > 3) {
                $addtime = ((substr($masaktif, 0, -1) * 7) + substr($masaktif, 2, 1)) . " Days";
            } else if (substr($masaktif, -1) == "d") {
                $addtime = substr($masaktif, 0, -1) . " Days";
            } else if (substr($masaktif, -1) == "h") {
                $addtime = substr($masaktif, 0, -1) . " Hours";
            } else if (substr($masaktif, -1) == "w") {
                $addtime = (substr($masaktif, 0, -1) * 7) . " Days";
            } 

            $enddate2 = ucfirst($enddate);
            $enddate3 = str_replace('/', '-', $enddate2);
            $add = strtotime('+' . $addtime, strtotime($enddate3));
            $newenddate =  strtolower(date('M/d/Y', $add));
        }

        $onevent = ':put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$masaktif.','.$newstartdate.','.$newenddate.','.$sname.','.$harga.',");/ppp secret set [find where name="'.$sname.'"] profile='.$fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$sname.'"]; /sys sch set [find where name="'.$sname.'"] interval='.$graceperiod.' on-event={:put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$masaktif.','.$newstartdate.','.$newenddate.','.$sname.','.$harga.',"); /ppp secret set [find where name="'.$sname.'"] disabled=yes ; /sys sch set [find where name="'.$sname.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$sname.'"];}';

        $query = $this->ROSModel->extend_ppp_secret($sid,$mainprofile);
        if (!empty($query['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppsecrets'));
        } else {
            $removeactive = $this->ROSModel->remove_ppp_active($pppactiveid);
            if (!empty($removeactive['after']['message'])) {
                $this->ROSModel->extend_ppp_scheduler($schid,$sname,$newenddate,$masaktif,$onevent);
                $this->session->setFlashdata('success', ['PPP Secret diperpanjang!']);
                return redirect()->to(base_url('u/pppsecrets'));
            } else {
                $this->ROSModel->extend_ppp_scheduler($schid,$sname,$newenddate,$masaktif,$onevent);
                $this->session->setFlashdata('success', ['PPP Secret diperpanjang!']);
                return redirect()->to(base_url('u/pppsecrets'));
            }
        }
    }

    public function do_changeprice_pppsecret() {
        $sname = $this->request->getPost('uname');
        $schid = $this->request->getPost('uschid');
        $startdate = $this->request->getPost('ustartdate');
        $enddate = $this->request->getPost('uenddate');
        $mainprofile = $this->request->getPost('umainprofile');
        $fupprofile = $this->request->getPost('ufupprofile');
        $masaktif = $this->request->getPost('umasaktif');
        $graceperiod = $this->request->getPost('ugraceperiod');
        $harga = $this->request->getPost('uharga');

        $onevent = ':put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$masaktif.','.$startdate.','.$enddate.','.$sname.','.$harga.',");/ppp secret set [find where name="'.$sname.'"] profile='.$fupprofile.' comment="EXPIRED"; /ppp active remove [find where name="'.$sname.'"]; /sys sch set [find where name="'.$sname.'"] interval='.$graceperiod.' on-event={:put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$masaktif.','.$startdate.','.$enddate.','.$sname.','.$harga.',"); /ppp secret set [find where name="'.$sname.'"] disabled=yes ; /sys sch set [find where name="'.$sname.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$sname.'"];}';

        $changeprice = $this->ROSModel->changeprice_ppp_scheduler($schid,$onevent);
        if (!empty($changeprice['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppsecrets'));
        } else {
            $this->session->setFlashdata('success', ['Harga berhasil di ubah!']);
            return redirect()->to(base_url('u/pppsecrets'));
        }
    }

    

    public function adduserprofile() {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        
        $data['pool'] = $this->ros->comm("/ip/pool/print", array());
        $data['pqueue'] = $this->ros->comm("/queue/simple/print", array("?dynamic" => "no"));
        
        $this->ros->disconnect;

        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-database"></i>';
        $data['title'] = ' Add User Profile';
        $data['view'] = 'base/dashboard/adduserprofile';
        return view('base/dashboard/layout', $data);
    }

    public function do_add_userprofile() {
        $namewithspace = $this->request->getPost('pname');
        $name = str_replace(' ', '', $namewithspace);
        $sharedusers = $this->request->getPost('pshared');
        $ratelimit = $this->request->getPost('plimit');
        $expmode = $this->request->getPost('pexpmode');
        $validity = $this->request->getPost('pvalidity');
        $graceperiod = $this->request->getPost('graceperiod');
        $getprice = $this->request->getPost('pprice');
        $getsprice = $this->request->getPost('psellingprice');
        $addrpool = $this->request->getPost('ppool');
        if ($getprice == "") {
            $price = "0";
        } else {
            $price = $getprice;
        }
        if ($getsprice == "") {
            $sprice = "0";
        } else {
            $sprice = $getsprice;
        }
        $getlock = $this->request->getPost('plock');
        if ($getlock == "Enable") {
            $lock = '; [:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
        } else {
            $lock = "";
        }
        $randstarttime = "0".rand(1,5).":".rand(10,59).":".rand(10,59);
        $randinterval = "00:02:".rand(10,59);

        $parent = $this->request->getPost('pqueue');

        $record = '; :local mac $"mac-address"; :local time [/system clock get time ]; /system script add name="$date-|-$time-|-$user-|-'.$price.'-|-$address-|-$mac-|-' . $validity . '-|-'.$name.'-|-$comment" owner="$month$year" source=$date comment=mikhmon';

        $onlogin = ':put (",'.$expmode.',' . $price . ',' . $validity . ','.$sprice.',,' . $getlock . ',"); {:local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ];:local comment [ /ip hotspot user get [/ip hotspot user find where name="$user"] comment]; :local ucode [:pic $comment 0 2]; :if ($ucode = "vc" or $ucode = "up" or $comment = "") do={ /sys sch add name="$user" disable=no start-date=$date interval="' . $validity . '"; :delay 2s; :local exp [ /sys sch get [ /sys sch find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pic $exp 0 6]; :local t [:pic $exp 7 16]; :local s ("/"); :local exp ("$d$s$year $t"); /ip hotspot user set comment=$exp [find where name="$user"];}; :if ($getxp = 8) do={ /ip hotspot user set comment="$date $exp" [find where name="$user"];}; :if ($getxp > 15) do={ /ip hotspot user set comment=$exp [find where name="$user"];}; /sys sch remove [find where name="$user"]';

        if ($expmode == "rem") {
            $onlogin = $onlogin . $lock . "}}";
            $mode = "remove";
        } elseif ($expmode == "ntf") {
            $onlogin = $onlogin . $lock . "}}";
            $mode = "set limit-uptime=1s";
        } elseif ($expmode == "remc") {
            $onlogin = $onlogin . $record . $lock . "}}";
            $mode = "remove";
        } elseif ($expmode == "ntfc") {
            $onlogin = $onlogin . $record . $lock . "}}";
            $mode = "set limit-uptime=1s";
        } elseif ($expmode == "0" && $price != "") {
            $onlogin = ':put (",,' . $price . ',,,noexp,' . $getlock . ',")' . $lock;
        } else {
            $onlogin = "";
        }

        $bgservice = ':local dateint do={:local montharray ( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );:local days [ :pick $d 4 6 ];:local month [ :pick $d 0 3 ];:local year [ :pick $d 7 11 ];:local monthint ([ :find $montharray $month]);:local month ($monthint + 1);:if ( [len $month] = 1) do={:local zero ("0");:return [:tonum ("$year$zero$month$days")];} else={:return [:tonum ("$year$month$days")];}}; :local timeint do={ :local hours [ :pick $t 0 2 ]; :local minutes [ :pick $t 3 5 ]; :return ($hours * 60 + $minutes) ; }; :local date [ /system clock get date ]; :local time [ /system clock get time ]; :local today [$dateint d=$date] ; :local curtime [$timeint t=$time] ; :foreach i in [ /ip hotspot user find where profile="'.$name.'" ] do={ :local comment [ /ip hotspot user get $i comment]; :local name [ /ip hotspot user get $i name]; :local gettime [:pic $comment 12 20]; :if ([:pic $comment 3] = "/" and [:pic $comment 6] = "/") do={:local expd [$dateint d=$comment] ; :local expt [$timeint t=$gettime] ; :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={ [ /ip hotspot user '.$mode.' $i ]; [ /ip hotspot active remove [find where user=$name] ];}}}';

        $qadd = $this->ROSModel->add_user_profile($name,$addrpool,$ratelimit,$sharedusers,$onlogin,$parent);
        $gsch = $this->ROSModel->get_scheduler_by_hotspotpname($name);
        $monid = $gsch[0]['.id'];
        if($expmode != "0") {
            if (empty($monid)) {
                $qsch = $this->ROSModel->add_scheduler($name,$randstarttime,$randinterval,$bgservice);
            } else {
                $qset = $this->ROSModel->set_scheduler($monid,$name,$randstarttime,$randinterval,$bgservice);
            }
        } else {
            $qrmv = $this->ROSModel->remove_scheduler_byid($monid);
        }

        if (!empty($qadd['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/userprofiles'));
        } else {
            $this->session->setFlashdata('success', ['Sukses! User profile berhasil disimpan!']);
            return redirect()->to(base_url('u/userprofiles'));
        }
    }

    public function do_edit_userprofile() {
        $pid = $this->request->getPost('pid');
        $namewithspace = $this->request->getPost('pname');
        $name = str_replace(' ', '', $namewithspace);
        $sharedusers = $this->request->getPost('pshared');
        $ratelimit = $this->request->getPost('plimit');
        $expmode = $this->request->getPost('pexpmode');
        $validity = $this->request->getPost('pvalidity');
        $graceperiod = $this->request->getPost('graceperiod');
        $getprice = $this->request->getPost('pprice');
        $getsprice = $this->request->getPost('psellingprice');
        $addrpool = $this->request->getPost('ppool');

        if ($getprice == "") {
            $price = "0";
        } else {
            $price = $getprice;
        }
        if ($getsprice == "") {
            $sprice = "0";
        } else {
            $sprice = $getsprice;
        }
        $getlock = $this->request->getPost('plock');
        if ($getlock == "Enable") {
            $lock = '; [:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
        } else {
            $lock = "";
        }
        $randstarttime = "0".rand(1,5).":".rand(10,59).":".rand(10,59);
        $randinterval = "00:02:".rand(10,59);

        $parent = $this->request->getPost('pqueue');

        $record = '; :local mac $"mac-address"; :local time [/system clock get time ]; /system script add name="$date-|-$time-|-$user-|-'.$price.'-|-$address-|-$mac-|-' . $validity . '-|-'.$name.'-|-$comment" owner="$month$year" source=$date comment=mikhmon';

        $onlogin = ':put (",'.$expmode.',' . $price . ',' . $validity . ','.$sprice.',,' . $getlock . ',"); {:local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ];:local comment [ /ip hotspot user get [/ip hotspot user find where name="$user"] comment]; :local ucode [:pic $comment 0 2]; :if ($ucode = "vc" or $ucode = "up" or $comment = "") do={ /sys sch add name="$user" disable=no start-date=$date interval="' . $validity . '"; :delay 2s; :local exp [ /sys sch get [ /sys sch find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pic $exp 0 6]; :local t [:pic $exp 7 16]; :local s ("/"); :local exp ("$d$s$year $t"); /ip hotspot user set comment=$exp [find where name="$user"];}; :if ($getxp = 8) do={ /ip hotspot user set comment="$date $exp" [find where name="$user"];}; :if ($getxp > 15) do={ /ip hotspot user set comment=$exp [find where name="$user"];}; /sys sch remove [find where name="$user"]';

        if ($expmode == "rem") {
            $onlogin = $onlogin . $lock . "}}";
            $mode = "remove";
        } elseif ($expmode == "ntf") {
            $onlogin = $onlogin . $lock . "}}";
            $mode = "set limit-uptime=1s";
        } elseif ($expmode == "remc") {
            $onlogin = $onlogin . $record . $lock . "}}";
            $mode = "remove";
        } elseif ($expmode == "ntfc") {
            $onlogin = $onlogin . $record . $lock . "}}";
            $mode = "set limit-uptime=1s";
        } elseif ($expmode == "0" && $price != "") {
            $onlogin = ':put (",,' . $price . ',,,noexp,' . $getlock . ',")' . $lock;
        } else {
            $onlogin = "";
        }

        $bgservice = ':local dateint do={:local montharray ( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );:local days [ :pick $d 4 6 ];:local month [ :pick $d 0 3 ];:local year [ :pick $d 7 11 ];:local monthint ([ :find $montharray $month]);:local month ($monthint + 1);:if ( [len $month] = 1) do={:local zero ("0");:return [:tonum ("$year$zero$month$days")];} else={:return [:tonum ("$year$month$days")];}}; :local timeint do={ :local hours [ :pick $t 0 2 ]; :local minutes [ :pick $t 3 5 ]; :return ($hours * 60 + $minutes) ; }; :local date [ /system clock get date ]; :local time [ /system clock get time ]; :local today [$dateint d=$date] ; :local curtime [$timeint t=$time] ; :foreach i in [ /ip hotspot user find where profile="'.$name.'" ] do={ :local comment [ /ip hotspot user get $i comment]; :local name [ /ip hotspot user get $i name]; :local gettime [:pic $comment 12 20]; :if ([:pic $comment 3] = "/" and [:pic $comment 6] = "/") do={:local expd [$dateint d=$comment] ; :local expt [$timeint t=$gettime] ; :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={ [ /ip hotspot user '.$mode.' $i ]; [ /ip hotspot active remove [find where user=$name] ];}}}';

        $qedit = $this->ROSModel->edit_user_profile($pid,$name,$addrpool,$ratelimit,$sharedusers,$onlogin,$parent);
        $gsch = $this->ROSModel->get_scheduler_by_hotspotpname($name);
        $monid = $gsch[0]['.id'];
        if($expmode != "0") {
            if (empty($monid)) {
                $qsch = $this->ROSModel->add_scheduler($name,$randstarttime,$randinterval,$bgservice);
            } else {
                $qset = $this->ROSModel->set_scheduler($monid,$name,$randstarttime,$randinterval,$bgservice);
            }
        } else {
            $qrmv = $this->ROSModel->remove_scheduler_byid($monid);
        }

        if (!empty($qedit['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/userprofiles'));
        } else {
            $this->session->setFlashdata('success', ['Sukses! User profile berhasil di edit!']);
            return redirect()->to(base_url('u/userprofiles'));
        }
    }

    public function generateusers() {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $data['server'] = $this->ros->comm("/ip/hotspot/print", array());
        $data['profile'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
        $this->ros->disconnect;

        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-user-plus"></i>';
        $data['title'] = 'Generate User';
        $data['view'] = 'base/dashboard/generateusers';
        return view('base/dashboard/layout', $data);
    }

    public function do_generate_users() {
//        $ciphering = "AES-128-CTR";
//        $iv_length = openssl_cipher_iv_length($ciphering);
//        $options = 0;
//        $iv = '1234567891011121';
//        $key = "MikPay";

        $sysclock = $this->ROSModel->get_clock();
        $systimezone = $sysclock[0]['time-zone-name'];
        date_default_timezone_set($systimezone);
        ini_set('max_execution_time', 300);

        $srvlist = $this->ROSModel->get_server();
        $qty = $this->request->getPost('qty');
        if (isset($qty)) {
            $rosauth = $this->DashboardModel->get_router_by_router_id();
            $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));

            $server = $this->request->getPost('server');
            $user = $this->request->getPost('user');
            $userl = $this->request->getPost('userl');
            $prefix = $this->request->getPost('prefix');
            $char = $this->request->getPost('char');
            $profile = $this->request->getPost('profile');
            $timelimit = $this->request->getPost('timelimit');
            $datalimit = $this->request->getPost('datalimit');
            $adcomment = $this->request->getPost('adcomment');
            $mbgb = $this->request->getPost('mbgb');
            if ($timelimit == "") {
                $timelimit = "0";
            } else {
                $timelimit = $this->request->getPost('timelimit');
            }
            if ($datalimit == "") {
                $datalimit = "0";
            } else {
                $datalimit = $datalimit * $mbgb;
            }
            if ($adcomment == "") {
                $adcomment = "";
            } else {
                $adcomment = $this->request->getPost('adcomment');
            }

            $getprofile = $this->ros->comm("/ip/hotspot/user/profile/print", array("?name" => "$profile"));
            $ponlogin = $getprofile[0]['on-login'];
            $getvalid = explode(",", $ponlogin)[3];
            $getprice = explode(",", $ponlogin)[2];
            $getsprice = explode(",", $ponlogin)[4];
            $getlock = explode(",", $ponlogin)[6];
            $_SESSION['ubp'] = $profile;
            $commt = $user . "-" . rand(100, 999) . "-" . date("m.d.y") . "-" . $adcomment;
            $datageneratedusers = [
                "user_id" => $_SESSION['id'],
                "router_id" => $_SESSION['router_id'],
                "comment" => $commt,
                "profile" => $profile,
                "price" => $getprice,
                "sprice" => $getsprice,
                "timelimit" => $timelimit,
                "datalimit" => $datalimit,
                "devicelock" => $getlock,
                "validity" => $getvalid
            ];

            $a = array("1" => "", "", 1, 2, 2, 3, 3, 4);
            $randomizehelper = new RandomizeHelper();
            if ($user == "up") {
                for ($i = 1; $i <= $qty; $i++) {
                    if ($char == "lower") {
                        $u[$i] = $randomizehelper->randLC($userl);
                    } elseif ($char == "upper") {
                        $u[$i] = $randomizehelper->randUC($userl);
                    } elseif ($char == "upplow") {
                        $u[$i] = $randomizehelper->randULC($userl);
                    } elseif ($char == "mix") {
                        $u[$i] = $randomizehelper->randNLC($userl);
                    } elseif ($char == "mix1") {
                        $u[$i] = $randomizehelper->randNUC($userl);
                    } elseif ($char == "mix2") {
                        $u[$i] = $randomizehelper->randNULC($userl);
                    }
                    if ($userl == 3) {
                        $p[$i] = $randomizehelper->randN(3);
                    } elseif ($userl == 4) {
                        $p[$i] = $randomizehelper->randN(4);
                    } elseif ($userl == 5) {
                        $p[$i] = $randomizehelper->randN(5);
                    } elseif ($userl == 6) {
                        $p[$i] = $randomizehelper->randN(6);
                    } elseif ($userl == 7) {
                        $p[$i] = $randomizehelper->randN(7);
                    } elseif ($userl == 8) {
                        $p[$i] = $randomizehelper->randN(8);
                    }

                    $u[$i] = "$prefix$u[$i]";
                }

                for ($i = 1; $i <= $qty; $i++) {
                    
                    $this->ros->comm("/ip/hotspot/user/add", array(
                        "server" => "$server",
                        "name" => "$u[$i]",
                        "password" => "$p[$i]",
                        "profile" => "$profile",
                        "limit-uptime" => "$timelimit",
                        "limit-bytes-total" => "$datalimit",
                        "comment" => "$commt",
                    ));
                }
            }

            if ($user == "vc") {
                $shuf = ($userl - $a[$userl]);
                for ($i = 1; $i <= $qty; $i++) {
                    if ($char == "lower") {
                        $u[$i] = $randomizehelper->randLC($shuf);
                    } elseif ($char == "upper") {
                        $u[$i] = $randomizehelper->randUC($shuf);
                    } elseif ($char == "upplow") {
                        $u[$i] = $randomizehelper->randULC($shuf);
                    }
                    if ($userl == 3) {
                        $p[$i] = $randomizehelper->randN(1);
                    } elseif ($userl == 4 || $userl == 5) {
                        $p[$i] = $randomizehelper->randN(2);
                    } elseif ($userl == 6 || $userl == 7) {
                        $p[$i] = $randomizehelper->randN(3);
                    } elseif ($userl == 8) {
                        $p[$i] = $randomizehelper->randN(4);
                    }

                    $u[$i] = "$prefix$u[$i]$p[$i]";

                    if ($char == "num") {
                        if ($userl == 3) {
                            $p[$i] = $randomizehelper->randN(3);
                        } elseif ($userl == 4) {
                            $p[$i] = $randomizehelper->randN(4);
                        } elseif ($userl == 5) {
                            $p[$i] = $randomizehelper->randN(5);
                        } elseif ($userl == 6) {
                            $p[$i] = $randomizehelper->randN(6);
                        } elseif ($userl == 7) {
                            $p[$i] = $randomizehelper->randN(7);
                        } elseif ($userl == 8) {
                            $p[$i] = $randomizehelper->randN(8);
                        }
                        $u[$i] = "$prefix$p[$i]";
                    }
                    if ($char == "mix") {
                        $p[$i] = $randomizehelper->randNLC($userl);
                        $u[$i] = "$prefix$p[$i]";
                    }
                    if ($char == "mix1") {
                        $p[$i] = $randomizehelper->randNUC($userl);
                        $u[$i] = "$prefix$p[$i]";
                    }
                    if ($char == "mix2") {
                        $p[$i] = $randomizehelper->randNULC($userl);
                        $u[$i] = "$prefix$p[$i]";
                    }

                }
                for ($i = 1; $i <= $qty; $i++) {
                    $this->ros->comm("/ip/hotspot/user/add", array(
                        "server" => "$server",
                        "name" => "$u[$i]",
                        "password" => "$u[$i]",
                        "profile" => "$profile",
                        "limit-uptime" => "$timelimit",
                        "limit-bytes-total" => "$datalimit",
                        "comment" => "$commt",
                    ));
                }
            }
            $this->ros->disconnect;
            $this->session->setFlashdata('success', ['Generate user berhasil']);
            $this->session->setFlashdata('comment', $commt);
            return redirect()->to(base_url('u/userlist/'));
        } else {
            $this->session->setFlashdata('error', ['Generate user gagal']);
            return redirect()->to(base_url('u/userlist'));
        }
    }

    public function adduser()
    {
        $rosauth = $this->DashboardModel->get_router_by_router_id();
        $this->ros->connect($rosauth[0]->router_host, $rosauth[0]->router_user, $this->key->de($rosauth[0]->router_pass));
        $data['server'] = $this->ros->comm("/ip/hotspot/print", array());
        $data['profile'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
        $this->ros->disconnect;
        
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['icon'] = '<i class="fe fe-user-plus"></i>';
        $data['title'] = 'Add User';
        $data['view'] = 'base/dashboard/adduser';
        return view('base/dashboard/layout', $data);
    }

    public function do_add_user() {
        $userver = $this->request->getPost('userver');
        $uname = $this->request->getPost('uname');
        $upass = $this->request->getPost('upass');
        $uprofile = $this->request->getPost('uprofile');
        $ulimittime = $this->request->getPost('ulimittime');
        $p1 = $this->request->getPost('p1');
        $p2 = $this->request->getPost('p2');
        if ($p2 == 'mb') {
            $ulimitdata = $p1 * 1048576;
        } else {
            $ulimitdata = $p1 * 1073741824;
        }
        if ($uname == $upass) {
            $ucomment = 'vc-';
        } else {
            $ucomment = 'up-';
        }

        $adduser = $this->ROSModel->add_user($userver, $uname, $upass, $uprofile, $ulimitdata, $ulimittime, $ucomment);
        if (!empty($adduser['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/userlist'));
        } else {
            $this->session->setFlashdata('success', ['User berhasil disimpan!']);
            return redirect()->to(base_url('u/userlist'));
        }
    }

    public function do_add_pppprofile() {
        $pname = $this->request->getPost('pname');
        $plocal = $this->request->getPost('plocal');
        $premote = $this->request->getPost('premote');
        $pqueue = $this->request->getPost('pqueue');
        $prlimit = $this->request->getPost('prlimit');
        $pcomment = $this->request->getPost('pcomment');

        $adduser = $this->ROSModel->add_ppp_profile($pname,$plocal,$premote,$pqueue,$prlimit,$pcomment);
        if (!empty($adduser['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppprofiles'));
        } else {
            $this->session->setFlashdata('success', ['PPP Profile berhasil disimpan!']);
            return redirect()->to(base_url('u/pppprofiles'));
        }
    }

    public function do_edit_pppprofile() {
        $pid = $this->request->getPost('pid');
        $pname = $this->request->getPost('pname');
        $plocal = $this->request->getPost('plocal');
        $premote = $this->request->getPost('premote');
        $pqueue = $this->request->getPost('pqueue');
        $prlimit = $this->request->getPost('prlimit');
        $pcomment = $this->request->getPost('pcomment');

        $adduser = $this->ROSModel->edit_ppp_profile($pid,$pname,$plocal,$premote,$pqueue,$prlimit,$pcomment);
        if (!empty($adduser['after']['message'])) {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppprofiles'));
        } else {
            $this->session->setFlashdata('success', ['PPP Profile berhasil diubah!']);
            return redirect()->to(base_url('u/pppprofiles'));
        }
    }

    public function do_remove_pppprofile() {
        $pid = $this->request->getPost('pid');
        $q = $this->ROSModel->remove_ppp_profile($pid);
        if (isset($q["after"]))
        {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/pppprofiles'));
        } else {
            $this->session->setFlashdata('hapuss', ['User profile berhasil dihapus!']);
            return redirect()->to(base_url('u/pppprofiles'));
        }
    }

    public function do_edit_user() {
        $uid = $this->request->getPost('uid');
        $userver = $this->request->getPost('userver');
        $uname = $this->request->getPost('uname');
        $upass = $this->request->getPost('upass');
        $uprofile = $this->request->getPost('uprofile');
        $ulimittime = $this->request->getPost('ulimittime');
        $p1 = $this->request->getPost('p1');
        $p2 = $this->request->getPost('p2');
        if ($p2 == 'mb') {
            $ulimitdata = $p1 * 1048576;
        } else {
            $ulimitdata = $p1 * 1073741824;
        }

        $q = $this->ROSModel->edit_user($uid, $userver, $uname, $upass, $uprofile, $ulimitdata, $ulimittime);
       
        if (isset($q["after"]))
        {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('u/userlist'));
        } else {
            $this->session->setFlashdata('success', ['User berhasil diedit!']);
            return redirect()->to(base_url('u/userlist'));
        }
    }

    public function do_remove_user_by_uids() {
        $uids = $this->request->getPost('uids');
        $q = $this->ROSModel->remove_user_by_ids($uids);
        if (isset($q["after"]))
        {
            $this->session->setFlashdata('error', ['Gagal!']);
            return 'error';
        } else {
            $this->session->setFlashdata('success', ['User berhasil dihapus!']);
            return 'ok';
        }
    }

    public function do_remove_user_by_comment() {
        $uids = $this->request->getPost('uids');
        $ucomment = $this->request->getPost('ucomment');
        $q = $this->ROSModel->remove_user_by_comments($uids, $ucomment);
        if (isset($q["after"]))
        {
            $this->session->setFlashdata('error', ['Gagal!']);
            return 'error';
        } else {
            $this->session->setFlashdata('success', ['User berhasil dihapus!']);
            return 'ok';
        }
    }

    public function do_disable_user() {
        $uid = $this->request->getPost('uid');
        $this->ROSModel->disable_user($uid);
        $this->session->setFlashdata('error', ['User disabled!']);
        return redirect()->to(base_url('u/userlist'));
    }

    public function do_enable_user() {
        $uid = $this->request->getPost('uid');
        $this->ROSModel->enable_user($uid);
        $this->session->setFlashdata('success', ['User enabled!']);
        return redirect()->to(base_url('u/userlist'));
    }

    public function do_remove_userprofile() {
        $pid = $this->request->getPost('pid');
        $pname = $this->request->getPost('pname');
        $monstate = $this->request->getPost('monstate');

        if ($monstate == 'text-green') {
            $gsch = $this->ROSModel->get_scheduler_by_hotspotpname($pname);
            $monid = $gsch[0]['.id'];
            $this->ROSModel->remove_scheduler_byid($monid);
            $this->ROSModel->remove_user_profile($pid);
            $this->session->setFlashdata('hapuss', ['User profile berhasil dihapus!']);
            return redirect()->to(base_url('u/userprofiles'));
        } else {
            $this->ROSModel->remove_user_profile($pid);
            $this->session->setFlashdata('hapuss', ['User profile berhasil dihapus!']);
            return redirect()->to(base_url('u/userprofiles'));
        }
    }

    public function printvoucher(){
        $ucomment = $this->request->getPost('ucomment');
        $data['user'] = $this->ROSModel->get_user_by_comment($ucomment);
        $profile =  $data['user'][0]['profile'];
        $getprofile = $this->ROSModel->get_profile_by_name($profile);
        foreach ($getprofile as $row) {
            $ponlogin = $row['on-login'];
            $getvalid = explode(",", $ponlogin)[3];
            $getprice = explode(",", $ponlogin)[2];
            $getsprice = explode(",", $ponlogin)[4];
        }
        if (!empty($getvalid)) {
            $data['validity'] = $getvalid;
        }
        if ($getsprice != 0) {
            $data['price'] = $getprice;
        }
        if ($getsprice != 0 ) {
            $data['seller_price'] = $getsprice;
        }
        $getusermode = explode("-", $ucomment);
        $data['usermode'] = $getusermode[0];
        $data['router'] = $this->DashboardModel->get_router_by_router_id();
        $data['koment'] = $ucomment;
        return view('pdf/userspdf', $data);
    }

    public function do_update_tripaydata() {
        $merchantcode = $this->request->getPost('merchantcode');
        $apikey = $this->request->getPost('apikey');
        $privatekey = $this->request->getPost('privatekey');
        $data = [
            'tripay_merchant_code'   => $merchantcode,
            'tripay_api_key'  => $apikey,
            'tripay_private_key' => $privatekey,
        ];
        $update = $this->DashboardModel->update_tripaydata($data);
        if ($update) {
            $this->session->setFlashdata('success', ['Tripay Settings Updated!']);
            return redirect()->to(base_url('u/paymentsettings'));
        } else {
            $this->session->setFlashdata('error', ['Failed!']);
            return redirect()->to(base_url('u/paymentsettings'));
        }
        
    }

    public function e404() {
        return view('errors/404');
    }

}