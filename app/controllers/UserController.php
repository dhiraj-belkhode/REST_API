<?php
namespace App\controllers;

class UserController{

	public function __construct(){
		$this->test = array('asdada da da','asd as das das d');
	}

	public function work($request){

		return $this->test;

	}

	public function worka($request){

		return "test worka";

	}

	public function workpost($request){
		return "IN WORKPOST";
	}
}