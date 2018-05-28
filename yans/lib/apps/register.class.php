<?php

class register extends yansApp {
  function execute() {
    $coreSkin = $this->registry->loadTemplate('core');
    $this->skin = $this->registry->loadTemplate('register');
    $coreSkin->loadAndRender('header', 'Rejestracja', ['public/mdrnze/register.css']);
    $coreSkin->loadAndRender('headerBar');
    $coreSkin->loadAndRender('branding');
    if(isset($this->registry->request['do']) && $this->registry->request['do'] == 'register') {
      $fieldNames = [
				'email'=> [
					'required'=> true,
					'parse'=> [],
					'test'=> [function($e) {
						return filter_var($e, FILTER_VALIDATE_EMAIL);
					}],
					'unique'=> true,
					'error'=> 'Wystąpił błąd z adresem email!'
				], 'username'=> [
					'required'=> true,
					'parse'=>[],
					'unique'=> true,
					'test'=> [function($e) {
						return strlen($e)>=3;
					}, function($e) {
						return !!preg_match('/^[\w\d]+$/', $e);
					}],
					'error'=> 'Wystąpił błąd z nazwą użytkownika'
				], 'password'=> [
					'required'=> true,
					'parse'=>[function($e) {
						return password_hash($e, PASSWORD_BCRYPT);
					}],
					'test'=> [],
					'error'=> ''
				], 'password2'=> [
					'required'=> true,
					'parse'=>[function($e) {
						return password_hash($e, PASSWORD_BCRYPT);
					}],
					'test'=> [],
					'equal'=>['password'],
					'error'=> 'Hasła nie są takie same!'
				], 'firstname'=> [
					'required'=> false,
					'parse'=> [function($e) {
						return stripslashes($e);
					}],
					'test'=> [function($e) {
						return strlen($e)<=255 && !ctype_space($e);
					}],
					'error'=> 'Nie podano prawidłowego imienia!'
				], 'surname'=> [
					'required'=>false,
					'parse'=> [function($e) {
						return stripslashes($e);
					}],
					'test'=> [function($e) {
						return strlen($e)<=255 && !ctype_space($e);
					}],
					'error'=> 'Nie podano prawidłowego nazwiska!'
				], 'place'=> [
					'required'=> false,
					'parse'=>[function($e) {
						return stripslashes($e);
					}],
					'test'=> [function($e) {
						return strlen($e)<=255 && !ctype_space($e);
					}],
					'error'=> 'Nie podano prawidłowego miejsca!'
				]
			];
      require_once(YANS_ROOT_PATH.'lib/yansForm.php');
      $formValues = yansForm::validateForm($this->registry->request, $fieldNames);
      if($formValues['type'] == 'form') {
  	      unset($formValues['type']);
	      $uniqueFields = [];
	      foreach($fieldNames as $key=>$field) {
	        if(!isset($field['equal']) && isset($field['unique']) && $field['unique']) {
	          $uniqueFields[$key] = $formValues[$key];
	        }
	      }
	      $where = [];
	      foreach($uniqueFields as $key=>$value) {
	        array_push($where, "$key='$value'");
	      }
	      $where = implode(' or ', $where);
	      if(count($this->DB->select([
	        'select'=> 'id',
	        'from'=> 'yans_members',
	        'where'=> $where
	      ]))) {
	        echo 'juz takie konto istnieje!';
	      } else {
	        $this->DB->insert([
	          'into'=> 'yans_members',
	          'values'=> $formValues
	        ]);
	      }
      } else {
      	unset($formValues['type']);
      	$this->skin->loadAndRender('form', $formValues);
      }
    } else {
      $this->skin->loadAndRender('form');
    }
    $coreSkin->loadAndRender('footer');
  }
}
