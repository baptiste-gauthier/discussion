<?php session_start() ; ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de présentation</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    </head>


    <body>

        <header>
            
            <?php 
                if(isset($_SESSION['id']))
                {
                    require("include/header_connect.php") ;
                }
                else
                {
                    require("include/header_disconnect.php") ;
                }
             ?>

        </header>

        <main>
            <section id="pres">
                <article class="contenu_pres">
                    <div class="description_pres animate__animated animate__fadeInLeft animate__delay-1s ">
                        <div>
                            <img src="images/eye_guts.png" alt ="yeux_guts">
                        </div>
                        <h3>Découvez notre forum pour discuter de l'actualité manga. Rejoignez dès maintenant notre communauté pour avoir accès aux topics de toutes les dernières sorties et discuter sur le sujet !</h3>
                        <h5>Pour cela rendez-vous sur l'onglet inscription pour créez votre compte et accéder à la discussion. Venez rejoindre notre communauté ! </h5>
                        <form action="pages/inscription.php">
                            <button type="submit"> Découvrir</button>
                        </form> 
                    </div>
                    <div class="titre_pres">
                        <h1>Bienvenue sur Forum Manga </h1>
                        <p>Forum dédié à tous ce qui concerne les mangas. Une communauté de fans pour discuter sur toutes les séries existantes et en cours de publications.</p>
                    </div>
                </article>
            </section>
            

        </main>

        <footer>
           <?php require("include/footer_index.php") ?> 
        </footer>
        
    </body>

</html>