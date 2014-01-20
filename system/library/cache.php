<?php

class Cache { 
	
	private $mem;
	
	public function __construct() {
		
		if(USE_MEMCACHE)
		{
			$mem = new Memcache;
			$mem->connect("127.0.0.1", 11211);
			$this->mem = $mem;
		}
	}
	
	public function get($key) {
		// USE_MEMCACHE
		if($this->mem)
		{
			$cache = $this->mem->get($key);
			if($cache)
			{
				$cache = unserialize($cache);
			}
			return $cache;
		}
		else
		{
			$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
	
			if ($files) {
				$cache = file_get_contents($files[0]);
				
				$data = unserialize($cache);
				
				foreach ($files as $file) {
					$time = substr(strrchr($file, '.'), 1);
	
	      			if ($time < time()) {
						if (file_exists($file)) {
							unlink($file);
						}
	      			}
	    		}
				
				return $data;			
			}
		}
	}

  	public function set($key, $value, $expire = 3600) {
    	$this->delete($key);
		// USE_MEMCACHE
		if($this->mem)
		{
    		$this->mem->set($key, serialize($value), 0, $expire);
		}
		else 
		{
			
			$file = DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.' . (time() + $expire);
			 
			$handle = fopen($file, 'w');
			
			fwrite($handle, serialize($value));
			
			fclose($handle);
		}
  	}
	
  	public function delete($key) {
		// USE_MEMCACHE
		if($this->mem){
  			$this->mem->delete($key);
		}
		else 
		{
			$files = glob(DIR_CACHE . 'cache.' . preg_replace('/[^A-Z0-9\._-]/i', '', $key) . '.*');
			
			if ($files) {
				foreach ($files as $file) {
					if (file_exists($file)) {
						unlink($file);
					}
				}
			}
		}
  	}
}
?>