<?php namespace App\Models\base;

use \RouterOS\Client;
use \RouterOS\Query;
use RouterOS\Config;

class ROSModel
{
    public function __construct()
    {
        $this->DashboardModel = new DashboardModel();
        $this->session = session();
        $this->key = new \App\Libraries\Key();
        if(session()->has('routerlogged'))
        {
            $rosauth = $this->DashboardModel->get_router_by_router_id();
            $this->config = new Config([
                'host' => explode(":", $rosauth[0]->router_host)[0],
                'user' => $rosauth[0]->router_user,
                'pass' => $this->key->de($rosauth[0]->router_pass),
                'port' => (int) explode(":", $rosauth[0]->router_host)[1],
                'timeout' => 3,
                'attempts' => 5,
                'delay' => 3,
                'socket_timeout' => 30,
                'socket_blocking' => false,
                'socket_options' => [ 
                    'tcp_nodelay' => true
                    ]
                ]);
        }
    }

    public function dashboard() {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/print');
        $query->equal('count-only');
        $hotspot_user = $this->ros->qr($query)['after']['ret'];
        $query = new Query('/ip/hotspot/active/print');
        $query->equal('count-only');
        $hotspot_active = $this->ros->qr($query)['after']['ret'];
        $query = new Query('/system/resource/print');
        $resource = $this->ros->qr($query);
        $model =  $resource[0]['board-name'];
        $ver =  $resource[0]['version'];
        $query = new Query('/system/clock/print');
        $sysdt = $this->ros->qr($query);
        $sysdate = $sysdt[0]['date'];
        $systime = $sysdt[0]['time'];
        $query = new Query('/ppp/secret/print');
        $query->equal('count-only');
        $ppp_secret = $this->ros->qr($query)['after']['ret'];
        $query = new Query('/ppp/active/print');
        $query->equal('count-only');
        $ppp_active = $this->ros->qr($query)['after']['ret'];
        return array(
            'hotspot_user' => $hotspot_user,
            'hotspot_active' => $hotspot_active,
            'model' => $model,
            'ver' => $ver,
            'sysdate' => $sysdate,
            'systime' => $systime,
            'ppp_secret' => $ppp_secret,
            'ppp_active' => $ppp_active,
        );
    }

    public function get_routerboard() {
        $this->ros = new Client($this->config);
        $query = new Query('/system/routerboard/print');
        return $this->ros->qr($query);
    }

    public function get_resource() {
        $this->ros = new Client($this->config);
        $query = new Query('/system/resource/print');
        return $this->ros->qr($query);
    }

    public function get_hotspot_users() {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/print');
        return $this->ros->qr($query);
    }

    public function get_ppp_secret() {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/print');
        return $this->ros->qr($query);
    }

    public function get_ppp_active() {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/active/print');
        return $this->ros->qr($query);
    }

    public function get_hotspot_active() {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/active/print');
        return $this->ros->qr($query);
    }

    public function get_clock() {
        $this->ros = new Client($this->config);
        $query = new Query('/system/clock/print');
        return $this->ros->qr($query);
    }

    public function add_user($userver, $uname, $upass, $uprofile, $ulimitdata, $ulimittime, $ucomment) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/add');
        $query->equal('server', $userver);
        $query->equal('name', $uname);
        $query->equal('password', $upass);
        $query->equal('profile', $uprofile);
        $query->equal('limit-bytes-total', $ulimitdata);
        if (!empty($ulimittime)) {
            $query->equal('limit-uptime', $ulimittime);
        }
        $query->equal('comment', $ucomment);
        return $this->ros->qr($query);
    }

    public function disable_user($uid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/set');
        $query->where('.id', $uid);
        $query->equal('.id', $uid);
        $query->equal('disabled', 'yes');
        return $this->ros->qr($query);
    }

    public function enable_user($uid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/set');
        $query->where('.id', $uid);
        $query->equal('.id', $uid);
        $query->equal('disabled', 'no');
        return $this->ros->qr($query);
    }

    public function edit_user($uid, $userver, $uname, $upass, $uprofile, $ulimitdata, $ulimittime) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/set');
        $query->where('.id', $uid);
        $query->equal('.id', $uid);
        $query->equal('server', $userver);
        $query->equal('name', $uname);
        if (!empty($upass)) {
            $query->equal('password', $upass);
        }
        $query->equal('profile', $uprofile);
        $query->equal('limit-bytes-total', $ulimitdata);
        if (!empty($ulimittime)) {
            $query->equal('limit-uptime', $ulimittime);
        } else {
            $query->equal('limit-uptime', '0');
        }
        return $this->ros->qr($query);
    }

    public function user_profile_list() {
        $this->ros = new Client($this->config);
        $query = new Query('ip/hotspot/user/profile/print');
        return $this->ros->qr($query);
    }

    public function add_user_profile($name,$addrpool,$ratelimit,$sharedusers,$onlogin,$parent) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/profile/add');
        $query->equal('name', $name);
        $query->equal('address-pool', $addrpool);
        $query->equal('shared-users', $sharedusers);
        $query->equal('parent-queue', $parent);
        $query->equal('rate-limit', $ratelimit);
        $query->equal('on-login', $onlogin);
        $query->equal('transparent-proxy', 'no');
        $query->equal('insert-queue-before', 'bottom');
        $query->equal('status-autorefresh', '1m');
        return $this->ros->qr($query);
    }

    public function edit_user_profile($pid,$name,$addrpool,$ratelimit,$sharedusers,$onlogin,$parent) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/profile/set');
        $query->where('.id', $pid);
        $query->equal('.id', $pid);
        $query->equal('name', $name);
        $query->equal('address-pool', $addrpool);
        $query->equal('shared-users', $sharedusers);
        $query->equal('parent-queue', $parent);
        $query->equal('rate-limit', $ratelimit);
        $query->equal('on-login', $onlogin);
        $query->equal('transparent-proxy', 'no');
        $query->equal('insert-queue-before', 'bottom');
        $query->equal('status-autorefresh', '1m');
        return $this->ros->qr($query);
    }

    public function get_user_by_uid($uid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/print');
        $query->where('.id', $uid);
        return $this->ros->qr($query);
    }

    public function change_expire($uid,$ucomment,$ulimit) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/set');
        $query->where('.id', $uid);
        $query->equal('.id', $uid);
        $query->equal('comment', $ucomment);
        if ($ulimit == '1s') {
            $query->equal('limit-uptime', '0');
        }
        return $this->ros->qr($query);
    }

    public function get_user_by_name($name) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/profile/print');
        $query->where('name', $name);
        return $this->ros->qr($query);
    }

    public function remove_user_by_ids($uids) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/remove');
        $query->equal('.id', $uids);
        return $this->ros->qr($query);
    }

    public function remove_user_by_comments($uids, $ucomment) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/remove');
        $query->equal('.id', $uids);
        $query->where('comment', $ucomment);
        return $this->ros->qr($query);
    }

    public function get_profile() {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/profile/print');
        return $this->ros->qr($query);
    }

    public function get_profile_by_name($profile) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/profile/print');
        $query->where('name', $profile);
        return $this->ros->qr($query);
    }

    public function get_server() {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/print');
        return $this->ros->qr($query);
    }

    public function get_scheduler() {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/print');
        return $this->ros->qr($query);
    }

    public function remove_user_profile($pid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/profile/remove');
        $query->equal('.id', $pid);
        return $this->ros->qr($query);
    }

    public function get_simple_queue() {
        $this->ros = new Client($this->config);
        $query = new Query('/queue/simple/print');
        $query->where('dynamic', 'no');
        return $this->ros->qr($query);
    }

    public function get_address_pool() {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/pool/print');
        return $this->ros->qr($query);
    }

    public function add_scheduler($name,$randstarttime,$randinterval,$bgservice) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/add');
        $query->equal('name', $name);
        $query->equal('start-time', $randstarttime);
        $query->equal('interval', $randinterval);
        $query->equal('on-event', $bgservice);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'Monitor Profile ' . $name);
        return $this->ros->qr($query);
    }

    public function set_scheduler($monid,$name,$randstarttime,$randinterval,$bgservice) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/set');
        $query->where('.id', $monid);
        $query->equal('.id', $monid);
        $query->equal('name', $name);
        $query->equal('start-time', $randstarttime);
        $query->equal('interval', $randinterval);
        $query->equal('on-event', $bgservice);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'Monitor Profile ' . $name);
        return $this->ros->qr($query);
    }

    public function remove_scheduler_byid($monid) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/remove');
        $query->equal('.id', $monid);
        return $this->ros->qr($query);
    }

    public function get_scheduler_by_hotspotpname($pname) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/print');
        $query->where('name', $pname);
        return $this->ros->qr($query);
    }

    public function get_user_by_comment($ucomment) {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/print');
        $query->where('comment', $ucomment);
        return $this->ros->qr($query);
    }
    public function get_ppp_profile() {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/profile/print');
        return $this->ros->qr($query);
    }

    public function add_ppp_profile($pname,$plocal,$premote,$pqueue,$prlimit,$pcomment) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/profile/add');
        $query->equal('name', $pname);
        if (!empty($plocal)) {
            $query->equal('local-address', $plocal);
        }
        if (!empty($premote)) {
            $query->equal('remote-address', $premote);
        }
        $query->equal('parent-queue', $pqueue);
        $query->equal('rate-limit', $prlimit);
        $query->equal('comment', $pcomment);
        return $this->ros->qr($query);
    }

    public function edit_ppp_profile($pid,$pname,$plocal,$premote,$pqueue,$prlimit,$pcomment) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/profile/set');
        $query->where('.id', $pid);
        $query->equal('.id', $pid);
        $query->equal('name', $pname);
        $query->equal('local-address', $plocal);
        $query->equal('remote-address', $premote);
        $query->equal('parent-queue', $pqueue);
        $query->equal('rate-limit', $prlimit);
        $query->equal('comment', $pcomment);
        return $this->ros->qr($query);
    }
    public function remove_ppp_profile($pid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/profile/remove');
        $query->equal('.id', $pid);
        return $this->ros->qr($query);
    }

    public function get_ppp_secrets() {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/print');
        return $this->ros->qr($query);
    }

    public function add_ppp_secret($sname,$spass,$localaddress,$remoteadress,$mainprofile) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/add');
        $query->equal('name', $sname);
        $query->equal('password', $spass);
        $query->equal('local-address', $localaddress);
        if (!empty($localaddress)) {
            $query->equal('local-address', $localaddress);
        }
        if (!empty($remoteadress)) {
            $query->equal('remote-address', $remoteadress);
        }
        $query->equal('profile', $mainprofile);
        $query->equal('service', 'pppoe');
        return $this->ros->qr($query);
    }

    public function add_ppp_scheduler($sname,$startdate,$validity,$onevent) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/add');
        $query->equal('name', $sname);
        $query->equal('start-date', $startdate);
        $query->equal('start-time', '00:00:00');
        $query->equal('interval', $validity);
        $query->equal('on-event', $onevent);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'PPPoE Monitor ' . $sname);
        return $this->ros->qr($query);
    }

    public function convert_ppp_scheduler($convert_name,$convert_startdate,$convert_validity,$onevent) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/add');
        $query->equal('name', $convert_name);
        $query->equal('start-date', $convert_startdate);
        $query->equal('start-time', '00:00:00');
        $query->equal('interval', $convert_validity);
        $query->equal('on-event', $onevent);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'PPPoE Monitor ' . $convert_name);
        return $this->ros->qr($query);
    }

    public function extend_ppp_scheduler($schid,$sname,$newenddate,$masaktif,$onevent) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/set');
        $query->where('.id', $schid);
        $query->equal('.id', $schid);
        $query->equal('name', $sname);
        $query->equal('start-date', $newenddate);
        $query->equal('start-time', '00:00:00');
        $query->equal('interval', $masaktif);
        $query->equal('on-event', $onevent);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'PPPoE Monitor ' . $sname);
        return $this->ros->qr($query);
    }

    public function changeprice_ppp_scheduler($schid,$onevent) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/set');
        $query->where('.id', $schid);
        $query->equal('.id', $schid);
        $query->equal('on-event', $onevent);
        return $this->ros->qr($query);
    }

    public function edit_ppp_scheduler($eschid,$ename,$onevent) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/set');
        $query->where('.id', $eschid);
        $query->equal('.id', $eschid);
        $query->equal('name', $ename);
        $query->equal('on-event', $onevent);
        $query->equal('disabled', 'no');
        $query->equal('comment', 'PPPoE Monitor ' . $ename);
        return $this->ros->qr($query);
    }

    public function extend_ppp_secret($sid,$mainprofile){
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/set');
        $query->where('.id', $sid);
        $query->equal('.id', $sid);
        $query->equal('profile', $mainprofile);
        $query->equal('comment', ' ');
        $query->equal('disabled', 'no');
        return $this->ros->qr($query);
    }

    public function edit_ppp_secret($eid,$ename,$epass,$elocaladdress,$eremoteaddress){
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/set');
        $query->where('.id', $eid);
        $query->equal('.id', $eid);
        $query->equal('name', $ename);
        $query->equal('password', $epass);
        if (!empty($elocaladdress)) {
            $query->equal('local-address', $elocaladdress);
        }
        if (!empty($eremoteaddress)) {
            $query->equal('remote-address', $eremoteaddress);
        }
        return $this->ros->qr($query);
    }

    public function convert_ppp_secret($convert_secretid,$convert_mainprofile){
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/set');
        $query->where('.id', $convert_secretid);
        $query->equal('.id', $convert_secretid);
        $query->equal('profile', $convert_mainprofile);
        $query->equal('service', 'pppoe');
        $query->equal('disabled', 'no');
        $query->equal('comment', '');
        return $this->ros->qr($query);
    }

    public function get_pppactive() {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/active/print');
        return $this->ros->qr($query);
    }
    public function remove_ppp_active($pppactiveid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/active/remove');
        $query->equal('.id', $pppactiveid);
        return $this->ros->qr($query);
    }

    public function disable_pppsecret($sid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/set');
        $query->where('.id', $sid);
        $query->equal('.id', $sid);
        $query->equal('disabled', 'yes');
        return $this->ros->qr($query);
    }

    public function enable_pppsecret($sid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/set');
        $query->where('.id', $sid);
        $query->equal('.id', $sid);
        $query->equal('disabled', 'no');
        return $this->ros->qr($query);
    }

    public function remove_scheduler($schid) {
        $this->ros = new Client($this->config);
        $query = new Query('/system/scheduler/remove');
        $query->equal('.id', $schid);
        return $this->ros->qr($query);
    }

    public function remove_pppsecret($sid) {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/remove');
        $query->equal('.id', $sid);
        return $this->ros->qr($query);
    }

    public function monitor() {
        $this->ros = new Client($this->config);
        $query = new Query('/interface/monitor-traffic');
        $query->equal('interface', $_SESSION['traffic_interface']);
        $query->equal('once');
        return $this->ros->qr($query);
    }

    public function get_interface() {
        $this->ros = new Client($this->config);
        $query = new Query('/interface/print');
        return $this->ros->qr($query);
    }
    

}