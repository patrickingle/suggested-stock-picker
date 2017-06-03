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
* https://www.nyse.com/search?site=idc_instruments&client=nyse_frontend_html&proxystylesheet=ice_frontend_json&requiredfields=INSTRUMENT_TYPE:EQUITY.NORMALIZED_TICKER:A*&getfields=*&num=236&filter=0&sort=meta:NORMALIZED_TICKER:A&start=0&wc=1000
*
* @param $country
*
* @return an array of listed companies
*/
function _nyse_get_listed_companies($country) {

	$listed = array();


	//$url = 'http://www.nyse.com/about/listed/lc_ny_country_'.$country.'_companies.js';
	foreach(range('A', 'Z') as $ticker) {
		$total = _nyse_get_regions($ticker);
		$url = 'https://www.nyse.com/search?site=idc_instruments&client=nyse_frontend_html&proxystylesheet=ice_frontend_json&requiredfields=INSTRUMENT_TYPE:EQUITY.NORMALIZED_TICKER:'.$ticker.'*&getfields=*&num='.$total.'&filter=0&sort=meta:NORMALIZED_TICKER:A&start=0&wc=1000';

		$contents = @file_get_contents($url);
		$json = json_decode($contents,TRUE);

		$total = $json['results_nav']['total_results'];

		foreach($json['results'] as $equity) {
			$temp = explode(':',$equity['title']);
			$symbol = trim($temp[0]);
			$title = trim($temp[1]);
			$quote = _get_quote_from_yahoo($symbol);

			$listed[] = array(
				'symbol' => $symbol,
				'title' => $title,
				'price' => $quote['close'],
				'dividend' => $quote['dividend'],
				'dividend_yield' => $quote['div yield'],
				'url' => str_replace("quote-idc","quote",$equity['url']),
				'quote' => $quote
			);
		}
	}

	return $listed;
}

// http://www.nyse.com/about/listed/lc_cms_region_count.js
/**
* _nyse_get_regions
*
* @return
*/
function _nyse_get_regions($ticker) {
	$url = 'https://www.nyse.com/search?site=idc_instruments&client=nyse_frontend_html&proxystylesheet=ice_frontend_json&requiredfields=INSTRUMENT_TYPE:EQUITY.NORMALIZED_TICKER:'.$ticker.'*&getfields=*&num=10&filter=0&sort=meta:NORMALIZED_TICKER:A&start=0&wc=1000';

	$contents = json_decode(file_get_contents($url),true);
	$total = $contents['results_nav']['total_results'];

	return $total;
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

	$quote_mapping = array('open','close','dividend','div paydate','div yield');

	// properties: s=symbol,d1=last trade date,o=open,p=previous close,r1=dividend paye date,y=div yield,y0=div yield in percent
	$url = 'http://download.finance.yahoo.com/d/quotes.csv?s='.$symbol.'&f=opdr1y&e=.csv';
	$quote_array['url'] = $url;
	$contents = @file_get_contents($url);

	$quote = explode(",",$contents);
	foreach($quote as $key => $value) {
		if (!$divonly) {
			$quote_array[$quote_mapping[$key]] = trim(str_replace('"','',$value));
		} else {
			if (isset($quote[3]) && $quote[3] > 0 &&
				doubleval($quote[4]) > $mindivpct &&
				doubleval($quote[1]) < $maxprice) {
				$quote_array[$quote_mapping[$key]] = trim(str_replace('"','',$value));
			}
		}
	}

	return $quote_array;
}

// https://www.google.com/finance/info?q=XNYS:AA
function _get_quote_from_google($symbol,$divonly=false,$maxprice=100,$mindivpct=10) {
	$quote_array = array();
	$_contents = @file_get_contents('https://www.google.com/finance/info?q='.$symbol);
	$contents = substr($_contents,3);
	echo $contents.'<br/>';
	$quote = json_decode($contents,true);
	echo '<pre>'; print_r($quote); echo '</pre>';
	foreach($quote as $_quote) {
		if (!$divonly) {
			$quote_array[$_quote['t']] = $_quote;
		} else {
			if (doubleval($_quote['yld']) > $mindivpct &&
			    doubleval($_quote['l']) < $maxprice) {
			    $quote_array[$_quote['t']] = $_quote;
			}
		}
	}

	return $quote_array;
}

?>