<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class HomeController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Themes','Users','Microwebsites','Events','Wedding_details');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
 
	public function index($url='')
	{
		//echo Router::url('/');       //-> /my_app
		//echo Router::url('/', true); //-> http://site.domain.com/my_app
		/*if($url!='')
		{
			echo "sdfdsff";exit;
			$this->autoRender = false;
			$this->render('test');
		}
		else
		{
			echo "selse";exit;
			$this->render('home/index');
		} */
		
	}
	public function sites($url='')
	{
		$userid = $this->Session->read('userId');//echo $userid;exit;
		if($userid){
			if($url!="")
			{
				$data = $this->Microwebsites->find('all',array('conditions'=>array('url'=>$url)));
				$mv = $data[0]['Microwebsites'];
				if($data)
				{
					$weddingdata = $this->Wedding_details->find('all',array('conditions'=>array('user_id'=>$mv['user_id'])));
					$data = $this->Users->find('all',array('conditions'=>array('id'=>$mv['user_id'])));
					$user = $data[0]['Users'];
					$events = $this->Events->find('all',array('conditions'=>array('user_id'=>$mv['user_id'])));
					//pr($events);
					//pr($user);
					//pr($mv);
					$this->set('websiteDetails',$mv);
					$this->set('wedding',$weddingdata[0]['Wedding_details']);
					$this->set('events',$events);
				}
				else
				{
					echo "not found url";exit;
				}
			}
			else
			{
				echo "notfound";exit;
			}
		}else{
			throw new ForbiddenException();
		}
	}
	
	public function sendInvite() {
	
		$email = $_POST['email'];
		
		$Email = new CakeEmail();
		$Email->template('welcome')
			->emailFormat('html')
			->to($email)
			->subject('Welcome')
			->from('ShaadiSeason@shaadiseason.com')
			->send();
			
		//$Email1 = new CakeEmail();
		//$Email1->template('userinfo')
		//	->viewVars(array('email' => $email))
		//	->emailFormat('html')
		//	->to('ruchika.arora@gmail.com')
		//	->subject('Register Info')
		//	->from('shadi@shaadiseason.com')
		//	->send();
				
		echo $this->saveusers($email);exit;
	}
	
	public function showusers(){
		echo "<pre>";
		$this->loadModel('UserModel');
		$res = $this->UserModel->find('all');
		foreach($res as $values){
			foreach($values as $key=>$index){
				//print_r($index);
				echo "Id: ".$index['id']."\tEmail: ".$index['email']."<br>";
			}
		}
		exit;
	}
	
	public function saveusers($email){
	
		
		$this->loadModel('User');
		$check = $this->User->find('first',array('conditions'=>array('email'=>$email)));
		if($check)
		{
			return "AlreadyExists";
		}
		else
		{
			$newData = array('email' => $email);
			$a = $this->User->save($newData);
			return "Success";
		}
	}
	
}
