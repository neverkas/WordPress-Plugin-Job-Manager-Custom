<?php
global $wp;



function detect_os(){
	/*    ====    Detect the OS    ====    */
	$ua = $_SERVER["HTTP_USER_AGENT"];
	// ---- Mobile ----

    // Android
    $android        = strpos($ua, 'Android') ? true : false;

    // BlackBerry
    $blackberry        = strpos($ua, 'BlackBerry') ? true : false;

    // iPhone
    $iphone        = strpos($ua, 'iPhone') ? true : false;

    // Palm
    $palm        = strpos($ua, 'Palm') ? true : false;

// ---- Desktop ----

    // Linux
    $linux        = strpos($ua, 'Linux') ? true : false;

    // Macintosh
    $mac        = strpos($ua, 'Macintosh') ? true : false;

    // Windows
    $win        = strpos($ua, 'Windows') ? true : false;

/*    ============================    */


/*    ====    Detect the UA    ====    */

    // Chrome
    $chrome            = strpos($ua, 'Chrome') ? true : false;        // Google Chrome
    
    // Firefox
    $firefox        = strpos($ua, 'Firefox') ? true : false;    // All Firefox
    $firefox_2        = strpos($ua, 'Firefox/2.0') ? true : false;    // Firefox 2
    $firefox_3        = strpos($ua, 'Firefox/3.0') ? true : false;    // Firefox 3
    $firefox_3_6        = strpos($ua, 'Firefox/3.6') ? true : false;    // Firefox 3.6
    
    // Internet Exlporer
    $msie            = strpos($ua, 'MSIE') ? true : false;        // All Internet Explorer
    $msie_7            = strpos($ua, 'MSIE 7.0') ? true : false;    // Internet Explorer 7
    $msie_8            = strpos($ua, 'MSIE 8.0') ? true : false;    // Internet Explorer 8
    
    // Opera
    $opera            = preg_match("/\bOpera\b/i", $ua);                    // All Opera
    
    
    // Safari
    $safari            = strpos($ua, 'Safari') ? true : false;        // All Safari
    $safari_2        = strpos($ua, 'Safari/419') ? true : false;    // Safari 2
    $safari_3        = strpos($ua, 'Safari/525') ? true : false;    // Safari 3
    $safari_3_1        = strpos($ua, 'Safari/528') ? true : false;    // Safari 3.1
    $safari_4        = strpos($ua, 'Safari/531') ? true : false;    // Safari 4

	$device = null;
	$browser = null;
	if ($ua) {
    // ---- Test if using a Handheld Device ----
    if ($android) {                    // Android
        //echo 'You are using an Android!';
        $device = "Android";
        }
    if ($blackbery) {                    // Blackbery
        //echo 'You are using a Blackbery!';
        $device = "Blackbery";
        }
    if ($iphone) {                    // iPhone
        //echo 'You are using an iPhone!';
        $device = "iPhone";
        }
    if ($palm) {                    // Palm
        //echo 'You are using a Palm!';
        $device = "Palm";
        }

    if ($linux) {                    // Linux Desktop
        //echo 'You are using Linux';
        $device = "Linux";
        }

    // ---- Test if Firefox ----
    if ($firefox) {
        //echo 'You are using Firefox!';
        $browser = "Firefox";

        // Test Versions
        if ($firefox_2) {                // Firefox 2
            //echo 'Version 2';
        	$browser = "Firefox Version 2";
            }
        elseif ($firefox_3) {            // Firefox 3
            //echo 'Version 3';
        	$browser = "Firefox Version 3";
            }
        elseif ($firefox_3_6) {            // Firefox 3.6
            //echo 'Version 3.6';
        	$browser = "Firefox Version 3.6";
            }
        else {                            // A version not listed
            //echo 'What Version do you use?';
            }
    }

    // ---- Test if Safari or Chrome ----
    elseif ( ($safari || $chrome) && !$iphone) {

        if ($safari && !$chrome) {                    // Test if Safari and not Chrome
            //echo 'You are using Safari!';
        	$browser = "Safari ";

            // Test if Safari Mac or Safari Windows
            if ($mac && $safari) {            // Safari Mac
                //echo 'You are using Safari on a Mac';
        		$browser .= "on Mac";
                }
            if ($win && $safari) {            // Safari Windows
                //echo 'You are using Safari on Windows';
        		$browser .= "on Windows";
                }

            // Test Versions
            if ($safari_2) {            // Safari 2
                $browser.= ' Version 2';
                }
            elseif ($safari_3) {            // Safari 3
                $browser.= ' Version 3';
                }
            elseif ($safari_4) {            // Safari 4
                $browser.= ' Version 4';
                }
            else {
                //echo 'What version are you using?';
                }
        }

        elseif ($chrome) {                    // Test if Chrome
                $browser= ' Chrome';
            }
    }

    // ---- Test if iPhone with Safari 3.1 ----
    elseif ($iphone && $safari_3_1) {
        //echo 'You are using Safari 3.1';
                $browser= 'Safari 3.1';
        }

    // ---- Test if Internet Explorer ----
    elseif ($msie) {
        //echo 'You are using Internet Explorer!';
                $browser= 'Internet Explorer ';

        // Test Versions
        if ($msie_7) {                        // Internet Explorer 7
            //echo 'Version 7';
            $browser.= 'Version 7';
            }
        elseif ($msie_8) {                        // Internet Explorer 8
            //echo 'Version 8';
            $browser.= 'Version 8';
            }
        else {
            //echo 'What Version do you use?';
            }
    }

    // ---- Test if Opera ----
    elseif ($opera) {
        	//echo 'You are using Opera!';
            $browser= 'Opera';
        }

    // ---- If none of the above ----
    else {
        //echo 'What browser are you using?';
        }

        /*
        echo "Device: {$device}";
        echo "<br />";
        echo "Browser: {$browser}";
        */
        $data['device'] = $device;
        $data['browser'] = $browser;

        return $data;

	}
}

/*    ============================    */


class Logging {
    // declare log file and file pointer as private properties
    private $log_file, $fp;
    // set log file (path and name)
    public function lfile($path) {
        $this->log_file = $path;
    }
    // write message to the log file
    public function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        // define script name
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        // write current time, script name and message to the log file
        $data["DATE"] = @date('[d/M/Y:H:i:s]'); 		
        $data["URL"] = home_url( add_query_arg( NULL, NULL ) );
        $data["CONTENT"] =  $message;

        $data_json = json_encode($data);
        $data_json_post = json_encode($_POST);
		//$arr = json_decode($data_json, true); //i prefer associative array in this context

        fwrite($this->fp, $data_json.",". PHP_EOL);

		$to = 'emmanuel.lazarte.011@gmail.com';
		$subject = 'Globalwat - Resume Updated '.$data["DATE"];
		$body = "$data_json";
		$headers = array('Content-Type: text/html; charset=UTF-8');


        $data = $message; // rewrite $data
		$detect_os = detect_os();
	
		$html = "";
		$html.="<b>Post ID:</b> ". $message['post_id']; 
		$html.="<br />";	
		$html.="<b>Fecha:</b> ". @date('[d/M/Y:H:i:s]'); 
		$html.="<br />";	
		$html.="<b>URL:</b> ". home_url(). "/wp-admin/post.php?post=".$message['post_id']."&action=edit";
		$html.="<br />";	
		$html.="<b>Device:</b> ". $detect_os['device'];
		$html.="<br />";	
		$html.="<b>Browser:</b> ". $detect_os['browser'];

		$html.="<br /><br />";	
		$html.="<b>General Info:</b><br>".$_SERVER['HTTP_USER_AGENT']."<br >".php_uname()."<br/>";	
		$html.="<br />";	


		$html.="<b>PLUGIN POST:</b> <br> $data_json";	
		$html.="<br /><br />";	

		$html.="<b>WORDPRESS POST:</b> <br> $data_json_post";	
		$html.="<br /><br />";	
		$html.="<a href='http://jsoneditoronline.org/'>http://jsoneditoronline.org/</a> <br>";	
		$html.="<a href='http://json2table.com/'>http://json2table.com/</a> <br>";	
		$html.="<a href='http://json.bloople.net/'>http://json.bloople.net/</a> <br>";	



		//echo $html;

		wp_mail( $to, $subject, $html, $headers );



        //fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}

function job_manager_custom_save($post_id){

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset( $_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'metabox_jmc_nonce')) return;
	if(!current_user_can('edit_post')) return;


	$fields = "";
	$data1 = "";
	$blocks = "";
	$data_files = "";

	$fields = isset($_POST) ? $_POST : '';
	$data1 = array();
	$data1['files'] = "";
	$data_files = array();
	$supported_types = array('application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png');

	$data1["empleadores"] = isset($fields["empleadores"]) ? $fields["empleadores"] : '';
	
	if(current_user_can('administrator')){
		//$data1["empleadores"] = isset($fields["empleadores"]) ? $fields["empleadores"] : '';
	}


	foreach($fields as $index => $item){
		if(strstr($index, "jmc-")){
			$data1[$index] = $item;			
		}
	}
	
	$blocks = array("courses", "experiences");

	foreach($blocks as $itemName){
		if($itemName){
			$data1["jmc-{$itemName}"] = isset($fields[$itemName]) ? $fields[$itemName] : '';
		}
	}

/**
*	TEST FILE UPLOAD
**/
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );


foreach ($_FILES as $file_name => $data) {

	if(!empty($data['name'])){ //New upload

		$arr_file_type = wp_check_filetype(basename($data['name']));
        $uploaded_type = $arr_file_type['type'];
        
        //if(in_array($uploaded_type, $supported_types)) {
			$override['action'] = 'editpost';
			$uploaded_file 		= wp_handle_upload($data, $override);
			$attachment 		= array(
				 'post_title' => $data['name'],
				 'post_content' => '',
				 'post_type' => 'attachment',
				 'post_parent' => $post_id,
				 'post_mime_type' => $data['type'],
				 'guid' => $uploaded_file['url']
			);
			// Save the data
			$id = wp_insert_attachment( $attachment,$data[ 'file' ], $post_id );

			if($id){
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $data['file'] ) );
				$data_files[$file_name]=$uploaded_file['url'];
			}
       // }

	}
}

foreach($fields as $input_name => $image_src){
	if($input_name){	
		if(strstr($input_name, "file-")){
			if(!$data_files[$input_name]){			
				if(!empty($image_src) && !empty($input_name)){					
					$data_files[$input_name] = $image_src;
				}
			}
		}
	}
}

$data1['files'] = $data_files;	

//die();

if(current_user_can('administrator') || current_user_can('jmc_student')){
	update_post_meta($post_id, 'jmc', $data1);


	$data1['post_id'] = $post_id;
	// Logging class initialization

	$log = new Logging();
	 
	// set path and name of log file (optional)
	//$log->lfile('/tmp/mylog.txt');
	$log->lfile(plugin_dir_path( __DIR__  ).'/debug.log');
	 
	// write message to the log file
	$log->lwrite($data1);
	 
	// close log file
	$log->lclose();

}
//die();

}
?>