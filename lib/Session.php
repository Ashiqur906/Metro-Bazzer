<?php 
/**
* Session Class
*/
// class Session{
// 	public static function init(){
// 		session_start();
// 	}

// 	public static function set($key, $value){
//         $_SESSION[$key] = $value;
// 	}

// 	public static function get($key){
//         if (isset($_SESSION[$key])) {
//         	return $_SESSION[$key];
//         }else{
//         	return false;
//         }
// 	}

// 	public static function checkSession(){
// 		self::init();
// 		if (self::get("adminlogin")==false) {
// 			self::destroy();
// 			header("Location:login.php");
// 		}
// 	}

// 	public static function checklogin(){
// 		self::init();
// 		if (self::get("adminlogin")==true) {
// 			header("Location:dashbord.php");
// 		}
// 	}

// 	public static function destroy(){
//          session_destroy();
//          header("Location:login.php");
// 	}
// }

 ?>


 <?php
/**
*Session Class
**/
class Session{
	 public static function init(){
	  if (version_compare(phpversion(), '5.6.8', '<')) {
	        if (session_id() == '') {
	            session_start();
	        }
	    } else {
	        if (session_status() == PHP_SESSION_NONE) {
	            session_start();
	        }
	    }
	 }

	 public static function set($key, $value){
	  $_SESSION[$key] = $value;
	 }

	 public static function get($key){
	  if (isset($_SESSION[$key])) {
	   return $_SESSION[$key];
	  } else {
	   return false;
	  }
	 }

	 public static function checkSession(){
	  self::init();
	  if (self::get("adminlogin")== false) {
	   self::destroy();
	   header("Location:login.php");
	  }
	 }

	 public static function checklogin(){
	  self::init();
	  if (self::get("adminlogin")== true) {
	   header("Location:dashbord.php");
	  }
	 }

	 public static function destroy(){
	  session_destroy();
	  header("Location:login.php");
	 }
 }
?>