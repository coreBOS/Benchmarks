<?php
include_once 'build/evBench/loadcorebos.php';

class cbEventHandlerBench {

	private $usrdota0x = 5; // testdmy 2 decimal places > non admin

	/**
	* @Revs(1000)
	* @Iterations(5)
	* @Assert("mode(variant.time.avg) < 3 ms")
	*/
	public function benchdoActionAdmin() {
		global $current_user, $currentModule;
		$currentModule = 'Accounts';
		$current_user = Users::getActiveAdminUser();
		ob_start();
		cbEventHandler::do_action('corebos.header');
		cbEventHandler::do_action('corebos.footer');
		ob_end_clean();
	}

	/**
	* @Revs(1000)
	* @Iterations(5)
	* @Assert("mode(variant.time.avg) < 3.4 ms")
	*/
	public function benchdoActionNonAdmin() {
		global $current_user, $currentModule;
		$currentModule = 'Accounts';
		$user = new Users();
		$user->retrieveCurrentUserInfoFromFile($this->usrdota0x);
		$current_user = $user;
		ob_start();
		cbEventHandler::do_action('corebos.header');
		cbEventHandler::do_action('corebos.footer');
		ob_end_clean();
		$current_user = Users::getActiveAdminUser();
	}
}