<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        $islogged=true;
        if(!strcmp($_SESSION['user_type'],'client')){
            $type='client';
        }else{
            $type="partenaire";
        }
    }else{
        $islogged=false;
    }
?>
<nav>
    <div class="logoContainer">
        <img src="<?php echo "http://" . $_SERVER['SERVER_NAME'] ."/Bricolini/Views/public/images/logo.png"; ?>" /> 
    </div>
    <div class="routes">
        <ul>
            <?php
            if(($islogged && !strcmp($type,"client")) || !$islogged){
                echo"
                    <a href='http://localhost/Bricolini'><li>Acceuil</li></a>
                    <a href='http://localhost/Bricolini/Services'><li>Services</li></a>";
                if($islogged){
                    echo "
                    <a href='http://localhost/Bricolini/Clients/getAllCommandes/Tous/4/DESC'><li>Commandes</li></a>
                        <a href='http://localhost/Bricolini/Clients/getAllComments/0/DESC'><li>Commentaires</li></a>
                        <a href='http://localhost/Bricolini/Clients/partenaires'><span>Partenaires</span></a>";

                }
            }else if($islogged && !strcmp($type,"partenaire")){
                echo"    
                    <a href='http://localhost/Bricolini/Partenaires/Historique'><li>Historique</li></a>
                    <a href='http://localhost/Bricolini/Partenaires/Interventions'><li>Mes Interventions</li></a>
                    <a href='http://localhost/Bricolini/Partenaires/commentaires/0/DESC'><li>Commentaires</li></a>";
            }
            ?>
        </ul>
    </div>
    <div class="auth"> 
        <?php
            if($islogged && !strcmp($type,"client"))
                echo "
                    <a href='http://localhost/Bricolini/Clients'><button>Profile</button></a>";
            else if($islogged && !strcmp($type,"partenaire"))
                echo "<a href='http://localhost/Bricolini/Partenaires/index/".$_SESSION['user_id']."'><button>Profile</button></a>";
        ?>
        <?php
        if(!$islogged){
            echo"    
            <a href='http://localhost/Bricolini/Authentification/showLoginForm'><button>Login</button></a>
            <a href='http://localhost/Bricolini/Authentification/showSignupForm'><button>SignUp</button></a>";
        }else{
            echo"    
            <a href='http://localhost/Bricolini/Authentification/logout'><button>Logout</button></a>";
        }
        ?>
    </div>
</nav>