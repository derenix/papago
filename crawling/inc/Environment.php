<?php

class Environment{
	public function isLocal(){
		$whitelist = array(
			'127.0.0.1',
			'localhost',
			'::1'
		);

		if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			return false;
		}else{
			return true;
		}
	}
}