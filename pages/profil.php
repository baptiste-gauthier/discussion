<?php
session_start();
require("../fonctions/fonctions.php") ;


if(isset($_POST['valider']))
{
    $new_login = htmlspecialchars($_POST['new_login']); 
    $new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
    $new_confirm_pass = htmlspecialchars($_POST['new_confirm_pass']);

    if(!empty($new_login) && !empty($new_pass) && !empty($new_confirm_pass))
    {
        if($_POST['new_pass'] == $new_confirm_pass && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#',$_POST['new_pass']))
        {
            try{
                $connexion = new PDO("mysql:host=localhost;dbname=discussion",'root','') ; 
                $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

                $result = checkLogin($new_login) ;
                if($result == 0)
                {
                    $id = $_SESSION['id'] ; 
                    $requete = $connexion->prepare("UPDATE utilisateurs 
                    SET login = :newlogin,
                        password = :newpass
                            WHERE id = :id ");
                    
                    $requete->bindParam(':newlogin', $new_login) ;
                    $requete->bindParam(':newpass', $new_pass) ; 
                    $requete->bindParam(':id', $id) ; 
                    
                    
                    if($requete->execute()) 
                    {
                        $changements = 'Changements effectués' ; 
                    }

                    $sql = $connexion->prepare("SELECT * FROM utilisateurs WHERE id = :id") ;
                    $sql->bindParam(':id', $id) ; 

                    $sql->execute(); 

                    $result = $sql->fetch(); 
                   
                    $_SESSION['login'] = $result['login'] ;
                    $_SESSION['password'] = $result['password'] ;
                    $_SESSION['id'] = $result['id'] ; 

                }
                else{
                    $error_login = '<p class="error">Ce login déjà pris</p>';
                }
                
            }
            catch(PDOExeption $e){
                echo 'Erreur :' .$e->getMessage();
            }

        }
        elseif($_POST['new_pass'] != $new_confirm_pass)
        {
            $error_pass = '<p class="error"> Mots de passe différents </p>' ;
        }
        else
        {
            $check_pass = '<p class="error">Mot de passe non valide : Il doit contenir au minimum 10 caractères, avec une majuscule, une minuscule, un chiffre et un caractère spécial.</p>' ; 
        }
    }
    else{
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
            <h1> Modifier son profil </h1>
                
                <article class="contenu_formulaire">
                    
                    <form action="profil.php" method="POST">
                        
                        <label for="login"> Nouveau login</label>
                        <input type="text" id="login" name="new_login" required>

                        <label for="password">Nouveau mot de passe </label>
                        <input type="password" id="password" name="new_pass" required>

                        <label for="confirm_password">Confirmation du nouveau mot de passe </label>
                        <input type="password" id="confirm_password" name="new_confirm_pass" required>
                        <?php
                            if(isset($error_login))
                            {
                                echo $error_login ; 
                            }
                            elseif( isset($error_pass))
                            {
                                echo $error_pass ; 
                            }
                            elseif(isset($check_pass))
                            {
                                echo $check_pass ;
                            }
                            elseif(isset($error_champs))
                            {
                                echo $error_champs ;
                            }
                            elseif(isset($changements))
                            {
                                echo $changements ;
                            }

                        ?>

                        <input type="submit" value="Envoyer" name="valider">
                            

                    </form>

                </article>

                <article class="vignette_manga">
                    <div>
                        <img src="../images/gon_kirua.jpg" alt="img_hxh">
                    </div>
                </article>    
           
            </section>

        </main>

        <footer>
            <?php require("../include/footer.php") ?> 
        </footer>    
                                        
    </body>

</html>
