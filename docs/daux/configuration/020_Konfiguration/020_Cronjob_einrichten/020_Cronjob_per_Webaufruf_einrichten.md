---
title: Cronjob per Webaufruf einrichten
---
Fügen Sie das Cronjob-Sicherheitspasswort in die Datei `config.inc.php` ein.<br>
Gehen Sie im Shopadmin in das Menü [ (D3) Module ] / [ Modul-Connector ] /
[ Systemeinstellungen ] / [ Tab: Config-Einträge ] / [ Datei bearbeiten ]<br>
Tragen Sie folgende Zeilen am Ende des Textfeldes ein:<br>
```php
// Sicherheitspasswort für automatische Vorkasse und Rechnungskauf
$this->cfgHeidelpay_sAccessKey = "Sicherheitspasswort";
```
Ändern Sie das "Sicherheitspasswort" in ein nur Ihnen bekanntes sicheres Zugriffspasswort.

Alternativ können Sie die Datei `cron_bankaccount.php` per URL im Cronjob aufrufen lassen.<BR>
Der Aufruf lautet wie folgt:<br>
```URL
https://www.IHRE-SHOP-URL.de/modules/d3/heidelpay/Cron/cron_bankaccount.php?key=Sicherheitspasswort
```
Ersetzen Sie die Phrase "Sicherheitspasswort" mit dem vergebenen Passwort.<br>
Ohne das korrekte Sicherheitspasswort wird die Ausführung des Cronjob verhindert.
> [!]Setzen Sie auf jeden Fall ein Sicherheitspasswort. Damit wird die Ausführung des php-Cronjob per Browser durch Dritte verhindert.
