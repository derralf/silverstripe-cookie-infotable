<?php

//define global path to Components' root folder
if(!defined('COOKIE_INFO_DIR')) define('COOKIE_INFO_DIR', rtrim(basename(dirname(__FILE__))));
if(!defined('COOKIE_INFO_DIR_ABS')) define('COOKIE_INFO_DIR_ABS', realpath(dirname(__FILE__)));


// Shortcodeparser for Cookie Info Table
// in Editor use [CookieInfoTable]
ShortcodeParser::get('default')->register('CookieInfoTable', function($arguments) {
	$data = new ArrayData(array(
		'CookieTypes' => CookieType::get(),
		'Cookies' => CookieInfo::get()
	));
	// $data->Cookies = CookieInfo::get();
	// $data->CookieTypes =	CookieType::get();
	// if ($data['Cookies']->exists()) {
	// 	return $data->renderWith('CookieInfoTable');
	// }
	return $data->renderWith('CookieInfoTable');
});