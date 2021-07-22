<?php
/**
 * The remote host file to process update requests
 *
 */

if ( !isset( $_POST['action'] ) ) {
	echo '0';
	exit;
}
$repo_name = 'DealersLeague/dealersleaguemarine-wordpress-plugin';
$url = 'https://api.github.com/repos/' . $repo_name . 'releases/latest';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.github.com/repos/' . $repo_name . 'releases/latest");
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)");
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
curl_close($ch);     
$release = json_decode($output, true);


if(!$release['message']){
	$obj = new stdClass();
	$obj->slug = 'dealersleague-marine.php';  
	$obj->name = 'Dealersleague Marine';
	$obj->plugin_name = 'dealersleague-marine.php';
	$obj->new_version = $release['tag_name'];
	$obj->last_updated = $release['published_at'];
	$obj->downloaded = $release['assets'][0]['size'];
	$obj->url = ABSPATH . 'wp-content/plugins/dealers-league-marine-new-wordpress/dealersleague-marine.php';

	$obj->package = 'https://github.com/' . $repo_name . 'releases/latest/download/dealersleaguemarine-wordpress-plugin.zip';

	switch ( $_POST['action'] ) {

	case 'version':  
		echo json_encode( $obj );
		break;  
	case 'info':   
		$obj->requires = '4.0';  
		$obj->tested = '4.0';  
		$obj->sections = array(  
			'description' => $release['body'],  
			'changelog' => $release['name']  
		);
		$obj->download_link = $obj->package;  
		echo json_encode( $obj );
	case 'license':  
		echo json_encode( $obj );
		break;  
	}  
}
?>