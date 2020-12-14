<?php
    session_start();

    if(isset($_POST['valider']))
    {
        $login = htmlspecialchars($_POST['login']) ; 
        $pass = htmlspecialchars($_POST['pass']) ; 
        

        if(!empty($login) && !empty($pass))
        {
            try
            {
                $connexion = new PDO("mysql:host=localhost;dbname=discussion",'root','') ; 
                $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

                $requete = $connexion->prepare("SELECT *
                                                    FROM `utilisateurs` 
                                                        WHERE `login` = :login"
                );

                $requete->bindParam(':login',$login) ;
                
                $requete->execute();
                $result = $requete->fetchAll() ;
                
                if($result AND password_verify($pass, $result[0]['password']))
                {
                    $_SESSION['login'] = $login ; 
                    $_SESSION['pass'] = $pass ; 
                    $_SESSION['id'] = $result[0]['id'] ;
                    
                    echo 'bravo vous êtes connecter' ; 
                    header("Location: profil.php") ;
        
                }

                else {
                    echo 'mot de passe ou login incorrect' ;
                }
            }
            catch(PDOExeption $e)
            {
                echo 'Echec :'.$e->getMessage() ; 
            }
        }
        else
        {
            echo 'Veuillez remplir tous les champs du formulaire' ;
        }
    }
?>


<DOCTYPE! html>
<html lang ="fr">

    <head>
        <title> Page connexion </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
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
                    
                <article class="contenu_formulaire">
                    
                    <form action="connexion.php" method="POST">
                        
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" required>

                        <label for="password">Mot de passe </label>
                        <input type="password" id="password" name="pass" required>

                        <input type="submit" value="Envoyer" name="valider">
                          
                    </form>

                </article>

                <article class="vignette_manga">
                    <div>
                        <img src="../images/fma.png" alt="img_fma">
                    </div>
                </article>   

            </section>

        </main>

        <footer>
        <?php require("../include/footer.php") ?> 
        </footer>


    </body>

</html>