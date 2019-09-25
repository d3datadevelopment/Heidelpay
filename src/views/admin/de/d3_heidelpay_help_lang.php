<?php

$sLangName = "Deutsch";
$iLangNr   = 0;
$aLang     = array(
    'charset'                                               => 'UTF-8',
    'HELP_D3DYN_HEIDELPAY_PARAM_CARDS_USE_RG'               => 'Bei aktiver Option wird vor einer ' //
        . 'Belastung/Reservierung eine Registierung für Karten durchgeführt.' //
        . '<br>Das betrifft die Kreditkarten- und Debitkartenzahlungsarten.' //
        . '<br><br>Auf eine Registrierung können zusätzliche Buchungen ausgeführt werden (bspw. im HIP).' //
        . '<br><br>Die Registrierung gilt als zusätzliche Transaktion, es fallen Gebühren dazu an ' //
        . '(Informationen dazu können Sie bei Ihrem Heidelpay Berater erfragen).',
    'HELP_D3HEIDELPAY_sD3HpHFOrderPendingTime'              => 'Stellen Sie hier die Zeit in Stunden ein, ' //
        . 'wie lange eine PENDING-Bestellung unver&auml;ndert bleibt.<br>'//
        . 'Nach Ablauf der Zeit greift die Einstellung "Aktion nach Lebenszeit".<br>' //
        . 'Tragen Sie eine 0 ein, um keine Aktion durchzuf&uuml;hren.<br>' //
        . 'Heidelpay emfiehlt eine Einstellung auf mindestens 26 Stunden.',
    'HELP_D3HEIDELPAY_sD3HpHFOrderCancelType'               => 'W&auml;hlen Sie die Art, wie die PENDING-Bestellungen abgearbeitet werden.',
    'HELP_D3HEIDELPAY_sD3HpHFOrderLimit'                    => 'Bei vielen Bestellungen kann es zu Ressourcenlimits des Servers kommen.<br>' //
        . 'Daher können Sie hier ein Limit für die Anzahl der zu bearbeitenden Bestellungen angeben.<br>' //
        . '100 ist Standard, kann je nach Bedarf angepasst werden.',
    'HELP_D3HEIDELPAY_blD3HpHFSetZeroOrderNumber'           => 'Ist diese Option inaktiv, werden Shop-Bestellungen ' //
        . 'mit fortlaufenden Bestellnummer generiert.',
    'HELP_D3DYN_HEIDELPAY_ACTIVE'                           => 'Aktivieren Sie diese Option, damit das Heidelpay-Modul ' //
        . 'generell in den Bezahlprozess eingreift. Alle Heidelpay zugeordnete Zahlungsarten werden dann ' //
        . 'entsprechend verarbeitet.',
    'HELP_D3DYN_HEIDELPAY_TESTMOD_ACTIVE'                   => 'Bei aktivem Testmodus wird mit dem Heidelpay-Testserver ' //
        . 'statt des Liveservers verbunden. <br><br>' //
        . 'Im Testmodus benötigen Sie Testdaten (Loging, Channels, Testkarten, etc.) von Heidelpay. Diese müssen auch ' //
        . 'an den Moduleinstellungen hinterlegt werden.<br><br>' //
        . '<b>Hinweis: <br>Testdaten erhalten Sie direkt von ' //
        . '<a href="https://dev.heidelpay.de/testumgebung/" target="heidelpay">Heidelpay</a>.</b>',
    'HELP_D3DYN_HEIDELPAY_LOGIN_LIVE_HEADER'           => 'Für den Livebetrieb werden Ihre Heidelpay-Daten benötigt. ' //
        . 'Diese werden nur bei <b>inaktivem Testmodus</b> genutzt.<br><br>' //
        . 'Tragen Sie Ihre Daten in die folgenden Felder ein. ' //
        . '<b>Die Livedaten werden Ihnen von Heidelpay bereitgestellt!</b><br><br>' //
        . 'Sollte nach Eingabe Ihrer Daten das Modul nicht ordnungsgemäß arbeiten, kontrollieren Sie die Werte ' //
        . 'auf Richtigkeit und fragen beim Heidelpay-Support nach, ob der Account mit allen gewünschten Zahlungsarten ' //
        . 'aktiv ist.',
    'HELP_D3DYN_HEIDELPAY_LOGIN_TEST_HEADER' =>  'Die folgenden Felder enthalten nach der Erstinstallation <b>Demodaten</b> zum Testen des Moduls. ' //
        . 'Diese werden nur im <b>aktivem Testmodus</b> genutzt.<br><br>' //
        . 'Sollte nach Eingabe Ihrer Daten das Modul nicht ordnungsgemäß arbeiten, kontrollieren Sie die Werte ' //
        . 'auf Richtigkeit und fragen beim Heidelpay-Support nach, ob der Account mit allen gewünschten Zahlungsarten ' //
        . 'aktiv ist.',
    'HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE'                => 'Hier stehen folgende Optionen zur Verfügung:<br><br>' //
        . '<ul>' //
        . '<li><b>\'Betrag sofort abbuchen\'</b><br> Die Karte des Kunden wird sofort nach Bestellabschluss belastet.</li>' //
        . '<li><b>\'Betrag nur reservieren\'</b><br> Der Betrag wird einige Tage reserviert und kann später im ' //
        . 'Heidelpay-HIP gebucht werden.<br>Es sind hier Teilbuchungen / Stornierungen möglich. ' //
        . 'Details erfahren Sie vom Heidelpay-Support.</li>' //
        . '<li><b>\'Inland buchen, Ausland reservieren\'</b><br> Mix der beiden Auswahloptionen für die Kundengruppen ' //
        . '"Inlandskunde" und "Auslandskunde</li>' //
        . '</ul>',
    'HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_PAYPAL'         => 'Hier stehen folgende Otionen zur Verfügung:<br><br>' //
        . '<ul>' //
        . '<li><b>\'Betrag sofort abbuchen\'</b><br> Das Paypal-Konto des Kunden wird sofort nach Bestellabschluss ' //
        . 'belastet.</li>' //
        . '<li><b>\'Betrag nur reservieren\'</b><br> Der Betrag wird einige Tage reserviert und kann im ' //
        . 'Heidelpay-HIP gebucht werden.<br>Es sind auch Teilbuchungen / Stornierungen möglich. Details erfahren ' //
        . 'Sie vom Heidelpay-Support.</li>' //
        . '</ul>',
    'HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECTDEBIT'    => 'Hier stehen folgende Otionen zur Verfügung:<br><br>' //
        . '<ul>' //
        . '<li><b>\'Betrag sofort abbuchen\'</b><br> Das Paypal-Konto des Kunden wird sofort nach ' //
        . 'Bestellabschluss belastet.</li>' //
        . '<li><b>\'Betrag nur reservieren\'</b><br> Der Betrag wird einige Tage reserviert und kann im ' //
        . 'Heidelpay-HIP gebucht werden.<br>Es sind Teilbuchungen / Stornierungen möglich. Details erfahren ' //
        . 'Sie vom Heidelpay-Support.</li>' //
        . '</ul>',
    'HELP_D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS'     => 'Hier stehen folgende Otionen zur Verfügung:<br><br>' //
        . '<ul>' //
        . '<li><b>\'Betrag sofort abbuchen\'</b><br> Das MasterPass-Konto des Kunden wird sofort nach Bestellabschluss ' //
        . 'belastet.</li>' //
        . '<li><b>\'Betrag nur reservieren\'</b><br> Der Betrag wird einige Tage reserviert und kann im ' //
        . 'Heidelpay-HIP gebucht werden.<br>Es sind Teilbuchungen / Stornierungen möglich. Details erfahren ' //
        . 'Sie vom Heidelpay-Support.</li>' //
        . '</ul>',
    'HELP_D3DYN_HEIDELPAY_PARAM_INTERNALLOG'                => 'Diese Option bestimmt den Grad der Informationen, ' //
        . 'welche in das D3-Log (Tabelle d3log) geschrieben werden. Die mitgeschriebenen Daten beinhalten ' //
        . 'Details zur Kommunikation zwischen Heidelpay und den Shop. Die Information können eingesehen werden unter:' //
        . '<br><pre><i>D³ Module > Modul-Connector > Logging</i></pre><br><br>' //
        . 'Wir empfehlen zu Beginn das Logging des Heidelpay-Moduls auf ' //
        . '"<b>alle Fehler- und Infolevel</b>" zu setzen, um evtl. Fehlkonfigurationen nachvollziehen zu können.<br>' //
        . 'Sie können das Logging später auf bspw. "Fehler und Warnungen" herab setzen.<br><br>' //
        . '<strong>Hinweise:</strong>' //
        . '<br><strong>D</strong>iese Einstellung regelt wie viel Einträge in die MySQL Tabelle d3log geschrieben werden.'//
        . '<br><strong>B</strong>eachten Sie, dass die Einstellung "alle Fehler- und Infolevel" sehr viele Einträge schreibt und ggf. die Tabelle d3log gewartet werden muss.'//
        . '<br><strong>F</strong>ür Supportanfragen und Analysen wird das vollständige Log ("alle Fehler und Infolevel") benötigt!',
    'HELP_D3DYN_HEIDELPAY_PARAM_DEBITUNMASK'                => 'Geben Sie an ob die Bankdaten im Shop vollständig ' //
        . 'angezeigt oder mit * teilweise maskiert werden sollen.',
    'HELP_D3DYN_HEIDELPAY_PARAM_STOREDDATA'                 => 'Das Modul unterstützt die Speicherung der ' //
        . 'Registrierungsdaten für erneute Zahlungen bei Kreditkarte und Debitkarten.<br>' //
        . 'Nach Bestellschritt 4 wird beim erneuten Einkauf dem Kunden angeboten, mit denselben Zahlungsdaten ' //
        . 'zu bezahlen. Der Händler spart zusätzlich die Kosten für eine Transaktion.<br><br>' //
        . '<b>Hinweis</b><br>Diese Option ist nur für Kredit- und Debitkartendaten möglich. Die Kundendaten werden nur maskiert im Shop gespeichert (bspw. 4111******).',
    'HELP_D3DYN_HEIDELPAY_PARAM_SHOWERRORTEXTS'             => 'Hiermit wird dem Kunden im Fehlerfall eine Meldung über den Grund der Ablehnung seiner Kartendaten im Shop gezeigt.<br>
z.B. "Kartenummer nicht korrekt".<br><br><b>Hinweis: Sicherheitsrelevante Meldungen wie "Karte gestohlen" werden nicht gezeigt!</b>',
    'HELP_D3DYN_HEIDELPAY_ORDER_EXECUTE_POST_FIELDS'        => 'Hinterlegen Sie in diesem Feld alle zusätzlichen ' //
        . 'Pflichtfelder, welche der Kunde für den Abschluss einer Bestellung bestätigten muss.<br> <br>' //
        . 'Diese werden auf der Bestellschrittseite 4 (order) ausgegeben. Entweder als Checkbox oder als ' //
        . 'verstecktes Feld.<br>' //
        . 'Im Oxid-Standard ist dies bspw. die Bestätigung für die AGB. <br> <br>' //
        . 'Optionale Felder werden nur mit einem vordefinierten Wert übergeben ' //
        . '(Pflichtfelder für den Bestellabschluss).<br> <br>' //
        . 'Geben Sie je Zeile das Feld und den Wert an, welcher eine erfolgreiche Bestellung zulässt.' //
        . '<br>Die Syntax dazu lautet: <br><b><i>Feldname => Wert</i></b> <br> <br>' //
        . 'Die Standard-Felder von Oxid sind bereits eingetragen:' //
        . '<pre><i>ord_agb => 1<br>' //
        . 'ord_custinfo => 1<br>' . //
        'oxdownloadableproductsagreement => 1<br>' . //
        'oxserviceproductsagreement => 1</i></pre>',
    'HELP_D3DYN_HEIDELPAY_ADDITIONAL_URL_PARAMETER'         => 'Hinterlegen Sie in diesem Feld alle zusätzlichen URL parameter die für evtl. Trackings gebraucht werden. ' //
        . 'Die Syntax ist : Parametername => Parameterwert<br> <br>' //
        . 'Bspw. Google Analytics -> utm_nooverride => 1<br> <br>',//
    'HELP_D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMAIL'       => 'Geben Sie hier eine E-Mail Adresse an, ' //
        . 'welche Benachrichtungen in "Fehlerfällen" erhalten soll. Diese Fälle können bspw. ' //
        . 'Abweichungen zum Transaktionsbetrag bei einer Bestellung sein.<br><br>' //
        . 'Wenn das Feld nicht befüllt ist, wird die "E-Mail-Adresse für Bestellungen" aus den ' //
        . 'Einstellungen des Shops verwendet.<pre><i>Stammdaten > Grundeinstellungen</i></pre>',
    'HELP_D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORSTATUS'     => 'Geben Sie hier den Transaktionsstatus ' //
        . '(oxorder__oxtransstatus) an, welcher an der betreffenden Bestellung hinterlegt wird. <br><br>' //
        . 'Wenn dieses Feld nicht befüllt ist, wird der Status auf "<b>ERROR</b>" gesetzt.',
    'HELP_D3HEIDELPAY_CARDTYPE_TIMEOUT'                     => 'Geben Sie hier das Dauer in Sekunden an, '
        . 'wie lange ein Kunde die Kartendateneingabe im Frontend vornehmen kann.<br><br>'//
        . 'Die Eingabe der Kredit-/Debitkartendaten erfolgt in einem iFrame. Der Inhalt des iFrame ' //
        . 'befindet sich ausserhalb des Shops. '//
        . 'Damit das Formulars nur innerhalb der Shopsession abgeschickt werden kann, wird das hier '
        . 'eingestellte Zeitlimit eingeblendet. '//
        . 'Nach Ablauf dieser Zeit wird der Absende-Button gesperrt und ein Popup mit einem Link zu '
        . 'Bestellschritt 2 angezeigt.<br><br>' //
        . 'Sollte die Sessionzeit kleiner als 10 Minuten sein, tragen Sie bitte den entsprechenden Wert '
        . 'hier ein. Die Sessionzeit wird über die PHP Variable "session.gc_maxlifetime" definiert.'
        . 'Diese ist zu finden unter <pre><i>Service > Systeminfo</i></pre><br>' //
        . 'Der Standardwert ist 600 Sekunden (10 Minuten).',
    'HELP_D3DYN_HEIDELPAY_PARAM_CURLTIMEOUTSEK'             => 'Geben Sie hier das Zeitlimit für Curl Anfragen an.<br>Der Standardwert sind 60 Sekunden.',
    'HELP_D3DYN_HEIDELPAY_PARAM_CSSPATH'                    => 'Mit der CSS-Datei erhalten Sie die Möglichkeit, das iFrame von Heidelpay optisch anzupassen. '
        . 'Wenn der Status grün ist, wird die CSS Datei vom Modul erkannt und an Heidelpay übergeben (ohne Inhaltsprüfung). '
        . 'Das iFrame kommt derzeit bei Kredit- und Debitkarte zum Einsatz.<br><br>'
        . 'Die Datei können Sie unter diesem Speicherort ablegen: /modules/d3/heidelpay/out/src/css/<br>'
        . 'Der Name der CSS Datei setzt sich aus "d3heidelpay_iframe_",  aktuelle Shopid und der Endung ".css" zusammen. Beispiel: d3heidelpay_iframe_1.css<br><br>'
        . 'Es gibt eine Whitelist der verwendbaren CSS-Parameter. Bitte fragen Sie bei Heidelpay nach der Dokumentation.',
    'HELP_D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES'     => 'Wenn die Einstellung aktiv ist, können die Konfigurationen pro Sprache eingerichtet und verwendet werden.<br>'
        . '<b>Aktiv:</b> Es wird ein Sprachumschalter unter /Heidelpay/Einstellungen/ angezeigt.<br>'
        . '<b>Inaktiv:</b> Es wird kein Sprachumschalter gezeigt. Bereits angelegte Konfigurationen in anderen Sprachen müssen gelöscht werden (eine entsprechende Funktion wird nach dem Speichern ausgeführt).',
    'HELP_D3DYN_HEIDELPAY_HASMULTILANGCONFIGBUTNOSETTING'   => '        Diese Meldung wird gezeigt, wenn eine Konfiguration in einer anderen Sprache gefunden wurde und die Einstellung <i>"mehrsprachige Konfigurationen erlauben"</i> inaktiv ist.'
        . '<br>Um Fehler zu vermeiden, darf alleine die Konfiguration in der <b>Sprache 0</b> aktiv sein.<br><br>'
        . '<ol><li>Drücken Sie auf <b style="color:#1db11a;">"mehrsprachige Konfigurationen entfernen"</b> um Konfigurationen aus anderen Sprachen zu löschen.</li>'
        . '<li>Wählen Sie <b style="color:#ff1212;">"mehrsprachige Konfigurationen wieder aktivieren"</b> um die Option <i>"mehrsprachige Konfigurationen erlauben"</i> wieder aktiv zu schalten. Die Konfigurationen in den anderen Sprachen bleiben erhalten.</li></ol>',
    'HELP_D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMINIMUM'     => 'Geben Sie hier den Mindest-Bestellwert für EasyCredit Anfragen an.<br>Der Standardwert sind 200 Euro.',
    'HELP_D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMAXIMUM'     => 'Geben Sie hier den Höchst-Bestellwert für EasyCredit Anfragen an.<br>Der Standardwert sind 5000 Euro.',
    'HELP_D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMINIMUM' => 'Geben Sie hier den Mindest-Bestellwert für gesichert. Rechnungskauf Anfragen an.<br>Der Standardwert sind 10 Euro.',
    'HELP_D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMAXIMUM' => 'Geben Sie hier den Höchst-Bestellwert für gesichert. Rechnungskauf Anfragen an.<br>Der Standardwert sind 1000 Euro.',
    'HELP_D3HEIDELPAY_SETTINGS_NOTIFYURL' => 'Das NGW System von Heidelpay bietet die Push Benachrichtigungen an. <br>
<br>
<strong>Was sind Push Benachrichtigungen?</strong><br>
Eine Push Benachrichtigung ist eine zusätzliche Rückmeldung, aus dem Heidelpay System, an die hinterlegte Shop-Benachrichtigungs-URL.<br>
Der Inhalt der Benachrichtigung enthält Informationen einer Transaktion.<br>
Das Heidelpay System schickt dabei fast alle bekannten Transaktionen an den Shop.<br>
Eine Transaktion kann bspw. bei der Kreditkarte eine Registrierung (CC.RG), ein Debit (CC.DB) oder auch ein Refund (CC.RF) enthalten.<br>
Das gilt natürlich auch für alle anderen Zahlungsarten.<br>
 <br>
<strong>Wozu dienen die Push Benachrichtigungen?</strong><br>
In erster Linie ist die Benachrichtigung eine Information an den Shop und damit eine Absicherung, dass der Shop die notwendigen Informationen erhält.<br>
Die Transaktion wird von unserem Modul im Shop gespeichert und der Bestellung zugeordnet (sofern diese vorhanden ist).<br>
 <br>
Die Modulversion 6.0.2.0 kann bei der Zahlungsart automatische Vorkasse bereits die zugehörige Bestellung als bezahlt markieren.<br>
Ablauf:<br>
Das Heidelpaysystem schickt ein PP.RC an den Shop.<br>
Dieser wird ausgewertet und die Bestellung wird auf bezahlt, sowie der Transaktionsstatus von PENDING auf OK gesetzt.<br>
<br>
<strong>Wie richte ich die Push Benachrichtungen ein?</strong><br>
Die Shop-Benachrichtigungs-URL muss bei Heidelpay (per E-Mail) eingereicht werden.<br>
Die URL setzt sich aus der Shopdomain (Hauptdomain bei EE Versionen, die Shop-Id wird in den Transaktionen überliefert) und dem Pfad zu der notify.php zusammen:<br>
https://www.meine-shop-dom.ain/modules/d3/heidelpay/public/notify.php<br>',
    'HELP_D3HEIDELPAY_CONFIG_TITLE'       => 'Der Titel der Konfiguration wird nur für interne Zwecke genutzt.',
    'HELP_D3HEIDELPAY_CONFIG_CHANNEL'     => 'Tragen Sie hier den von Heidelpay erhaltenen Channel ein.',
    'HELP_D3HEIDELPAY_CONFIG_PAYMENTTYPE' => 'Wählen Sie hier die zugehörige Heidelpay Zahlungsart aus, die zu dem eingetragenen Channel passt.',
    'HELP_D3HEIDELPAY_CONFIG_ISTESTCONFIG' => 'Wenn diese Option aktiv ist, wird die Kommunikation an das Heidelpay Testsystem, anstatt an das Livesystem übertragen.<br>
Es werden auf dem Test Server keine realen Buchungen durchgeführt!<br><br>' //
        . '<b>Hinweis: <br>Testdaten können Sie direkt von ' //
        . '<a href="https://dev.heidelpay.de/testumgebung/" target="heidelpay">Heidelpay</a> beziehen.</b>'
);
