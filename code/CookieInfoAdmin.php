<?php 

// 
class CookieInfoAdmin extends ModelAdmin {

	public static $managed_models = array( 
		'CookieInfo',
		'CookieType'
	);
 
	static $url_segment = 'CookieInfo'; // will be linked as /admin/products
	static $menu_title = 'Cookie Info';
	
	public static $page_length = 50;
  

	/**
	 * getEditForm.
	 * Orderable Rows ermöglichen
	 */
	public function getEditForm($id = null, $fields = null) {
		$form=parent::getEditForm($id, $fields);


		//This check is simply to ensure you are on the managed model you want adjust accordingly
		if(($this->modelClass=='CookieInfo' || $this->modelClass=='CookieType') && $gridField=$form->Fields()->dataFieldByName($this->sanitiseClassName($this->modelClass))) {
			//This is just a precaution to ensure we got a GridField from dataFieldByName() which you should have
			if(class_exists('GridFieldSortableRows') && $gridField instanceof GridField) {
				$gridField->getConfig()->addComponent(new GridFieldOrderableRows('SortOrder'));

			}
		}

		return $form;
	}
  
 
}


?>