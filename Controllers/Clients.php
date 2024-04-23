<?php

class Clients extends Controller{
   public function index(){
        $this->loadModel("Client");
        $profile=json_decode($this->Client->getProfile(1));
        $this->loadView("index",compact('profile'));
   }
   public function editProfile(){
         $this->loadModel("Client");
         $profile=$this->Client->getInfos(1);
         $this->loadView("edit",compact('profile'));
   }
   public function updateInfos(){
      if(isset($_POST['subButton'])){
         $this->loadModel("Client");
         if(!filesize($_FILES["pic"]["size"])){
            $updated=$this->Client->updateInfos("null",$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telephone'],1);
         }else{
            $updated=$this->Client->updateInfos(basename($_FILES["pic"]["name"]),$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telephone'],1);
            echo "heree";
            $target_dir = "../Views/public/clientPic/";
            $target_file = $target_dir . basename($_FILES["pic"]["name"]);
            $updated=$this->Client->updateInfos(basename($_FILES["pic"]["name"]),$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telephone'],1);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (file_exists($target_file)) {
               $uploadOk = 0;
            }
            if ($uploadOk == 0) {
               $updated=false;
            } else {
               if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
                  
               } else {
                  echo $updated=false;
               }
            }
         }
         $profile=$this->Client->getInfos(1);
         if($updated){
            header("Location:http://localhost/Bricolini/Clients/editProfile?msg=Modifier Avec Success");
         }else{
            header("Location:http://localhost/Bricolini/Clients/editProfile?msg=Une Erreur est Survenue");
         }
      }
   }
   public function getAllCommandes($type,$status,$sort){
      $this->loadModel("Client");
      $profile=json_decode($this->Client->getCommandes(1,$type,$status,$sort));
      $this->loadView("commandes",compact('profile'));
   }
   public function getAllComments($rating,$sort){
      $this->loadModel("Client");
      $profile=json_decode($this->Client->getComments(1,$rating,$sort));
      $this->loadView("commentaires",compact('profile'));
   }
   public function report
}