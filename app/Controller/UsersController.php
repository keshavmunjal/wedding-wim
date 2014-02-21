<?php
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');
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
	public $uses = array('Themes','Users','Microwebsites','Wedding_details','Events');

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
			$userDetails = $this->Users->find('all',array('conditions'=>array('email'=>$email,'password'=>$password,'status'=>"'1'")));
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
			$tempuser = $this->Users->find('all',array('conditions'=>array('email'=>$_POST['email'])));
			$tempmv = $this->Microwebsites->find('all',array('conditions'=>array('url'=>$this->request->data['url'])));
			if($tempuser)
			{
				echo "User_Exist";
				exit;
			}
			else if($tempmv)
			{
				echo "Url_Exist";
				exit;
			}
			else
			{
				$user = array();
				//$user = $this->Users->create();
				$user['Users']['user_name'] = $this->request->data['user_name'];
				$user['Users']['email'] = $this->request->data['email'];
				$user['Users']['password'] = $this->Auth->password($_POST['password']);
				$user['Users']['created_date'] = date('Y-m-d H:i:s');
				$user['Users']['url'] = $this->request->data['url'];
				$user['Users']['new_email_key'] = md5(rand().microtime());
				$this->Users->save($user);//saving user in DB
				echo $userId = $this->Users->id;
				//send activation mail to user
				/*
				 $Email = new CakeEmail();
				$Email->template('activate')
					->viewVars(array('user' => $user['Users'],'user_id'=>$userId))
					->emailFormat('html')
					->to($user['Users']['email'])
					->subject('Welcome')
					->from('ShaadiSeason@shaadiseason.com')
					->send(); 
				*/
				//$this->Session->write('userId',$userId);
				//$this->Session->write('user_name',$user['Users']['user_name']);
				
				$mv = $this->Microwebsites->create();
				$mv['Microwebsites']['user_id'] = $userId;
				$mv['Microwebsites']['theme_id'] = $this->request->data['themeId'];
				$mv['Microwebsites']['url'] = $this->request->data['url'];
				$mv['Microwebsites']['created_date'] = date('Y-m-d H:i:s');
				$this->Microwebsites->save($mv);//saving Microwebsite data
			}
			
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
	
	public function activate($userId,$new_email_key)
	{
		//echo $userId.$new_email_key;
		$this->loadModel('User');
		$user = $this->Users->find('all',array(
									'conditions'=>array(
										'id'=>$userId,
										'new_email_key'=>$new_email_key,
										'UNIX_TIMESTAMP(created_date) >'=>time() - 60*60*24*2
									)));
		if($user)
		{
			//activate user account
			$this->Users->updateAll(array('status'=>"'1'"), array('id = '=>$user[0]['Users']));
			$userdetail = $user[0]['Users'];
			$this->Session->write('userId',$userdetail['id']);
			$this->Session->write('user_name',$userdetail['user_name']);
			$this->redirect(array("controller"=>"users","action"=>"step3"));
		}
		else
		{
			//error activation
		}
		exit;
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
			/*****Gmail Code******/
			App::import('Vendor', 'GmailOath');
			$sClientId = '365616338942-pt7i2dnbs5ib9jicj1eg4ur67jtkpkjv.apps.googleusercontent.com';
			$sClientSecret = 'ktEPKXQiL-vKcqtRnsBYUcjY';
			$sCallback = 'http://shaadiseason.in/users/step3'; // callback url, don't forget to change it to your!
			$iMaxResults = 100; // max results
			$sStep = 'auth'; // current step
			
			$argarray = array();
			$oAuth = new GmailOath($sClientId, $sClientSecret, $argarray, false, $sCallback);
			$oGetContacts = new GmailGetContacts();
			
			if ($_GET && $_GET['oauth_token']) {

				$sStep = 'fetch_contacts'; // fetch contacts step

				// decode request token and secret
				$sDecodedToken = $oAuth->rfc3986_decode($_GET['oauth_token']);
				$sDecodedTokenSecret = $oAuth->rfc3986_decode($_SESSION['oauth_token_secret']);

				// get 'oauth_verifier'
				$oAuthVerifier = $oAuth->rfc3986_decode($_GET['oauth_verifier']);

				// prepare access token, decode it, and obtain contact list
				$oAccessToken = $oGetContacts->get_access_token($oAuth, $sDecodedToken, $sDecodedTokenSecret, $oAuthVerifier, false, true, true);
				$sAccessToken = $oAuth->rfc3986_decode($oAccessToken['oauth_token']);
				$sAccessTokenSecret = $oAuth->rfc3986_decode($oAccessToken['oauth_token_secret']);
				$aContacts = $oGetContacts->GetContacts($oAuth, $sAccessToken, $sAccessTokenSecret, false, true, $iMaxResults);

				// turn array with contacts into html string
				$contact = array();
				$count = 0;
				$sContacts = $sContactName = '';
				foreach($aContacts as $k => $aInfo) {
					$sContactName = end($aInfo['title']);
					$aLast = end($aContacts[$k]);
					foreach($aLast as $aEmail) {
						$contact[$count]['name'] = $sContactName;
						$contact[$count++]['email'] = $aEmail['address'];
						$sContacts .= '<p>' . $sContactName . '(' . $aEmail['address'] . ')</p>';
					}
				$this->set('contact',$contact);
				$this->set('invite_gmail','1');
				}
			} else {
				// prepare access token and set it into session
				$oRequestToken = $oGetContacts->get_request_token($oAuth, false, true, true);
				$this->set('token',$oAuth->rfc3986_decode($oRequestToken['oauth_token']));
				$_SESSION['oauth_token'] = $oRequestToken['oauth_token'];
				$_SESSION['oauth_token_secret'] = $oRequestToken['oauth_token_secret'];
			}
			/*****End of Gmail*****/
			
			
			$websiteDetails = $this->Microwebsites->find('all',array('conditions'=>array('user_id'=>$userId)));
			$events = $this->Events->find('all',array('conditions'=>array('user_id'=>$userId)));
			
			
			$this->set('websiteDetails',$websiteDetails[0]['Microwebsites']);
			$this->set('events',$events);
			
		}
		else
		{
			throw new ForbiddenException();
		}
		
			//echo "sdfdsf";exit;
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
	
	public function login_new(){
		if($_POST){
		//pr($_POST);
			$email = $this->request->data['loginEmail'];
			$password = $this->Auth->password($this->request->data['loginPassword']);
			$userDetails = $this->Users->find('all',array('conditions'=>array('email'=>$email,'password'=>$password)));
			if($userDetails)
			{
				$user = $userDetails[0]['Users'];
				$this->Session->write('userId',$user['id']);
				$this->Session->write('user_name',$user['user_name']);
				$data = $this->Microwebsites->find('all',array('conditions'=>array('user_id'=>$user['id'])));
				$url = $data[0]['Microwebsites']['url'];
				echo $url;
				/*$this->redirect(array(
					'controller' => 'home',
					'action' => 'sites/'.$url,
					
				));*/
			}
			else
			{
				echo "fail";
			}exit;
		}
	}
	
	public function edit_event(){
		$userId = $this->Session->read('userId');
		if($userId){
			$wedding_details = $this->Wedding_details->find('all', array('conditions' => array('user_id' => $userId)));
			$events = $this->Events->find('all', array('conditions' => array('user_id' => $userId)));
			$mv = $this->Microwebsites->find('all', array('conditions' => array('user_id' => $userId)));
			$theme_id = $mv[0]['Microwebsites']['theme_id'];
			$url = $mv[0]['Microwebsites']['url'];
			$theme= $this->Themes->find('all', array('conditions' => array('id' => $theme_id)));
			//pr($events);exit;
			$this->set('wedding', $wedding_details[0]['Wedding_details']);
			$this->set('events', $events);
			$this->set('themeId', $theme_id);
			$this->set('url', $url);
			$this->set('theme', $theme[0]['Themes']);
		}else{
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login_new'
			));
		}
	}
	
	public function logout(){
		$this->Session->destroy();
		$this->redirect(array(
			'controller' => 'users',
			'action' => 'login_new'
		));
	}
	
	public function edit_new_event(){
		$this->layout = 'ajax';
		$this->register = 'new_event';
		$data = array();
		$data = $this->Events->create();
		$data['Events']['user_id'] = $this->Session->read('userId');
		$data['Events']['event_title'] = "Event Name";
		$data['Events']['event_date'] = "2014-3-14";
		$data['Events']['event_date_text'] = "Monday 14 April 2014";
		$data['Events']['event_image'] = "noimage.jpg";
		$data['Events']['venue'] = "address";
		$data['Events']['rsvp'] = "656959299";
		$data['Events']['created_date'] = date('Y-m-d H:i:s');
		$data['Events']['last_modified'] = date('Y-m-d H:i:s');
		$res = $this->Events->save($data);
		$this->set('id', $res['Events']['id']);
	}
	
}
