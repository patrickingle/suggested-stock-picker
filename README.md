suggested-stock-picker
======================

A PHP script that polls Yahoo! Finance of all NYSE listed securities searching for equities which meet a criteria of stock dividends, minimal stock dividend return and maximum stock price

Updating equity CSV files
=========================
Occasinally, the equity company files will need to be updated. 

NYSE https://www.nyse.com/listings_directory/stock

NYSE, NASDAQ, AMEX: https://www.nasdaq.com/api/v1/screener?page=1&pageSize=20 about 300 pages (from 1-300)

returns,

{
    "data":[
        {
            "ticker":"AAPL",
            "company":"Apple Inc",
            "marketCap":1156096627600,
            "marketCapGroup":"Mega",
            "sectorName":"Consumer Goods",
            "sector":"consumergoods",
            "dividendData":{
                "dividendYield":1.2039,
                "dividend":0.77000000000000002,
                "dividendYieldGroup":"Positive"
            },
            "analystConsensusLabel":"Moderate Buy",
            "analystConsensus":"ModerateBuy",
            "priceTargetData":{
                "analystPriceTarget":249.56,
                "upside":-0.024469999999999999,
                "upsideGroup":4
            },
            "bestAnalystConsensusLabel":"Moderate Buy",
            "bestAnalystConsensus":"ModerateBuy",
            "bestPriceTargetData":{
                "analystPriceTarget":252.41,
                "upside":-0.01332,
                "upsideGroup":4
            },
            "newsSentimentData":{
                "signal":"ModerateBuy",
                "label":"Moderate Buy",
                "score":0.8367
            },
            "insiderSentimentData":{
                "signal":"Hold",
                "label":"Hold",
                "score":0.29160000000000003
            },
            "mediaBuzzData":{
                "signal":"ModerateBuy",
                "label":"Moderate Buy",
                "score":0.62914999999999999
            },
            "hedgeFundSentimentData":{
                "signal":"Negative",
                "label":"Negative",
                "score":0.3493
            },
            "investorSentimentData":{
                "signal":"StrongSell",
                "label":"Strong Sell",
                "score":0
            },
            "bloggerSentimentData":{
                "signal":"Bullish",
                "label":"Bullish",
                "bearishCount":15,"bullishCount":99
            },
            "priceChartSevenDay":[
                {
                    "date":"2019-10-24T00:00:00",
                    "price":243.58000000000001
                },
                {
                    "date":"2019-10-25T00:00:00",
                    "price":246.58000000000001
                },
                {
                    "date":"2019-10-28T00:00:00",
                    "price":249.05000000000001
                },
                {
                    "date":"2019-10-29T00:00:00",
                    "price":243.28999999999999
                },
                {
                    "date":"2019-10-30T00:00:00",
                    "price":243.25999999999999
                },
                {
                    "date":"2019-10-31T00:00:00",
                    "price":248.75999999999999
                },
                {
                    "date":"2019-11-01T00:00:00",
                    "price":255.81999999999999
                }
            ],
            "articles":[],
            "gicsSector":"Materials",
            "gicsSectorName":"Materials"
        }
    ]
}

About the data and picks directory
==================================
For those who do not have the resources to execute this script, I have this script executed every Sunday and updates new picks (or suggested equities) and save the new files in the picks. The data directory contains a JSON snapshot list of all companies on the selected exchange.

Only the last 10 weeks of data and picks are kept.

The criteria that I set for my picks are the closing price less than $100 and the stock divident rate greater than or equal to 10%.

To view my picks, navigate your browser to the picks directory by clicking on the picks link above, then choose the CSV file of the picks that you want to se and Click on that file, your browser will show you the picks in a nice tabular format. You can alternatively download the file and open i your favorit spreadsheet program.

Trading Suggestion
==================
The following is a trading suggestion and does not constitute trading advice, neither direct nor implied.

- When buying shares, buy in quantities of 100 shares. 
- Adopt a buy and hold strategy and resist the urge to day trade.


Recommended Video
=================

The following video is strongly recommended for analyzing the suggested list and investing in companies with dividends.

How to pick income winners -- The big dividend trap - MoneyWeek Investment Tutorials
[![How to pick income winners -- The big dividend trap - MoneyWeek Investment Tutorials](http://img.youtube.com/vi/zBEoukbuT38/0.jpg)](http://www.youtube.com/watch?v=zBEoukbuT38)

Suggested Videos
================

The Basics of Stock Dividends

Profit Payout Ratio (PPR) = Total Dividend Payout / Profit Before Dividend Payout * 100

if PPR is less than 50%, then the company can afford to substain (and increase) dividend payouts
if PPR is greater than 50%, then this company cannot substain it's dividend payouts.

To determine the Dividend Payout Ratio, http://www.dummies.com/business/accounting/how-to-read-financial-reports-for-the-dividend-payout-ratio/

Ex Div Date = dividends paid out up to the year end date

[![The Basics of Stock Dividends](http://img.youtube.com/vi/nIINBjajVeA/0.jpg)](http://www.youtube.com/watch?v=nIINBjajVeA)

Key benefits of owning dividend stocks with David Stanley and Rob Carrick

[![Key benefits of owning dividend stocks with David Stanley and Rob Carrick](http://img.youtube.com/vi/Es-1gTbhTrg/0.jpg)](http://www.youtube.com/watch?v=Es-1gTbhTrg)

Potential benefits of dividend-paying equities

[![Potential benefits of dividend-paying equities](http://img.youtube.com/vi/2hwMU1F-Kis/0.jpg)](http://www.youtube.com/watch?v=2hwMU1F-Kis)




Suggested Links
===============

DRIP (Dividend Reinvesting Program)
https://www.directinvesting.com/search/no_fees_list.cfm

