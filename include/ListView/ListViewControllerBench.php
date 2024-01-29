<?php
include_once 'build/evBench/loadcorebos.php';

class ListViewControllerBench {

	private $usrdota0x = 5; // testdmy 2 decimal places > non admin
	private $usrdota3comdollar = 12; // testmcurrency
	private $CompanyFilterId = 0;

	/**
	* @Revs(250)
	* @Iterations(2)
	* @Assert("mode(variant.time.avg) < 43 ms")
	*/
	public function benchgetListViewEntriesContacts() {
		global $current_user, $currentModule, $adb;
		$currentModule = 'Contacts';
		$focus = CRMEntity::getInstance($currentModule);
		$url_string = '';
		$sorder = 'ASC';
		$order_by = 'firstname';
		$skipAction = false;
		$queryGenerator = new QueryGenerator($currentModule, $current_user);
		$viewid = 7; // Contacts ALL
		$queryGenerator->initForCustomViewById($viewid);
		$list_query = $queryGenerator->getQuery();
		$start = 0;
		$limit_start_rec = $start;
		$list_max_entries_per_page = 10;
		$limitQuery = " LIMIT $limit_start_rec, $list_max_entries_per_page";
		$list_result = $adb->pquery($list_query. $limitQuery, array());
		$count_result = $adb->query(mkCountQuery($list_query));
		$noofrows = $adb->query_result($count_result, 0, 0);
		$controller = new ListViewController($adb, $current_user, $queryGenerator);
		$navigation_array = VT_getSimpleNavigationValues($start, $list_max_entries_per_page, $noofrows);
		$controller->getListViewHeader($focus, $currentModule, $url_string, $sorder, $order_by, $skipAction);
		$controller->getListViewEntries($focus, $currentModule, $list_result, $navigation_array, $skipAction);
	}

	/**
	* @Revs(250)
	* @Iterations(2)
	* @Assert("mode(variant.time.avg) < 13.1 ms")
	*/
	public function benchgetListViewEntriesDocs() {
		global $current_user, $currentModule, $adb;
		$currentModule = 'Documents';
		$focus = new $currentModule();
		$url_string = '';
		$sorder = 'ASC';
		$order_by = 'notes_title';
		$skipAction = false;
		$queryGenerator = new QueryGenerator($currentModule, $current_user);
		$viewid = 22; // Documents ALL
		$queryGenerator->initForCustomViewById($viewid);
		$start = 0;
		$limit_start_rec = $start;
		$list_max_entries_per_page = 1;
		$list_query = $queryGenerator->getQuery();
		$limitQuery = " LIMIT $limit_start_rec, $list_max_entries_per_page";
		$list_result = $adb->pquery($list_query. $limitQuery, array());
		$noofrows = 1;
		$controller = new ListViewController($adb, $current_user, $queryGenerator);
		$navigation_array = VT_getSimpleNavigationValues($start, $list_max_entries_per_page, $noofrows);
		$controller->getListViewHeader($focus, $currentModule, $url_string, $sorder, $order_by, $skipAction);
		$controller->getListViewEntries($focus, $currentModule, $list_result, $navigation_array, $skipAction);
	}

	/**
	* @Revs(250)
	* @Iterations(2)
	* @Assert("mode(variant.time.avg) < 16.0 ms")
	*/
	public function benchgetListViewEntriesProducts() {
		global $current_user, $currentModule, $adb;
		$currentModule = 'Products';
		$focus = CRMEntity::getInstance($currentModule);
		$url_string = '';
		$sorder = 'ASC';
		$order_by = 'productname';
		$skipAction = false;
		$user = new Users();
		$user->retrieveCurrentUserInfoFromFile($this->usrdota3comdollar);
		$current_user = $user;
		$queryGenerator = new QueryGenerator($currentModule, $current_user);
		$viewid = 24; // Products ALL
		$queryGenerator->initForCustomViewById($viewid);
		$start = 0;
		$limit_start_rec = $start;
		$list_max_entries_per_page = 1;
		$list_query = $queryGenerator->getQuery();
		$limitQuery = " LIMIT $limit_start_rec, $list_max_entries_per_page";
		$list_result = $adb->pquery($list_query. $limitQuery, array());
		$noofrows = 1;
		$controller = new ListViewController($adb, $current_user, $queryGenerator);
		$navigation_array = VT_getSimpleNavigationValues($start, $list_max_entries_per_page, $noofrows);
		$controller->getListViewHeader($focus, $currentModule, $url_string, $sorder, $order_by, $skipAction);
		$controller->getListViewEntries($focus, $currentModule, $list_result, $navigation_array, $skipAction);
		$current_user = Users::getActiveAdminUser();
	}

	/**
	* @Revs(250)
	* @Iterations(2)
	* @Assert("mode(variant.time.avg) < 10.0 ms")
	*/
	public function benchgetListViewEntriesCompany() {
		global $current_user, $currentModule, $adb;
		$currentModule = 'cbCompany';
		$focus = CRMEntity::getInstance($currentModule);
		$url_string = '';
		$sorder = 'ASC';
		$order_by = 'compnyname';
		$skipAction = false;
		$queryGenerator = new QueryGenerator($currentModule, $current_user);
		$viewid = $this->CompanyFilterId; // Company fields
		$queryGenerator->initForCustomViewById($viewid);
		$start = 0;
		$limit_start_rec = $start;
		$list_max_entries_per_page = 1;
		$list_query = $queryGenerator->getQuery();
		$limitQuery = " LIMIT $limit_start_rec, $list_max_entries_per_page";
		$list_result = $adb->pquery($list_query. $limitQuery, array());
		$noofrows = 1;
		$controller = new ListViewController($adb, $current_user, $queryGenerator);
		$navigation_array = VT_getSimpleNavigationValues($start, $list_max_entries_per_page, $noofrows);
		$controller->getListViewHeader($focus, $currentModule, $url_string, $sorder, $order_by, $skipAction);
		$controller->getListViewEntries($focus, $currentModule, $list_result, $navigation_array, $skipAction);
	}
}