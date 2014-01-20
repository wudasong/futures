<?php
class ControllerCommonLoad extends Controller {
    public function index() {
    	
		if(isset($this->request->cookie['cookie']) && !$this->customer->isLogged()){
			
			$openid = $this->request->get['cookie'];
    		//$this->session->data['is_wx_user'] = true;
    		
    		$this->load->model('account/customer');
    		$this->load->model('account/customer_connect');
    		
    		// 判断该快捷注册用户是否已经存在
    		if($this->model_account_customer_connect->getCustomerId($openid)){
    			// 存在则登录
    			$customer_id = $this->model_account_customer_connect->getCustomerId($openid);
    			$customer = $this->model_account_customer->getCustomer($customer_id);
    			$this->customer->login($customer['email'],'',true);
    		}
    		else {
    			// 不存在则注册，并登录
	    		$fake_email = $openid.'@cqbianli.com';
	    		
	    		// 注册一个系统用户
	    		$fake_customer = Array('firstname' => '', 'lastname' => '', 'email' => $wx_fake_email,
	    				 'telephone' => '', 'fax' =>'', 'company' =>'', 'customer_group_id' => 1, 'company_id' => '', 'tax_id' =>'', 
	    				 'address_1' => '', 'address_2'=>'', 'city' => '', 'postcode' => '', 'country_id' => 44, 'zone_id' => 686,
	    				 'password' => 'cqbianli123', 'confirm' => 'cqbianli123', 'newsletter' => 0);
	    		
	    		$this->model_account_customer->addCustomer($fake_customer, false);
	    		
	    		// 添加系统用户和快捷用户的连接
	    		$customer = $this->model_account_customer->getCustomerByEmail($fake_email);
	    		
	    		$data = array();
	    		$data['customer_id'] = $customer['customer_id'];
	    		$data['openid'] = $openid;
	    		$this->model_account_customer_connect->addConnect($data);
	    		
	    		// 登录该用户
	    		$this->customer->login($fake_email,'',true);
    		}
		}
    	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/load.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/common/load.tpl';
        } else {
            $this->template = 'default/template/common/load.tpl';
        }
        
		$this->response->setOutput($this->render());
    }
}
?>