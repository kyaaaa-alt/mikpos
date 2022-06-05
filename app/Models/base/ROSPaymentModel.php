<?php namespace App\Models\base;

use RouterOS\Client;
use RouterOS\Query;
use CodeIgniter\Model;

class ROSPaymentModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->key = new \App\Libraries\Key();
        $db  = \Config\Database::connect(); 
        $this->router = $db->table('router');
        $this->users = $db->table('users');
        $this->transaksi = $db->table('transaksi');
        $this->payment_method = $db->table('payment_method');
        
    }

    public function get_user_by_id($userid) {
        $builder = $this->users;
        $builder->select('id');
        $builder->where('id', $userid);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_router_by_id($routerid,$userid) {
        $builder = $this->router;
        $builder->select('id,user_id,router_name,router_dns,router_ntp');
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        return $query->getResult();
    }

    public function gr($routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_tripay_api($routerid,$userid) {
        $builder = $this->router;
        $builder->select('id,user_id,tripay_merchant_code,tripay_api_key,tripay_private_key');
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        return $query->getResult();
    }

    public function add_transaksi($dataTransaksi) {
        $builder = $this->transaksi;
        return $builder->insert($dataTransaksi);
    }

    public function get_transaksi_by_membername($userid,$routerid,$membername) {
        $builder = $this->transaksi;
        $builder->where('user_id', $userid);
        $builder->where('router_id', $routerid);
        $builder->where('customer_name', $membername);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_transaksi_by_ref($userid,$routerid,$ref,$mref) {
        $builder = $this->transaksi;
        $builder->where('user_id', $userid);
        $builder->where('router_id', $routerid);
        $builder->where('reference', $ref);
        $builder->where('merchant_ref', $mref);
        $query = $builder->get();
        return $query->getResult();
    }
    public function update_transaksi_status($userid,$routerid,$ref,$mref,$status){
        $builder = $this->transaksi;
        $builder->set('status', $status);
        $builder->where('user_id', $userid);
        $builder->where('router_id', $routerid);
        $builder->where('reference', $ref);
        $builder->where('merchant_ref', $mref);
        return $builder->update();
    }
    
    public function update_transaksi_query_failed($userid,$routerid,$ref,$mref){
        $builder = $this->transaksi;
        $builder->set('query_status', 'failed');
        $builder->where('user_id', $userid);
        $builder->where('router_id', $routerid);
        $builder->where('reference', $ref);
        $builder->where('merchant_ref', $mref);
        return $builder->update();
    }

    public function update_transaksi_query_sukses($userid,$routerid,$ref,$mref,$qresult){
        $builder = $this->transaksi;
        $builder->set('query_status', 'sukses');
        $builder->set('query_result', $qresult);
        $builder->where('user_id', $userid);
        $builder->where('router_id', $routerid);
        $builder->where('reference', $ref);
        $builder->where('merchant_ref', $mref);
        return $builder->update();
    }

    public function get_ppp_secret_by_secret_name($ppp_secret_name,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ppp/secret/print');
        $query->where('name', $ppp_secret_name);
        return $ros->qr($query);
    }
    public function remove_ppp_active($activeid,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ppp/active/remove');
        $query->equal('.id', $activeid);
        return $ros->qr($query);
    }

    public function add_user($name,$profile,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/add');
        $query->equal('server', 'all');
        $query->equal('name', $name);
        $query->equal('password', $name);
        $query->equal('profile', $profile);
        $query->equal('comment', 'vc-');
        return $ros->qr($query);
    }

    public function extend_ppp_secret($sid,$mainprofile,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ppp/secret/set');
        $query->where('.id', $sid);
        $query->equal('.id', $sid);
        $query->equal('profile', $mainprofile);
        $query->equal('comment', ' ');
        $query->equal('disabled', 'no');
        return $ros->qr($query);
    }

    public function extend_ppp_scheduler($schid,$sname,$newenddate,$masaktif,$onevent,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/system/scheduler/set');
        $query->where('.id', $schid);
        $query->equal('.id', $schid);
        $query->equal('name', $sname);
        $query->equal('start-date', $newenddate);
        $query->equal('start-time', '00:00:00');
        $query->equal('interval', $masaktif);
        $query->equal('on-event', $onevent);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'PPPoE Monotior ' . $sname);
        return $ros->qr($query);
    }

    public function get_ppp_secret($name,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ppp/secret/print');
        $query->where('name', $name);
        return $ros->qr($query);
    }
    public function get_ppp_sch($name,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/system/scheduler/print');
        $query->where('name', $name);
        return $ros->qr($query);
    }

    public function get_hotspot_user($name,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/print');
        $query->where('name', $name);
        return $ros->qr($query);
    }

    public function get_uprofile($uprofile,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/profile/print');
        $query->where('name', $uprofile);
        return $ros->qr($query);
    }

    public function get_ppp_active($name,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ppp/active/print');
        $query->where('name', $name);
        return $ros->qr($query);
    }

    public function get_scheduler_by_secret_name($ppp_secret_name,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/system/scheduler/print');
        $query->where('name', $ppp_secret_name);
        return $ros->qr($query);
    }
    public function get_hotspot_profile($routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/profile/print');
        return $ros->qr($query);
    }

    public function extend_hotspot_user($uid,$newvalidity,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/set');
        $query->where('.id', $uid);
        $query->equal('.id', $uid);
        $query->equal('comment', $newvalidity);
        $query->equal('limit-uptime', '0');
        return $ros->qr($query);
    }

    public function get_hotspot_profile_by_name($profile,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/profile/print');
        $query->where('name', $profile);
        return $ros->qr($query);
    }

    public function get_profile_sch($profile,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/system/scheduler/print');
        $query->where('name', $profile);
        return $ros->qr($query);
    }

    public function get_hotspot_user_by_name($kodevoucher,$routerid,$userid) {
        $builder = $this->router;
        $builder->where('id', $routerid);
        $builder->where('user_id', $userid);
        $query = $builder->get();
        $rosauth = $query->getResult();
        $ros = new Client([
            'host' => explode(":", $rosauth[0]->router_host)[0],
            'user' => $rosauth[0]->router_user,
            'pass' => $this->key->de($rosauth[0]->router_pass),
            'port' => (int) explode(":", $rosauth[0]->router_host)[1],
        ]);
        $query = new Query('/ip/hotspot/user/print');
        $query->where('name', $kodevoucher);
        return $ros->qr($query);
    }

    public function get_payment_method($routerid,$userid) {
        $builder = $this->payment_method;
        $builder->where('router_id', $routerid);
        $builder->where('user_id', $userid);
        $builder->where('status', '1');
        $query = $builder->get();
        return $query->getResult();
    }

}