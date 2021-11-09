# Moses API Logging

This API logging extension from Moses Extensions, provides an options to log all/specific api calls.

In most of our environment we use different third party services such as order management, product management, product search , shipping management etc. These services interact with Magento using Rest APi'S. 

At times it would become very difficult to identify the root cause if we face any problem with these services.

Moreover if we are in headless environment primarily using rest apis it would be really hard to identify the root cause for certain issues. 

Consider a scenario where add to cart is not working for a particular customer only. 

To effectively debug this issue, we would require the post data, headers etc that is posted by that particular user.

This extension would help you in this scenario. It has the feature that we can log the api request that is made by a specific user.

Let see the complete features of this extension.

## Features
Enable or Disable Logging through Admin Configuration

Able to configure the api urls that needs to be logged using regular expression which will give endless opportunity to the developer to log a specific url

Few such ex are

- Able to log all the API logs
- Able to log logged in users API calls
- Able to log guest user API calls
- Able to log only a specific api calls such as custom api call, cart, CMS, Product, Order etc
- Able to log a specific user api calls.
- The API logs contain both the request and Response
- The logs are made in a separate file 
- This extension doesn't override any CORE Api class.

This can be safely deployed in Production environment as its very light weight.

## To Install

This extension can be installed through composer or by downloading the extension package and placing it under the code directory (MAGE_ROOT/app/code/Moses/Log)
Alternatively you can download from github as well https://github.com/mosesdinakaran/magento-log.git

To Install with composer

composer require moses/magento-log

Warning : This package is not installable via Composer 1.x, please make sure you upgrade to Composer 2+.

## Configuration
Stores -> Configuration -> Moses Extensions -> API Logging

Enable API Logging : To Enable all/selected api calls

Regular Expression Patterns: Define the regular expression pattern to log selected urls, For more than one urls use next line.

Ex

V1/carts/9 :  Matches all urls for quote ID 9 that contains V1/carts/9

V1/carts/(\d)* : Matches for all quotes

V1/checkoutcomupapi/getTokenList : Match a specific url

## Output

Once the API Logging is enabled, The request and response will be available in the below log file
MAGE_ROOT/var/log/moses-api-debug.log
