<?php
    require("../fonctions/fonctions.php") ; 
    
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
                        echo 'login déjà existant' ;
                    }
                   
                }
        
                catch(PDOExeption $e){
                    echo 'Echec :'.$e->getMessage() ; 
                }
            }
            elseif($_POST['pass'] != $confirm_pass)
            {
                echo 'mot de passe différents' ;
            }
            else
            {
                echo 'Mot de passe non valide : Il doit contenir au minimum 10 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.' ;  
            }

        }
        else
        {
            echo 'Veuillez remplir tous les champs' ;
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
    </head>  
    
    <body>

        <header>
            <?php require("../include/header_disconnect.php") ?>
        </header>

        <main>

            <section id="formulaire">
                
                <article class="contenu_formulaire">
                    
                    <form action="inscription.php" method="POST">
                        <div>
                            <label for="login">Login</label>
                            <input type="text" id="login" name="login" required>
                        </div>

                        <div>
                            <label for="password">Mot de passe </label>
                            <input type="password" id="password" name="pass" required>
                        </div>

                        <div>
                            <label for="confirm_password">Confirmation mot de passe </label>
                            <input type="password" id="confirm_password" name="confirm_pass" required>
                        </div>
                        
                        <div>
                            <input type="submit" value="Envoyer" name="valider">
                        </div>    

                    </form>

                </article>
           
            </section>

        </main>
                                        
    </body>

</html>