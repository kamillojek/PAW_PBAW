<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$kwota,&$oprocentowanie,&$raty){
    $kwota = isset($_REQUEST ['kwota']) ? $_REQUEST['kwota'] : null;
    $oprocentowanie = isset($_REQUEST ['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
    $raty = isset($_REQUEST ['raty']) ? $_REQUEST['raty'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota,&$oprocentowanie,&$raty,&$messages){
    // sprawdzenie, czy parametry zostały przekazane
    if ( ! (isset($kwota) && isset($raty) && isset($oprocentowanie))) {
        // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
        // teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
        return false;
    }

    // sprawdzenie, czy potrzebne wartości zostały przekazane
    if ( $kwota == "") {
        $messages [] = 'Nie podano kwoty!';
    }
    if ( $oprocentowanie == "") {
        $messages [] = 'Nie podano oprocentowania!';
    }
    if ( $raty == "") {
        $messages [] = 'Nie podano ile lat chcesz spłacać kredyt!!';
    }


    //nie ma sensu walidować dalej gdy brak parametrów
    if (count ( $messages ) != 0) return false;

    // sprawdzenie, czy $x i $y są liczbami całkowitymi
    if (! is_numeric( $kwota )) {
        $messages [] = 'Kwota nie jest liczbą całkowitą!';
    }

    if (! is_numeric( $oprocentowanie ) && $oprocentowanie > 0 ) {
        $messages [] = 'Oprocentowanie musi być liczbą całkowitą większą od 0!';
    }

    if (count ( $messages ) != 0) return false;
    else return true;
}

function process(&$kwota,&$oprocentowanie,&$raty,&$messages,&$wynik){
    global $role;

    //konwersja parametrów na int
    $kwota = intval($kwota);
    $oprocentowanie = floatval($oprocentowanie);
    $raty = intval($raty);

    $q = 1+(($oprocentowanie/100)/12);
    $lata = $raty * 12;

    //wykonanie operacji
            if ($role == 'admin'){
                $rata = $kwota*pow($q, $lata)*($q-1)/((pow($q, $lata))-1);
                $wynik = round($rata, 2);
            } else {
                $messages [] = 'Tylko administrator może korzytsać z tej funkcji !';
            }

}

//definicja zmiennych kontrolera
$kwota = null;
$oprocentowanie = null;
$raty = null;
$wynik = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($kwota,$oprocentowanie,$raty);
if ( validate($kwota,$oprocentowanie,$raty,$messages) ) { // gdy brak błędów
    process($kwota,$oprocentowanie,$raty,$messages,$wynik);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';