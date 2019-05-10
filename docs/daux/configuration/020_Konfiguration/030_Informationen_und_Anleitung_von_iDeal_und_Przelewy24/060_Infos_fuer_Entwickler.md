---
title: Infos für Entwickler
---

Bestellungen die über iDeal und Przelewy24 abgewickelt werden, gehen einen anderen Weg.  
Statt über `order::execute` wird vorher eine Bestellung in folgender Methode angelegt:  
`D3\Heidelpay\Controllers\Order::createOrder`
  
Danach wird der Kunde zu dem Zahlungsanbieter weitergeleitet.  
Der Kunde landet im Erfolgsfall auf der Thankyou Seite.  
Dabei wird kein `oxorder::finalizeOrder` ausgeführt!

Die Methode wurde in 2 Teile gesplittet:  
`d3_oxorder_heidelpay::d3CreateTemporaryOrder`  
`d3_oxorder_heidelpay::d3FinalizeTemporaryOrder`

Sollte der Cronjob lange benötigen, können Sie folgende Indexes setzen:
```mysql
ALTER TABLE `oxorder` 
  ADD INDEX `D3HPIDEALP24INDEX` (`OXSTORNO`, `OXTRANSSTATUS`) COMMENT 'index for d3 heidelpay ideal + przelewy24';
ALTER TABLE `d3_d3log_oxobject2d3transactionlog` 
  ADD INDEX `OXOBJECTID` (`OXOBJECTID`), ADD INDEX `D3GROUP` (`D3GROUP`);
```
