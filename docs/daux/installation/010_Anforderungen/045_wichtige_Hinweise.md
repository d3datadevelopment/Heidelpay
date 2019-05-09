---
title: Wichtige Hinweise
---

zu Ihrem Heidelpay-Händlervertrag
================================
Nur relevant bei Zahltyp "Sofort by Klarna" und einem Update des Moduls.  
Das Modul nutzt für Sofort by Klarna eine spezielle Option der Heidelpay-Konfiguration, mit der Ihr Endkunde erst auf der Webseite von Sofort by Klarna seine Bankdaten eingeben muss.  
Diese Option muss jedoch erst in Ihrem Händlerkonto eingerichtet werden.  
Ohne diese Einstellung ist eine Nutzung des Zahltyp "Sofort by Klarna" nicht möglich!  
Lassen Sie daher vor dem Einspielen der vorliegenden Modulversion die Aktivierung der genannten Option in Ihrem Händlerkonto von Ihrem Heidelpay-Händlerbetreuer prüfen.  

Modulversion 6.0.0.0  
================================
Das Oxid Standard "Mobile-Theme" wird nicht mehr untersützt!

Modulversion 6.0.2.0
================================  
Nur EE:  
Mit dem kleinem Update 6.0.2.0 werden für die gespeicherten Daten die Shopid eingeführt.  
Damit wird unterbunden, dass Kunden auf die Referenzdaten aus anderen Subshops erhalten.  
Bitte führen Sie die folgende Abfrage manuell im Admin oder in der Datenbank aus:  
```sql
UPDATE d3hpuid, oxuser
SET d3hpuid.oxshopid = oxuser.oxshopid
WHERE d3hpuid.OXUSERID = oxuser.OXID
AND oxuser.OXSHOPID != d3hpuid.OXSHOPID;
```

Modulversion 6.0.3.0
================================
Die Zahlungsart Billsafe wird nicht mehr über das Heidelpay Modul angeboten.
