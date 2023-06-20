<?php
include_once 'build/evBench/loadcorebos.php';

class CommonUtilsBench {

	/**
	* @Revs(1000)
	* @Iterations(5)
	*/
	public function benchgetCurrencyName() {
		getCurrencyName(1, true);
	}

	/**
	* @Revs(1000)
	* @Iterations(5)
	*/
	public function benchgpopup_from_html() {
		popup_from_html('$string', true);
	}
}