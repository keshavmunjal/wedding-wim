<?php
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('Themes','Users','Microwebsites');

/**
 * index method
 *
 * @return void
 */
	/* public function beforeFilter() {
		parent::beforeFilter();
		 $this->Auth->fields = array(
		 'username' => 'username', 
		 'password' => 'password'
		 );
	  } */
	public function login() {
		if ($this->RequestHandler->isAjax())
		{
			$email = $this->request->data['username'];
			$password = $this->Auth->password($this->request->data['password']);
			$userDetails = $this->Users->find('all',array('conditions'=>array('email'=>$email,'password'=>$password)));
			if($userDetails)
			{
				$user = $userDetails[0]['Users'];
				$this->Session->write('userId',$user['id']);
				$this->Session->write('user_name',$user['user_name']);
				echo $user['id'];
			}
			else
			{
				echo "FAIL";
			}
		}
		exit;
	}
	
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add_user() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$users = $this->User->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$users = $this->User->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function create()
	{
		if ($this->RequestHandler->isAjax())
		{	
			$user = array();
			//$user = $this->Users->create();
			$user['Users']['user_name'] = $this->request->data['user_name'];
			$user['Users']['email'] = $this->request->data['email'];
			$user['Users']['password'] = $this->Auth->password($_POST['password']);
			$user['Users']['created_date'] = date('Y-m-d H:i:s');
			$user['Users']['url'] = $this->request->data['url'];
			$this->Users->save($user);//saving user in DB
			echo $userId = $this->Users->id;
			
			//send activation mail to user
			
			$this->Session->write('userId',$userId);
			$this->Session->write('user_name',$user['Users']['user_name']);
			
			$mv = $this->Microwebsites->create();
			$mv['Microwebsites']['user_id'] = $userId;
			$mv['Microwebsites']['theme_id'] = $this->request->data['themeId'];
			$mv['Microwebsites']['url'] = $this->request->data['url'];
			$mv['Microwebsites']['created_date'] = date('Y-m-d H:i:s');
			$this->Microwebsites->save($mv);//saving Microwebsite data
			
		}
		else
		{
		throw new ForbiddenException();
		}
		exit;
	}
 
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function registers(){
	
	}
	public function step1(){
		if($this->request->is('post'))
		{
			$user = $this->request->data;
			$this->Session->write('Users.themeId', $user['themeId']);
			exit;
		}
	}
	public function step2(){
	
		$themeId = $this->Session->read('Users.themeId');//getting theme for current user
		if(empty($themeId))
		{
			$this->redirect(array("controller" => "Users","action" => "step1"));
		}
		$themeDetails = $this->Themes->find('all',array('conditions'=>array('id'=>$themeId)));
		//pr($themeDetails);exit;
		$this->set('themeDetails',$themeDetails[0]['Themes']);
		$this->set('themeId',$themeId);
		//$this->Session->delete('Users.themeId');//deleting session selected theme off me for production face
	}
	public function step3(){
		$userId = $this->Session->read('userId');
		if($userId)
		{
			$websiteDetails = $this->Microwebsites->find('all',array('conditions'=>array('user_id'=>$userId)));
			$this->set('websiteDetails',$websiteDetails[0]['Microwebsites']);
		}
		else
		{
			throw new ForbiddenException();
		}
	}
	public function new_event(){
		$this->layout = 'ajax';
		$this->register = 'new_event';
	}
	public function checkurl(){
		
		if ($this->RequestHandler->isAjax())
		{
			$url = ($_GET['url']);
			$data = $this->Microwebsites->find('all',array('conditions'=>array('url'=>$url)));
			if($data)
			echo "false";
			else
			echo "true";
		}
		else
		{
			throw new ForbiddenException();
		}
		exit;
	}
}
