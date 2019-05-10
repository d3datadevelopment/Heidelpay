---
title: Automatische Vorkasse und Rechnungskauf
---

> [!] Sofern Sie die Zahlungsart "automatische Vorkasse" oder "Rechnungskauf" über Heidelpay NICHT nutzen, können Sie auf die nächste Seite blättern.

## Ablauf bei "automatische Vorkasse" und "Rechnungskauf"
Eine "Vorkasse"- bzw. "Rechnungskauf"-Bestellung wird zum Zeitpunkt der Bestellung das Feld `Interner Status` _"oxtransstatus"_ auf `PENDING` gestellt.

Bei Nutzung dieser Zahltypen prüft der Cronjob auf vorhandene Zahlungseingänge bei Heidelpay.

Werden vorhandene Zahlungseingänge an den Shop übermittelt, so werden diese mit den gespeicherten Bestellungen abgeglichen.

Wird eine korrekte Zahlung ermittelt, so wird `Interner Status` _"oxtransstatus"_ auf `OK` geändert, sowie das Feld `Bezahlt am` _"oxpaid"_ mit dem Zeitpunkt (Datum & Uhrzeit) der Bezahlung gefüllt.

Weiterhin wird an den Kunden und den Shopinhaber, eine Informations-E-Mail über den Erhalt der Zahlung geschickt.

Für die Formatierung der Mails stehen E-Mail-Templates zur Verfügung unter<br> `/modules/d3/heidelpay/views/tpl/email/*`.

Den E-Mail-Inhalt liefern CMS-Texte, die mit dem Modul installiert wurden.<br>
Diese finden Sie im Admin unter [ Kundeninformationen ] / [ CMS-Seiten ] beginnend mit <br>
dem Ident _"d3_hp_vorkassemail"_ und <br>
dem Titel _"Heidelpay Vorkasseinfomail"_.
<br>
> **Hinweis:**
> Sollte die Höhe der Zahlung von dem Bestellwert abweichen, werden folgende Schritte durchgeführt:
> -  Der _"Interner Status"_ (oxtransstatus) der Bestellung wird auf _"ERROR"_ gestellt und das Feld _"Bezahlt am"_ (oxpaid) bleibt unverändert.
> -  Weiterhin werden E-Mails an Kunde und Shopinhaber gesandt, die auf die fehlerhafte Zahlung hinweisen.


## Einrichtung eines Cronjob
Für die Zahlungsarten "automatische Vorkasse" und "Rechnungskauf" ist ein Cronjob einzurichten.<br>
Dieser sorgt dafür, dass täglich mehrmals ein Abgleich eingegangener Zahlungen zwischen Shop und Heidelpay erfolgt.<br>
Wir empfehlen das Starten des Jobs 2-3x pro Tag. z.B. vormittags, nachmittags und abends.<br>
Weitere Informationen zum Anlegen von Cronjobs finden Sie in unserer <a href="http://faq.oxidmodule.com" target="http://faq.oxidmodule.com"> FAQ</a>.

##Wichtiger Sicherheitshinweis
 Verhindern Sie den Aufruf von .sh-Dateien via Browser.
 Erweitern Sie z.B. die ".htaccess"-Datei des Shops um folgende Zeilen:
```apacheconfig
<Files *.sh>
    <IfModule mod_authz_core.c>
        # htaccess - apache 2.4
        Require all denied
    </IfModule>
    <IfModule !mod_authz_core.c>
        Order allow,deny
        Deny from all
        Satisfy All
    </IfModule>
</Files>
```
