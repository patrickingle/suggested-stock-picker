<?php
/**
* File: amex.php
* Description: main execution script for amex
* Author: Patrick Ingle for PHK Corporation
* Author URL: http://phkcorp.com
* License: COMMON DEVELOPMENT AND DISTRIBUTION LICENSE Version 1.0 (CDDL-1.0) [See lincese.txt]
*/
include 'table2arr.php';
include 'functions.php';

$country = 9; // default US selected

$companies = _load_company_list('amex');

file_put_contents('amex_'.time().'.json',json_encode($companies));

//echo '<pre>'; print_r($companies); echo '</pre>';

$suggested = array();
$total_dividend = 0.0;

foreach($companies as $equity) {
	// find companies which offer dividends with a maximum $100 share price and
	// minimum 10% dividend return.

	if (isset($equity['quote']['close']) && isset($equity['quote']['div yield']) && $equity['quote']['close'] <= 100.00 && $equity['quote']['div yield'] >= 10) {
		$temp = array();
		$temp['symbol'] = $equity['symbol'];
		$temp['company'] = $equity['title'];
		$temp['url'] = $equity['url'];
		$temp['edgar'] = $equity['edgar'];
		$temp['dividend'] = $equity['quote']['dividend'];
		$temp['yield'] = $equity['quote']['div yield'];
		$temp['quote'] = json_encode($equity['quote']);
		$temp['eps'] = $equity['quote']['eps'];
		$temp['dividend_payout_ratio'] = $equity['ppr'];
		$suggested[] = $temp;
		//print_r($temp);
		$total_dividend += $equity['quote']['dividend'];
	}
}

echo '<pre>'; print_r($suggested); echo '</pre>';

// Save the results in a CSV file.
$fp = fopen('amex_suggested_'.$country.'_'.time().'.csv', 'w');

$total_suggested = count($suggested);

foreach ($suggested as $fields) {
	$fields['allocation'] = 1000000 * ($fields['dividend'] / $total_dividend);
    fputcsv($fp, $fields);
}

fclose($fp);


?>
