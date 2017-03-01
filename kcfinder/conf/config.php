<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */

/* IMPORTANT!!! Do not comment or remove uncommented settings in this file
   even if you are using session configuration.
   See http://kcfinder.sunhater.com/install for setting descriptions */

if($_SERVER['SERVER_NAME'] == 'localhost'){
    $arr = explode("/",$_SERVER['PHP_SELF']);
    $path = '/'.$arr[1];
}else{
    $path = '';
}

$customer_id = $_SESSION['customer_id'];

return array(


// GENERAL SETTINGS

    'disabled' => false ,
    // 'uploadURL' => "/bibishop/application/data/uploads",
    // 'uploadURL' => "/application/data/uploads",
    'uploadURL' => $path."/system/upload/support/".$customer_id,
    'uploadDir' => "",
    'theme' => "default",

    'types' => array(

    // (F)CKEditor types
        'uploads'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",

    // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),


// IMAGE SETTINGS

    'imageDriversPriority' => "imagick gmagick gd",
    'jpegQuality' => 90,
    'thumbsDir' => ".thumbs",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'watermark' => "",


// DISABLE / ENABLE SETTINGS

    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,


// PERMISSION SETTINGS

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => false,
            'copy'   => false,
            'move'   => false,
            'rename' => false
        ),

        'dirs' => array(
            'create' => false,
            'delete' => false,
            'rename' => false
        )
    ),

    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",


// MISC SETTINGS

    'filenameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',


// THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION SETTINGS

    '_sessionVar' => "KCFINDER",
    '_check4htaccess' => true,
    '_normalizeFilenames' => false,
    '_dropUploadMaxFilesize' => 10485760,
    // '_tinyMCEPath' => "/phuongthanh_CI/application/data/admin/js/tiny_mce",
    '_tinyMCEPath' => $path."/tiny_mce",
    //'_cssMinCmd' => "java -jar /path/to/yuicompressor.jar --type css {file}",
    //'_jsMinCmd' => "java -jar /path/to/yuicompressor.jar --type js {file}",
);
