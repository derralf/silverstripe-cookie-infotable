<?php 

class CookieType extends DataObject implements PermissionProvider {

	static $singular_name = 'Cookie-Typ';
	static $plural_name = 'Cookie-Typen';
	
	private static $db = array(
		'Title' 		=>	'Varchar(255)',
		'Subtitle'		=>	'Varchar(255)',
		'Description'	=>	'Text',
		'SortOrder' 	=>	'Int'
	);

	private static $has_one = array(
	);

	private static $has_many = array(
		'CookieInfos'	=>	'CookieInfo'
	);

	private static $many_many = array(
	);

	private static $belongs_many_many = array(
	);

	private static $defaults = array(
	);

	public static $default_sort = 'SortOrder ASC';

	private static $field_labels = array (
		'Title'			=>	'Titel',
		'Subtitle'		=>	'Kurzinfo',
		'Description'	=>	'Beschreibung',
		'SortOrder'		=>	'Sortierung'
	);
	
	private static $summary_fields = array(
		'ID',
		'Title',
		'Subtitle',
		'Description',
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

		$ClassName = 'CookieType';

		if(class_exists($ClassName) && !DataObject::get_one($ClassName)) {
			$obj1 = new $ClassName();
			$obj1->Title = _t('CookieType.TypeDefaultTitle1', 'Type 1');
			$obj1->Subtitle = _t('CookieType.TypeDefaultSubtitle1', '');
			$obj1->Description = _t('CookieType.TypeDefaultDescription1', '');
			$obj1->write();

			$obj2 = new $ClassName();
			$obj2->Title = _t('CookieType.TypeDefaultTitle2', 'Type 2');
			$obj2->Subtitle = _t('CookieType.TypeDefaultSubtitle2', '');
			$obj2->Description = _t('CookieType.TypeDefaultDescription2', '');
			$obj2->write();

			$obj3 = new $ClassName();
			$obj3->Title = _t('CookieType.TypeDefaultTitle3', 'Type 3');
			$obj3->Subtitle = _t('CookieType.TypeDefaultSubtitle3', '');
			$obj3->Description = _t('CookieType.TypeDefaultDescription3', '');
			$obj3->write();

			$obj4 = new $ClassName();
			$obj4->Title = _t('CookieType.TypeDefaultTitle4', 'Type 4');
			$obj4->Subtitle = _t('CookieType.TypeDefaultSubtitle4', '');
			$obj4->Description = _t('CookieType.TypeDefaultDescription4', '');
			$obj4->write();
        }
    }


	/* PERMISSIONS */
	
	public function providePermissions() {
		$objectName = property_exists($this, 'singular_name') ? self::$singular_name : $this->ClassName;
		$categoryName = 'Eigene Berechtigungen: ' . $objectName . " bearbeiten";
		return array(
			'CookieType_VIEW' => array (
				'name'		=>	$objectName . ' betrachten (view)',
				'category'	=>	$categoryName
			),
			'CookieType_EDIT' => array (
				'name'		=>	$objectName . ' bearbeiten (edit)',
				'category'	=>	$categoryName
			),
			'CookieType_DELETE' => array (
				'name'		=>	$objectName . ' löschen (delete)',
				'category'	=>	$categoryName
			),
			'CookieType_CREATE' => array (
				'name'		=>	$objectName . ' erstellen (create)',
				'category'	=>	$categoryName
			),
			'CookieType_PUBLISH' => array (
				'name'		=>	$objectName . ' veröffentlichen (publish)',
				'category'	=>	$categoryName
			)
		);
	}

	public function canView($Member = null){
		return Permission::check('CookieType_VIEW');
	}
	public function canEdit($Member = null) {
		return Permission::check('CookieType_EDIT');
	}
	public function canDelete($Member = null) {
		return Permission::check('CookieType_DELETE');
	}
	public function canCreate($Member = null){
		return Permission::check('CookieType_CREATE');
	}
	public function canPublish($Member = null){
		return Permission::check('CookieType_PUBLISH');
	}


}
