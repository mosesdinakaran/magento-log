# Magento Logging

A very lightweight logging module that supports
- Rest Api Logging
- Elastic Search Logging
- GraphQl Logging



> ### Please note that, This extension is for debugging purpose only, Once enabled this extension will write all/partial request and response to the log file based on your configuration, So plz be advised that keeping this extension on enabled mode for a long time will fill up your disk space. Once the debugging is completed this needs to be disabled

## To Install

### For Magento Version >= 2.4.4

```
composer require moses/magento-log
php bin/magento setup:upgrade
```

#### Supported Logging
- Rest API Logging
- GraphQl Logging
- ElasticSearch Logging

### For Magento Version < 2.4.4

```
composer require moses/magento-log 1.1.0
php bin/magento setup:upgrade
```

#### Supported Logging
- Rest API Logging
- ElasticSearch Logging

For Magento version less than 2.4.4 if you need support for GraphQl logging plz try the below (Note its not tested from my end you can give a try)
- Add this commit in to your code base https://github.com/magento/magento2/commit/50c88eb432b4a0880484a4db46165ad431d12a14
- Post that download the version 2.1.0 directly from git and then put it under the app/code 

Warning : This package is not install able via Composer 1.x, please make sure you upgrade to Composer 2+.

Alternatively you can download from github as well https://github.com/mosesdinakaran/magento-log.git


## API Logging

This API logging extension from Moses Extensions, provides an option to log all/specific api calls.

In most of our environment we use different third party services such as order management, product management, product search , shipping management etc. These services interact with Magento using Rest APi'S. 

At times, it would become very difficult to identify the root cause if we face any problem with these services.

Moreover, if we are in headless environment primarily using rest apis it would be really hard to identify the root cause for certain issues. 

Consider a scenario where add to cart is not working for a particular customer only. 

To effectively debug this issue, we would require the post data, headers etc that is posted by that particular user.

This extension would help you in this scenario. It has the feature that we can log the api request that is made by a specific user.

Let see the complete features of this extension.

### Features
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

This can be safely deployed in Production environment as its very lightweight.

### Configuration
Stores -> Configuration -> Moses Extensions -> API Logging

Enable API Logging : To Enable all/selected api calls

Regular Expression Patterns: Define the regular expression pattern to log selected urls, For more than one urls use next line.

Ex

V1/carts/9 : Matches all urls for quote ID 9 that contains V1/carts/9

V1/carts/(\d)* : Matches for all quotes

V1/checkoutcomupapi/getTokenList : Match a specific url

### Output

Once the API Logging is enabled, The request and response will be available in the below log file
MAGE_ROOT/var/log/moses-logging.log

## Elastic Search Logging

At times there might me a case where you need to find out exactly what data is being pushed to elastic search and what is the response that we receive.
This extension will help you to do that.
It will log all the request and response of Elasticsearch from Magento.

### Configuration
Stores -> Configuration -> Moses Extensions -> Elastic Search Logging

### Output

Once the API Logging is enabled, The request and response will be available in the below log file
MAGE_ROOT/var/log/moses-logging.log

### How it works
The implementation is not very complicated its quiet simple though.

Magento uses the third party api client "elasticsearch/elasticsearch" to interact with Elasticsearch. This Extension by default has the feature of logging the request and responses.

\Elasticsearch\Connections\Connection::logRequestSuccess

But while creating the instance of this elasticsearch model, Magento always set the logger to be NULL due to which the request never get logged.
This extension through a plugin sets this logger to a custom logger, Due to which the requests and the response are logged.

## GraphQl Logging
GraphQl logging is supported only for magento version greater than or equal to 2.4.4

### Configuration
Stores -> Configuration -> Moses Extensions -> Graphql Logging

### Output
Once the API Logging is enabled, The graphql request and response will be available in the below log file
MAGE_ROOT/var/log/moses-logging.log

