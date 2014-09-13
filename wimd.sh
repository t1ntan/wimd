#!/bin/sh
### BEGIN INIT INFO
# Provides:          wimd
# Required-Start:
# Required-Stop:
# Default-Start:     2 3 4 5
# Default-Stop:      0 1 6
# Short-Description: Sendet die Netzwerkeinstellung an ein PHP-Skript
# Description:       Sendet die Netzwerkeinstellung an ein PHP-Skript
### END INIT INFO

touch /var/lock/wimd

case "$1" in
start)
    echo "Sende Netzwerkdaten des RasPi ... "
    # hostname ermitteln und in Variable speichern
    info_hostname=$(hostname)
    #echo $info_hostname

    # IPv4-Adresse ermitteln und in Variable speichern
    info_ipv4=$(ip addr show dev eth0 | grep -oE 'inet ([0-9]{1,3}.){3}[0-9]{1,3}' | cut -d' ' -f2)
    #echo $info_ipv4

    # MAC-Adresse ermitteln und in Variable speichern
    info_mac=$(ip link show dev eth0 | grep -oE 'link/ether ([a-f0-9]{2}:){5}[a-f0-9]{2}' | cut -d' ' -f2)
    #echo $info_mac

    # Daten an Webserver per GET-Methode übermitteln
    wget --delete-after --quiet "http://t1ntan.crew.c-base.org/wimd/receive.php?hostname=$info_hostname&ip=$info_ipv4&mac=$info_mac"
# > /dev/null
    echo 'wget --delete-after --quiet "http://t1ntan.crew.c-base.org/wimd/receive.php?hostname=$info_hostname&ip=$info_ipv4&mac=$info_mac"'

;;
stop)
    echo "Beende das Senden der Netzwerkdaten ..."
    killall wimd 2> /dev/null
;;
*)
    echo "Usage: /etc/init.d/wimd {start|stop}"
exit 1
;;
esac
exit 0
