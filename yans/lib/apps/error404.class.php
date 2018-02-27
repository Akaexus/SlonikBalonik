<?php

class error404 extends yansApp {
  function execute() {
    echo '404, tut mir leid';
    echo '<pre>'.print_r($this->registry, 1).'</pre>';
  }
}
