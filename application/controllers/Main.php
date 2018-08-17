<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');

class Main extends MY_Controller{
  function __constructor(){
    parent::__constructor();
  }


  function index(){
    $this->load->view('main');

  }
}
?>
