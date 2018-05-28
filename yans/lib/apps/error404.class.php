<?php

class error404 extends yansApp {
  function execute() {
    echo '<h1>404</h1>tut mir leid, aber something went wrong';
    echo '<pre>'.print_r($_SERVER, 1).'</pre>';
  }
}
