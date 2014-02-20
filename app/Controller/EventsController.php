<?php
App::uses('AppController', 'Controller');


/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	//public $components = array('Paginator','Cookie');
	var $components = array("Paginator","Cookie",
						'UploadComp' => array(
								'files_dir'   => 'data',
								'rm_tmp_file' => false,
								'images_size' => array(
									'big'   => array(640, 480, 'resize'),
									'med'   => array(263, 263, 'resize'),
									'small' => array( 90,  90, 'resizeCrop')
								),
								'allow_non_image_files' => true,
							)
						);
	public $uses = array('Events', 'Users','Wedding_details', 'Microwebsites');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	/*public function preview_event(){
		if ($this->RequestHandler->isAjax())
		{
			$data = array();
			for($i=0; $i<$_POST['no_of_events']; $i++){
				
				//$data = $this->Events->create();
				$data[$i]['Events']['event_title'] = $_POST['event_name'][$i];
				$data[$i]['Events']['event_date'] = '2014-02-03';
				$data[$i]['Events']['venue'] = $_POST['address'][$i];
				$data[$i]['Events']['rsvp'] = $_POST['rsvp'][$i];
				$data[$i]['Events']['created_date'] = date('Y-m-d H:i:s');
				//$res = $this->Events->save($data);
			}
			echo "<pre>";
			pr($data);
			exit;
		}
		else
		{
			throw new ForbiddenException();
		}
	}*/
	public function add_event() {
	//echo "sdfds";exit;
		$user = array();
		//$user = $this->Users->create();
		//$user['Users']['user_name'] = $_POST['user_name'];
		//$user['Users']['created_date'] = date('Y-m-d H:i:s');
		//$user['Users']['url'] = $_POST['user_name'].'weds'.$_POST['bride_name'];
		//$this->Users->save($user);	
		$temp = array();
		$temp['Wedding_details']['user_id'] = $_POST['user_id'];
		$temp['Wedding_details']['groom'] = $_POST['groom'];
		$temp['Wedding_details']['bride'] = $_POST['bride'];
		$temp['Wedding_details']['wedding_date'] = $_POST['wedding_date'];
		$temp['Wedding_details']['wedding_date_text'] = $_POST['wedding_date_text'];
		
		$this->Wedding_details->save($temp);
		
		
		
		if ($this->request->is('post')) {
			for($i=0; $i<$_POST['no_of_events']; $i++){
				if($_FILES['image']['name'][$i]!=""){
					$image = array();
					$image['name'] = $_POST['user_id'].date('YmdHis').$_FILES['image']['name'][$i];
					$image['type'] = $_FILES['image']['type'][$i];
					$image['tmp_name'] = $_FILES['image']['tmp_name'][$i];
					$image['error'] = $_FILES['image']['error'][$i];
					$image['size'] = $_FILES['image']['size'][$i];
					if($this->UploadComp->upload_FS($image)){
						echo $upload = true;					
					}else{
						echo $upload = false;
					}
				}
				$data = array();
				$data = $this->Events->create();
				$data['Events']['user_id'] = $_POST['user_id'];
				$data['Events']['event_title'] = $_POST['event_name'][$i];
				$data['Events']['event_date'] = $_POST['date'][$i];
				$data['Events']['event_date_text'] = $_POST['datepicker'][$i];
				if($upload){
					$data['Events']['event_image'] = $image['name'];
				}
				$data['Events']['venue'] = $_POST['address'][$i];
				$data['Events']['rsvp'] = $_POST['rsvp'][$i];
				$data['Events']['created_date'] = date('Y-m-d H:i:s');
				$data['Events']['last_modified'] = date('Y-m-d H:i:s');
				$res = $this->Events->save($data);
			}
			/*if ($res) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}*/
		}
		//echo $this->Users->id;
		exit;
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('The event has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function image_upload(){
	print_r($_FILES);exit;
	 	if($_FILES['image']['name']!=""){
			//var_dump($this->UploadComp->upload_FS($_FILES['image']));exit;
			$image['Events']['user_id'] = 7;
			$image['Events']['event_image'] = $_FILES['image']['name'];
			print_r($image);
			if($this->UploadComp->upload_FS($_FILES['image'])){
				var_dump($this->Events->save($image));	
				echo "image uploaded successfully";
				
			}else{
				echo "error occurred";
			}
			
			
			//var_dump($this->Events->save($data));
		}exit;
		/*if(isset($_FILES["image"])){
			$output_dir = 'http://localhost/wedding-wim/app/webroot/uploads';
			//Filter the file types , if you want.
			if ($_FILES["image"]["error"] > 0)
			{
				echo "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				//move the uploaded file to uploads folder;
					move_uploaded_file($_FILES["image"]["tmp_name"],$output_dir. $_FILES["image"]["name"]);
				
				echo "Uploaded File :".$_FILES["image"]["name"];
			}
		
		}
		exit;*/
	}
	
	public function update_event(){
		//print_r($this->request->data);exit;
		if ($this->request->is('post')) {
			$this->loadModel('Wedding_detail');
			$wed = $this->Wedding_detail->update_wed($this->request->data);
			//var_dump($wed);
			$this->loadModel('Event');
			$eve = $this->Event->update_eve($this->request->data);
			//var_dump($eve);
			$url = $this->Microwebsites->find('all' ,array('conditions'=> array('user_id' => $this->request->data['user_id'])));
			
		}
		//echo $this->Users->id;
			
			echo $url[0]['Microwebsites']['url'];exit;
	}
	
	
}
