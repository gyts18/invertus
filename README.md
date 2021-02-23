# Invertus task

## My own thoughts
 
 This is actually the first time i've written in pure php, so that experience was quite interesting
 
 To save time (I've written comments, on how some functionality should play out in real life scenarios) and just did a mock up.

 # How to run it
 
 - Clone project
 - run sudo ./start-dev.sh, make sure you have docker-compose and docker installed. Keep in mind I'm using my boilerplate Dockerfile, so it's larger than usual.
 - Once done launch command composer install
 - To start the task launch command php index.php

To change default currency and add others, make according changes in CurrencyProvider.php file.

To change values public/files.txt is available for changes, please make sure that the first line is an empty string, unless you want your cart to have one item short from the top (library parsing bug, I think atleast), I could've written my own parser, but just picking a simple library was more logical for this task.
 
 ## What's used
 - Redis for saving final cart and getting it.
 - PHP 7.4
 - Docker

###
