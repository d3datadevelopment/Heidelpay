---
title: Changelog
---
## 6.1.2.0 - (2020-05-12)
### added
- 0009705: Freigabe OXID 6.2

## 6.1.1.3 - (2020-04-03)
### changed
- ermöglicht Einsatz mit ModulConnector 5.3
- ermöglicht Installation in Projekten ohne "oxid-esales/oxideshop-metapackage-ce"

### fixed
- Abbruch bei Verwendung nicht zu Heidelpay zugewiesener Zahlart korrigiert

---

## 6.1.1.2 - (2020-03-19)
### fixed
- 0009550: Manipulationsprävention bei Zahlung mit abgesichertem Rechnungskauf integriert
- 0009539: fehlerhafte Aufrufe bei Ausführung des Cronjobs für Rechnungskauf oder Vorkasse korrigiert
- 0009540: fehlendes Admintemplate "d3_heidelpay_views_admin_tpl_channels_sub_prepayment.tpl" eingefügt
- 0009553: fehlende Bankdaten bei Vorkasse
- 0009554: cron_bankaccount.php - falscher Channel bei Vorkassse

---

## 6.1.1.1 - (2020-01-09)
### fixed
- 0009389: Modulversion 6.1.1.0 - Installation unvollständig (falsche Versionsnummer in Installationsroutine)

---

## 6.1.1.0 - (2020-01-03)
### added
- 0008760: add Wave Theme support

### changed
- 0000000: iDeal + Przelewy24 orders with no incoming payment and no "after lifetime action" will set to NOT_FINISHED after span of life  
- 0000000: missing active check of channel provider data integrated  
- 0000000: Initialization of JavaScript (web integration) heidelpayInstance may only be created once  

###fixed
- 0005712: Distinction between test and live configuration when assigning "Heidelpay Channel - Oxid Payment Methods"  
- 0009201: different modcfg version in composer.josn & InstallRoutine  
- 0000000: Inactive channel configuration was displayed in the frontend, if an active oxid-paymenttype-assignment exists  
- 0000000: OT payments are not redirecting, if user switch to OrderController and send order:execute again  
- 0000000: navigation on other language causes admin template language to standard (0)  
- 0000000: fixed use saved data doesn't work in wave -> missing post order execute parameter  

---

## 6.1.0.1 - (2019-10-07)
### fixed
0009155: 6.1.0.0: Too few arguments to function D3\Heidelpay\Controllers\Admin\Order\Heidelpay::isBasicLicence()  
0000000: 6.1.0.0: incorrect redirect to mydomain.tld/modules/d3/heidelpay/public/redirect -> should be redirect to payment/start page  

---

## 6.1.0.0 - (2019-09-25)

**Minor version upgrade notice: there are some backward-incompatible changes to this release.**

**0000000: [ Important ] the setup routine has a backwards compatibility break (BC break)! Only module configurations greater than or equal to modul version 6.0.0.0 will be fully migrated!**  
0000000: [ Configuration ] rebuild channel configuration see: [(6.1.0.0) Umstellung der Konfiguration](https://docs.oxidmodule.com/Heidelpay/6.1.0.0/changelog/Channel_Rekonfiguration.html)  
0000000: [ Refactor ] \D3\Heidelpay\Models\Factory class refactored to a factory pattern  
0000000: [ Refactor ] split /public/hp_response.php calls into separated front controller (f.e. /public/Creditcard.php, /public/Debitcard.php)  
0000000: [ Bug ] additional redirect parameters will not add in redirect url of the public response file's (like utm_nooverride=1)  
0000000: [ Info ] replaced https://faq.oxidmodule.com/ links with https://faq.d3data.de  

---

## 6.0.3.1 - (2019-06-07)
0008863: 6.0.3.0 Fehler bei nicht Heidelpay zugeordneten Zahlungsarten - keine Bestellung möglich  
0000000: [cronjob collectPayments] parameter FRONTEND.ENABLED=true causing a order delete for Przelewy24 and iDeal payments  
0000000: [cronjob collectPayments] set referenceid before temporaray order is finalized  
0000000: [cronjob collectPayments] reduced NOTICE in collectpayments.php 0000000: [general] added new criterion info parameter "heidelPaymentMethod"  
0000000: replaced deprecated method "getShopEdition" for request parameter  
0000000: changing url in metadata to https://docs.oxidmodule.com/Heidelpay/  

---

## 6.0.3.0 - (2019-05-09)
0008145: OT Zahlungsarten auf Länder und Währung einschränken  
0008577: Exception bei dem Versenden von d3SendHPErrorMessage  
0008263: Daux.io Umsetzung Heidelpay  
0000000: neue Zahlungsart B2B Rechnungskauf hinzugefügt

---

## 6.0.2.3 - (2019-03-08)
0008253: alte Trusted Shops Käuferschutz Kompatibilität entfernen  
0000000: Collation der Admin Sprachdateien auf UTF-8 gesetzt  
0008158: Zahlungstyp Billsafe entfernen  
0000000: [ Refactor ] \D3\Heidelpay\Models\Containers\Parameter

---

## 6.0.2.2 - (2019-01-09)
0008210: Transaktions-Fehlermeldung im Tab Order/Heidelpay anzeigen lassen  
0008237: [ Blocker ] Fehlermeldung beim Bestellabschluss  
0000000: Neues Model Models\Actions\Finalize  
0000000: [ Refactor ] \D3\Heidelpay\Models\Containers\Parameter::setMandatoryData  
0000000: [ Refactor ] \D3\Heidelpay\Models\Containers\Criterions\*  
0000000: [ Refactor ] Umbenennung der \D3\Heidelpay\Models\Actions\* Eigenschaften and Methoden  

---

## 6.0.2.1 - (2019-01-03)
0008148: [ Push ] E-Mail bei fehlender Bestellung  
0008154: Anzeige der Push Benachrichtigungs URL im Admin  
0008155: [ EE ] Updatescript für gespeicherte Kundendaten bereit stellen  
0008156: divs in flow templates ergänzen  

---

## 6.0.2.0 - (2018-12-05)
0007899: Push Notifications integriert  
0000000: WAITING Status auf PENDING gestellt  
0007921: Feldbegrenzungen in der Basket Api validieren  
0007480: [ Konfiguration ] neuer Eintrag Limits für (gesicherten) Rechnungskauf einstellen  
0008113: precheck entfernen  
0008143: [ EE ] Shopid für gespeicherte Referenzdaten anlegen  
0007483: FONTEND.ENABLED sollte immer übertragen werden  
0006751: WAITING Status an Bestellung weitergebe

---

## 6.0.1.3 - (2018-11-01)
0008030: IBAN Anfangsbuchstaben müssen immer groß geschrieben werden  
0007945: Doppelklick führt zu doppelten Bestellungen/Abbuchungen  
0007906: Endlosschleife in automatischer Installation

---

## 6.0.1.2 - (2018-08-20)
0007856: 6.0.3 / 6.1.0 veraltete obsolete dynvalues wurden validiert (Bankeinzug + Giropay)

---

## 6.0.1.1 - (2018-08-08)
0007756: EPS - Ablehnung da falsches Land übertragen wurde - ACCOUNT.COUNTRY  
0007812: Änderungen Flow 3.0.2 übernehmen (OXID Compilation 6.1.0)  
0007820: Freigabe 6.1.0  
0007817: Mobile theme Unterstützung entfernen
 
---

## 6.0.1.0 - (2018-05-22)
0005802: Postfinance Integration  
0007283: EasyCredit Korrekturen  
0007214: d3hpprepaymentdata::getTransaction selektiert falsch bei gesichert. Rechnungskauf  
0007328: Chargeback entfernen  
0007422: Fehlertexte werden teilweise allgemein ausgegeben  
0007388: Umfirmierung der Heidelberger Payment GmbH in heidelpay (GmbH)  
0000000: extended logging of initial ngw requests  

---

## 6.0.0.1 - (2018-04-26)
0007418: fixed d3/modcfg::d3counter calls have to be case sensitive     

---

## 6.0.0.0 - (2018-03-19)

**Minor version upgrade notice: there are some backward-incompatible changes to this release.**

0000000: migration to oxid-esales/oxideshop-ce v6.1.0 | dropping support below v6.1.0  
0000000: fixed error was shown on changing currency marked viewconfig…  
0000000: added d3transactionlog to bankaccount (prepayment)  
0000000: improved logging (request to Heidelpay:: {Info})  
0000000: migrated e-mail templates to oxid standard  
0000000: removed giropay dynvalue checks  
0000000: Giropay doesn't provide bank/account information in a PA  
0000000: language files in utf-8  
0000000: using oxids metadata version 2.0  
0000000: using namespaces  
0000000: using composer installation

---

## 5.3.0.0
0006668: Easycredit implementieren  
0006745: Sofortüberweisungslogo + Texte ersetzen

#### 5.2.3.4
0004941: Css Dateipfad für das iFrame mitgeben  
0006384: Altlasten-Mehrsprachigkeit können zu mehreren Fehlverhalten führen  
0006626: 3D Secure Prüfung wird bei gespeicherten Daten übersprungen  

#### 5.2.3.3
0006552: Geburtsdatum bei gesicherter Lastschrift ergänzen.  
0006396: fehlende (zweite) Bonitätsprufung bei Rechnungskauf  
0006441: Heidelpay metadata.php enthäl ö im Klassennamen - v5.2.3.2  
0006291: Warnung bei leerer XML Übergabe  
0000000: fixed bug in mobile theme on error message, wrong template name was loaded  
0000000 set "no reference but heidelpay payment" warning to error level  

#### 5.2.3.2
0000000: var_dump Ausgabe entfernt (copy_this/modules/d3/d3heidelpay/views/flow/tpl/payment/debitnote.tpl)  
0000000: (iDeal/Przelewy24) wenn oxorderdate 0 ist oder nicht interpretiert wird, kann die Bestellung storniert/gelöscht werden  

#### 5.2.3.1
0006291: DOMDocument::loadXML im Modul überprüfen  
0000000: hp_response.php ermöglicht kein redirect mehr

### 5.2.3.0
0000000: Support für 4.7.x und 4.8.x ist eingestellt  
0000000: Parameter name.company in Standard-Parameteriste aufgenommen  
0000000: erweitertes Exception-Handling in d3_hp_response bei nicht-Heidelpay-Zahlungsarten  
0006181: http_build_query 3. Parameter arg_separator & übergeben  
0005673: JavaScriptaktualisierung Frontendumsetzung  
0005496: Altdateien und Shopweichen im Modul entfernen  
0004877: iDeal nur für unterstützte Währungen anzeigen  
0002355: E-Mails in der Sprache der Bestellung versenden  
0006138: Fehlerhafte Überladung in Block/Template select_payment.tpl 5.2.2.0  
0004098: falsches Tacking in Google Analytics, Notwendig: zusätzlich definierbare Parameter  
0003228: Lieferadressen bei Zahlung mit gesicherten Rechnungskauf/Lastschrift und paypal kontrollieren  
0001921: Transaktionsübersicht im Admin anlegen  
0006142: Integration gesicherte Lastschrift  
0006141: Basket API für gesicherten Rechnungskauf/Lastschrift integrieren  
0002025: Hilfetexte und Layout im Shopadmin  
0005157: Kunden-IP statt Heidelpay-IP bei Paypal-Zahlungen an oxorder hinterlegen  
0002678: Einstellung "Kontodaten vollständig speichern?" entfernen  

### 5.2.2.0
0004201: Button "Reversal (REV)" im Shopbackend ergänzen  
0005030: Anpassung des Moduls auf das Flow-Theme  
0005590: Bankdaten und Shortid an Endkunden weiterreichen  
0005715: Kompatibilität mit tronet Sofortüberweisung hergestellt  
0005835: CRITERION-Tags im Admin sichtbar machen  
0005891: Refactoring der Templatestruktur
die Template Struktur wurde in der metadata.php geändert (von -> zu) :     
<table>
<tr><td>d3_d3heidelpay_controllers_admin_order_heidelpay.tpl</td><td>-></td><td>d3_d3heidelpay_views_admin_tpl_order.tpl</td></tr>  
<tr><td>d3_d3heidelpay_controllers_admin_settings.tpl</td><td>-></td><td>d3_d3heidelpay_views_admin_tpl_settings.tpl</td></tr>  
<tr><td>hp_prepayment_cust_html.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_email_html_prepayment_cust.tpl</td></tr>  
<tr><td>hp_prepayment_cust_subj.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_email_html_prepayment_cust_subj.tpl</td></tr>  
<tr><td>hp_prepayment_owner_html.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_email_html_prepayment_owner.tpl</td></tr>  
<tr><td>hp_prepayment_owner_subj.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_email_html_prepayment_owner_subj.tpl</td></tr>  
<tr><td>hp_prepayment_cust_plain.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_email_plain_prepayment_cust.tpl</td></tr>  
<tr><td>hp_prepayment_owner_plain.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_email_plain_prepayment_owner.tpl</td></tr>  
<tr><td>payment_heidelpay_img.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_payment_img.tpl</td></tr>  
<tr><td>heidelpay_cc_input.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_cc_input.tpl</td></tr>  
<tr><td>heidelpay_order_3ds.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_order_3ds_iframe.tpl</td></tr>  
<tr><td>heidelpay_order_3ds_iframe.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_order_3ds_iframe.tpl</td></tr>  
<tr><td>payment_heidelpaycards.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_cards.tpl</td></tr>  
<tr><td>payment_inc_storeduid.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_storeduid.tpl</td></tr>  
<tr><td>payment_heidelpaybillsafe.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_billsafe.tpl</td></tr>  
<tr><td>payment_heidelpaydebitnote.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_debitnote.tpl</td></tr>  
<tr><td>payment_heidelpayeps.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_eps.tpl</td></tr>  
<tr><td>payment_heidelpaygiropay.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_giropay.tpl</td></tr>  
<tr><td>payment_heidelpayideal.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_ideal.tpl</td></tr>  
<tr><td>payment_heidelpaysofort.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_sofort.tpl</td></tr>  
<tr><td>payment_heidelpaypostfinance.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_postfinance.tpl</td></tr>  
<tr><td>payment_heidelpaypaypal.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_paypal.tpl</td></tr>  
<tr><td>payment_heidelpayprzelewy24.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_przelewy24.tpl</td></tr>  
<tr><td>payment_heidelpaymasterpass.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_payment_masterpass.tpl</td></tr>  
<tr><td>heidelpay_redirect_postformular.tpl</td><td>-></td><td>d3_d3heidelpay_views_tpl_redirect_postformular.tpl</td></tr>  
<tr><td>heidelpay_order_iframe.tpl</td><td>-></td><td>d3_d3heidelpay_views_azure_tpl_order_iframe.tpl</td></tr>  
<tr><td>heidelpay_cc_input_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_cc_input.tpl</td></tr>  
<tr><td>heidelpay_order_3ds_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_order_3ds.tpl</td></tr>  
<tr><td>heidelpay_order_3ds_iframe_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_order_3ds_iframe.tpl</td></tr>  
<tr><td>payment_inc_storeduid_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_storeduid.tpl</td></tr>  
<tr><td>payment_heidelpaycards_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_cards.tpl</td></tr>  
<tr><td>payment_heidelpaysofort_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_sofort.tpl</td></tr>  
<tr><td>payment_heidelpaydebitnote_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_debitnote.tpl</td></tr>  
<tr><td>payment_heidelpayeps_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_eps.tpl</td></tr>  
<tr><td>payment_heidelpaygiropay_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_giropay.tpl</td></tr>  
<tr><td>payment_heidelpayideal_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_ideal.tpl</td></tr>  
<tr><td>payment_heidelpaybillsafe_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_billsafe.tpl</td></tr>  
<tr><td>payment_heidelpaypaypal_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_paypal.tpl</td></tr>  
<tr><td>payment_heidelpayprzelewy24_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_przelewy24.tpl</td></tr>  
<tr><td>payment_heidelpaymasterpass_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_masterpass.tpl</td></tr>  
<tr><td>payment_heidelpaypostfinance_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_payment_postfinance.tpl</td></tr>  
<tr><td>heidelpay_order_iframe_mobile.tpl</td><td>-></td><td>d3_d3heidelpay_views_mobile_tpl_order_iframe.tpl</td></tr>
</table>

#### 5.2.1.1
0005524: mehrfach gespeicherte Daten anzeigen  
0005235: es wird kein PA/DB bei gespeicherten Daten genutzt  
0005419: XML Query wird im paymentcollector nicht korrekt übergeben  
0005405: Kein Fehlerhandling im Frontend beim iFrame  
0005470: IonCube Umsetzung  
0000000: removed payment::hasUserHPStoreData, payment::getUserHPStoreData, payment::getHPWrappedPayment  
0000000: probably bug in d3_oxorder_heidelpay::finalizeOrder  
0000000: fixed memcache bug in collectpayments process  
0000000: payment model not found causes exception in admin  

### 5.2.1.0
0002681: Kunden die während Formulareingaben in ein Session timeout kommen  
0000000: Bestellbenutzer wird bei Admin Aktionen nicht gesetzt  
0005301: Abgebrochene Bestellabwicklungen an den Händler melden    
0005320: MasterPass Integration  
0005289: Sprache ist im Admin auswählbar  
0005222: ReferenceId nach Schritt4 prüfen  
0005081: order::execute() Rüchgabewert Fehlerhaft  
0005300: Warenkorbwert kann gegenüber dem Transaktionbetrag manipuliert werden  
0005170: Bestellung- Tab Heidelpay - Aktionen klappen nicht auf  
0000000: PRESENTATION.USAGE wird nicht übergeben  
0000000: PA soll auch bei "gespeicherte Daten verwenden" genutzt werden  
0005202: betrifft EE: cronjob für PP und IV ignoriert ShopId  
0005189: bei gespeicherten Daten (Kredit-/Debitkarte) fehlen die zu übergebenden Parameter (agb, download etc)  
0005188: falsche Rücksprungbehandlung bei erfolgreichen Billsafe Bezahlungen  
0005103: Heidelpay iFrame wird zerschossen angezeigt

#### 5.2.0.1  
Installationsroutine kann nicht abgeschlossen werden  
neue Debitkarten hinzufügen  
NGW geladene Icons sollen in eigene Templates (für Azure und Mobile ausgelagert werden)  
Hilfetext für "Pflichtfelder für den Bestellabschluss"  
möglicher Fehler: Fehlerfälle von order::execute testen  
unvollständige / inkorrekte version_compare innerhalb des Moduls bei EE 5.0.x  
Nachkommestellen durch Punkt trennen  
Mobile theme lauffähig machen  
4.7.x ready machen  
Geburtstdatum übergeben  
Inkorrektes Handling mit Gutscheinen

## 5.2.0.0  
Implementierung PCI3 (Kartenzahlung via iFrame)  
Umstellung von SGW/XML auf NGW/POST  
neue Option "Registierung für Karten nutzen (Kreditkarte, Debitkarte)" hinzugefügt  
neuer Menüpunkt /D³ Module/Heidelpay/Logging/  
Fehlverhalten im JavaScript mit einer deaktivierten Zahlungsart gelöst  
das Oxid Standard "Mobile-Theme" wird bis zum nächsten Update nicht untersützt!  
Auflösung der Formularstruktur im Bestellschritt 3 (Versand & Zahlung)  
generelle Weiterleitung bei 3DSecure  
Bankeinzug Kundendaten werden nun im Shop gespeichert

#### 5.1.1.2  
neue Zahlungsart Przelewy24  
Updateassistent startet nicht bei Update von 5.1.1.0 auf 5.1.1.1  
Erweiterung für Pflichtfelder bei einem Update  
NGW: Curl-Error-Handling implementieren  
NGW-Informationen für "nach Schritt 4"  
Anpassung des Mobile-Themes für NGW  
5.1.0.0 ist nicht in der 4.7 einsetzbar

#### 5.1.1.1  
Pflichtfelder für den Bestellabschluss  
Installationsanleitung aktualisieren  
Changelog nachtragen

### 5.1.1.0  
Integration der NGW-Schnittstelle  
Zahlart T-Pay Online Überweisung aus Heidelpay-Modul entfernen (5er-Version)  
Aktive Brands(Kartentypen, etc..) von der NGW-Response nutzen  
fake User-Checkboxen anpassen  
URL-Einstellungen aus den Moduleinstellungen entfernen  
NGW Implementation in latin-Shop testen  
Umlaute an Zahlarten bei Installation Fehlerhaft  
Bei ELV mit DE-Konto soll das BIC-Feld ausgeblendet werden.  
5.1.0.0 ist nicht in der 4.7 einsetzbar

## 5.1.0.0  
Anpassung für Oxid Mobile Theme  
kleiner Bug im Zusammenhang mit Billpay  
Übermittlung abweichende Lieferadresse an PayPal

#### 5.0.0.4  
Bugfix für automatische Installation  
Sprachdateien unverschlüsselt belasst  
neues Logo Billsafe  
Anpassung der Ausgabe bei gespeicherten Daten und dem SEPA-Modus  
Test auf 4.9 / 5.2

#### 5.0.0.3  
Kompatilität mit Modul Amazon Payments hergestellt  
Templates angepasst damit es bei einer Deaktivierung des Moduls nicht zu Fehlermeldungen kommt

#### 5.0.0.2  
Bugfix: im Shop aktives Modul, über Modul-Connector inaktiv, kann im Bestellschritt 3 nicht abgesendet werden  
fehlende sh-Datei nachgetragen  
Dokumentation überarbeitet

#### 5.0.0.1  
Bugfix: Während eines Update wurden die Zuordnungen zwischen Shop und Heidelpay-Modul nicht übernommen  
Kompatibilität zu PHP 5.2 wieder hergestellt

# 5.0.0.0  
Refactoring zur Oxid Zertifizierung

### 4.0.6.0  
Kompatilität mit Skrill-Modul hergestellt #2465  
Update der Systmprüfung (d3precheck.php) #2480

#### 4.0.5.4  
alte Moduleinstellungen von 3.x werden beim Update auf 4.x migriert  
Bugfix: Bei Bezahlung mit Billsafe kam im Shop eine Fehlermeldung, wenn mehr als 7 Artikel in den Warenkorb gelegt wurden

#### 4.0.5.3  
Hinweis auf Umstellung des Händlerkontos (nur bei Sofortüberweisung) in die Installationsanleitung eingefügt  
Bugfix: Bei Nutzung von Sofortüberweisung konnte es im Zusammenhang mit SEPA zu Fehlermeldungen kommen

#### 4.0.5.2  
Bugfix: Wichtige Sicherheitslücke in der Modulkonfiguration geschlossen

#### 4.0.5.1  
Bugfix: In BS4 wurde unter bestimmten Situationen eine Exception geworfen, wenn andere Module ebenfalls die Klasse 'order' erweitern

### 4.0.5.0  
SEPA-Modus integriert
  - im Adminbereich kann nun SEPA aktiviert werden (Schaltet bei Lastschrift, Giropay, Rechnungskauf und Vorkasse auf IBAN/BIC um)
  - Überweisungsdaten für BillSAFE, Rechnungskauf und Vorkasse zeigen nun IBAN/BIC in BS5 und EMails
  - Integration von SEPA-Prüfroutinen bei Giropay
  
Sofortüberweisung benötigt keine Kontodateneingabe in BS3 mehr (Änderung des Händlerkontos bei Heidelpay nötig)  
iDeal Bankenliste aktualisiert  
Bugfix: Sind Kontodaten mit * maskiert, werden sie nicht mehr in BS3 bei Bestandskunden vorausgefüllt  
Bugfix: fehlende Buchungsaktionen an den Bestellungen hinzugefügt

#### 4.0.4.1  
Fehler in automatischer Installation behoben  
Precheck aktualisiert

### 4.0.4.0  
Anpassung für OXID eShop 4.8.x / 5.1.x  
Integration Transaktionslog  
Integration Neues Admin Interface (unter Bestellungen, Tab "Heidelpay")  
Sofortüberweisung unterstützt nun auch österreichische Bankkonten  
Fehlercodetabelle aktualisiert  
Bugfix: Bei Zahlungsart Giropay fehlte das Eingabefeld für den Kontoinhaber  
Bugfix: Bei Zahlungsart Billsafe werden die Überweisungsdaten nun korrekt nach Bestellungsende aus der Session entfernt  
Bugfix: Bei einigen Zahlungsarten gab es Probleme mit Umlauten in UTF8-Shops  
Install-PDF überarbeitet, PreCheck v3.0 integriert

#### 4.0.3.3  
Bugfix: automatische Installation des Moduls reagierte nicht

#### 4.0.3.2  
php5.4 STRICT_STANDARDS-Fehler wurden behoben  
BillSafe UTF-8 Problem (doppeltes encoding als UTF-8 String bei UTF-8 Shops) wurde behoben

#### 4.0.3.1  
Zahlungsart Paypal ist auch im Basic-Modul konfigurierbar

### 4.0.3.0  
Zahlungsart Billsafe hinzugefügt  
Zahlungsart Rechnungskauf hinzugefügt  
Zahlungsart PayPal hinzugefügt  
Integration der Automatischen Installation  
Fehler bei Basic/Premium im Admin gefixt  
Zahlungsart T-Pay entfernt

### 4.0.2.0  
Integration Basic / Premium Unterscheidung

### 4.0.1.0  
Debitkarte "Dankort" hinzugefügt  
Fehlertexte der Fehlercodes werden nun aus lang-Dateien geholt (damit kann die normale Mehrsprachigkeit des Shops genutzt werden)  
Umstellung aller buchungsrelevanten TransaktionIdents auf einen eigenen Nummernkreis  
ShopId wird nun mit an die Response-Url übergeben

# 4.0.0.0  
komplette Überarbeitung des Moduls für die neue Shopstruktur EE5/PE47

#### 3.2.3.1  
Bugfix: bei nicht 3DSecure Karten und Einstellung "nach Schritt" 4

### 3.2.3  
Dummy Kreditkarten für 4.6.x entfernt  
checkout.css aus der payment_ext.tpl entfernt

### 3.2.2  
Änderungen für Shopversion ab 4.6.0 integriert  
kleinerer JS-Fehler in payment-Template behoben  
NOK-Rückmeldungen werden nun als "response error" geloggt  
neue Testdaten für Sofortüberweisung integriert  
mod_cfg -> Requirements eingebaut

### 3.2.1  
neue Admineinstellungen (Curl-Timeout, Unmask) eingebaut  
div. Fehler bei der Nutzung der Basic-Templates (4.5) behoben  
Version kann nun auch uneingeschränkt in Shopversionen < 4.5 genutzt werden

## 3.2.0  
Version für OXID ab 4.5.0

### 3.1.1  
Änderung der Sprache nach einer Heidelpaytransaktion

## 3.1  
Einbau neuer Zahlmethoden
- Sofortüberweisung
- Giropay
- iDeal Niederlande
- EPS Österreich
- T-Pay
- automatische Vorkasse

Speicherung der Registrierungsdaten für Heidelpay für erneute Zahlungen bei Kreditkarte, Bankeinzug und Debitkarten unter Bestellschritt 3.  
    Damit wird beim erneuten Einkauf dem Kunden angeboten mit denselben Karten oder Bankdaten einzukaufen ohne erneut
    die Daten einzugeben bzw. an Heidelpay zu senden zu müssen. Der Händler spart zusätzlich die Kosten für eine Transaktion.
    Dieses ist standardmäßig ausgeschalten und kann wahlweise im Shopadmin über den Haken "Gespeicherte Daten dem Kunden anbieten?" aktiviert werden.  
Einbau neuer Logos für fast alle Zahlmethoden und Kartentypen.  
Überarbeitung aller Templates  
Aktualisierung der Heidelpay-Fehlercodes  
Admin-Interface mit eigener language-Datei  
Aktualisierung menu.xml

### 3.0.4  
Anpassung des Moduls an neue Sicherheitsstruktur des OXID Version 4.3.0 (TrustIPs, sToken)  
Timeout beim Aufrufen der 3DS-Fehlerseite mit "KK-Eingabe nach Schritt4"  
Problem mit mehrfachen 3DS Aufrufen bei "KK-Eingabe nach Schritt4" behoben  
3DS-Fehlerseite für "KK-Eingabe nach Schritt4" und "KK-Eingabe in Schritt3" optimiert

### 3.0.2  
Heidelpaytransaktionen konnten in den Shopfolgesprachen (Language 1 etc.) nicht abgeschlossen werden  
Sproradischer Verlust der Session nach Rücksprung vom Heidelpay-Server ab OXID 4.1.3
  - Behebung durch zusätzlichen config-Parameter  
Teilweise Probleme mit Shoprücksprung nach fehlerhafter 3DSecure-Eingabe

### 3.0.1
neu  
Multilang-Platzhalter eingebaut

Fix  
Korrektur der order-Erweiterung, da mit Shopversion 4.1.1 die Prüfung zum Widerrufsrecht geändert wurde  
Änderung der Prüfungsparameter für 3DSecure

# 3.0
Kompletter Neuaufbau des Moduls für den Einsatz unter OXID 4.
Optimierung aller Modulteile. Dadurch u.a. schnellere Abarbeitung der Heidelpay-Daten.

## 2.1
####neue Funktionen:  
- Einbau einer alternativen Bezahlung mit Kreditkarte nach Schritt 4 im Bestellvorgang (Aktivierung im Admin)
  Damit wird die zusätzliche "Registierung" des Kunden bei Heidelpay nicht genutzt und der Shopinhaber hat nur 1x Transaktionsgebühren pro Bestellung  
- KK- und Bankkarten - Daten werden aus den Heidelpay-Responsedaten ausgelesen und in die Session als Dynvalue gespeichert.  
  -> Wichtig für eFire / creditPass-Boniprüfung
Zusätzlich werden die KK- und ELV-Daten im Shop gespeichert, um im Schritt 3 bei wiederholter Zahlung diese anzuzeigen
Achtung! Die KK-Nummer wird lediglich mit den letzten 4 Stellen gespeichert!  
- Optionen für Test-Betrieb erweitert
####Korrekturen:  
Anpassung der tpls an den aktuellen OXID-Versionsstand 3.0.4.1 (steps-tpl und css-Dateien)  
bei Nutzung anderer oxpaymentgateway-Module (z.B. Paypal Pro) werden diese nun korrekt in den Modulbaum eingebunden und aufgerufen  
Korrektur der 3DS-Funktionalität. Es konnte unter bestimmten Voraussetzungen passieren, das Bestellungen nicht ordnungsgemäß erstellt wurden.  
Behebung einer Smarty-Fehlermeldung im 3DS-iFrame  
Es wurden einige "onclick" in der payment_ext.tpl entfernt, da dadurch teilweise Kunden versehentlich andere Zahlartenangeklickt hatten

# 2.0  
Integration von 3DSecure

## 1.2
Kleinere Korrekturen. u.a. Behebung eines Sprachproblems (Domainzuordnung)

## 1.1  
Einbau der kompletten Heidelpay-Systemcodes und Ausgabe in Schritt3 als deutsche Fehlermeldung  
Speicherung des Heidelpay-Registrationcodes für Folgebestellungen ohne erneute Registration des Kunden  
Korrektur kleinerer Bugs im Modul und tpl-Dateien  
TransactionID zusätzlich mit Timestamp belegt, um mehrfache Bestellversuche zu ermöglichen

# 1.0  
Korrektur des formulars der payment_ext.tpl für ELV

# 1.0 beta:  
Rückgabe in hp_response.php per curl  
Einbau ELV
