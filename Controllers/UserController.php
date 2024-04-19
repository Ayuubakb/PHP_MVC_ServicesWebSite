<?php
class UserController extends Controller {
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données du formulaire
            $type = $_POST['type']; // client ou partenaire
            
            $data = [
                'LastName' => $_POST['LastName'],
                'FirstName' => $_POST['FirstName'],
                'Email' => $_POST['Email'],
                'Telephone' => $_POST['Telephone'],
                
            ];
            
            if ($type == 'client') {
                $data['Address'] = $_POST['Address'];
                $this->loadModel("Client");
                $this->Client->creerClient($data);
            } elseif ($type == 'partenaire') {
                $data += [
                    'Metier' => $_POST['Metier'],
                    'Ville' => $_POST['Ville'],
                    'Creneaux' => $_POST['Creneaux'],
                    'YearExperience' => $_POST['YearExperience'],
                    
                ];
                $this->loadModel("Partenaire");
                $this->Partenaire->creerPartenaire($data);
            }
            
            
        }
    }

    public function showSignupForm($type = 'client') {
        
        $type = in_array($type, ['client', 'partenaire']) ? $type : 'client';
        $this->loadView("Authentification/signup", ['type' => $type]);
    }
}