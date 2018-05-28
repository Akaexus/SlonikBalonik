<?php

class yansForm {
  static function validateForm($g, $fields) {
    $g  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $form = [];
    $errors = [];
    foreach($fields as $fieldName => $options) {
      if(isset($g[$fieldName])) {
        if(($options['required'] && $g[$fieldName]!='') || $g[$fieldName]!='') {
          $fieldValue = $g[$fieldName];
          foreach($options['parse'] as $parseFunction) {
            $fieldValue = $parseFunction($fieldValue);
          }
          foreach($options['test'] as $testFunction) {
            if(!$testFunction($fieldValue)) {
              array_push($errors, $options['error']);
            }
          }
          if(isset($options['equal'])) {
            foreach($options['equal'] as $equalField) {
              if($g[$fieldName]!=$g[$equalField]) {
                array_push($errors, $options['error']);
              }
            }
          } else {
            $form[$fieldName] = $fieldValue;
          }
        }
      } else {
        array_push($errors, 'Nie podano wszystkich pól!');
      }
    }
    if(count($errors)) {
      $errors['type'] = 'error';
      return $errors;
    } else {
      $form['type'] = 'form';
      return $form;
    }
  }
}
