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

	public function update_eve($data){
	//pr($data);
		$db = $this->getDataSource();
		for($i=0; $i<$data['no_of_events']; $i++){
				
				$temp = array();
				//$event = $this->Events->create();
				//$event['Events']['user_id'] = $data['user_id'];
				$temp['event_title'] = $db->value($data['event_name'][$i], 'string');
				$temp['event_date'] = $data['date'][$i];
				$temp['event_date_text'] = $db->value($data['datepicker'][$i], 'string');
				/*if($upload){
					$temp['event_image'] = $image['name'];
				}*/
				$temp['venue'] = $db->value($data['address'][$i], 'string');
				$temp['rsvp'] = $db->value($data['rsvp'][$i], 'string');
				$temp['last_modified'] = $db->value(date('Y-m-d H:i:s'), 'string');
				$data['event_id'][$i];
				$sql = "UPDATE `shaadise_staging`.`events` AS `Event` SET `Event`.`event_title` = ".$temp['event_title'].", `Event`.`event_date` = ".$temp['event_date'].", `Event`.`event_date_text` = ".$temp['event_date_text'].", `Event`.`venue` = ".$temp['venue'].", `Event`.`rsvp` = ".$temp['rsvp'].", `Event`.`last_modified` = ".$temp['last_modified']." WHERE `id` = ".$data['event_id'][$i]."";
				
				$update = $this->Event->query($sql);
				return $update;
				/*$update = $this->updateAll(
					$temp,
					array('id' => 7)
				);*/
				//var_dump($update);exit;
			}
			
			/*$temp = array();
			$groom = $db->value($data['groom'], 'string');
			$temp['groom'] = $groom;
			$bride = $db->value($data['bride'], 'string');
			$temp['bride'] = $bride;
			$temp['wedding_date'] = $data['wedding_date'];
			$date = $db->value($data['wedding_date_text'], 'string');
			$temp['wedding_date_text'] = $date;
			
			*/
		
	}
}
