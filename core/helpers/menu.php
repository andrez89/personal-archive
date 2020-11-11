<?php

/** Struttura del menu parametrico.
 * 
 * L'array MENU contiene un insieme di chiavi => valori:
 *      La chiave è il link della voce di menu (NON DEVE CONTENERE #)
 *      Il valore è un array con i seguenti valori
 *          zwicon, Etichetta, Privilegi, [sottomenu]
 * 
 * La chiave può esere divider o divider1 per definire 1+ separatori
 *          
 *      I Privilegi sono: 
 *          0 = All 
 *          1 = Admin
 * 
 * Nel caso di sottomenu, abbiamo un array come segue:
 *      La chiave è il link della voce di sottomenu (deve iniziare con la chiave padre)
 *      Il valore è l'etichetta mostrata per la voce
 */

define("MENU", [
    "dashboard/" => ["home", _("Monitoraggio"), 0, []],
    "monitor/plants" => ["my-location", _("Impianti"), -1, []],
    "operations/" => ["lifebelt", _("Operazioni Critiche"), -2, [
        "#operations/pi"  => _("Pronto Intervento"),
        "#operations/oaa" => _("Operazioni Avvisi-Allarmi")
    ]],
    "divider" => 0,
    "search/" => ["search", _("Ricerca Impianti-Strumenti"), 0, []],
    "anag/" => ["database", _("Gestione Anagrafiche"), 1, [
        "anag/customers" => _("Clienti"),
        "anag/plants" => _("Impianti"),
        "anag/contacts" => _("Contatti")
    ]],
    "install/" => ["cog", _("Installazione"), 1, [
        "#install/assembler"    => _("Strumenti & Test"),
        "divider"               => 0,
        "install/test"          => _("Test Strumentazione"),
        "divider1"              => 0,
        "#install/simulate"     => _("Simulazione Strumento")

    ]],
    "admin/" => ["cog", _("Amministrazione"), 2, [
        "admin/users" => _("Utenti"),
        "divider"     => 0,
        "admin/utils" => _("Utilità di Sistema")

    ]],
    "funz/" => ["cog", _("Gestione Funzionalità"), 3, [
        "funz/SdM"      => _("Sistema di Misura"),
        "funz/instr"    => _("Gestione Strumentazione"),
        "funz/admin/SmsEmail" => _("Gestione Messaggistica")

    ]],
    "applic/" => ["cog", _("Gestione Applicazioni"), 3, [
        "applic/ApplsManager"  => _("Nuove Applicazioni"),
        "applic/ManagerBellows" => _("Compensatori")

    ]],

    "#info" => ["info-circle", _("Info Sistema"), 0, []],
    "smltAppl/" => ["cog", _("Simulazione"), 3, []]
]);

/**
 * Funzione che ritorna vero se l'utente può visualizzare la pagina corrente
 * 
 * Basata sull'URL attuale (o il parametro $page), 
 * l'utente loggato e sui valori della costante MENU
 */
function canSeePage($page = null)
{
    if ($page == null) {
        $page = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
    }
    $l = "";
    // cicla tutte le voci di menu, e verifica sotto quale siamo
    foreach (MENU as $link => $m) {
        if (strpos($page, $link) !== false) {
            $l = $link;
            break;
        }
    }
    if ($l == "")
        return false;
    // prende il grado di privilegio e verifica il mio grant
    $m = MENU[$l];
    return ($m[2] == 0) || // all
        ($m[2] == 1 && isLoggedIn());
}
