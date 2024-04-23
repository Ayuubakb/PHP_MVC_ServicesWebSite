<?php
class UserController extends Controller {
    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Déterminer le type en fonction de la case à cocher
            $type = isset($_POST['isPartenaire']) ? 'partenaire' : 'client';
            
            // Récupérer les données du formulaire
            $data = [
                'LastName' => $_POST['LastName'],
                'FirstName' => $_POST['FirstName'],
                'Email' => $_POST['Email'],
                'Telephone' => $_POST['Telephone'],
            ];
            
            if ($type == 'client') {
                $data['Address'] = $_POST['Address'];
                $this->loadModel("Client");
                // Assurez-vous que la méthode creerClient existe et peut traiter $data
                $this->Client->creerClient($data);
            } elseif ($type == 'partenaire') {
                $data += [
                    'Metier' => $_POST['Metier'],
                    'Ville' => $_POST['Ville'],
                    'Creneaux' => $_POST['Creneaux'],
                    'YearExperience' => $_POST['YearExperience'],
                ];
                $this->loadModel("Partenaire");
                // Assurez-vous que la méthode creerPartenaire existe et peut traiter $data
                $this->Partenaire->creerPartenaire($data);
            }
            
            // Redirection ou gestion de l'affichage après l'inscription
            // Par exemple, rediriger vers la page de connexion ou afficher un message de succès
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Retrieve form data
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Authenticate user
            $user = $this->getUserByEmail($email);
    
            if ($user && password_verify($password, $user['password'])) {
                // Authentication successful
                // Check if the user has an Address field
                if (isset($user['Address'])) {
                    // User is a client
                    header('Location: '); // Redirect to client dashboard
                } else {
                    // User is a partenaire
                    header('Location: '); // Redirect to partenaire dashboard
                }
                exit();
            } else {
                // Authentication failed
                echo "Invalid email or password";
            }
        }
    }
    

    public function showSignupForm() {
        
        $this->loadView("Authentification/signup");
    }

    public function showLoginForm() {
        
        $this->loadView("Authentification/login");
    }




}