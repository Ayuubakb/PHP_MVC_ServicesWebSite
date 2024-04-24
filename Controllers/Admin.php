<?php
class Admin extends Controller {
    // Action to display the dashboard
    public function index() {
        // Load the Admindash model
        $this->loadModel('Admindash');
        
        // Fetch statistics
        $stats = $this->Admindash->getStats();
        
        // Load the view with statistics
        $this->loadView('index', ['stats' => $stats]);
    }
    
    // Action to display the users page
    public function users() {
        // Load the User model
        $this->loadModel('Users');
        
        // Fetch all users
        $userslist = $this->Users->getAllUsers();
        
        // Load the view with users data
        $this->loadView('Users', ['users' => $userslist]);
    }
    
    // Action to display the comments page
    public function comments() {
        // Load the Comment model
        $this->loadModel('Comment');
        
        // Fetch all comments
        $comments = $this->Comment->getAllComments();
        
        // Load the view with comments data
        $this->loadView('Comments', ['comments' => $comments]);
    }
    
    // Action to display the reservations page
    public function reservations() {
        // Load the Reservation model
        $this->loadModel('Reservation');
        
        // Fetch all reservations
        $reservations = $this->Reservation->getAllReservations();
        
        // Load the view with reservations data
        $this->loadView('Reservations', ['reservations' => $reservations]);
    }
    
    // Action to display the services page
    public function services() {
        // Load the Service model
        $this->loadModel('Services');
        
        // Fetch all services
        $services = $this->Services->getAllServices();
        
        // Load the view with services data
        $this->loadView('Services', ['services' => $services]);
    }
    
    // Action to display the signals page
    public function signals() {
        // Load the Signal model
        $this->loadModel('Signals');
        
        // Fetch all signals
        $signals = $this->Signals->getAllSignals();
        
        // Load the view with signals data
        $this->loadView('Signals', ['signals' => $signals]);
    }
    public function handleReclamationAction() {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the action is set
            if (isset($_POST["action"])) {
                $reclamationId = $_POST["reclamationId"];
                $reclaimerId = $_POST["reclaimerId"];
                $reclaimerType = $_POST["reclaimerType"];
                $action = $_POST["action"];
    
                // Include necessary files and instantiate the model
                $this->loadModel('Signals');
                $signalsModel = new Signals();
    
                // Execute the corresponding function in the model based on the action
                if ($action == "ignore") {
                    // Call the function to ignore the reclamation
                    $signalsModel->ignoreReclamation($reclamationId);
                } elseif ($action == "delete") {
                    // Call the function to delete the reclaimer
                    $signalsModel->deleteReclaimer($reclamationId, $reclaimerId, $reclaimerType);
                }
            }
        }
        // Redirect back to the page displaying reclamations or any other appropriate action
        header("Location: signals"); // Assuming 'signals' is the route to the reclamations page
    }
    
}
