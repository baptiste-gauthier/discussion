<?php

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
                    
                    echo $_SESSION['id'] ;
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
    </head>  
    
    <body>

        <header>
        
        </header>

        <main>

            <section id="formulaire">
                    
                <article class="contenu_formulaire">
                    
                    <form action="connexion.php" method="POST">
                        <div>
                            <label for="login">Login</label>
                            <input type="text" id="login" name="login" required>
                        </div>

                        <div>
                            <label for="password">Mot de passe </label>
                            <input type="password" id="password" name="pass" required>
                        </div>

                        <div>
                            <input type="submit" value="Envoyer" name="valider">
                        </div>    

                    </form>

                </article>

            </section>

        </main>

        <footer>

        </footer>


    </body>

</html>