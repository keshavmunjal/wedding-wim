<?php
App::uses('AppModel', 'Model');
App::uses('DboSource', 'Model/Datasource');
/**
 * Event Model
 *
 * @property Event $Event
 * @property User $User
 * @property Event $Event
 */
class Event extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	//public $usesTable = 'Events';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'event_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'event_title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'event_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'event_image' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'venue' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rsvp' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function update_eve($data, $files){
	pr($files);
		$db = $this->getDataSource();
		for($i=0; $i<$data['no_of_events']; $i++){
			echo $f = array_search($data['event_id'][$i], $files['event_id']);
			if(isset($data['event_id'][$i])){
				//var_dump(in_array($data['event_id'][$i], $files['event_id']));
				$temp = array();
				//$event = $this->Events->create();
				//$event['Events']['user_id'] = $data['user_id'];
				$temp['event_title'] = $db->value($data['event_name'][$i], 'string');
				$temp['event_date'] = $data['date'][$i];
				$temp['event_date_text'] = $db->value($data['datepicker'][$i], 'string');
				//var_dump($f);
				$temp['event_image']='';
				if(gettype($f)=='integer'){
					
					$temp['event_image'] = $db->value($files['name'][$f], 'string');
				}
				echo $temp['event_image'];
				$temp['venue'] = $db->value($data['address'][$i], 'string');
				$temp['rsvp'] = $db->value($data['rsvp'][$i], 'string');
				$temp['last_modified'] = $db->value(date('Y-m-d H:i:s'), 'string');
				$data['event_id'][$i];
				if($temp['event_image']!=''){
					$sql = "UPDATE `shaadise_staging`.`events` AS `Event` SET `Event`.`event_title` = ".$temp['event_title'].", `Event`.`event_date` = ".$temp['event_date'].", `Event`.`event_date_text` = ".$temp['event_date_text'].", `Event`.`event_image` = ".$temp['event_image'].", `Event`.`venue` = ".$temp['venue'].", `Event`.`rsvp` = ".$temp['rsvp'].", `Event`.`last_modified` = ".$temp['last_modified']." WHERE `id` = ".$data['event_id'][$i]."";
				}else{
					$sql = "UPDATE `shaadise_staging`.`events` AS `Event` SET `Event`.`event_title` = ".$temp['event_title'].", `Event`.`event_date` = ".$temp['event_date'].", `Event`.`event_date_text` = ".$temp['event_date_text'].", `Event`.`venue` = ".$temp['venue'].", `Event`.`rsvp` = ".$temp['rsvp'].", `Event`.`last_modified` = ".$temp['last_modified']." WHERE `id` = ".$data['event_id'][$i]."";
				}
				$update = $this->Event->query($sql);
				//return $update;
			}else{
			//echo "vfyva";
				$temp = array();
				//$temp = $this->create();
				$temp['user_id'] = $data['user_id'];
				$temp['event_title'] = $data['event_name'][$i];
				$temp['event_date'] = $data['date'][$i];
				$temp['event_date_text'] = $data['datepicker'][$i];
				/*if($upload){
					$temp['Events']['event_image'] = $image['name'];
				}*/
				$temp['venue'] = $data['address'][$i];
				$temp['rsvp'] = $data['rsvp'][$i];
				$temp['created_date'] = date('Y-m-d H:i:s');
				$temp['last_modified'] = date('Y-m-d H:i:s');pr($temp);
				$res = $this->save($temp);var_dump($res);
			}	
				
				
			}
			
			
		
	}
}
