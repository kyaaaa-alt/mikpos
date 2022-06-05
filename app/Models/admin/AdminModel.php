<?php namespace App\Models\admin;

use CodeIgniter\Model;

class AdminModel extends Model
{
    public function __construct() {

        //disini untuk mengetahui usernya kita pake seession id biar lebih mudah

        parent::__construct();
        $db  = \Config\Database::connect();
        $this->pengunjung = $db->table('pengunjung'); 
        $this->komen = $db->table('komen'); 
        $this->themes = $db->table('themes'); 
        $this->order = $db->table('order'); 
        $this->rules = $db->table('rules'); 
        $this->mempelai = $db->table('mempelai'); 
        $this->data = $db->table('data'); 
        $this->acara = $db->table('acara'); 
        $this->album = $db->table('album'); 
        $this->cerita = $db->table('cerita');  
        $this->users = $db->table('users');  
        $this->pembayaran = $db->table('pembayaran'); 
        $this->setting = $db->table('setting'); 
        $this->admin = $db->table('admin'); 
        $this->donasi = $db->table('donasi'); 
        $this->withdraw = $db->table('withdraw'); 
        $this->transaksi = $db->table('transaksi'); 
        $this->payment_method = $db->table('payment_method'); 
        $this->session = session();

    }

    public function update_donasi($data){
        $builder = $this->donasi;
        $builder->where('id', $data['id']);
        return $builder->update($data);
    }

    public function disable_pm($payment_method) {
        $builder = $this->payment_method;
        $builder->where('kode', $payment_method);
        $builder->set('status', '0');
        return $builder->update();
    }

    public function get_payment_method2(){
        $builder = $this->payment_method;
        $builder->select('*');
        $builder->orderBy('status', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_all_donasi_pending(){
        $builder = $this->donasi;
        $builder->select('*'); 
        $builder->orderBy('created_at', 'DESC');
        $builder->where('status', 'UNPAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_pengirim_donasi_pending(){
        $builder = $this->donasi;
        $builder->selectCount('id');
        $builder->where('status', 'UNPAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_jumlah_donasi_pending(){
        $builder = $this->donasi;
        $builder->selectSum('amount_received');
        $builder->where('status', 'UNPAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_all_donasi_approved(){
        $builder = $this->donasi;
        $builder->select('*'); 
        $builder->orderBy('id', 'DESC');
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_pengirim_donasi_approved(){
        $builder = $this->donasi;
        $builder->selectCount('id');
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_jumlah_donasi_approved(){
        $builder = $this->donasi;
        $builder->selectSum('amount_received');
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_all_donasi_rejected(){
        $builder = $this->donasi;
        $builder->select('*'); 
        $builder->orderBy('created_at', 'DESC');
        $status = ['EXPIRED','FAILED'];
        $builder->whereIn('status', $status);
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_pengirim_donasi_rejected(){
        $builder = $this->donasi;
        $builder->selectCount('id');
        $status = ['EXPIRED','FAILED'];
        $builder->whereIn('status', $status);
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_jumlah_donasi_rejected(){
        $builder = $this->donasi;
        $builder->selectSum('amount_received');
        $status = ['EXPIRED','FAILED'];
        $builder->whereIn('status', $status);
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_all_donasi_withdrawn(){
        $builder = $this->donasi;
        $builder->select('*'); 
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '1');
        $builder->orderBy('created_at', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_pengirim_donasi_withdrawn(){
        $builder = $this->donasi;
        $builder->selectCount('id');
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '1');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_jumlah_donasi_withdrawn(){
        $builder = $this->donasi;
        $builder->selectSum('amount_received');
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '1');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_all_withdraw(){
        $builder = $this->withdraw;
        $builder->select('*'); 
        $builder->orderBy('created_at', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_completed_withdraw(){
        $builder = $this->withdraw;
        $builder->selectCount('id');
        $builder->orderBy('created_at', 'DESC');
        $builder->where('status', '1');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_pending_withdraw(){
        $builder = $this->withdraw;
        $builder->selectCount('id');
        $builder->orderBy('created_at', 'DESC');
        $builder->where('status', '0');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function confirm_withdraw($filename,$id){
        $builder = $this->withdraw;
        $builder->set('bukti_pencairan', $filename);
        $builder->set('status', '1');
        $builder->where('id', $id);
        return $builder->update();
    }
    
    public function get_total_pengunjung(){
        $builder = $this->pengunjung;
        $builder->selectCount('id');
        $where = "id_user=".$_SESSION['id_usernya'];
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_pengunjung_today(){
        $builder = $this->pengunjung;
        $builder->selectCount('id');
        $where = "date(created_at) = CURDATE() AND id_user=".$_SESSION['id_usernya'];
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_komentar(){
        $builder = $this->komen;
        $builder->selectCount('id');
        $where = "id_user=".$_SESSION['id_usernya'];
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_komentar_today(){
        $builder = $this->komen;
        $builder->selectCount('id');
        $where = "date(created_at) = CURDATE() AND id_user=".$_SESSION['id_usernya'];
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_pengunjung_mingguan(){
        $builder = $this->pengunjung;
        $builder->select("DAY(created_at) as tanggal, COUNT(id) as jumlah", true);
        $where = "(created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) AND id_user=".$_SESSION['id_usernya'];
        $builder->groupBy("DAY(created_at)");
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_all_komen(){
        $builder = $this->komen;
        $builder->select('*'); 
        $builder->orderBy('created_at', 'DESC');
        $where = "id_user=".$_SESSION['id_usernya'];
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_transaksi_order(){
        $builder = $this->transaksi;
        $builder->select('*'); 
        $builder->orderBy('created_at', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_transaksi_order(){
        $builder = $this->transaksi;
        $builder->selectSum('amount_received');
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_all_pengunjung(){
        $builder = $this->pengunjung;
        $builder->select('nama_pengunjung, created_at'); 
        $builder->orderBy('created_at', 'DESC');
        $where = "id_user=".$_SESSION['id_usernya'];
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult();
    }

    public function delete_komen_by_id($id){
        $builder = $this->komen;
        $builder->where('id', $id);
        return $builder->delete();
    }

    //mengambil semua data pada table themes
    public function get_all_themes(){
        return $this->themes->get();
    }

    public function update_tema($data){
        $builder = $this->order;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function get_order_by_id_user(){
        $builder = $this->order;
        $builder->select('order.*,themes.nama_theme,themes.kode_theme');
        $builder->join('themes', 'themes.id = order.theme', 'left');
        $builder->where('order.id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_fitur_by_id_user(){
        $builder = $this->rules;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_payment_method(){
        $builder = $this->payment_method;
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_payment_method($idpm,$status){
        $builder = $this->payment_method;
        $builder->where('id', $idpm);
        $builder->set('status', $status);
        return $builder->update();
    }

    public function update_fitur($data){
        $builder = $this->rules;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function cek_domain($domain)
    {
        $query = $this->order->where('domain', $domain)->get();
        return $query->getResult();
    }

    public function update_domain($domain){
        $builder = $this->order;
        $builder->set('domain', $domain);
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update();
    }

    public function get_data_by_id_user(){
        $builder = $this->data;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }
   

    public function get_mempelai_by_id_user(){
        $builder = $this->mempelai;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_mempelai($data){
        $builder = $this->mempelai;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function get_acara_by_id_user(){
        $builder = $this->acara;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_acara($data){
        $builder = $this->acara;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }
   
    public function update_maps($data){
        $builder = $this->data;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function get_album_by_id_user(){
        $builder = $this->album;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function save_album($data){
    	return $this->album->insert($data);
    }

    public function delete_album($data){
        $builder = $this->album;
        $builder->where($data);
        return $builder->delete();
    }

    public function update_video($data){
        $builder = $this->data;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function update_stream($data){
        $builder = $this->data;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function get_cerita_by_id_user(){
        $builder = $this->cerita;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function hapus_cerita(){
        $builder = $this->cerita;
        $builder->where('id_user', $_SESSION['id_usernya']);
        return $builder->delete();
    }

    public function save_cerita($data){
    	return $this->cerita->insert($data);
    }

    public function get_user_by_id_user(){
        $builder = $this->users;
        $builder->select('*');
        $builder->where('id', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_user($data){
        $builder = $this->users;
        $builder->where('id', $_SESSION['id_usernya']);
        return $builder->update($data);
    }

    public function get_user($data){
        $builder = $this->users;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_pembayaran($data,$invoice){
        $builder = $this->pembayaran;
        $builder->where('invoice', $invoice);
        return $builder->update($data);
    }

    public function get_pembayaran_by_id_user(){
        $builder = $this->pembayaran;
        $builder->select('*');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    // public function get_all_join()
    // {
    //     $builder = $this->pembayaran;
    //     $builder->select('order.*,users.*,pembayaran.*,pembayaran.status as statusPembayaran,pembayaran.invoice as invoice,order.status as statusWeb,order.theme as temaWeb,acara.*,transaksi.status as statusTransaksi');
    //     $builder->join('users', 'users.id = pembayaran.id_user', 'left');
    //     $builder->join('order', 'order.id_user = pembayaran.id_user', 'left');
    //     $builder->join('acara', 'acara.id_user = pembayaran.id_user', 'left');
    //     $builder->join('transaksi', 'transaksi.id_user = pembayaran.id_user', 'left');
    //     // $builder->groupBy('transaksi.id_user');
    //     $builder->orderBy('transaksi.created_at', 'DESC');
    //     $query = $builder->get();
    //     return $query->getResult();
    // }

    public function get_all_join() {
        $builder = $this->users;
        $builder->select('order.*,users.*,pembayaran.*,pembayaran.status as statusPembayaran,pembayaran.invoice as invoice,order.status as statusWeb,order.theme as temaWeb,acara.*,transaksi.status as statusTransaksi,transaksi.created_at as tc');
        $builder->join('pembayaran', 'pembayaran.id_user = users.id', 'left');
        $builder->join('order', 'order.id_user = users.id', 'left');
        $builder->join('acara', 'acara.id_user = users.id', 'left');
        $builder->join('transaksi', 'transaksi.id = (SELECT id FROM transaksi AS p2 WHERE p2.id_user = users.id ORDER BY p2.created_at DESC LIMIT 1)', 'left');
        $builder->orderBy('users.id', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_pending(){
        $builder = $this->pembayaran;
        $builder->selectCount('id');
        $where = "status=0";
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_lunas(){
        $builder = $this->pembayaran;
        $builder->selectCount('id');
        $where = "status=2";
        $builder->where($where);
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_keuntungan(){
        $builder = $this->pembayaran;
        $builder->selectCount('id');
        $where = "status=2";
        $builder->where($where);
        $query = $builder->get();
        $penggunaAktif = $query->getResult()[0]->id;

        $builder2 = $this->setting;
        $builder2->select('harga');
        $query2 = $builder2->get();
        return $query2->getResult()[0]->harga*$penggunaAktif;
    }

    public function get_total_keuntungan_donasi(){
        $builder = $this->withdraw;
        $builder->selectSum('mns_income');
        $builder->where('status', '1');
        $query = $builder->get();
        return $query->getResult()[0]->mns_income;
    }

    public function delete_pengunjung($id){
        $builder = $this->pengunjung;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_komen($id){
        $builder = $this->komen;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_order($id){
        $builder = $this->order;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_rules($id){
        $builder = $this->rules;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_mempelai($id){
        $builder = $this->mempelai;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_data($id){
        $builder = $this->data;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_acara($id){
        $builder = $this->acara;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function hapus_album($id){
        $builder = $this->album;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_cerita($id){
        $builder = $this->cerita;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_pembayaran($id){
        $builder = $this->pembayaran;
        $builder->where('id_user', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function delete_users($id){
        $builder = $this->users;
        $builder->where('id', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    public function konfirmasi_user($id){

        //update status pembayaran
        $builder = $this->pembayaran;
        $builder->set('status', '2');
        $builder->where('id_user', $id);
        $builder->update();

        //update stats website
        $builder2 = $this->order;
        $builder2->set('status', '1');
        $builder2->where('id_user', $id);
        return $builder2->update();
    }

    public function ganti_tema($id, $tema){
        //update tema
        $builder = $this->order;
        $builder->set('theme', $tema);
        $builder->where('id_user', $id);
        return $builder->update();
    }

    public function get_admin_by_id(){
        $builder = $this->admin;
        $builder->select('*');
        $builder->where('id', $_SESSION['id_admin']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_admin($data){
        $builder = $this->admin;
        $builder->where('id', $_SESSION['id_admin']);
        return $builder->update($data);
    }

    public function get_setting(){
        $builder = $this->setting;
        $builder->select('*');
        $builder->where('id', '1');
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_setting($data){
        $builder = $this->setting;
        $builder->where('id', '1');
        return $builder->update($data);
    }


    public function get_admin($data){
        $builder = $this->admin;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }

    // GET DATA DONASI PER USER
    public function get_all_donasi(){
        $builder = $this->donasi;
        $builder->select('*'); 
        $builder->orderBy('updated_at', 'DESC');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_total_pengirim_donasi(){
        $builder = $this->donasi;
        $builder->selectCount('id');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->id;
    }

    public function get_total_saldo_donasi(){
        $builder = $this->donasi;
        $builder->selectSum('amount_received');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $builder->where('status', 'PAID');
        $builder->where('wdstatus', '0');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_total_saldo_donasi_pdf(){
        $builder = $this->donasi;
        $builder->selectSum('amount_received');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $builder->where('status', 'PAID');
        $query = $builder->get();
        return $query->getResult()[0]->amount_received;
    }

    public function get_all_withdraw_by_user(){
        $builder = $this->withdraw;
        $builder->select('*'); 
        $builder->orderBy('created_at', 'DESC');
        $builder->where('id_user', $_SESSION['id_usernya']);
        $query = $builder->get();
        return $query->getResult();
    }

    public function simpan_transaksi($data){
    	return $this->transaksi->insert($data);
    }
    public function changepaymentmethod($userid){
        $builder = $this->transaksi;
        $builder->where('id_user', $userid);
        $builder->set('status', 'EXPIRED');
        return $builder->update();
    }
}