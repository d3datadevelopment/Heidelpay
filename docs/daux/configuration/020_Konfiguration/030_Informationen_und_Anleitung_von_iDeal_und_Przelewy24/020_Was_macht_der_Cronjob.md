---
title: Was macht der Cronjob?
---


Der Cronjob holt sich eine Liste von Bestellungen die auf `PENDING` gesetzt und nicht storniert sind.<br> 
Pro Bestellung werden alle Transaktionen von dem Heidelpay Server eingeholt.

Transaktionen die nicht im Shop vorhanden sind, werden in die Datenbank gespeichert.

Anhand des Status der Transaktion wird die Bestellung abgearbeitet.

Bei einer erfolgreichen Receipt `OT.RC` wird die Bestellung abgeschlossen.

Die E-Mails werden zu **diesem Zeitpunkt** verschickt.
