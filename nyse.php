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
$countries = _nyse_get_regions();

$results = array();
$country = 9; // default US selected
// Obtain a list of traded equities for the US.
$results[$country] = _nyse_get_listed_companies($country);

$suggested = array();

// Parse the company list looking for companies that meet the minimum requirements
foreach($results[9] as $equity) {
	// find companies which offer dividends with a maximum $100 share price and 
	// minimum 10% dividend return.
	$quote = _get_quote_from_yahoo($equity[0],true); 

	if (count($quote) > 0) {
		$temp = array();
		$temp = $equity;
		$temp['quote'] = json_encode($quote);
		$suggested[] = $temp;
	}
}

// Save the results in a CSV file.
$fp = fopen('suggested_'.$country.'_'.time().'.csv', 'w');

foreach ($suggested as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

?>