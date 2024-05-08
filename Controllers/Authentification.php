<?php
class Authentification extends Controller {
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = !strcmp($_POST["checkClient"],"partenaire") ? 'partenaire' : 'client';
            
            $data = [
                'LastName' => $_POST['LastName'],
                'FirstName' => $_POST['FirstName'],
                'Email' => $_POST['Email'],
                'Telephone' => $_POST['Telephone'],
                'password' => $_POST['password'],
            ];
            
            if ($type == 'client') {
                $data['Address'] = $_POST['Address'];
                $this->loadModel("Client");
                $this->Client->creerClient($data);
            } elseif ($type == 'partenaire') {
                $data += [
                    'Metier' => $_POST['Metier'],
                    'Ville' => $_POST['Ville'],
                    'YearExperience' => $_POST['YearExperience'],
                ];
                $days=$_POST["days"];
                $Creneanux="";
                foreach($days as $day){
                    if(!strcmp($day,"Monday"))
                        $Creneanux.="Lundi:".$_POST["lundifrom"]."-".$_POST["lundito"]."/";
                    if(!strcmp($day,"Tuesday"))
                        $Creneanux.="Mardi:".$_POST["mardifrom"]."-".$_POST["mardito"]."/";
                    if(!strcmp($day,"Wednesday"))
                        $Creneanux.="Mercredi:".$_POST["mercredifrom"]."-".$_POST["mercredito"]."/";
                    if(!strcmp($day,"Thursday"))
                        $Creneanux.="Jeudi:".$_POST["jeudifrom"]."-".$_POST["jeudito"]."/";
                    if(!strcmp($day,"Friday"))
                        $Creneanux.="Vendredi:".$_POST["vendredifrom"]."-".$_POST["vendredito"]."/";
                    if(!strcmp($day,"Saturday"))
                        $Creneanux.="Samedi:".$_POST["samedifrom"]."-".$_POST["samedito"]."/";
                    if(!strcmp($day,"Sunday"))
                        $Creneanux.="Dimanche:".$_POST["dimanchefrom"]."-".$_POST["dimancheto"]."/";
                }
                $data["Creneaux"]=$Creneanux;
                $this->loadModel("Partenaire");
                $this->Partenaire->creerPartenaire($data);
            }
            
            header('Location:http://localhost/Bricolini/Authentification/showLoginForm');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->loadModel("Authentificate");
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->Authentificate->getUserByEmail($email);
    
            if ($user && !strcmp($password, $user['password'])) {
                session_start();
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = isset($user['Address']) ? 'client' :(isset($user['Ville'])?'partenaire':'admin');
                
                if (!strcmp($_SESSION['user_type'],'client')) {
                    header('Location:http://localhost/Bricolini/Clients'); 
                } else if(!strcmp($_SESSION['user_type'],'partenaire')) {
                    header('Location:http://localhost/Bricolini/Partenaires/index/'.$_SESSION['user_id'].'');
                }else{
                    header('Location:http://localhost/Bricolini/Admin');
                }
                exit();
            } else {
                $msg="Invalide Email Or Password";
                $this->loadView("login",compact("msg"));
            }
        }
    }
    
    

    public function showSignupForm() {
        
        $this->loadView("signup");
    }

    public function showLoginForm() {
        
        $this->loadView("login");
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        $this->loadView("login");
    }



}