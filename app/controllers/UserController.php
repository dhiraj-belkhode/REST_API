<?php
namespace App\controllers;

class UserController{

	public function __construct(){
		echo "UserController";
		$this->test = "Working this";
	}

	public function work($request){

		return json_encode($request);

		exit;
		echo "<pre>";
		print_r($request);
		exit;

		echo "<br>";
		echo $this->test;
		echo "<br>";
		echo "in work";
		exit;
	}
}