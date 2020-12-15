<?php
session_start(); 

if(!isset($_SESSION['id']))
{
    header("Location: connexion.php") ;
}

if(isset($_POST['envoyer']))
{
    $message = $_POST['message'] ;
    $id = $_SESSION['id'] ;
    $date = date('Y-m-d H:i:s');

    if(!empty($_POST['message']))
    {
        $connexion = new PDO("mysql:host=localhost;dbname=discussion",'root','') ; 
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

        $requete = $connexion->prepare("INSERT INTO messages (message, id_utilisateur, date)
                                            VALUES(:mess, :id_utilisateur, :date)"
        );

        $requete->bindParam(':mess', $message) ;
        $requete->bindParam(':id_utilisateur', $id) ;
        $requete->bindParam(':date', $date) ;

        $requete->execute(); 
       
    }
    else{
        $error_msg = '<p class="error">Veuillez écrire votre message</p>' ;
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
            <?php require("../include/header_connect_pages.php"); ?>
        </header>
        
        <main>
            
            
            <section id="discussion">
                <h1> Discussion </h1>

            <?php 

            $connexion = new PDO("mysql:host=localhost;dbname=discussion",'root','') ; 
            $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;

            $requete = $connexion->prepare("SELECT login,message,date 
                                                FROM utilisateurs
                                                    INNER JOIN messages
                                                        ON utilisateurs.id = messages.id_utilisateur"
            );

            $requete->execute();
            
            $result = $requete->fetchAll();

            //var_dump($result);

            for($i = 0; isset($result[$i]); $i++)
            {
                echo '<p class="message"> Par <b>'.$result[$i]['login'].'</b> le <em>'.$result[$i]['date'].'</em> '.$result[$i]['message'].'</p>';
            }
            
            ?>
                
                <article class="contenu_discussion">
                    <form action="discussion.php" method="POST">
                        <label for="message"> Message : </label>
                        <textarea id="message" name="message" placeholder="Votre message..." required></textarea>
                        <?php 
                            if(isset($error_msg))
                            {
                                echo $error_msg ;
                            }
                        ?>

                        <input type="submit" value="Envoyer" name="envoyer">
                    </form>    
                </article>
                            
            </section>

        </main>

        <footer>
            <?php require("../include/footer.php") ?> 
        </footer>    
                                        
    </body>

</html>
