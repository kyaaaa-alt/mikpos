<?php namespace App\Controllers\base;

use CodeIgniter\Controller;
use App\Models\base\ROSPaymentModel;
use CodeIgniter\I18n\Time;
use Symfony\Component\HttpFoundation\Response;
use App\Libraries\RouterosAPI;

/**
 * @desc devine are you on production mode or development mode
 * true for production
 * false for development
 */
define("userid", false);
define("routerid", false);
define("endpoint", false);
define("ref", false);

class PaymentController extends Controller
{
    public function __construct() {

        $this->session = session();
        $this->ROSPaymentModel = new ROSPaymentModel();
		$this->request = \Config\Services::request();
        $this->db  = \Config\Database::connect();
        $this->ros = new RouterosAPI();
        $this->uri = $this->request->uri;
        $this->key = new \App\Libraries\Key();
        if (userid == true) {
            $this->userid = 2;
        } else {
            $this->userid = 3;
        }
        if (routerid == true) {
            $this->routerid = 3;
        } else {
            $this->routerid = 4;
        }
        if (ref == true) {
            $this->ref = 4;
        } else {
            $this->ref = 5;
        }
        if (endpoint == true) {
            $this->endpoint = 'api';
        } else {
            $this->endpoint = 'api-sandbox';
        }
    }

    public function isolir() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $data['userid'] = $userid;
            $data['routerid'] = $routerid;
            return view('errors/isolir', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        } 
    }

    public function isolir2() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['username'] = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $data['userid'] = $userid;
            $data['routerid'] = $routerid;
            return view('errors/isolir2', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        } 
    }

    public function landing() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $data['userid'] = $userid;
            $data['routerid'] = $routerid;
            return view('payment/landing', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        } 
    }

    public function expire() {
        header('Access-Control-Allow-Origin: *');
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $membername = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));
            $get_hotspot_user = $this->ros->comm("/ip/hotspot/user/print", array("?name" => "$membername"));
            $this->ros->disconnect;
            
            $profile = $get_hotspot_user[0]['profile'];
            $get_profile = $this->ROSPaymentModel->get_hotspot_profile_by_name($profile,$routerid,$userid);
            $get_profile_sch = $this->ROSPaymentModel->get_profile_sch($profile,$routerid,$userid);
            if (!empty($get_hotspot_user) && !empty($get_profile) && !empty($get_profile_sch)) {
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                $comment = $get_hotspot_user[0]['comment'];
                if (substr($comment, 0, 3) == 'jan' || substr($comment, 0, 3) == 'feb' || substr($comment, 0, 3) == 'mar' || substr($comment, 0, 3) == 'apr' || substr($comment, 0, 3) == 'may' || substr($comment, 0, 3) == 'jun' || substr($comment, 0, 3) == 'jul' || substr($comment, 0, 3) == 'aug' || substr($comment, 0, 3) == 'sep' || substr($comment, 0, 3) == 'oct' || substr($comment, 0, 3) == 'nov' || substr($comment, 0, 3) == 'dec') {
                    $date1 =  ucfirst($comment);
                    $date2 = str_replace('/', '-', $date1);
                    echo date("d/m/Y H:i", strtotime($date2));
                }
            } 
        }
    }
    
    public function ppp_check_validity() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $data['userid'] = $userid;
            $data['routerid'] = $routerid;
            return view('payment/chkvalidity', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function check_status() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $data['userid'] = $userid;
            $data['routerid'] = $routerid;
            return view('payment/chkstatus', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function tchk() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $data['userid'] = $userid;
            $data['routerid'] = $routerid;
            return view('template/tchk', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function voucher_payment() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);

        $data['pmethod'] = $this->ROSPaymentModel->get_payment_method($routerid,$userid);
        $data['ref'] = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));
            $data['hotspot_profile'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
            $this->ros->disconnect;

            return view('payment/voucherpayment', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function tbeli() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);

        $data['pmethod'] = $this->ROSPaymentModel->get_payment_method($routerid,$userid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));
            $data['hotspot_profile'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
            $this->ros->disconnect;

            return view('template/tbeli', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function tperpanjang() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);

        $data['pmethod'] = $this->ROSPaymentModel->get_payment_method($routerid,$userid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));
            $data['hotspot_profile'] = $this->ros->comm("/ip/hotspot/user/profile/print", array());
            $this->ros->disconnect;

            return view('template/tperpanjang', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function ppp_validity() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $membername = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {

            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));
            $get_ppp_secret = $this->ros->comm("/ppp/secret/print", array("?name" => "$membername"));
            $get_ppp_scheduler = $this->ros->comm("/system/scheduler/print", array("?name" => "$membername"));
            $this->ros->disconnect;

            if (!empty($get_ppp_secret) && $membername == explode(",",$get_ppp_scheduler[0]['on-event'])[7]) {
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                foreach ($get_ppp_secret as $secret) {
                    $secretprofile = $secret['profile'];
                    $disabled = $secret['disabled'];
                }
                foreach ($get_ppp_scheduler as $sch) {
                    $schscript = $sch['on-event'];
                }
                
                $validity = explode(",",$schscript)[4];
                if (substr($validity, -1) == "d") {
                    $validity = substr($validity, 0, -1) . " Hari";
                } else if (substr($validity, -1) == "h") {
                    $validity = substr($validity, 0, -1) . " Jam";
                }
                $date1 =  ucfirst(explode(",", $schscript)[6]);
                $date2 = str_replace('/', '-', $date1);
                $expdate = strftime("%d %B %Y", strtotime($date2));
                if ($disabled == 'true') {
                    $status = '<span class="text-danger">Tidak Aktif</span>';
                } else if ($secretprofile == explode(",", $schscript)[2]) {
                    $status = '<span class="text-danger">ISOLIR/FUP</span>';
                } else {
                    $status = '<span>Aktif</span>';
                }
                $data['membername'] = $membername;
                $data['validity'] = $validity;
                $data['expdate'] = $expdate;
                $data['status'] = $status;
                $data['price'] = 'Rp ' . number_format((float)explode(",", $schscript)[8],0,',','.');
                $data['userid'] = $userid;
                $data['routerid'] = $routerid;
                $data['riwayat'] = $this->ROSPaymentModel->get_transaksi_by_membername($userid,$routerid,$membername);
                return view('payment/validity', $data);
            } else {
                $this->session->setFlashdata('error', ['Kode Member Salah !']);
                return redirect()->to(base_url('chkvalidity') . '/' . $userid . '/' . $routerid);
            }
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function hotspot_status() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $membername = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));

            $get_hotspot_user = $this->ros->comm("/ip/hotspot/user/print", array("?name" => "$membername"));
            $profile = $get_hotspot_user[0]['profile'];
            $get_profile = $this->ros->comm("/ip/hotspot/user/profile/print", array("?name" => "$profile"));
            $get_profile_sch = $this->ros->comm("/system/scheduler/print", array("?name" => "$profile"));
            $this->ros->disconnect;

            if (!empty($get_hotspot_user) && !empty($get_profile) && !empty($get_profile_sch)) {
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                $download = $get_hotspot_user[0]['bytes-out'];
                $upload = $get_hotspot_user[0]['bytes-in'];
                $ratelimit = $get_profile[0]['rate-limit'];
                $shared = $get_profile[0]['shared-users'];
                $limituptime = $get_hotspot_user[0]['limit-uptime'];
                if (!empty(explode(",", $get_profile[0]['on-login'])[4])) {
                    $price = explode(",", $get_profile[0]['on-login'])[4];
                } else {
                    $price = explode(",", $get_profile[0]['on-login'])[2];
                }
                if ($limituptime == '1s') {
                    $status = '<small class="text-danger">Masa Aktif Habis</small>';
                } else {
                    $status = 'Aktif';
                }
                $validity = explode(",", $get_profile[0]['on-login'])[3];
                if (substr($validity, -1) == "d") {
                    $validity = substr($validity, 0, -1) . " Hari";
                } else if (substr($validity, -1) == "h") {
                    $validity = substr($validity, 0, -1) . " Jam";
                }
                $comment = $get_hotspot_user[0]['comment'];
                if (substr($comment, 0, 3) == 'vc-' || substr($comment, 0, 3) == 'up-') {
                    $expdate = '<small>Kode voucher ini belum digunakan, masa kadaluarsa akan dihitung dari pertama kali login</small>';
                } else {
                    $date1 =  ucfirst($comment);
                    $date2 = str_replace('/', '-', $date1);
                    $expdate = date("d/h/Y H:i", strtotime($date2));
                }
                $data['expmode'] = explode(",", $get_profile[0]['on-login'])[1];
                $data['download'] = $download;
                $data['upload'] = $upload;
                $data['ratelimit'] = $ratelimit;
                $data['shared'] = $shared;
                $data['membername'] = $membername;
                $data['validity'] = $validity;
                $data['expdate'] = $expdate;
                $data['status'] = $status;
                $data['price'] = 'Rp ' . number_format((float)$price,0,',','.');
                $data['userid'] = $userid;
                $data['routerid'] = $routerid;
                $data['riwayat'] = $this->ROSPaymentModel->get_transaksi_by_membername($userid,$routerid,$membername);
                return view('payment/status', $data);
            } else {
                $this->session->setFlashdata('error', ['Kode Member Salah !']);
                return redirect()->to(base_url('chkstatus') . '/' . $userid . '/' . $routerid);
            }
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function tstatus() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $membername = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $gr = $this->ROSPaymentModel->gr($routerid,$userid);
            $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));

            $get_hotspot_user = $this->ros->comm("/ip/hotspot/user/print", array("?name" => "$membername"));
            $profile = $get_hotspot_user[0]['profile'];
            $get_profile = $this->ros->comm("/ip/hotspot/user/profile/print", array("?name" => "$profile"));
            $get_profile_sch = $this->ros->comm("/system/scheduler/print", array("?name" => "$profile"));
            $this->ros->disconnect;

            if (!empty($get_hotspot_user) && !empty($get_profile) && !empty($get_profile_sch)) {
                setlocale(LC_ALL, 'id-ID', 'id_ID');
                $download = $get_hotspot_user[0]['bytes-out'];
                $upload = $get_hotspot_user[0]['bytes-in'];
                $ratelimit = $get_profile[0]['rate-limit'];
                $shared = $get_profile[0]['shared-users'];
                $limituptime = $get_hotspot_user[0]['limit-uptime'];
                if (!empty(explode(",", $get_profile[0]['on-login'])[4])) {
                    $price = explode(",", $get_profile[0]['on-login'])[4];
                } else {
                    $price = explode(",", $get_profile[0]['on-login'])[2];
                }
                if ($limituptime == '1s') {
                    $status = '<small class="text-danger">Masa Aktif Habis</small>';
                } else {
                    $status = 'Aktif';
                }
                $validity = explode(",", $get_profile[0]['on-login'])[3];
                if (substr($validity, -1) == "d") {
                    $validity = substr($validity, 0, -1) . " Hari";
                } else if (substr($validity, -1) == "h") {
                    $validity = substr($validity, 0, -1) . " Jam";
                }
                $comment = $get_hotspot_user[0]['comment'];
                if (substr($comment, 0, 3) == 'vc-' || substr($comment, 0, 3) == 'up-') {
                    $expdate = '<small>Kode voucher ini belum digunakan, masa kadaluarsa akan dihitung dari pertama kali login</small>';
                } else {
                    $date1 =  ucfirst($comment);
                    $date2 = str_replace('/', '-', $date1);
                    $expdate = date("d/h/Y H:i", strtotime($date2));
                }
                $data['expmode'] = explode(",", $get_profile[0]['on-login'])[1];
                $data['download'] = $download;
                $data['upload'] = $upload;
                $data['ratelimit'] = $ratelimit;
                $data['shared'] = $shared;
                $data['membername'] = $membername;
                $data['validity'] = $validity;
                $data['expdate'] = $expdate;
                $data['status'] = $status;
                $data['price'] = 'Rp ' . number_format((float)$price,0,',','.');
                $data['userid'] = $userid;
                $data['routerid'] = $routerid;
                $data['riwayat'] = $this->ROSPaymentModel->get_transaksi_by_membername($userid,$routerid,$membername);
                return view('template/tstatus', $data);
            } else {
                $this->session->setFlashdata('error', ['Kode Member Salah !']);
                return redirect()->to(base_url('tchk') . '/' . $userid . '/' . $routerid);
            }
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function ppp_payment() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $data['pmethod'] = $this->ROSPaymentModel->get_payment_method($routerid,$userid);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            return view('payment/pppoepayment', $data);
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function ppp_req_payment() {
        $userid = $this->request->getPost('userid');
        $routerid = $this->request->getPost('routerid');
        $gr = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        date_default_timezone_set($gr[0]->router_ntp);
        $ppp_secret_name = $this->request->getPost('kodepembayaran');
        $payment_method = $this->request->getPost('payment_method');

        $gr = $this->ROSPaymentModel->gr($routerid,$userid);
        $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));
        $get_ppp_secret = $this->ros->comm("/ppp/secret/print", array("?name" => "$ppp_secret_name"));
        $get_ppp_scheduler = $this->ros->comm("/system/scheduler/print", array("?name" => "$ppp_secret_name"));
        $this->ros->disconnect;

        $price = explode(",",$get_ppp_scheduler[0]['on-event'])[8];
        $validity = explode(",",$get_ppp_scheduler[0]['on-event'])[4];
        $min = strtotime("-30 years");
        $max = strtotime("-19 years");
        $time = rand($min,$max);
        $generatedate = date("dm",$time);
        $generatephone = '0812' . rand(11111111,99999999);
        if (!empty($get_ppp_secret) && $ppp_secret_name == explode(",",$get_ppp_scheduler[0]['on-event'])[7]) {
            $getapi = $this->ROSPaymentModel->get_tripay_api($routerid,$userid);
            $apiKey       = $getapi[0]->tripay_api_key;
            $privateKey   = $getapi[0]->tripay_private_key;
            $merchantCode = $getapi[0]->tripay_merchant_code;
            $merchantRef  = 'INVP/' . $userid . '/' . $routerid . '/' . strtoupper($ppp_secret_name) . '/' .  date("dmy",time()) . '/' . rand(1,999);
            $amount       = $price;
            $data = [
                'method'         => $payment_method,
                'merchant_ref'   => $merchantRef,
                'amount'         => $amount,
                'customer_name'  => $ppp_secret_name,
                'customer_email' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),1,1) . $ppp_secret_name . $generatedate . '@gmail.com',
                'customer_phone' => $generatephone,
                'order_items'    => [
                    [
                        'sku'         => 'PPPoE-' . $validity,
                        'name'        => 'Perpanjang-' . $ppp_secret_name,
                        'price'       => $price,
                        'quantity'    => 1
                    ]
                ],
                'return_url'   => base_url('payment') . '/' . $userid . '/' . $routerid,
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = json_decode(curl_exec($curl));
            $error = json_decode(curl_error($curl));
            curl_close($curl);
            if (empty($error) && $response->success == true) {
                $dataTransaksi = [
                    'user_id' => $userid,
                    'router_id' => $routerid,
                    'merchant_ref' => $merchantRef,
                    'customer_name' => $ppp_secret_name,
                    'reference' => $response->data->reference,
                    'payment_name' => $response->data->payment_name,
                    'amount_received' => $response->data->amount_received,
                    'return_url' => base_url('invoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference,
                    'service' => explode("-",$response->data->order_items[0]->sku)[0],             
                    'query_status' => 'waiting payment',             
                    'status' => $response->data->status,              
                ];
                $saveData = $this->ROSPaymentModel->add_transaksi($dataTransaksi);
                if ($saveData) {
                    return redirect()->to(base_url('invoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference);
                } else {
                    $this->session->setFlashdata('error', ['Gagal request, silahkan coba lagi...']);
                    return redirect()->to(base_url('payment') . '/' . $userid . '/' . $routerid);
                }
            } else {
                $this->session->setFlashdata('error', ['Metode pembayran sedang gangguan, silahkan coba dengan metode pembayaran yang berbeda']);
                return redirect()->to(base_url('payment') . '/' . $userid . '/' . $routerid);
            }
            
        } else {
            $this->session->setFlashdata('error', ['Kode Member Tidak Ditemukan!']);
            return redirect()->to(base_url('payment') . '/' . $userid . '/' . $routerid);
        }
    }

    public function buy_voucher() {
        $userid = $this->request->getPost('userid');
        $routerid = $this->request->getPost('routerid');
        $template = $this->request->getPost('template');
        $gr = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        date_default_timezone_set($gr[0]->router_ntp);
        $kodevoucher = $this->request->getPost('kodevoucher');
        $profile = $this->request->getPost('paket');
        $payment_method = $this->request->getPost('payment_method');

        $gr = $this->ROSPaymentModel->gr($routerid,$userid);
        $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));

        $get_hotspot_user = $this->ros->comm("/ip/hotspot/user/print", array("?name" => "$kodevoucher"));
        $get_profile = $this->ros->comm("/ip/hotspot/user/profile/print", array("?name" => "$profile"));
        $get_profile_sch = $this->ros->comm("/system/scheduler/print", array("?name" => "$profile"));
        $this->ros->disconnect;

        if (!empty(explode(",", $get_profile[0]['on-login'])[4])) {
            $price = explode(",", $get_profile[0]['on-login'])[4];
        } else {
            $price = explode(",", $get_profile[0]['on-login'])[2];
        }
        $validity = explode(",", $get_profile[0]['on-login'])[3];
        $min = strtotime("-30 years");
        $max = strtotime("-19 years");
        $time = rand($min,$max);
        $generatedate = date("dm",$time);
        $generatephone = '0812' . rand(11111111,99999999);
        if (empty($get_hotspot_user) && !empty($get_profile) && !empty($get_profile_sch)) {
            $getapi = $this->ROSPaymentModel->get_tripay_api($routerid,$userid);
            $apiKey       = $getapi[0]->tripay_api_key;
            $privateKey   = $getapi[0]->tripay_private_key;
            $merchantCode = $getapi[0]->tripay_merchant_code;
            $merchantRef  = 'INVB/' . $userid . '/' . $routerid . '/' . strtoupper($kodevoucher) . '/' .  date("dmy",time()) . '/' . rand(1,999);
            $amount       = $price;
            $data = [
                'method'         => $payment_method,
                'merchant_ref'   => $merchantRef,
                'amount'         => $amount,
                'customer_name'  => $kodevoucher,
                'customer_email' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),1,1) . $kodevoucher . $generatedate . '@gmail.com',
                'customer_phone' => $generatephone,
                'order_items'    => [
                    [
                        'sku'         => 'Voucher-' . $validity,
                        'name'        => 'Pembelian-' . $kodevoucher,
                        'price'       => $price,
                        'quantity'    => 1
                    ]
                ],
                'return_url'   => base_url('voucher') . '/' . $userid . '/' . $routerid,
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = json_decode(curl_exec($curl));
            $error = json_decode(curl_error($curl));
            curl_close($curl);
            if (empty($error) && $response->success == true) {
                $dataTransaksi = [
                    'user_id' => $userid,
                    'router_id' => $routerid,
                    'merchant_ref' => $merchantRef,
                    'customer_name' => $kodevoucher,
                    'reference' => $response->data->reference,
                    'payment_name' => $response->data->payment_name,
                    'amount_received' => $response->data->amount_received,
                    'return_url' => base_url('invoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference,
                    'service' => explode("-",$response->data->order_items[0]->sku)[0],
                    'profile' => $profile,             
                    'query_status' => 'waiting payment',             
                    'status' => $response->data->status,              
                ];
                $saveData = $this->ROSPaymentModel->add_transaksi($dataTransaksi);
                if ($saveData) {
                    if ($template == 'yes') {
                        return redirect()->to(base_url('tinvoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference);
                    } else {
                        return redirect()->to(base_url('invoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference);
                    }
                } else {
                    $this->session->setFlashdata('error', ['Gagal request, silahkan coba lagi...']);
                    if ($template == 'yes') {
                        return redirect()->to(base_url('tbeli') . '/' . $userid . '/' . $routerid);
                    } else {
                        return redirect()->to(base_url('voucher') . '/' . $userid . '/' . $routerid);
                    }
                    
                }
            } else {
                $this->session->setFlashdata('error', ['Metode pembayran sedang gangguan, silahkan coba dengan metode pembayaran yang berbeda.']);
                if ($template == 'yes') {
                    return redirect()->to(base_url('tbeli') . '/' . $userid . '/' . $routerid);
                } else {
                    return redirect()->to(base_url('voucher') . '/' . $userid . '/' . $routerid);
                }
            }
            
        } else {
            $this->session->setFlashdata('error', ['Kode voucher sudah digunakan, silahkan ubah kode voucher!']);
            return redirect()->to(base_url('voucher') . '/' . $userid . '/' . $routerid);
        }
    }

    public function perpanjang_voucher() {
        $userid = $this->request->getPost('userid');
        $routerid = $this->request->getPost('routerid');
        $template = $this->request->getPost('template');
        $gr = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        date_default_timezone_set($gr[0]->router_ntp);
        $kodevoucher = $this->request->getPost('kodevoucher');
        $payment_method = $this->request->getPost('payment_method');

        $gr = $this->ROSPaymentModel->gr($routerid,$userid);
        $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));

        $get_hotspot_user = $this->ros->comm("/ip/hotspot/user/print", array("?name" => "$kodevoucher"));
        $profile = $get_hotspot_user[0]['profile'];
        $get_profile = $this->ros->comm("/ip/hotspot/user/profile/print", array("?name" => "$profile"));
        $get_profile_sch = $this->ros->comm("/system/scheduler/print", array("?name" => "$profile"));
        $this->ros->disconnect;

        if (!empty(explode(",", $get_profile[0]['on-login'])[4])) {
            $price = explode(",", $get_profile[0]['on-login'])[4];
        } else {
            $price = explode(",", $get_profile[0]['on-login'])[2];
        }
        $validity = explode(",", $get_profile[0]['on-login'])[3];
        $min = strtotime("-30 years");
        $max = strtotime("-19 years");
        $time = rand($min,$max);
        $generatedate = date("dm",$time);
        $generatephone = '0812' . rand(11111111,99999999);
        if (!empty($get_hotspot_user) &&  !empty($get_profile_sch) && explode(",", $get_profile[0]['on-login'])[1] == 'ntf' || explode(",", $get_profile[0]['on-login'])[1] == 'ntfc') {
            $getapi = $this->ROSPaymentModel->get_tripay_api($routerid,$userid);
            $apiKey       = $getapi[0]->tripay_api_key;
            $privateKey   = $getapi[0]->tripay_private_key;
            $merchantCode = $getapi[0]->tripay_merchant_code;
            $merchantRef  = 'INVPV/' . $userid . '/' . $routerid . '/' . strtoupper($kodevoucher) . '/' .  date("dmy",time()) . '/' . rand(1,999);
            $amount       = $price;
            $data = [
                'method'         => $payment_method,
                'merchant_ref'   => $merchantRef,
                'amount'         => $amount,
                'customer_name'  => $kodevoucher,
                'customer_email' => substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'),1,1) . $kodevoucher . $generatedate . '@gmail.com',
                'customer_phone' => $generatephone,
                'order_items'    => [
                    [
                        'sku'         => 'Voucher-' . $validity,
                        'name'        => 'Perpanjang-' . $kodevoucher,
                        'price'       => $price,
                        'quantity'    => 1
                    ]
                ],
                'return_url'   => base_url('voucher') . '/' . $userid . '/' . $routerid,
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = json_decode(curl_exec($curl));
            $error = json_decode(curl_error($curl));
            curl_close($curl);
            if (empty($error) && $response->success == true) {
                $dataTransaksi = [
                    'user_id' => $userid,
                    'router_id' => $routerid,
                    'merchant_ref' => $merchantRef,
                    'customer_name' => $kodevoucher,
                    'reference' => $response->data->reference,
                    'payment_name' => $response->data->payment_name,
                    'amount_received' => $response->data->amount_received,
                    'return_url' => base_url('invoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference,
                    'service' => explode("-",$response->data->order_items[0]->sku)[0],        
                    'query_status' => 'waiting payment',             
                    'status' => $response->data->status,              
                ];
                $saveData = $this->ROSPaymentModel->add_transaksi($dataTransaksi);
                if ($saveData) {
                    if ($template == 'yes') {
                        return redirect()->to(base_url('tinvoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference);
                    } else {
                        return redirect()->to(base_url('invoice') . '/' . $userid . '/' . $routerid . '/' . $response->data->reference);
                    }
                } else {
                    $this->session->setFlashdata('error', ['Gagal request, silahkan coba lagi...']);
                    if ($template == 'yes') {
                        return redirect()->to(base_url('tperpanjang') . '/' . $userid . '/' . $routerid);
                    } else {
                        $this->session->setFlashdata('hide', ['d-none']);
                        $this->session->setFlashdata('checked', ['checked']);
                        $this->session->setFlashdata('show', ['d-none']);
                        return redirect()->to(base_url('voucher') . '/' . $userid . '/' . $routerid);
                    }
                    
                }
            } else {
                $this->session->setFlashdata('error', ['Metode pembayran sedang gangguan, silahkan coba dengan metode pembayaran yang berbeda.']);
                if ($template == 'yes') {
                    return redirect()->to(base_url('tperpanjang') . '/' . $userid . '/' . $routerid);
                } else {
                    $this->session->setFlashdata('hide', ['d-none']);
                    $this->session->setFlashdata('checked', ['checked']);
                    $this->session->setFlashdata('show', ['d-none']);
                    return redirect()->to(base_url('voucher') . '/' . $userid . '/' . $routerid);
                }
            }
            
        } else {
            $this->session->setFlashdata('error', ['Kode Voucher tidak ditemukan!']);
            if ($template == 'yes') {
                return redirect()->to(base_url('tperpanjang') . '/' . $userid . '/' . $routerid);
            } else {
                $this->session->setFlashdata('hide', ['d-none']);
                $this->session->setFlashdata('checked', ['checked']);
                $this->session->setFlashdata('show', ['d-none']);
                return redirect()->to(base_url('voucher') . '/' . $userid . '/' . $routerid);
            }
        }
    }

    public function ppp_invoice() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $ref = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $getapi = $this->ROSPaymentModel->get_tripay_api($routerid,$userid);
            $apiKey = $getapi[0]->tripay_api_key;
            $payload = ['reference'	=> $ref];
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/transaction/detail?'.http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            $response = json_decode(curl_exec($curl));
            $error = json_decode(curl_error($curl));
            curl_close($curl);

            $pmethod = ['code' => $response->data->payment_method];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/merchant/payment-channel?'.http_build_query($pmethod),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ));

            $res = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if (empty($error) && empty($err)) {
                $data['payment'] = $res;
                $data['response'] = $response;
                $data['userid'] = $userid;
                $data['routerid'] = $routerid;
                return view('payment/invoice', $data);
            } else {
                echo '<p style="text-align:center">Something Wrong</p>';
            }
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function tinvoice() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $ref = $this->uri->getSegment($this->ref);
        $data['user'] = $this->ROSPaymentModel->get_user_by_id($userid);
        $data['router'] = $this->ROSPaymentModel->get_router_by_id($routerid,$userid);
        if (!empty($data['router']) && !empty($data['router'])) {
            $getapi = $this->ROSPaymentModel->get_tripay_api($routerid,$userid);
            $apiKey = $getapi[0]->tripay_api_key;
            $payload = ['reference'	=> $ref];
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/transaction/detail?'.http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            $response = json_decode(curl_exec($curl));
            $error = json_decode(curl_error($curl));
            curl_close($curl);

            $pmethod = ['code' => $response->data->payment_method];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/' . $this->endpoint . '/merchant/payment-channel?'.http_build_query($pmethod),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ));

            $res = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if (empty($error) && empty($err)) {
                $data['payment'] = $res;
                $data['response'] = $response;
                $data['userid'] = $userid;
                $data['routerid'] = $routerid;
                return view('template/tinvoice', $data);
            } else {
                echo '<p style="text-align:center">Something Wrong</p>';
            }
        } else {
            echo '<p style="text-align:center">Wrong URL</p>';
        }
    }

    public function callback() {
        $userid = $this->uri->getSegment($this->userid);
        $routerid = $this->uri->getSegment($this->routerid);
        $getapi = $this->ROSPaymentModel->get_tripay_api($routerid,$userid);
        $privateKey = $getapi[0]->tripay_private_key;
        
		$json = file_get_contents("php://input");
		$callbackSignature = isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE']) ? $_SERVER['HTTP_X_CALLBACK_SIGNATURE'] : '';
		$signature = hash_hmac('sha256', $json, $privateKey);
		if( $callbackSignature !== $signature ) {
			exit("Invalid Signature"); 
		}
		$data = json_decode($json);
        $status = $data->status;
        $ref = $data->reference;
        $mref = $data->merchant_ref;
        if ('payment_status' !== $_SERVER['HTTP_X_CALLBACK_EVENT']) {
            exit('Invalid callback event, no action was taken');
        }

        $transaksidb = $this->ROSPaymentModel->get_transaksi_by_ref($userid,$routerid,$ref,$mref);
        $name = $transaksidb[0]->customer_name;
        $profile = $transaksidb[0]->profile;
        $paytype = explode("/",$transaksidb[0]->merchant_ref)[0];

        if (empty($transaksidb)) {
            exit('Data not found, no action was taken');
        }

        if ($status == 'PAID') {
            if ($paytype == 'INVP') {
                $update = $this->ROSPaymentModel->update_transaksi_status($userid,$routerid,$ref,$mref,$status);
                if ($update) {
                    $gr = $this->ROSPaymentModel->gr($routerid,$userid);
                    $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));

                    $get_ppp_secret = $this->ros->comm("/ppp/secret/print", array("?name" => "$name"));
                    $get_ppp_sch = $this->ros->comm("/system/scheduler/print", array("?name" => "$name"));
                    $sid = $get_ppp_secret[0]['.id'];
                    $schid = $get_ppp_sch[0]['.id'];
                    $onevent = $get_ppp_sch[0]['on-event'];
                    $startdate = explode(",", $onevent)[5];
                    $enddate = explode(",", $onevent)[6];
                    $mainprofile = explode(",", $onevent)[1];
                    $fupprofile = explode(",", $onevent)[2];
                    $masaktif = explode(",", $onevent)[4];
                    $graceperiod = explode(",", $onevent)[3];
                    $harga = explode(",", $onevent)[8];
                    $sname = $name;

                    date_default_timezone_set($gr[0]->router_ntp);
                    $myTime = Time::today($gr[0]->router_ntp, 'id_ID');
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

                    $onevent = ':put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$masaktif.','.$newstartdate.','.$newenddate.','.$sname.','.$harga.',");/ppp secret set [find where name="'.$sname.'"] profile='.$fupprofile.' comment="dalam masa tenggang (isolir/fup)"; /ppp active remove [find where name="'.$sname.'"]; /sys sch set [find where name="'.$sname.'"] interval='.$graceperiod.' on-event={:put (",'.$mainprofile.','.$fupprofile.','.$graceperiod.','.$masaktif.','.$newstartdate.','.$newenddate.','.$sname.','.$harga.',"); /ppp secret set [find where name="'.$sname.'"] disabled=yes ; /sys sch set [find where name="'.$sname.'"] disabled=yes; :delay 15s; /ppp active remove [find where name="'.$sname.'"];}';

                    $query = $this->ROSPaymentModel->extend_ppp_secret($sid,$mainprofile,$routerid,$userid);
                    // $query = $this->ros->comm("/ppp/secret/set", array(
                    //     ".id" => "$sid",
                    //     "profile" => "$mainprofile",
                    //     "comment" => "",
                    //     "disabled" => "no",
                    // ));

                    if (!empty($query['after']['message'])) {
                        $this->ROSPaymentModel->update_transaksi_query_failed($userid,$routerid,$ref,$mref);
                        exit('ROS Query Failed');
                    } else {
                        $get_ppp_active = $this->ros->comm("/ppp/active/print", array("?name" => "$name"));
                        $this->ros->disconnect;
                        $activeid = $get_ppp_active[0]['.id'];
                        $removeactive = $this->ROSPaymentModel->remove_ppp_active($activeid,$routerid,$userid);
                        // $removeactive = $this->ros->comm("/ppp/active/remove", array(
                        //     ".id" => "$activeid",
                        // ));
                        if (!empty($removeactive['after']['message'])) {
                            $qresult = $newenddate;
                            $this->ROSPaymentModel->update_transaksi_query_sukses($userid,$routerid,$ref,$mref,$qresult);
                            $this->ROSPaymentModel->extend_ppp_scheduler($schid,$sname,$newenddate,$masaktif,$onevent,$routerid,$userid);
                            echo json_encode(['success' => true]); 
                            exit;
                        } else {
                            $qresult = $newenddate;
                            $this->ROSPaymentModel->update_transaksi_query_sukses($userid,$routerid,$ref,$mref,$qresult);
                            $this->ROSPaymentModel->extend_ppp_scheduler($schid,$sname,$newenddate,$masaktif,$onevent,$routerid,$userid);
                            echo json_encode(['success' => true]); 
						    exit;
                        }
                    }
                }
            } else if ($paytype == 'INVB') {
                $update = $this->ROSPaymentModel->update_transaksi_status($userid,$routerid,$ref,$mref,$status);
                if ($update) {
                    $query = $this->ROSPaymentModel->add_user($name,$profile,$routerid,$userid);
                    if (!empty($query['after']['message'])) {
                        $this->ROSPaymentModel->update_transaksi_query_failed($userid,$routerid,$ref,$mref);
                        exit('ROS Query Failed');
                    } else {
                        $qresult = 'User Created';
                        $this->ROSPaymentModel->update_transaksi_query_sukses($userid,$routerid,$ref,$mref,$qresult);
                        echo json_encode(['success' => true]); 
                        exit;
                    }
                }
            } else if ($paytype == 'INVPV') {
                $update = $this->ROSPaymentModel->update_transaksi_status($userid,$routerid,$ref,$mref,$status);
                if ($update) {
                    $gr = $this->ROSPaymentModel->gr($routerid,$userid);
                    $this->ros->connect($gr[0]->router_host, $gr[0]->router_user, $this->key->de($gr[0]->router_pass));

                    // $get_user = $this->ROSPaymentModel->get_hotspot_user($name,$routerid,$userid);
                    $get_user = $this->ros->comm("/ip/hotspot/user/print", array("?name" => "$name"));
                    $this->ros->disconnect;

                    $uid = $get_user[0]['.id'];
                    $ucomment = $get_user[0]['comment'];
                    $ucommentdate = explode(" ", $ucomment)[0];
                    $ucommentclock = explode(" ", $ucomment)[1];
                    $uprofile = $get_user[0]['profile'];
                    $get_profile = $this->ROSPaymentModel->get_uprofile($uprofile,$routerid,$userid);
                    $validity = explode(",", $get_profile[0]['on-login'])[3];

                    date_default_timezone_set($gr[0]->router_ntp);
                    $myTime = Time::today($gr[0]->router_ntp, 'id_ID');
                    $tudey = date('d-m-Y', strtotime($myTime));
                    $now = strtotime($tudey);
                    $d2 = str_replace('/', '-', $ucommentdate);
                    $d3 = strtotime($d2);
                    $d4 = date('d-m-Y', $d3);
                    $exp_date = strtotime($d4);
                    $formula = $now - $exp_date;
                    $datediff = round($formula / (60 * 60 * 24));
                    
                    if ($exp_date < $now) {
                        $e2 = ucfirst($ucommentdate);
                        $e3 = str_replace('/', '-', $e2);
                        $add_diff = strtotime('+' . $datediff . ' days', strtotime($e3));
                        $newdateafterdiff =  strtolower(date('M/d/Y', $add_diff));
                        if (substr($validity, -1) == "d" & strlen($validity) > 3) {
                            $addtime = ((substr($validity, 0, -1) * 7) + substr($validity, 2, 1)) . " Days";
                        } else if (substr($validity, -1) == "d") {
                            $addtime = substr($validity, 0, -1) . " Days";
                        } else if (substr($validity, -1) == "h") {
                            $addtime = substr($validity, 0, -1) . " Hours";
                        } else if (substr($validity, -1) == "w") {
                            $addtime = (substr($validity, 0, -1) * 7) . " Days";
                        } 
                        $enddate2 = ucfirst($newdateafterdiff);
                        $enddate3 = str_replace('/', '-', $enddate2);
                        $add = strtotime('+' . $addtime, strtotime($enddate3));
                        $new_validity_date = strtolower(date('M/d/Y', $add));
                        $newvalidity = $new_validity_date . ' ' . $ucommentclock;
                        $query = $this->ROSPaymentModel->extend_hotspot_user($uid,$newvalidity,$routerid,$userid);
                        if (!empty($query['after']['message'])) {
                            $this->ROSPaymentModel->update_transaksi_query_failed($userid,$routerid,$ref,$mref);
                            exit('ROS Query Failed');
                        } else {
                            $qresult = $newvalidity;
                            $this->ROSPaymentModel->update_transaksi_query_sukses($userid,$routerid,$ref,$mref,$qresult);
                            echo json_encode(['success' => true]); 
                            exit;
                        }
                    } else {
                        if (substr($validity, -1) == "d" & strlen($validity) > 3) {
                            $addtime = ((substr($validity, 0, -1) * 7) + substr($validity, 2, 1)) . " Days";
                        } else if (substr($validity, -1) == "d") {
                            $addtime = substr($validity, 0, -1) . " Days";
                        } else if (substr($validity, -1) == "h") {
                            $addtime = substr($validity, 0, -1) . " Hours";
                        } else if (substr($validity, -1) == "w") {
                            $addtime = (substr($validity, 0, -1) * 7) . " Days";
                        } 
                        $enddate2 = ucfirst($ucommentdate);
                        $enddate3 = str_replace('/', '-', $enddate2);
                        $add = strtotime('+' . $addtime, strtotime($enddate3));
                        $new_validity_date = strtolower(date('M/d/Y', $add));
                        $newvalidity = $new_validity_date . ' ' . $ucommentclock;
                        $query = $this->ROSPaymentModel->extend_hotspot_user($uid,$newvalidity,$routerid,$userid);
                        if (!empty($query['after']['message'])) {
                            $this->ROSPaymentModel->update_transaksi_query_failed($userid,$routerid,$ref,$mref);
                            exit('ROS Query Failed');
                        } else {
                            $qresult = $newvalidity;
                            $this->ROSPaymentModel->update_transaksi_query_sukses($userid,$routerid,$ref,$mref,$qresult);
                            echo json_encode(['success' => true]); 
                            exit;
                        }
                    }
                }
            }
        } else if ($status == 'EXPIRED') {
            $update = $this->ROSPaymentModel->update_transaksi_status($userid,$routerid,$ref,$mref,$status);
            if ($update) {
                echo json_encode(['success' => true]); 
                exit;
            }
        } else if ($status == 'FAILED') {
            $update = $this->ROSPaymentModel->update_transaksi_status($userid,$routerid,$ref,$mref,$status);
            if ($update) {
                echo json_encode(['success' => true]); 
                exit;
            }
        }
    }
}