<?php
/**
* File: nyse.php
* Description: main execution script
* Author: Patrick Ingle for PHK Corporation
* Author URL: http://phkcorp.com
* License: COMMON DEVELOPMENT AND DISTRIBUTION LICENSE Version 1.0 (CDDL-1.0) [See lincese.txt]
*/
include 'table2arr.php';
include 'functions.php';

// Obtain a list of countries
//$countries = _nyse_get_regions();

$results = array();
$country = 9; // default US selected
// Obtain a list of traded equities for the US.
$results[$country] = _nyse_get_listed_companies($country);

file_put_contents('nyse_'.time().'.json',json_encode($results[$country]));

//echo '<pre>'; print_r($results); echo '</pre>'; exit;
//echo '<pre>';

$suggested = array();
$total_dividend = 0.0;

// Parse the company list looking for companies that meet the minimum requirements
foreach($results[9] as $equity) {
	// find companies which offer dividends with a maximum $100 share price and
	// minimum 10% dividend return.

	if ($equity['quote']['close'] <= 100.00 && $equity['quote']['div yield'] >= 10) {
		$temp = array();
		$temp['symbol'] = $equity['symbol'];
		$temp['company'] = $equity['title'];
		$temp['url'] = $equity['url'];
		$temp['dividend'] = $equity['dividend'];
		$temp['yield'] = $equity['dividend_yield'];
		$temp['quote'] = json_encode($equity['quote']);
		$suggested[] = $temp;
		//print_r($temp);
		$total_dividend += $equity['dividend'];
	}
}

//echo '</pre>';
// Save the results in a CSV file.
$fp = fopen('suggested_'.$country.'_'.time().'.csv', 'w');

$total_suggested = count($suggested);

foreach ($suggested as $fields) {
	$fields['allocation'] = 1000000 * ($fields['dividend'] / $total_dividend);
    fputcsv($fp, $fields);
}

fclose($fp);

?>