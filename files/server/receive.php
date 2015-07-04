<?php
/*
 * in diesem Script verwendete Variablen
 */
$clean_hostname = "";
$clean_eth0_mac = "";
$clean_eth0_ip4 = "";
$clean_eth0_ip6 = "";
$clean_wlan0_mac = "";
$clean_wlan0_ip4 = "";
$clean_wlan0_ip6 = "";


$datei = 'devices.csv';

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


// prüfen ob eth0_mac in $_GET vorhanden ist.
if (isset($_GET['eth0_mac'])) {

    // prüfen ob eth0_mac nicht leer ist.
    if (!empty($_GET['eth0_mac'])) {

        // prüfen ob eth0_mac eine gültige MAC-Adresse enthält
          if (preg_match('/^(([0-9a-fA-F][0-9a-fA-F])([:\-][0-9a-fA-F][0-9a-fA-F]){5})$/', $_GET['eth0_mac'])) {
            $clean_eth0_mac = $_GET['eth0_mac'];
        } else {
            $clean_eth0_mac = "eth0_mac-Formatfehler";
        } // ende regex-prüfung

    } else {
        $clean_eth0_mac = "eth0_mac-Variable ist leer!";
    } // ende leer-prüfung
} else {
        $clean_eth0_mac = "eth0_mac-Variable fehlt!";
} // ende vorhanden-prüfung


// prüfen ob eth0_ipv4 in $_GET vorhanden ist.
if (isset($_GET['eth0_ipv4'])) {

    // prüfen ob eth0_ipv4 nicht leer ist.
    if (!empty($_GET['eth0_ipv4'])) {

        // prüfen ob eth0_ipv4 eine gültige IPv4-Nummer ist.
        if (preg_match('/^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})){3})$/', $_GET['eth0_ipv4'])) {
            $clean_eth0_ipv4 = $_GET['eth0_ipv4'];
        } else {
            $clean_eth0_ipv4 = "eth0_ipv4-Formatfehler";
        } // ende der regex-prüfung

    } else {
        $clean_eth0_ipv4 = "eth0_ipv4-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_eth0_ipv4 = "eth0_ipv4-Variable fehlt!";
} // ende vorhanden-prüfung


// prüfen ob eth0_ipv6 in $_GET vorhanden ist.
if (isset($_GET['eth0_ipv6'])) {

    // prüfen ob eth0_ipv6 nicht leer ist.
    if (!empty($_GET['eth0_ipv6'])) {

        // prüfen ob eth0_ipv6 eine gültige IPv6-Nummer ist.
        if (preg_match('/^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$/', $_GET['eth0_ipv6'])) {
            $clean_eth0_ipv6 = $_GET['eth0_ipv6'];
        } else {
            $clean_eth0_ipv6 = "eth0_ipv6-Formatfehler";
        } // ende der regex-prüfung

    } else {
        $clean_eth0_ipv6 = "eth0_ipv6-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_eth0_ipv6 = "eth0_ipv6-Variable fehlt!";
} // ende vorhanden-prüfung


// prüfen ob wlan0_mac in $_GET vorhanden ist.
if (isset($_GET['wlan0_mac'])) {

    // prüfen ob wlan0_mac nicht leer ist.
    if (!empty($_GET['wlan0_mac'])) {

        // prüfen ob wlan0_mac eine gültige MAC-Adresse enthält
          if (preg_match('/^(([0-9a-fA-F][0-9a-fA-F])([:\-][0-9a-fA-F][0-9a-fA-F]){5})$/', $_GET['wlan0_mac'])) {
            $clean_wlan0_mac = $_GET['wlan0_mac'];
        } else {
            $clean_wlan0_mac = "wlan0_mac-Formatfehler";
        } // ende regex-prüfung

    } else {
        $clean_wlan0_mac = "wlan0_mac-Variable ist leer!";
    } // ende leer-prüfung
} else {
        $clean_wlan0_mac = "wlan0_mac-Variable fehlt!";
} // ende vorhanden-prüfung


// prüfen ob wlan0_ipv4 in $_GET vorhanden ist.
if (isset($_GET['wlan0_ipv4'])) {

    // prüfen ob wlan0_ipv4 nicht leer ist.
    if (!empty($_GET['wlan0_ipv4'])) {

        // prüfen ob wlan0_ipv4 eine gültige IPv4-Nummer ist.
        if (preg_match('/^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})){3})$/', $_GET['wlan0_ipv4'])) {
            $clean_wlan0_ipv4 = $_GET['wlan0_ipv4'];
        } else {
            $clean_wlan0_ipv4 = "wlan0_ipv4-Formatfehler";
        } // ende der regex-prüfung

    } else {
        $clean_wlan0_ipv4 = "wlan0_ipv4-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_wlan0_ipv4 = "wlan0_ipv4-Variable fehlt!";
} // ende vorhanden-prüfung


// prüfen ob wlan0_ipv6 in $_GET vorhanden ist.
if (isset($_GET['wlan0_ipv6'])) {

    // prüfen ob wlan0_ipv6 nicht leer ist.
    if (!empty($_GET['wlan0_ipv6'])) {

        // prüfen ob wlan0_ipv6 eine gültige IPv6-Nummer ist.
        if (preg_match('/^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$/', $_GET['wlan0_ipv6'])) {
            $clean_wlan0_ipv6 = $_GET['wlan0_ipv6'];
        } else {
            $clean_wlan0_ipv6 = "wlan0_ipv6-Formatfehler";
        } // ende der regex-prüfung

    } else {
        $clean_wlan0_ipv6 = "wlan0_ipv6-Variable ist leer!";
    } // ende leer-prüfung

} else {
        $clean_wlan0_ipv6 = "wlan0_ipv6-Variable fehlt!";
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
$datensatz = "'".$datum."';'".$zeit."';'".$clean_hostname."';'".$clean_eth0_mac."';'".$clean_eth0_ipv4."';'".$clean_eth0_ipv6."';'".$clean_wlan0_mac."';'".$clean_wlan0_ipv4."';'".$clean_wlan0_ipv6."'"."<br />\n";

// prüfen ob die Datei devices.csv existiert
$handle = fopen($datei, a);

if ($handle == true) {
    fwrite($handle, $datensatz);
    fclose($handle);
    echo "Daten gespeichert.";
} else {
    echo "Fehler beim speichern.";
}
?>
