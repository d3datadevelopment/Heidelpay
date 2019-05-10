---
title: Was hat sich im Bestellprozess geändert?
---

Der Benutzer durchläuft den Bestellprozess wie gewohnt.<br> 
Nach dem Klick auf den Button [ Zahlungspflichtig bestellen ] im Bestellschritt 4, wird direkt eine Bestellung angelegt bevor der Benutzer zu dem Zahlungsanbieter weitergeleitet wird.

Die temporäre Bestellung erhält den Status `PENDING` sowie die Bestellnummer 0 (einstellungsabhängig).  
Die Einstellungen finden Sie in den Heidelpay-Modul-Einstellungen unter [ {$menutitle} ] / [ Einstellungen ] / [ Cronjob Einstellungen (iDeal und Przelewy 24) ].

Es wird zu diesem Zeitpunkt **keine E-Mail** versendet.<br>
Im Admin unter [ Bestellungen verwalten ] /[ Bestellungen ] /[ Tab {$menutitle} ] können Sie die Reservation `OT.PA` sehen.
