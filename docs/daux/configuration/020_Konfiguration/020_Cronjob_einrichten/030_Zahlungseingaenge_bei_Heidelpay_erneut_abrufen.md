---
title: Zahlungseingänge bei Heidelpay erneut abrufen
---
Der Cronjob fragt Zahlungseingänge bei Heidelpay immer für den aktuellen __Tag__ ab.

Stellen Sie den Cronjob so ein, dass dieser mehrmals am Tag aufgerufen wird!

Sollten Sie ältere Eingänge erneut abrufen wollen, steht Ihnen ein Parameter `date` zur Verfügung.<br>
Die Syntax dazu lautet: `YYYY-MM-DD`.

Der Aufruf per Browser wäre dazu:
```URL
http://www.IHRE-SHOP-URL.de/modules/d3/heidelpay/Public/cron_bankaccount.php?key=Sicherheitspasswort&date=2017-12-31“
```
Bei Nutzung der sh-Datei ist der Parameter ebenfalls nutzbar.<br>
Der Parameter muss an 2ter Stelle übergeben werden (bspw. `/modules/d3/heidelpay/Cron/cron_bankaccount.php 1 2017-12-31` ).
