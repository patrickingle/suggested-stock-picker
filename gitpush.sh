#!/bin/bash
/usr/bin/php /var/www/html/my-api.us/suggested-stock-picker/nyse.php
/usr/bin/php /var/www/html/my-api.us/suggested-stock-picker/amex.php
/usr/bin/php /var/www/html/my-api.us/suggested-stock-picker/nasdaq.php

git add .
git commit -m "Added new picks"
git push origin master

