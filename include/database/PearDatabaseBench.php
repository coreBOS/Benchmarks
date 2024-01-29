<?php
include_once 'build/evBench/loadcorebos.php';

class PearDatabaseBench {

	/**
	* @Revs(1000)
	* @Iterations(5)
	*/
	public function benchpquery() {
		global $adb;
		$adb->pquery('select * from cb_settings', null);
		$adb->pquery('select * from cb_settings', []);
		$adb->pquery('select * from cb_settings where setting_key like ?', ['%click%']);
		$adb->pquery('select * from cb_settings where setting_key like ? or setting_key like ? or setting_key like ?', ['%click%', ['%cb%', '%a%']]);
		$adb->pquery('show tables like ?', ['cb_settings']);
	}
}