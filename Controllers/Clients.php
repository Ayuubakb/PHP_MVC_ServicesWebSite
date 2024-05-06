<?php

class Clients extends Controller{
   public function index(){
        session_start();
        $this->loadModel("Client");
        $profile=json_decode($this->Client->getProfile($_SESSION['user_id']));
        $this->loadView("index",compact('profile'));
   }
   public function editProfile(){
         session_start();
         $this->loadModel("Client");
         $profile=$this->Client->getInfos($_SESSION['user_id']);
         $this->loadView("edit",compact('profile'));
   }
   public function updateInfos(){
      session_start();
      if(isset($_POST['subButton'])){
         $this->loadModel("Client");
         if(filesize($_FILES["pic"]["size"]) == 0){
            $updated=$this->Client->updateInfos("null",$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telephone'],$_SESSION['user_id']);
         }else{
            //$updated=$this->Client->updateInfos(basename($_FILES["pic"]["name"]),$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telephone'],$_SESSION['user_id']);
            $target_dir = "../Views/public/images/";
            $target_file = $target_dir . basename($_FILES["pic"]["name"]);
            $updated=$this->Client->updateInfos(basename($_FILES["pic"]["name"]),$_POST['firstName'],$_POST['lastName'],$_POST['address'],$_POST['telephone'],$_SESSION['user_id']);
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
         $profile=$this->Client->getInfos($_SESSION['user_id']);
         if($updated){
            header("Location:http://localhost/Bricolini/Clients/editProfile?msg=Modifier Avec Success");
         }else{
            header("Location:http://localhost/Bricolini/Clients/editProfile?msg=Une Erreur est Survenue");
         }
      }
   }
   public function getAllCommandes($type,$status,$sort){
      session_start();
      $this->loadModel("Client");
      $profile=json_decode($this->Client->getCommandes($_SESSION['user_id'],$type,$status,$sort));
      $this->loadView("commandes",compact('profile'));
   }
   public function getAllComments($rating,$sort){
      session_start();
      $this->loadModel("Client");
      $profile=json_decode($this->Client->getComments($_SESSION['user_id'],$rating,$sort));
      $this->loadView("commentaires",compact('profile'));
   }
   /*public function report($id_t,$type,$motif){
      $this->loadModel("Reclamations");
      $result=$this->Reclamations->reportFromClient(1,$id_t,$type,$motif);
      header("Location:http://localhost/Bricolini/Clients/index?msg=1");
   }*/
   public function report(){
      $this->loadModel("Reclamations");
      $this->Reclamations->reportFromClient($_POST["id_reclamateur"],$_POST["id_T"],$_POST["type_reclamation"],$_POST["type_reclamateur"],$_POST["motif"]);
   }
   public function partenaires(){
      session_start();
      $this->loadModel("Client");
      if(isset($_POST["subBtn"])){
         $partenaires=$this->Client->getPartenaires($_POST['nom'],$_POST['ville'],$_POST['rating'],$_POST['metier']);
      }else{
         $partenaires=$this->Client->getPartenaires("","",6,"");
      }
      $this->loadView("partenaires",compact("partenaires"));
   }
}