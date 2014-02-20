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
class Wedding_detail extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $usesTable = 'Wedding_details';

/**
 * Validation rules
 *
 * @var array
 */
	
	public function update_wed($data){
			$db = $this->getDataSource();
			$temp = array();
			$groom = $db->value($data['groom'], 'string');
			$temp['groom'] = $groom;
			$bride = $db->value($data['bride'], 'string');
			$temp['bride'] = $bride;
			$temp['wedding_date'] = $data['wedding_date'];
			$date = $db->value($data['wedding_date_text'], 'string');
			$temp['wedding_date_text'] = $date;
			$update = $this->updateAll(
				$temp,
				array('user_id' => $_POST['user_id'])
			);
			return $update;
		
	}
	
}
