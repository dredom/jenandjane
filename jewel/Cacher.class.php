<?php
/*
 * Modeled after MemCache - common cache for all users.
 * But we are limited by host software install, so use _SESSION.
 * All classes referenced MUST be included before session_start.
 */
class Cacher {
	private static $started = false;
	
	public static function start() {
		if (!self::$started) {
			session_start();
			self::$started = true;
		}
	}
	
	public static function set($key, $value) {
		self::start();
		$_SESSION[$key] = $value;
	}
	
	public static function get($key) {
		self::start();
		if (isset($_SESSION[$key])) {
	    	return $_SESSION[$key];
		}
		return null;
	}
	
	public static function delete($key) {
		self::start();
		unset($_SESSION[$key]);
	}
}
?>