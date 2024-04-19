<?php

class Clients extends Controller{
   public function index(){
        $this->loadModel("Client");
        $profile=json_decode($this->Client->getProfile(1));
        $this->loadView("index",compact('profile'));
   }
}