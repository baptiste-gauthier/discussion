<?php

// Fonction connexion bdd //



// Fonction verif login //

function checkLogin($login)
{
    $connexion = new PDO("mysql:host=localhost;dbname=discussion",'root','') ;
    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
    
    $requete = $connexion->prepare("SELECT COUNT(`login`) 
                                            FROM `utilisateurs`
                                             WHERE `login` = :login;"
    );

    $requete->bindParam(':login', $login) ; 
    $requete->execute();
    $count = $requete->fetchColumn() ;

    if($count == 0)
    {
        return 0 ; 
    }
    elseif($count == 1)
    {
        return 1 ; 
    }
    else
    {
        return -1 ; 
    }
}

?>