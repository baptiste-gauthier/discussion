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
                        <h3>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error beatae iusto, dolorum sed consectetur est pariatur inventore hic at exercitationem quasi? Exercitationem quos illum consectetur sed molestias minus praesentium debitis.</h3>
                        <h5>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur neque, tempore fugit corrupti minima molestiae quam repellat nostrum perferendis magni numquam officia harum, autem esse possimus, nam excepturi! Pariatur, odio.</h5>
                        <button type="submit"> Découvrir</button>
                    </div>
                    <div class="titre_pres">
                        <h1>Bienvenue sur Forum Manga </h1>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. ,  recusandae quae, ut unde quia, beatae cum dolorem amet numquam adipisci dolores!</p>
                    </div>
                </article>
            </section>
            

        </main>

        <footer>
           <?php require("include/footer.php") ?> 
        </footer>
        
    </body>

</html>