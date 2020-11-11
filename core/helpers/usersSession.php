<?php
/*----------------------------------------------------------------------------\

    FILE        : usersSession.php
    AIM         : Include le funzioni per il controllo degli accessi per i vari
                  utenti.
    NOTE        : File da includere all'inizio delle view che devono discrimi-
                  nare le proprie azioni in base ai privilegi associati all'u-
                  tente di sessione.
\----------------------------------------------------------------------------*/

// Verifica che l'utente di id = user_id sia connesso.

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function userID()
{
    if (isset($_SESSION['user_id'])) {
        return $_SESSION['user_id'];
    } else {
        return -1;
    }
}
