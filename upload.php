<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 

require 'credentials.php';
require 'phpFlickr.php';


	$tempFile = $_FILES['media']['tmp_name'];
	$imginfo_array = getimagesize($tempFile);

	if ($imginfo_array !== false) {
        $mime_type = $imginfo_array['mime'];
        $mime_array = array("video/quicktime", "image/png", "image/jpeg", "image/gif", "image/bmp");
        if (in_array($mime_type , $mime_array)) { 
			$f = new phpFlickr($api_key, $api_secret, true);
			$f->setToken($auth_token);

			$img_title="Photo from Twitter";
			$img_desc="";
			$img_tags="twitter";

			if (isset($_REQUEST['message']))
			{
				$img_desc = $_REQUEST['message'];
				preg_match_all('/(#[A-Za-z0-9-]+)/', $_REQUEST['message'], $matches);
			}
			if (isset($_REQUEST['source']))
			{
				$img_title = $_REQUEST['source'];
			}
			if (count($matches) > 0)
			{
				$img_tags = "twitter " . str_replace('#', '', implode(' ', $matches[0]));
			}
			
			$num = $f->sync_upload($tempFile, $img_title, $img_desc, $img_tags, 1, 1, 1 );

			$alphabet="123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
			$base_count = strlen($alphabet);
			$encoded = '';
			while ($num >= $base_count)
			{
				$div = $num/$base_count;
				$mod = ($num-($base_count*intval($div)));
				$encoded = $alphabet[$mod] . $encoded;
				$num = intval($div);
			}
			if ($num) $encoded = $alphabet[$num] . $encoded;
			echo "<mediaurl>http://flic.kr/p/" . $encoded . "</mediaurl>";
		}
	}

?>