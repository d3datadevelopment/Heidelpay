---
title: Systemanforderungen
---

* PHP Version
    * 5.6.x bis 7.2.x
* PHP Decoder
    * installierter ionCube Loader
* Shopversionen / -editionen
    * OXID eShop Community Edition (CE), Professional Edition (PE) oder Enterprise Edition (EE) in Compilation Version 
        * 6.0.x
        * 6.1.x
* D3 Modul-Connector ([kostenfrei bei D3 erhältlich](https://www.oxidmodule.com/connector/)) ab Version 5.2.0.0 
* Installation via [Composer](https://getcomposer.org)
* bei Verwendung der Zahlungsart „iDeal“ oder „Przelewy24“ wird ein freier Cronjob benötigt
* bei Verwendung der Zahlungsart „Vorkasse“ oder „Rechnungskauf“ wird ein freier Cronjob benötigt

Bei Nutzung eines UTF-8 Shops wurde in Einzelfällen beobachtet, dass PHP mit der Option "enable-zend-multibyte" genutzt werden muss.

Beachten Sie, dass die Ihnen vorliegende Modulversion entsprechend für **PHP 5.6**, **PHP 7.0**, **PHP 7.1** oder **PHP 7.2** sowie dem auf Ihrem Server vorhandenen Decoder (**ionCube Loader**) kompatibel ist. Im Zweifelsfall kontaktieren Sie uns und nennen den für Ihren Shop genutzten Decoder und die PHP-Version.

Kontrollieren Sie bitte auch, ob diese Modulversion für die von Ihnen eingesetzte Shopedition (Professional Edition (PE) oder Enterprise Edition (EE)) ausgelegt ist. 

### Hinweis:
> Durch composer werden die Abhängigkeiten direkt vor der Installation geprüft.  
> D.h. wenn eine der Anforderung nicht erfüllt ist, wird das Modul nicht installiert und die entsprechende Anforderung wird direkt auf der Konsole ausgegeben.
