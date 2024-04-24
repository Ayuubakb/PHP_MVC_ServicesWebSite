<?php
class Authentification extends Controller {
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
            $this->loadModel("Authentificate");
            // Retrieve form data
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Authenticate user
            $user = $this->Authentificate->getUserByEmail($email);
    
            if ($user && !strcmp($password, $user['password'])) {
                // Authentication successful
                // Start the session
                session_start();
                
                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = isset($user['Address']) ? 'client' : 'partenaire';
                
                // Redirect based on user type
                if (!strcmp($_SESSION['user_type'],'client')) {
                    header('Location:http://localhost/Bricolini/Clients'); // Redirect to client dashboard
                } else {
                    header('Location:http://localhost/Bricolini/Partenaires'); // Redirect to partenaire dashboard
                }
                exit();
            } else {
                // Authentication failed
                echo "Invalid email or password";
            }
        }
    }
    
    

    public function showSignupForm() {
        
        $this->loadView("signup");
    }

    public function showLoginForm() {
        
        $this->loadView("login");
    }




}