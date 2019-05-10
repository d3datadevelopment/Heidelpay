---
title: Cronjob per Konsole einrichten
---
Der Cronjob muss entweder die Datei `cron_bankaccount.sh` oder `cron_bankaccount.php` aufrufen.<br>
Die Dateien liegen im Shop unter: `/modules/d3/heidelpay/Cron/` <br>
Die Endung .sh bezeichnet eine sog. Shell-Datei, die unter Unix/Linux-Systemen ausgeführt werden kann.
> Sollte Ihr Shop auf einem anderen Betriebssystem laufen, so ist eine vergleichbare Datei manuell anzulegen

Bei `cron_bankaccount.sh` handelt es sich um eine Beispieldatei, die für den Hosting-Provider Profihost einsetzbar ist.<br>
Bei anderen Providern kann der Inhalt der sh-Datei variieren. Erfragen Sie die Details bei Ihrem Provider nach.

Öffnen Sie die .sh-Datei mit einem Text-Editor und passen Sie den Pfad zur startenden php-Datei an.<br>
Dazu ist der Bereich `/ihr/serverpfad/zum/shop/` mit dem absoluten Pfad zum Shop-Hauptverzeichnis zu tauschen

> Der absolute Pfad zum Shop-Hauptverzeichnis ist in der _`config.inc.php`_ zu finden.
> Öffnen Sie die Datei mit einem Editor und suchen Sie die Zeile `$this->sShopDir`.
