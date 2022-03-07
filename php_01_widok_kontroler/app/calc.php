<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$kwota = $_REQUEST ['kwota'];
$oprocentowanie = $_REQUEST ['oprocentowanie'];
$raty = $_REQUEST ['raty'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($kwota) && isset($oprocentowanie) && isset($raty))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
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
if (empty( $messages )) {
	
	// sprawdzenie, czy $kwota i $raty są liczbami całkowitymi + czy $oprocentowanie jest liczbą całkowitą > 0
	if (! is_numeric( $kwota )) {
		$messages [] = 'Kwota nie jest liczbą całkowitą!';
	}
	
	if (! is_numeric( $oprocentowanie ) && $oprocentowanie > 0 ) {
		$messages [] = 'Oprocentowanie musi być liczbą całkowitą większą od 0!';
	}

    if (! is_numeric( $raty )) {
        $messages [] = 'Ilość lat nie jest liczbą całkowitą!';
    }

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
    $kwota = intval($kwota);
    $oprocentowanie = floatval($oprocentowanie);
    $raty = intval($raty);

    $q = 1+(($oprocentowanie/100)/12);
    $lata = $raty * 12;
	
	//wykonanie operacji
    $rata = $kwota*pow($q, $lata)*($q-1)/((pow($q, $lata))-1);
    $wynik = round($rata, 2);

}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';