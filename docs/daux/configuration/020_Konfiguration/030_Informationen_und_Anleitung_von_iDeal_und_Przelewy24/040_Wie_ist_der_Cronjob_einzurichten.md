---
title: Wie ist der Cronjob einzurichten?
---

Die Datei unter [ /modules/d3/heidelpay/Cron/collectpayments.php ] muss eingebunden werden.

Folgende Parameter sind dafür erforderlich:
- via WWW Aufruf:
  - shp=oxshopid - oxshopid steht für die jeweilige Shop Ident
  - key=accessKey - accessKey ist der Key, der hier beschrieben wird: [Cronjob per Webaufruf einrichten](configuration/020_Konfiguration/020_Cronjob_einrichten/020_Cronjob_per_Webaufruf_einrichten.md)
  
Die fertige URL könnte so aussehen:
```bash
http://www.meinshop.de/modules/d3/heidelpay/Cron/collectpayments.php?shp=1&key=Sicherheitspasswort
```

- Aufruf via Konsole
  - shp=oxshopid - oxshopid steht für die jeweilige Shop Ident (nur EE relevant)

Der fertige Aufruf könnte so aussehen: 
```bash
php /ihr/serverpfad/zum/shop/modules/d3/heidelpay/Cron/collectpayments.php 1
``` 

Es gibt einen Bereich im Admin [ (D3) Module ] / [ {$menutitle} ] / [ Einstellungen ] / [ Stamm ] / [ Cronjob Einstellungen (iDeal und Przelewy24) ], hier können Sie die Einstellungen zum Cronjob vornehmen. 
> [i] In den Hilfetexten (mit einem ? gekennzeichnet) finden Sie eine Beschreibung zu den einzelnen Einstellungen.
