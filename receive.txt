<?php
/*
 * in diesem Script verwendete Variablen
 */
$clean_hostname = "";
$clean_ip = "";
$clean_mac = "";

$datei = 'devices.csv';

$f_exist = 0;
$f_writable = 0;

/*
 * Prüfen der Daten die per GET übergebenen werden
 */

// prüfen ob hostname in $_GET vorhanden ist.
if (isset($_GET['hostname'])) {

    // prüfen ob hostname nicht leer ist.
    if (!empty($_GET['hostname'])) {

        // prüfen ob hostname den Regeln nach RFC 952 entspricht
        // 1-63 Zeichen länge; kleine und große Buchstaben; Ziffern 0-9;
        // Minus, aber nicht als erstes und/oder letztes Zeichen

        if (preg_match('/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?)$/', $_GET['hostname'])) {
            $clean_hostname = $_GET['hostname'];
        } else {
            $clean_hostname = "hostname-Formatfehler";
        } // ende regex-prüfung

    } else {
        $clean_hostname = "hostname-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_hostname = "hostname-Variable fehlt!";
} // ende vorhanden-prüfung

// prüfen ob ip in $_GET vorhanden ist.
if (isset($_GET['ip'])) {

    // prüfen ob ip nicht leer ist.
    if (!empty($_GET['ip'])) {

        // prüfen ob ip eine gültige IPv4-Nummer ist.
        if (preg_match('/^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})){3})$/', $_GET['ip'])) {
            $clean_ip = $_GET['ip'];
        } else {
            $clean_ip = "ip-Formatfehler";
        } // ende der regex-prüfung

    } else {
        $clean_ip = "ip-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_ip = "ip-Variable fehlt!";
} // ende vorhanden-prüfung

// prüfen ob mac in $_GET vorhanden ist.
if (isset($_GET['mac'])) {

    // prüfen ob mac nicht leer ist.
    if (!empty($_GET['mac'])) {

        // prüfen ob mac eine gültige MAC-Adresse enthält
          if (preg_match('/^(([0-9a-fA-F][0-9a-fA-F])([:\-][0-9a-fA-F][0-9a-fA-F]){5})$/', $_GET['mac'])) {
            $clean_mac = $_GET['mac'];
        } else {
            $clean_mac = "mac-Formatfehler";
        } // ende regex-prüfung

    } else {
        $clean_mac = "mac-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_mac = "mac-Variable fehlt!";
} // ende vorhanden-prüfung


/*
 * zeitwerte für den Datensatz ermitteln
 */

// speichere UNIX-timestamp
$timestamp = time();

// errechne aus $timestamp das Datum
$datum = date("d.m.Y", $timestamp);

// errechne aus $timestamp die Uhrzeit
$zeit = date("H:i:s", $timestamp);


/*
 *  Datensatz in Datei speichern
 */

// zu speichernden Datensatz erstellen
$datensatz = "'".$timestamp."';'".$datum."';'".$zeit."';'".$clean_mac."';'".$clean_hostname."';'".$clean_ip."'"."<br />\n";

// prüfen ob die Datei devices.csv existiert
$handle = fopen($datei, a);

if ($handle == true) {
    fwrite($handle, $datensatz);
    fclose($handle);
    echo "Daten gespeichert.";
} else {
    echo "Fehler beim speichern.";
}

/*
// Schreiben des neuen Wertes
$handle = fopen ("devices.csv", "w");
fwrite ($handle, $datensatz);
fclose ($handle);
*/

/*
// ist Datei devices.csv vorhanden
if (file_exists("devices.csv")) {
    //
} else {
    // erstelle Datei
}
*/

?>
