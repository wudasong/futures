<?php  
class ControllerDiaryMonth extends Controller {
	public function index() {
		$this->document->setTitle('期货交易记录');
		$this->document->setDescription('这是一个用来记录期货交易数据的系统');
		$this->document->setKeywords('期货交易记录，期货，黄金期货');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
		}
		
		$this->children = array(
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
	
	protected function create(){
		
	}
}
?>