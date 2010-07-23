<?php 
class azDirectoryPage extends Page {
	static $has_many = array (
		'azDirectoyPage_Listings' => 'azDirectoyPage_Listing'
	);
	
	public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->findOrMakeTab('Root.Content')->insertBefore(new Tab('A-Z Directory'),"Main");
		$f->addFieldToTab("Root.Content.A-Z Directory", new DataObjectManager(
			$this,
			'azDirectoyPage_Listings',
			'azDirectoyPage_Listing',
			array('Name' => 'Name'),
			'getCMSFields_forPopup'
		));
		return $f;
	}
}
class azDirectoryPage_Controller extends Page_Controller {
	public $az=array('A','B','C');
	public $p;
	//public static $allowed_actions = array('results');

	public function init() {
	}
		
	/**
	public function SearchForm(){
		$searchText = Convert::raw2sql(isset($_REQUEST['Search']) ? $_REQUEST['Search'] : '');
		Validator::set_javascript_validation_handler('none');
		
		$fields = new FieldSet(
			new TextField("Search", "Search Expertise", $searchText),
			new LiteralField("AdvancedSearch_open","<h4 id='advancedsearch_expert_header'>Advanced Search</h4><div id='advancedsearch_expert_block' style='margin:0'>"),
				new DropdownField('Source','Source of expertise',Dataobject::get("ExpertSource")->toDropdownMap("ID","Name","(select one)",true),isset($_REQUEST['Source']) ? $_REQUEST['Source'] : ''),
			new LiteralField("AdvancedSearch_close","</div>")
			
	  	);
		$actions = new FieldSet(
	      	new FormAction('results', 'Search')
	  	);
	  	
	  	return new SearchForm($this, "", $fields, $actions);
	}
	
	public function results(){
		$this->p=Convert::raw2sql($_REQUEST);
		$where=array(
			"Name LIKE '%' OR Department LIKE '%' OR Keywords LIKE '%'"
		);
		isset($this->p['Search']) ? $where = preg_replace('/%/',"%".$this->p['Search']."%",$where) : $this->p['q']=null;
		if(isset($this->p['Source']) && $this->p['Source']){
		Requirements::customScript('jQuery(function($) {
			$(document).ready(function() {
					$("#advancedsearch_expert_block").show("normal");
			})
		})');
		$where[]='SourceID='.$this->p['Source'];
		}
	
		$data=DataObject::get("Expert",$where,"FirstLetter");
			  	
		  if(Director::is_ajax()) {
		  //TODO JSON request
		   return false;
		  }else {
		   return $data;
		  }
	}
	**/
	
	public function AZLetters(){
	
	//return new ArrayData($this->az);
	
	
		$doSet=new DataObjectSet();
		for ($i = 'a', $j = 1; $j <= 26;  $i++, $j++) {
		    $letters[$j] = $i;
		}
		
		return new ArrayData($letters); 
		
		$doSet->push(new ArrayData($letters));
		
		$member=Member::currentUser();
		if(isset($member) && $member->ID=='1'){
			
		}
		
		return new ArrayData($letters);
	}
	
	public function getIndividual(){
		if($URLAction = Director::URLParam('Action')){
			$ID = Convert::raw2xml($URLAction);
			return DataObject::get_by_id('azDirectoyPage_Listing', (int)$ID);
		}
	}
	public function getAll(){
		return DataObject::get('azDirectoyPage_Listing');
	}	
}


class azDirectoyPage_Listing extends DataObject {
	static $db = array(
		'Name' => 'Text',
		'Email'  => 'Text',
		'Department' => 'Text',
		'FirstLetter' => 'VarChar(1)',
	
		'Building' => 'Varchar',
		'Street' => 'Varchar',
		'Area' => 'Varchar',
		'City' => 'Varchar',
		'PostCode' => 'Varchar',

		'Phone1' => 'Text',
		'Phone2' => 'Text',
		'Phone3' => 'Text',
	
		'WebsiteURL' => 'Text',
		'WebsiteURL2' => 'Text',
		'WebsiteRSS' => 'Text',
		'Twitter' => 'Text',
		'YouTube' => 'Text',
	
		'Content' => 'HTMLText',
		'Keywords' => 'Text',
		'Summary' => 'Text'
	);
	
	static $has_one = array('azDirectoryPage' => 'azDirectoryPage');
	
	public function getCMSFields_forPopup(){
		return new FieldSet(
			new CompositeField(
				new TextField('Name'),
				new EmailField('Email'),
				new TextField('Department')
			),
			new CompositeField(
				new TextField('Building'),
				new TextField('Steet'),
				new TextField('Area'),
				new TextField('City'),
				new TextField('PostCode')
			),
			new CompositeField(
				new TextField('Phone1'),
				new TextField('Phone2'),
				new TextField('Phone3')
			),
			new CompositeField(
				new TextField('WebsiteURL'),
				new TextField('WebsiteURL2'),
				new TextField('WebsiteRSS'),
				new TextField('Twitter'),
				new TextField('YouTube')
			),
			new CompositeField(
				new SimpleTinyMCEField('Content', _t('CONTENT', 'Content')),
				new TextareaField('Keywords','All Keywords',1,3),
				new TextareaField('Summary','All Keywords',1,3)
			)
		);
	}
	
	public function validate(){
		$this->FirstLetter=isset($this->Department[0]) ? $this->Department[0] : $this->Name[0];
		return parent::validate();
	}
}