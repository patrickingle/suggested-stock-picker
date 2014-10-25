<?php
/**
* File: functions.php
* Description: library of useful functions
* Author: Patrick Ingle for PHK Corporation
* Author URL: http://phkcorp.com
* License: COMMON DEVELOPMENT AND DISTRIBUTION LICENSE Version 1.0 (CDDL-1.0) [See lincese.txt]
*/

/**
* _nyse_get_listed_companies
* 
* Obtain the listed companies from NYSE based on the country selected
* 
* Test URLS:
* ---------
* http://www.nyse.com/about/listed/lc_ny_region_2.html?ListedComp=All&country=9&start=1&startlist=1&item=1&firsttime=done
* http://www.nyse.com/about/listed/lc_ny_country_9_companies.js
* 
* @param $country
* 
* @return an array of listed companies
*/
function _nyse_get_listed_companies($country) {
	
	$listed = array();

	$url = 'http://www.nyse.com/about/listed/lc_ny_country_'.$country.'_companies.js';
	
	$contents = @file_get_contents($url);

	$json = substr($contents,34,strlen($contents)); 

	$updated = substr($json,0,strlen($json)-7);
	
	$temp = explode("],[",$updated);
	
	$mapping = array('symbol','name','country','url','exchange');
	$quote_mapping = array('open','close','dividend','yield','percent');
	
	foreach($temp as $key => $value) {
		$t = explode(",",$value);
		$equity = array();
		foreach($t as $k1 => $v1) {
			$equity[$k1] = str_replace('"','',$v1);
		}
		//$equity['quote'] = _get_quote_from_yahoo($equity[0],true);
		$listed[] = $equity;
	}
	
	return $listed;
}

// http://www.nyse.com/about/listed/lc_cms_region_count.js
/**
* _nyse_get_regions
* 
* @return
*/
function _nyse_get_regions() {
	$url = 'http://www.nyse.com/about/listed/lc_cms_region_count.js';
	
	$contents = file_get_contents($url);
	
	$temp = explode("\n",$contents);
	
	$arr = array();
	foreach($temp as $key => $value) {
		if ($key > 0) {
			$t = explode("_",$value);
			if (isset($t[3]) && $t[3] > 0) {
				$arr[] = $t[3];
			}
		}
	}
	
	return $arr;
}

// http://query.yahooapis.com/v1/public/yql
// http://download.finance.yahoo.com/d/quotes.csv?s=DBK.DE&f=sd1op&e=.csv
/**
* 
* @param $symbol = company trading symbol
* @param $divonly = filter only companies with have dividends
* @param $maxprice = filter companies with a share price less than this value
* @param $mindivpct = filter companies with a dividend return greater than this value
* 
* @return an array of suggested companies
*/
function _get_quote_from_yahoo($symbol,$divonly=false,$maxprice=100,$mindivpct=10) {
	$quote_array = array();
	
	// properties: s=symbol,d1=last trade date,o=open,p=previous close,r1=dividend paye date,d0=div yield,y0=div yield in percent
	$contents = @file_get_contents('http://download.finance.yahoo.com/d/quotes.csv?s='.$symbol.'&f=opr1d0y0&e=.csv');
	
	$quote = explode(",",$contents);
	foreach($quote as $key => $value) {
		if (!$divonly) {
			$quote_array[$key] = str_replace('"','',$value);
		} else {
			if (isset($quote[3]) && $quote[3] > 0 && 
				doubleval($quote[4]) > $mindivpct && 
				doubleval($quote[1]) < $maxprice) {
				$quote_array[$key] = str_replace('"','',$value);
			}
		}
	}
	
	return $quote_array;
}

?>