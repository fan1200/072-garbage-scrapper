# 072 Garbage Calender Scrapper

Made in a hurry and very fast to catch information about the upcoming garbage dates. Since they are not available through any public API I made it possible to scrap them from the webpage and present them as JSON output.
With this information I can feed my dashboard again. 

This script makes use of data belonging to stadswerk072.nl. No other information can be scrapped.  

## Installation requirements
-  PHP >= 7.1.3
- Composer

## Install steps
1. ``composer install``
2. copy .env.example to .env

## Usage
Since it is a simple script you can run it without any need of a webserver. It has two arguments namely the postcode and house number from which you would like to receive of. 

``php app/index.php [postcode] [houseNumber]``
  
### Output
It will out an JSON object with information for example:
