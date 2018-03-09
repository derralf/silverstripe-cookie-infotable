<?php

class CookieInfo extends DataObject implements PermissionProvider {

	static $singular_name = 'Cookie-Info';
	static $plural_name = 'Cookie-Infos';

	private static $db = array(
		'Hidden'			=>	'Boolean',
		'Title' 			=>	'Varchar(255)',
		'Source'			=>	'Varchar(255)',
		'ExpirationTime'	=>	'Varchar(255)',
		'Description'		=>	'Text',
		'SortOrder' 		=>	'Int'
	);

	private static $has_one = array(
		'CookieType'		=>	'CookieType'
	);

	private static $has_many = array(
	);

	private static $many_many = array(
	);

	private static $belongs_many_many = array(
	);

	private static $defaults = array(
	);

	public static $default_sort = 'SortOrder ASC';

	private static $field_labels = array (
		'Hidden'			=>	'verbergen',
		'Title'				=>	'Titel',
		'ExpirationTime'	=>	'Ablaufzeit',
		'Description'		=>	'Beschreibung',
		'CookieType'		=>	'Typ',
		'CookieType.Title'	=>	'Typ',
		'SortOrder'			=>	'Sortierung'
	);

	private static $summary_fields = array(
		// 'ID',
		'Hidden',
		'Title',
		'Description',
		'ExpirationTime',
		'CookieType.Title',
		'SortOrder'
	);

	private static $searchable_fields = array(
		'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('SortOrder');

		return $fields;
	}


	public function requireDefaultRecords() {
		parent::requireDefaultRecords();

		$ClassName = 'CookieInfo';

		// nur zum Testen: alle löschen
		DataObject::get($ClassName)->removeAll();

		if(class_exists($ClassName) && !DataObject::get_one($ClassName)) {

			$defaultCookies = array(
					// zwingend notwendig
					'PHPSESSID',
					// funktional
					'viewmode',
					'cookieconsentstatus',
					// Google Analytics Universal: "analytics.js"
					'ga',
					'gat',
					// Google Analytics Traditionell: "ga.js"
					'utma',
					'utmt',
					'utmb',
					'utmc',
					// Google Analytics Traditionell with _setCustomVar method
					'utmz',
					// Social: Facebook
					'facebooklike',
					// 'datr',
					// 'regextref',
					// 'regfbgate',
					// 'regfbref',
					// Social: Google+
					'googleplus',
					// Social: Twitter
					'twitter'



			);

			foreach ($defaultCookies as $cookie) {
				$obj = new $ClassName();
				$obj->Hidden = _t('CookieDefaultEntry.'.$cookie.'.Hidden');
				$obj->Title = _t('CookieDefaultEntry.'.$cookie.'.Title');
				$obj->Source = _t('CookieDefaultEntry.'.$cookie.'.Source', '');
				$obj->ExpirationTime = _t('CookieDefaultEntry.'.$cookie.'.ExpirationTime', '');
				$obj->Description = _t('CookieDefaultEntry.'.$cookie.'.Description', '');
				$obj->CookieTypeID = _t('CookieDefaultEntry.'.$cookie.'.Type', '');
				$obj->write();
			}

			// $obj = new $ClassName();
			// $obj->Hidden = _t('CookieDefaultEntry.PHPSESSID.Hidden');
			// $obj->Title = _t('CookieDefaultEntry.PHPSESSID.Title', 'PHPSESSID');
			// $obj->Source = _t('CookieDefaultEntry.PHPSESSID.Source', '');
			// $obj->ExpirationTime = _t('CookieDefaultEntry.PHPSESSID.ExpirationTime', '');
			// $obj->Description = _t('CookieDefaultEntry.PHPSESSID.Description', '');
			// $obj->CookieTypeID = _t('CookieDefaultEntry.PHPSESSID.Type', '');
			// $obj->write();

        }
    }



	/* PERMISSIONS */

	public function providePermissions() {
		$objectName = property_exists($this, 'singular_name') ? self::$singular_name : $this->ClassName;
		$categoryName = 'Eigene Berechtigungen: ' . $objectName . " bearbeiten";
		return array(
			'CookieInfo_VIEW' => array (
				'name'		=>	$objectName . ' betrachten (view)',
				'category'	=>	$categoryName
			),
			'CookieInfo_EDIT' => array (
				'name'		=>	$objectName . ' bearbeiten (edit)',
				'category'	=>	$categoryName
			),
			'CookieInfo_DELETE' => array (
				'name'		=>	$objectName . ' löschen (delete)',
				'category'	=>	$categoryName
			),
			'CookieInfo_CREATE' => array (
				'name'		=>	$objectName . ' erstellen (create)',
				'category'	=>	$categoryName
			),
			'CookieInfo_PUBLISH' => array (
				'name'		=>	$objectName . ' veröffentlichen (publish)',
				'category'	=>	$categoryName
			)
		);
	}

	public function canView($Member = null){
		return Permission::check('CookieInfo_VIEW');
	}
	public function canEdit($Member = null) {
		return Permission::check('CookieInfo_EDIT');
	}
	public function canDelete($Member = null) {
		return Permission::check('CookieInfo_DELETE');
	}
	public function canCreate($Member = null){
		return Permission::check('CookieInfo_CREATE');
	}
	public function canPublish($Member = null){
		return Permission::check('CookieInfo_PUBLISH');
	}


}
