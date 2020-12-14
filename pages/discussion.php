<?php
session_start(); 

if(!isset($_SESSION['id']))
{
    header("Location: connexion.php") ;
}

if(isset($_POST['envoyer']))
{
    if(!empty($_POST['message']))
    {

    }
    else{
        echo 'Veuillez écrire votre message' ;
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
                
                <article class="contenu_discussion">
                    <h1> Discussion </h1>
                    <form action="discussion.php" method="POST">
                        <label for="message"> Message : </label>
                        <textarea id="message" name="message" placeholder="Votre message..." required></textarea>

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