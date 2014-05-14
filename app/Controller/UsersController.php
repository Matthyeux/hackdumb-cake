<?php
App::uses('AppController','Controller');
class UsersController extends AppController{
		
		public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('signup','login');
        }
		public function signup(){
			if (!empty($this->request->data)) {
            $this->User->create($this->request->data);
            if($this->User->validates()){
                $token = md5(time() . ' - ' . uniqid());
                $this->User->create(array(
                    'pseudo' => $this->request->data['User']['pseudo'],
                    'password' => $this->Auth->password($this->request->data['User']['password']),
                    'adresse_mail'     => $this->request->data['User']['adresse_mail']
                ));
                $this->User->save();

                $this->Session->setFlash('Merci vous êtes inscrit');
            }else{
                $this->Session->setFlash('Merci de corriger vos erreurs', 'flash', array('class' => 'error'));
            }
        }
    }

}