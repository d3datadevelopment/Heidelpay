---
title: Systemanforderungen
---

* PHP Version
    * 5.6.x bis 7.4.x
* PHP Decoder
    * installierter ionCube Loader
* Shopversionen / -editionen
    * OXID eShop Community Edition (CE), Professional Edition (PE) oder Enterprise Edition (EE) in Compilation Version 
        * 6.0.x
        * 6.1.x
        * 6.2.x
* Themes
    * azure
    * flow
    * wave
* D3 Modul-Connector ([kostenfrei bei D3 erhältlich](https://www.oxidmodule.com/connector/)) ab Version 5.3.0.0 
* Installation via [Composer](https://getcomposer.org)
* bei Verwendung der Zahlungsart „iDeal“ oder „Przelewy24“ wird ein freier Cronjob benötigt
* bei Verwendung der Zahlungsart „Vorkasse“ oder „Rechnungskauf“ wird ein freier Cronjob benötigt

Beachten Sie, dass die Ihnen vorliegende Modulversion entsprechend für **PHP 5.6**, **PHP 7.0**, **PHP 7.1**, **PHP 7.2**, **PHP 7.3** oder **PHP 7.4** sowie dem auf Ihrem Server vorhandenen Decoder (**ionCube Loader**) kompatibel ist. Im Zweifelsfall kontaktieren Sie uns und nennen den für Ihren Shop genutzten Decoder und die PHP-Version.

Kontrollieren Sie bitte auch, ob diese Modulversion für die von Ihnen eingesetzte Shopedition (Professional Edition (PE) oder Enterprise Edition (EE)) ausgelegt ist. 

### Hinweis:
> Durch composer werden die Abhängigkeiten direkt vor der Installation geprüft.  
> D.h. wenn eine der Anforderung nicht erfüllt ist, wird das Modul nicht installiert und die entsprechende Anforderung wird direkt auf der Konsole ausgegeben.
