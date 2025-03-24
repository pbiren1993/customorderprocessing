# Magento2 Module Vendor_CustomOrderProcessing

    ``vendor/module-customorderprocessing``

## Main Functionalities
- Order Status Update via API
- Log the change into a custom database table using observer and send email notification

## Installation
- Extract the xip inside 'projectroot/app/code' folder
- Run below magento commands
  * php bin/magento s:up
  * php bin/magento s:d:c
  * php bin/magento s:s:d -f
- Module will enable by default but if not then run below command and then all other magento commands
 * php bin/magento module:enable Vendor_CustomOrderProcessing


## Process to run
- Create 1 order in magento and then create shipment.
- Generate bearer token of your user or create Integration token and enbale 'Allow OAuth Access Tokens to be used as standalone Bearer tokens'.
- Use below url to run our api and and functionality 
  * https://<!-- Project Url -->/rest/V1/vendor-customorderprocessing/orderstatus
- Body json format as below
   {
    "incrementId": "000000006",
    "status": "shipped"
   }
- Demo link
 * https://www.awesomescreenshot.com/video/37956735?key=cbcc5e2e1c0ea9dccda2b519db7d8697

## Tested On
- Magento 2.4.7-p3
- Php 8.2.8