<?php
    session_start(); 
    require("../fonctions/fonctions.php") ; 

    if(isset($_SESSION['id']))
    {
        header("Location: ../index.php") ;
        exit();
    }
    
    if(isset($_POST['valider']))
    {
        $login = htmlspecialchars($_POST['login']) ; 
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $confirm_pass = htmlspecialchars($_POST['confirm_pass']) ; 

        if(!empty($login) && !empty($pass) && !empty($confirm_pass))
        {
            if(($_POST['pass'] == $confirm_pass) && (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#',$_POST['pass'])))
            {
                try 
                {
                    $connexion = new PDO("mysql:host=localhost;dbname=discussion",'root','') ;
                    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
        
                    $result = checkLogin($login) ;
        
                    if($result == 0) 
                    {
                        $requete = $connexion->prepare("INSERT INTO utilisateurs(login,password) 
                                            VALUES(:login,:password)"
                        );
    
                        $requete->bindParam(':login', $login) ; 
                        $requete->bindParam(':password', $pass) ; 

                        $requete->execute();

                        header("Location: connexion.php") ;
                        exit();
    
                    }
                    elseif($result == 1)
                    {
                        $login_exist = '<p class="error">login déjà existant</p>' ;
                    }
                   
                }
        
                catch(PDOExeption $e){
                    echo 'Echec :'.$e->getMessage() ; 
                }
            }
            elseif($_POST['pass'] != $confirm_pass)
            {
                echo 'mot de passe différents' ;
                $diff_pass = '<label for="password">Mot de passe </label>
                <input type="password" id="password" name="pass" class="animate__animated animate__shakeX" required>

                <label for="confirm_password">Confirmation mot de passe </label>
                <input type="password" id="confirm_password" name="confirm_pass" class="animate__animated animate__shakeX" required>
                <p class="error"> Mots de passe différents </p>' ; 
                
            }
            else
            {
                $error_pass = '<label for="password">Mot de passe </label>
                <input type="password" id="password" name="pass" required>

                <label for="confirm_password">Confirmation mot de passe </label>
                <input type="password" id="confirm_password" name="confirm_pass" required>
                <p class="error"> Mot de passe invalide : Le mot de passe faire au minimum 10 caractères avec 1 majuscule, 1 chiffre et 1 caractère spécial </p>' ;  
            }

        }
        else
        {
            $error_champs = '<p class="error">Veuillez remplir tous les champs</p>' ;
        }
        
    }

?>

<DOCTYPE! html>
<html lang ="fr">

    <head>
        <title> Page inscription </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>  
    
    <body>

        <header>
        <?php 
            if(isset($_SESSION['id']))
            {
                require("../include/header_connect_pages.php");
            }
            else{
                require("../include/header_disconnect_pages.php");
            }
        ?>
        </header>

        <main>

            <section id="formulaire">
            <h1> Inscription </h1>
                
                <article class="contenu_formulaire">
                    
                    <form action="inscription.php" method="POST">
                        
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" required>

                        <?php 
                            if(isset($diff_pass))
                            {
                                echo $diff_pass ;
                                
                            }
                            elseif(isset($error_pass))
                            {
                                echo $error_pass ; 
                            }
                            else
                            {
                                ?>
                            <label for="password">Mot de passe </label>
                            <input type="password" id="password" name="pass" required>

                            <label for="confirm_password">Confirmation mot de passe </label>
                            <input type="password" id="confirm_password" name="confirm_pass" required>
                                <?php
                            }

                            if(isset($error_champs))
                            {
                                echo $error_champs ; 
                            }
                            elseif(isset($login_exist))
                            {
                                echo $login_exist ;
                            }

                            ?>
                        
                        <input type="submit" value="Envoyer" name="valider">
                            

                    </form>

                </article>

                <article class="vignette_manga">
                    <div>
                        <img src="../images/jojo.png" alt="img_jojo">
                    </div>
                </article>    
           
            </section>

        </main>

        <footer>
            <?php require("../include/footer.php") ?> 
        </footer>    
                                        
    </body>

</html>

