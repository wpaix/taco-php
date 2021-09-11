<?php defined('TACO') or die('Not allowed');

//------------------------------------------------------------------------------

function page_meta_text(){
    $p = get_page();
    $text = 'Hej, Vi hedder Milk Studio. Vi er et kreativt digitalt bureau. Vi bygger bro mellem avanceret webteknologi og skarp designæstetik.';
    //$text = 'Vi hjælper modige kunder med at designe, udvikle og eksekvere digitale løsninger med bruger oplevelsen i fokus.';
    if( isset($page->meta_text) ) $text = $page->meta_text;
    return $text;
}

function page_title(){
    $page = get_page();

    $basetitle = 'Milk Studio';
    $sep = ' - ';

    if( empty($page) ) return $basetitle.$sep.'Kreative digitale kræfter';

    if( $page->slug == 'index' ) return $basetitle.$sep.'Kreative digitale kræfter';

    if( !empty($page->page_title) ) return $basetitle.$sep.$page->page_title;
    if( empty($page->page_title) ) return $basetitle.$sep.unslugify($page->slug);
}

function page_meta_og_img(){
    $p = get_page();

    if( isset($p->blocks) ) {
        foreach( $p->blocks as $b ) {
            if( !empty($b->bgimg) && !empty($b->bgimg->l) ) return base_url_media().$b->bgimg->l;
            if( !empty($b->img) && !empty($b->img->l) ) return base_url_media().$b->img->l;
        }
    }

    return base_url().'assets/img/milk_og_share.jpg';

}

function page_meta_og_description(){
    $p = get_page();
    
    if( isset($p->blocks) ) {
        foreach( $p->blocks as $b ) {
            if( !empty($b->type == 'case-brief') && !empty($b->text2) ) return strip_tags($b->text2);
        }
    }

    return page_meta_text();
}

function page_meta_og_url(){
    $p = get_page();
    if( empty($p) ) return base_url();
    return base_url().$p->slug;
}

function main_contactphoneno_human(){
    return '+45 3110 6718'; // paix private
    return '+45 5044 9020'; // milk phone
}

function main_contactphoneno_linkable(){
    $n = main_contactphoneno_human();
    $n = str_replace( '+45','0045', $n);
    $n = str_replace( ' ','', $n);
    return $n;
}


//------------------------------------------------------------------------------

function body_cls(){
    if( empty($GLOBALS['body_cls']) ) $GLOBALS['body_cls'] = [];
    if( is_development() ) $GLOBALS['body_cls'][] = 'is-development';
    return $GLOBALS['body_cls'];
}

function body_cls_str(){
    $body_cls = body_cls();
    if( empty($body_cls) ) return '';
    return implode(' ', $body_cls);
}

function add_body_cls($input){
    if( empty($GLOBALS['body_cls']) ) $GLOBALS['body_cls'] = [];
    if( is_array($input)  ) foreach( $input as $str ) $GLOBALS['body_cls'][] = $str;
    if( is_string($input) ) $GLOBALS['body_cls'][] = $input;
}

function has_body_cls($cls){
    if( empty($GLOBALS['body_cls']) ) return FALSE;
    return in_array($cls, $GLOBALS['body_cls']);
}

//------------------------------------------------------------------------------

function svg( $file, $fill = NULL ){
    if( !is_file($file) ) return;
    ob_start();
    include $file;
    $svg = ob_get_clean();
    // str_replace fill
    if( isset($fill) ) $svg = str_replace( 'fill="inherit"', 'fill="'.$fill.'"', $svg );
    return $svg;
}

function getContrastColor($hexColor) {

    if( strlen($hexColor) == 4 ) $hexColor = $hexColor.substr($hexColor,1,3);

    // hexColor RGB
    $R1 = hexdec(substr($hexColor, 1, 2));
    $G1 = hexdec(substr($hexColor, 3, 2));
    $B1 = hexdec(substr($hexColor, 5, 2));

    // Black RGB
    $blackColor = "#000000";
    $R2BlackColor = hexdec(substr($blackColor, 1, 2));
    $G2BlackColor = hexdec(substr($blackColor, 3, 2));
    $B2BlackColor = hexdec(substr($blackColor, 5, 2));

     // Calc contrast ratio
     $L1 = 0.2126 * pow($R1 / 255, 2.2) +
           0.7152 * pow($G1 / 255, 2.2) +
           0.0722 * pow($B1 / 255, 2.2);

    $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
          0.7152 * pow($G2BlackColor / 255, 2.2) +
          0.0722 * pow($B2BlackColor / 255, 2.2);

    $contrastRatio = 0;
    if ($L1 > $L2) {
        $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
    } else {
        $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
    }

    // If contrast is more than 5, return black color
    if ($contrastRatio > 5) {
        return '#000000';
    } else { 
        // if not, return white color.
        return '#FFFFFF';
    }
}

//------------------------------------------------------------------------------

// converts a hex color code to rgb array
function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
    $r = hexdec(substr($hex,0,1).substr($hex,0,1));
    $g = hexdec(substr($hex,1,1).substr($hex,1,1));
    $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

//------------------------------------------------------------------------------

function hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
    return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
    $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
    return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    if( $opacity === false ) $opacity = .5;
    $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    return $output;
}

//------------------------------------------------------------------------------

function media( $input, $size = NULL ){
		
    // get file and check for size param
    if( is_string($input) ) $file = $input;
    if( is_object($input) && isset($input->{$size}) ){
        $file = $input->{$size};
    }
    if( empty($file) ) return '';				

    // get ext
    $ext = pathinfo($file, PATHINFO_EXTENSION);

    // define prefix
    //$pre = base_url_media().'media.php?f=';
    //$pre = '';
    
    return base_url_media().$file;
    
    //if( $ext == 'mp4' ) $pre = base_url_media().'site_cms/wp-content/uploads/';
    //if( $ext == 'mp4' ) $pre = base_url_media().'media/';

    //return $pre.$file;
    
}

//------------------------------------------------------------------------------

function media_video_url( $video ){
    return base_url_media() . basename($video->url);
}

function randomString($length = 6) {
	$chars = "abcdefghijklmnopqrstuwxyz0123456789";
	$chars = str_shuffle($chars);
	return substr($chars,0,$length);
}

function seo_redirect( $url = NULL ){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("Location: ".$url); 
    exit();
}

function rand_from_array($a) { return $a[array_rand($a)]; }

//------------------------------------------------------------------------------

function delete_dir_with_files_in($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            delete_dir_with_files_in($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

function ext_is_img( $ext ){
	$ext = strtolower($ext);
	if( $ext == 'png' ) return true;
	if( $ext == 'gif' ) return true;
	if( $ext == 'jpg' ) return true;
	if( $ext == 'jpeg' ) return true;
	return false;
}


// Adds option to bypass date by GET
function today_date() {

	
	$today_date = strtotime( date("Y-m-d H:i:s") );

	if( isset( $_GET['d'] ) && $_GET['d'] != "late" )  {
		$today_date = strtotime($_GET['d']);
	}

	if( isset( $_GET['d'] ) && $_GET['d'] == "late" ) {
		$today_date = strtotime("2020-12-24 00:00:00");
	}
	
	return $today_date;
}

//------------------------------------------------------------------------------

	// deletes a folder WITH files in, or a single file or folder

	function delete_files($target) {
	    if(is_dir($target)){
	        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

	        foreach( $files as $file )
	        {
	            delete_files( $file );
	        }

	        rmdir( $target );
	    } elseif(is_file($target)) {
	        unlink( $target );
	    }
	}

//------------------------------------------------------------------------------

	function formatBytes($bytes) {

		return $bytes = number_format($bytes / 1048576, 1) . ' MB';

		if ($bytes >= (1048576)*200 ) {
			$bytes = number_format($bytes / 1073741824, 0) . ' GB';
		}
		elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 0) . ' MB';
		}
		elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 0) . ' KB';
		}
		elseif ($bytes > 1) {
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1) {
			$bytes = $bytes . ' byte';
		}
		else {
			$bytes = '0 bytes';
		}
		return $bytes;
	}

//------------------------------------------------------------------------------

	function get_ext_from_path( $path ){
		$path_parts = pathinfo($path);
		$ext = $path_parts['extension'];
		return $ext;
	}
