tweetbot2flickr
===============

PHP Script to upload photos to Flickr from Tweetbot.
Based on phpFlickr, http://www.phpflickr.com

Usage:
-------------
1.) Upload all files to your server.
2.) Open http://www.flickr.com/services/apps/create/apply/ to obtain your API key and API secret.
3.) Edit the Flickr authentication flow, set the callback URL to the file auth.php on your server.
4.) Enter your API Key and API secret in credentials.php on server.
5.) Open getToken.php in your browser. You should be redirected to Flickr. Allow write permissions for your new app.
6.) Enter the Auth Token in credentials.php on your server.
7.) Point Tweetbot's custom API endpoint to the file upload.php on your server.
