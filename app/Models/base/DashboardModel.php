<?php namespace App\Models\base;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function __construct() {

        parent::__construct();
        $db  = \Config\Database::connect();
        $this->users = $db->table('users');  
        $this->router = $db->table('router');
        $this->transaksi = $db->table('transaksi');
        $this->payment_method = $db->table('payment_method');
        $this->session = session();

    }

    public function get_user($data){
        $builder = $this->users;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function auth_router($data){
        $builder = $this->router;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function do_add_router($saverouter) {
        $builder = $this->router;
        return $builder->insert($saverouter);
    }

    public function add_payment_method($paymentmethod) {
        $builder = $this->payment_method;
        return $builder->insert($paymentmethod);
    }

    public function get_payment_method() {
        $builder = $this->payment_method;
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_router_by_user_id() {
        $builder = $this->router;
        $builder->where('user_id', $_SESSION['id']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_router_by_router_id() {
        $builder = $this->router;
        $builder->where('id', $_SESSION['router_id']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_tripaydata($data){
        $builder = $this->router;
        $builder->where('id', $_SESSION['router_id']);
        $builder->where('user_id', $_SESSION['id']);
        return $builder->update($data);
    }

    public function edit_router($data,$router_id) {
        $builder = $this->router;
        $builder->where('id', $router_id);
        $builder->where('user_id', $_SESSION['id']);
        return $builder->update($data);
    }

    public function update_payment_method($status, $kode) {
        $builder = $this->payment_method;
        $builder->set('status', $status);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('kode', $kode);
        return $builder->update();
    }

    public function delete_router($router_id) {
        $builder = $this->router;
        $builder->where('id', $router_id);
        $builder->where('user_id', $_SESSION['id']);
        return $builder->delete();
    }

    public function update_user($data) {
        $builder = $this->users;
        $builder->where('id', $_SESSION['id']);
        return $builder->update($data);
    }

    public function get_total_profit(){
        $builder = $this->transaksi;
        $builder->selectSum('amount_received');
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_total_profit_month(){
        $builder = $this->transaksi;
        $builder->selectSum('amount_received');
        $where = "MONTH(updated_at) = MONTH(CURRENT_DATE()) AND YEAR(updated_at) = YEAR(CURRENT_DATE())";
        $builder->where($where);
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function profit_last_month(){
        $builder = $this->transaksi;
        $builder->selectSum('amount_received');
        $where = "MONTH(updated_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) AND YEAR(updated_at) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)";
        $builder->where($where);
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function profit_last_day(){
        $builder = $this->transaksi;
        $builder->selectSum('amount_received');
        $where = "updated_at BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE() - INTERVAL 1 SECOND";
        $builder->where($where);
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_total_profit_day(){
        $builder = $this->transaksi;
        $builder->selectSum('amount_received');
        $where = "DATE(updated_at) = CURRENT_DATE()";
        $builder->where($where);
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_transaksi() {
        $builder = $this->transaksi;
        $builder->where('user_id', $_SESSION['id']);
        $builder->where('router_id', $_SESSION['router_id']);
        $builder->orderBy('id', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_router_by_router_name() {
        $builder = $this->router;
        $builder->where('router_name', 'RouterOS-VMware');
        $query = $builder->get();
        return $query->getResult();
    }

}