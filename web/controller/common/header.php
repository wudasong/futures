<?php   
class ControllerCommonHeader extends Controller {
	
	protected function quick_login(){
		
		if(!$this->customer->isLogged() && isset($this->request->cookie['wx'])){
				
			$openid = $this->request->cookie['wx'];
		
			$this->load->model('account/customer');
			$this->load->model('account/customer_connect');
		
			// 判断该快捷注册用户是否已经存在
			if($this->model_account_customer_connect->getCustomerId($openid)){
				// 存在则登录
				$customer_id = $this->model_account_customer_connect->getCustomerId($openid);
				$customer = $this->model_account_customer->getCustomer($customer_id);
				$this->customer->login($customer['email'],'',true);
			}
		}
		
	}
	
	protected function months_filter($filter = null){
		$filters = array();
		$year_month = date('Ym');
		if($filter != null){
			$year_month = $filter;
		}
		
		$this->data['current_filter'] = $year_month;
		
		$year = substr($year_month, 0, 4);
		$year_start = $year.'01';
		$year_start_int = (int)$year_start;
		
		$filters[$year_start_int] = $year.'年1月';
		
		for($i=1; $i<12; $i++){
			$key = $year_start_int + $i;
			$val = ($i+1).'月';
			$filters[$key] = $val;
		}
		
		$this->data['months_filter'] = $filters;
	}
	
	protected function index() {
		
		//$this->quick_login();
		
		$this->data['title'] = $this->document->getTitle();
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
        
        if (isset($this->session->data['error']) && !empty($this->session->data['error'])) {
            $this->data['error'] = $this->session->data['error'];
            
            unset($this->session->data['error']);
        } else {
            $this->data['error'] = '';
        }

		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
			
		
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		
		$this->months_filter();
		
		// Daniel's robot detector
		$status = true;
		
		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", trim($this->config->get('config_robots')));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}
		
    	$this->render();
	} 	
}
?>
