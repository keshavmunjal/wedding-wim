<?php
App::uses('AppController', 'Controller');
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
	public $uses = array('Themes','Users');

/**
 * index method
 *
 * @return void
 */
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
		$user = array();
		$user = $this->Users->create();
		$user['Users']['user_name'] = $_POST['user_name'];
		$user['Users']['email'] = $_POST['email'];
		$user['Users']['password'] = $_POST['password'];
		$user['Users']['created_date'] = date('Y-m-d H:i:s');
		$user['Users']['url'] = $_POST['url'];
		$this->Users->save($user);
		echo $this->Users->id;
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
	
	}
	public function new_event(){
		$this->layout = 'ajax';
		$this->register = 'new_event';
	}
}
