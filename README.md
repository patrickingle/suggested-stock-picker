# suggested-stock-picker

A PHP script that polls Yahoo! Finance of all NYSE listed securities searching for equities which meet a criteria of stock dividends, minimal stock dividend return and maximum stock price

# Updating equity CSV files

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

# About the data and picks directory
For those who do not have the resources to execute this script, I have this script executed every Sunday and updates new picks (or suggested equities) and save the new files in the picks. The data directory contains a JSON snapshot list of all companies on the selected exchange.

Only the last 10 weeks of data and picks are kept.

The criteria that I set for my picks are the closing price less than $100 and the stock divident rate greater than or equal to 10%.

To view my picks, navigate your browser to the picks directory by clicking on the picks link above, then choose the CSV file of the picks that you want to se and Click on that file, your browser will show you the picks in a nice tabular format. You can alternatively download the file and open i your favorit spreadsheet program.

# Trading Suggestion
The following is a trading suggestion and does not constitute trading advice, neither direct nor implied.

    - When buying shares, buy in quantities of 100 shares. 
    - Adopt a buy and hold strategy and resist the urge to day trade.


# Recommended Video

The following video is strongly recommended for analyzing the suggested list and investing in companies with dividends.

How to pick income winners -- The big dividend trap - MoneyWeek Investment Tutorials
[![How to pick income winners -- The big dividend trap - MoneyWeek Investment Tutorials](http://img.youtube.com/vi/zBEoukbuT38/0.jpg)](http://www.youtube.com/watch?v=zBEoukbuT38)

# Suggested Videos

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

# Suggested Links

DRIP (Dividend Reinvesting Program)
https://www.directinvesting.com/search/no_fees_list.cfm

# Application Categories
## Books
Apps that provide extensive interactivity for content that is traditionally offered in printed form. If you are planning a more traditional reading experience, you may want to look at publishing an iBook instead.

For example: stories, comics, eReaders, coffee table books, graphic novels.

## Business
Apps that assist with running a business or provide a means to collaborate, edit, or share content.

For example: document management (PDFs, scanning, file viewing/editing), VoIP telephony, dictation, remote desktop, job search resources, customer resource management, collaboration, enterprise resource planning, point of sale.

## Developer Tools
Apps that provide tools for app development, management, and distribution.

For example: coding, testing, debugging, workflow management, text and code editing.

## Education
Apps that provide an interactive learning experience on a specific skill or subject.

For example: arithmetic, alphabet, writing, early learning and special education, solar system, vocabulary, colors, language learning, standardized test prep, geography, school portals, pet training, astronomy, crafts.

## Entertainment
Apps that are interactive and designed to entertain and inform the user, and which contain audio, visual, or other content.

For example: television, movies, second screens, fan clubs, theatre, ringtones, voice manipulation, ticketing services, art creation.

## Finance
Apps that perform financial transactions or assist the user with business or personal financial matters.

For example: personal financial management, mobile banking, investment, bill reminders, budgets, debt management, tax, small business finance, insurance.

## Food & Drink
Apps that provide recommendations, instruction, or critique related to the preparation, consumption, or review of food or beverages.

For example: recipe collections, cooking guides, restaurant reviews, celebrity chefs/recipes, dietary & food allergy, alcohol reviews, brewery guides, international cuisine.

## Games
Apps that provide single or multiplayer interactive activities for entertainment purposes.

For example: action, adventure, board, card, family, music, puzzle, racing, role playing, simulation, sports, strategy.

## Graphics & Design
Apps that provide tools for art, design, and graphics creation.

For example: vector graphic design, image editing, drawing and illustration.

## Health & Fitness
Apps related to healthy living, including stress management, fitness, and recreational activities.

For example: yoga, muscle diagrams, workout tracking, running, cycling, stress management, pregnancy, meditation, weight loss, pilates, acupuncture/acupressure, Eastern/Chinese medicine.

## Lifestyle
Apps relating to a general-interest subject matter or service.

For example: real estate, crafts, hobbies, parenting, fashion, home improvement.

## Kids (iOS and iPadOS only)
Apps designed specifically for children ages 11 and under. Age-appropriate apps must be placed in one of three age bands based on their primary audience: 5 and under, 6–8, or 9–11.

For example: age-appropriate games, interactive stories, educational materials, magazines.

## Magazines & Newspapers
Apps that offer auto-renewing subscriptions to magazine or newspaper content. Choose Magazines & Newspapers if you deliver content using an issue-based strategy or are producing interactive versions of a printed periodical.

For example: newspapers, magazines, other recurring periodicals.

## Medical
Apps that are focused on medical education, information management, or health reference for patients or healthcare professionals.

For example: skeletal, muscular, anatomy, medical record-keeping, diseases, symptom reference, companion devices (blood pressure, pulse, and so on), health tracking.

## Music
Apps that are for discovering, listening to, recording, performing, or composing music, and that are interactive in nature.

For example: music creation, radio, education, sound editing, music discovery, composition, lyric writing, band and recording artists, music videos and concerts, concert ticketing.

## Navigation
Apps that provide information to help a user travel to a physical location.

For example: driving assistance, walking assistance, topographical maps, maritime, pilot logs/assistance, oceanic tides, road atlas, fuel finders, public transit maps.

## News
Apps that provide information about current events or developments in areas of interest such as politics, entertainment, business, science, technology, and so on. Choose News if your app serves content via newsreader or digest format, or if your app is for a digital-first or broadcast-first media outlet with frequent content updates.

For example: television, video, radio, or online news outlets or programs, RSS readers.

## Photo & Video
Apps that assist in capturing, editing, managing, storing, or sharing photos and videos.

For example: capture, editing, special effects, sharing, imaging, printing, greeting card creation, manuals.

## Productivity
Apps that make a specific process or task more organized or efficient.

For example: task management, calendar management, translation, note taking, printing, password management, cloud storage, email clients, flow chart generators, audio dictation, simulation, data viewing.

## Reference
Apps that assist the user in accessing or retrieving information.

For example: atlas, dictionary, thesaurus, quotations, encyclopedia, general research, animals, law, religious, how-tos, politics.

## Shopping
Apps that support the purchase of consumer goods or materially enhance the shopping experience.

For example: commerce, marketplace, coupon, product review, apps with Apple Pay.

## Social Networking
Apps that connect people by means of text, voice, photo, or video. Apps that contribute to community development.

For example: interpersonal connections, text messaging, voice messaging, video communication, photo & video sharing, dating, blogs, special interest communities, companion apps for traditional social networking services.

## Sports
Apps related to professional, amateur, collegiate, or recreational sporting activities.

For example: fantasy sports companions, college teams/conference, professional teams/leagues, athletes, score trackers, instruction, sports news.

## Travel
Apps that assist the user with any aspect of travel, such as planning, purchasing, or tracking.

For example: flight tracking, multi-time clocks, city guides, hotel/rental car/air fare shopping, vacation planning, public transportation, travel rewards.

## Utilities
Apps that enable the user to solve a problem or complete a specific task.

For example: calculators (standard, tip, financial), clocks, measurement, time, web browsing, flashlights, screen locks, bar code scanners, unit conversion tools, password management, remote controls.

## Weather
Apps that provide forecasts, alerts, and information related to weather conditions.

For example: radar, forecast, storms, tides, severe weather, local weather.
