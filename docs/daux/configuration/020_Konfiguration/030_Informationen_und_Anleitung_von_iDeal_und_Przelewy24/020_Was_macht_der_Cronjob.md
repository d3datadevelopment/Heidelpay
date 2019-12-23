---
title: Was macht der Cronjob?
---


Der Cronjob holt sich eine Liste von Bestellungen die auf `PENDING` gesetzt und nicht storniert sind.<br> 
Pro Bestellung werden alle Transaktionen von dem Heidelpay Server eingeholt.

Transaktionen, die nicht im Shop vorhanden sind, werden in die Datenbank gespeichert.

Anhand des Status der Transaktion wird die Bestellung abgearbeitet.

Bei einer erfolgreichen Receipt `OT.RC` wird die Bestellung abgeschlossen.

Die E-Mails werden zu **diesem Zeitpunkt** verschickt.


Wenn eine Bestellung das Ende der [ Lebenszeit einer PENDING-Bestellung (in Stunden) ] erreicht hat,  
tritt die [ Aktion nach Lebenszeit ] in Kraft.  
Sie können zwischen folgenden Bearbeitungsoptionen wählen:
<dl>
<dt>NOT_FINISHED (oxorder__oxtransstatus)</dt>
<dd>Bis 6.1.0.2 blieb die Bestellung unverändert.</dd>
<dd>Ab 6.1.0.2 wird der Bestellstatus (oxorder__oxtransstatus) PENDING auf NOT_FINISHED gesetzt.</dd>
<dt>Bestellung stornieren</dt>
<dd>Die Bestellung wird über die reguläre Routine des Shops storniert (Order::cancelOrder()).</dd>
<dt>Bestellung l&ouml;schen</dt>
<dd>Die Bestellung wird unwiderruflich gelöscht. Die Löschung erfolg über den Shop selbst (order::delete()) </dd>
</dl>
