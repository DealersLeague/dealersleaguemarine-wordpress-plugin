# Dealers League Marine 
Contributors: josephbydesign, dealersleague

Tags: marine, dealer, yacht, brokerage, boat

Requires at least: 5.2

Tested up to: 5.6

Requires PHP: 7.0

Stable tag: 2.0.0

License: GPLv3

License URI: https://www.gnu.org/licenses/gpl-3.0.html
 

## Description 

Our boat brokerage platform is designed make publishing and managing your stock easy and fast. It is full of features that help you run your business successfully online.

- Add your boat info, pictures, videos and 360° images
- Integrate with over30 platforms including Yachtall and eBay
- Edit your listings once and it updates on all platforms
- Comes with a fast, secure and mobile responsive website 


## Deploy New Plugin Version to Github

Below are the steps required to push a new update to users with the Wordpress plugin installed.
1. change the version number at the top and bottom of this file: `dealersleague-marine.php`
2. run `gulp dist` which will create a new build in the `/dist/` directory 
3. push these updated files to https://github.com/DealersLeague/dealersleaguemarine-wordpress-plugin 
5. navigate to https://github.com/DealersLeague/dealersleaguemarine-wordpress-plugin/releases/latest page and create new release. In the new release important to create tag with the same version you want to publish
6. add the description, name and any other information about new updates
7. submit release
8. after the release is submitted, within a few hours, Wordpress will detect that the plugin has a new update and will show the standard Wordpress update message and if the user has auto update turned on the plugin will be downloaded from the Github repo and updated

## Change-log 

### 1.0.2
- New front end 

### 1.0.1
- Connection to Dealers League Marine API 

### 1.0.0
- Initial Release