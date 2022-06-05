<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{

	// public function __construct() {
	// 	parent::__construct();
	// 	$this->request = \Config\Services::request(); 
	// 	$this->uri = $this->request->uri;

	// 	//==================filter untuk login dashboard===============
	// 	if($_SERVER['HTTP_HOST'] == DOMAIN_UTAMA || $_SERVER['HTTP_HOST'] == DOMAIN_UTAMA_WWW){
	// 		$this->filters = [
	// 			'authuser' => ['before' => ['user/*']]
	// 		];
	// 	}
	// }

	// Makes reading things below nicer,
	// and simpler to change out script that's used.
	public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		'authuser' => \App\Filters\AuthUser::class, 
		'authrouter' => \App\Filters\AuthRouter::class, 
	];

	// Always applied before every request
	public $globals = [
		'before' => [
			//'honeypot'
			// 'csrf',
			// 'authuser' => ['user/*'],
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
	public $filters = [
		'authrouter' => [ 'before' => ['u/*'] ],
		'authuser' => [ 'before' => ['router/*'] ],
	];
}
