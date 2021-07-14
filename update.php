<?php
/**
 * The remote host file to process update requests
 *
 */
if ( !isset( $_POST['action'] ) ) {
	echo '0';
	exit;
}

//set up the properties common to both requests 
$obj = new stdClass();
$obj->slug = 'dealersleague-marine.php';  
$obj->name = 'Dealers League Marine';
$obj->plugin_name = 'dealersleague-marine.php';
$obj->new_version = '2.0.1';
// the url for the plugin homepage
$obj->url = plugin_dir_url( __FILE__ );
//the download location for the plugin zip file (can be any internet host)
$obj->package = plugin_dir_url( __FILE__ ) . 'dealersleague-marine.zip';

switch ( $_POST['action'] ) {

case 'version':  
	//echo serialize( $obj );
	echo json_encode( $obj );
	break;  
case 'info':   
	$obj->requires = '5.0';  
	$obj->tested = '5.0';  
	$obj->downloaded = 12540;  
	$obj->last_updated = '2012-10-17';  
	$obj->sections = array(  
		'description' => 'The new version of the Auto-Update plugin',  
		'another_section' => 'This is another section',  
		'changelog' => 'Some new features'  
	);
	$obj->download_link = $obj->package;  
	//echo serialize($obj);  
	echo json_encode( $obj );
case 'license':  
	//echo serialize( $obj );
	echo json_encode( $obj );
	break;  
}  

?>