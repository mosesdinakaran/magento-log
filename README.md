# Moses Log

An Logger Extension to log all/specific API calls

## To Install

Using Composer : composer require moses/magento-log

Download from Github https://github.com/mosesdinakaran/magento-log.git and paste in app code folder

## Configuration
Stores -> Configuration -> Advanced -> Developer -> Moses Logging

Enable API Logging : To Enable all/selected api calls

Regular Expression Patterns: Define the regular expression pattern to log selected urls, For more than one urls use next line.

Ex

V1/carts/9 :  Matches all urls for quote ID 9 that contains V1/carts/9

V1/carts/(\d)* : Matches for all quotes

V1/checkoutcomupapi/getTokenList : Match a specific url


