<?php

$sLangName = "Deutsch";
$iLangNr   = 0;
$aLang     = array(
    'charset'                                                           => 'UTF-8',
    'd3mxheidelpay'                                                     => 'Heidelpay',
    'd3mxheidelpay_settings'                                            => 'Einstellungen',
    'd3tbclheidelpay_settings'                                          => 'Stamm',
    'd3tbclheidelpay_support'                                           => 'Support',
    'd3mxheidelpaylog'                                                  => 'Logging',
    'd3mxheidelpaytransactionlog'                                       => 'Transaktionsübersicht',
    'D3DYN_HEIDELPAY_ACTIVE'                                            => 'Heidelpay-Modul aktiv',
    'D3DYN_HEIDELPAY_TESTMOD_ACTIVE'                                    => 'Testmodus aktiv',
    'D3DYN_HEIDELPAY_PARAM_SECURITYSENDER'                              => 'Sender-ID',
    'D3DYN_HEIDELPAY_PARAM_USERID'                                      => 'Login',
    'D3DYN_HEIDELPAY_PARAM_PASSWORD'                                    => 'Password',
    'D3DYN_HEIDELPAY_PARAM_CARDS_USE_RG'                                => 'Registierung für Karten nutzen (Kreditkarte, Debitkarte)',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE'                                 => 'Buchungstyp (Kreditkarte, Debitkarte)',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECT'                          => 'Betrag sofort abbuchen',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_RESERVE'                         => 'Betrag nur reservieren',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_FOREIGNRESERVE'                  => 'Inland buchen, Ausland reservieren',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_PAYPAL'                          => 'Buchungstyp (PayPal)',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_DIRECTDEBIT'                     => 'Buchungstyp (Lastschrift mit Zahlungssicherung)',
    'D3DYN_HEIDELPAY_PARAM_BOOKINGTYPE_MASTERPASS'                      => 'Buchungstyp (MasterPass)',
    'D3DYN_HEIDELPAY_PARAM_STOREDDATA'                                  => 'Gespeicherte Daten dem Kunden anbieten?',
    'D3DYN_HEIDELPAY_PARAM_CURLTIMEOUT'                                 => 'max. cUrl-Verbindungszeit zum Server',
    'D3DYN_HEIDELPAY_PARAM_CURLTIMEOUTSEK'                              => 'Sekunden',
    'D3DYN_HEIDELPAY_PARAM_LOGPAYMENT'                                  => 'Log Payment Aktionen',
    'D3DYN_HEIDELPAY_PARAM_SHOWERRORTEXTS'                              => 'Fehlermeldungen im Shop anzeigen',
    'D3DYN_HEIDELPAY_PARAM_TESTSERVERTYPE'                              => 'Test-Servertyp',
    'D3DYN_HEIDELPAY_PARAM_TESTMOD_ERRORCODE'                           => 'Test-Modus Error-Code',
    'D3DYN_HEIDELPAY_PARAM_TESTMOD_RETURNCODE'                          => 'Test-Modus Return-Code',
    'D3DYN_HEIDELPAY_PARAM_INTERNALLOG'                                 => 'D3 Logging',
    'D3DYN_HEIDELPAY_PARAM_INTERNALLOG_INACTIVE'                        => 'nicht aktiv',
    'D3DYN_HEIDELPAY_PARAM_INTERNALLOG_ONLYERRORS'                      => 'nur Fehler',
    'D3DYN_HEIDELPAY_PARAM_INTERNALLOG_ALL'                             => 'alles',
    'D3DYN_HEIDELPAY_NOCURL'                                            => '<b>ACHTUNG, Modul ist nicht einsatzfähig, da PHP-CURL fehlt!</b>',
    'D3DYN_HEIDELPAY_PARAM_DEBITUNMASK'                                 => 'Kontodaten vollständig speichern',
    'D3DYN_HEIDELPAY_PARAM_DEBITUNMASK_NO'                              => 'maskieren (wie Kreditkarte ***)',
    'D3DYN_HEIDELPAY_PARAM_DEBITUNMASK_YES'                             => 'nicht maskieren',
    'D3DYN_HEIDELPAY_ACTIVEPAYMENTS'                                    => '<b>Heidelpay zugeordnete Zahlungsarten</b>',
    'D3DYN_HEIDELPAY_NOACTIVEPAYMENTS'                                  => 'Heidelpay sind aktuell keine Zahlarten zugeordnet!',
    'D3DYN_HEIDELPAY_CURRENTPAYMENTS'                                   => '<i>Diese Zahlarten werden aktuell über das Heidelpay-Modul abgewickelt.</i>',
    'D3DYN_HEIDELPAY_PAYTYPE'                                           => 'Heidelpay-Zahltyp:',
    'D3_HEIDELPAY_RESTRICTIONINFO'                                      => 'Sie verwenden Heidelpay \'Basic\', daher sind einige Funktionen nicht aktiv. Wenn Sie alle Möglichkeiten des Moduls zu nutzen möchten, erwerben Sie bitte Heidelpay \'Premium\'.',
    'd3_heidelpay_controllers_admin_order_heidelpay'                    => 'Heidelpay',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_SUBMIT'             => 'absenden',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_IS_NOT_HEIDELPAY'   => 'Keine Heidelpay Transaktionen vorhanden.',
    'D3_HEIDELPAY_PAYMENT_CC'                                           => 'Kreditkarte',
    'D3_HEIDELPAY_PAYMENT_DD'                                           => 'Lastschrift',
    'D3_HEIDELPAY_PAYMENT_DC'                                           => 'Debitkarte',
    'D3_HEIDELPAY_PAYMENT_VA'                                           => 'Virtual Account',
    'D3_HEIDELPAY_PAYMENT_OT'                                           => 'Online Transfer',
    'D3_HEIDELPAY_PAYMENT_IV'                                           => 'Rechnung',
    'D3_HEIDELPAY_PAYMENT_PP'                                           => 'Vorkasse',
    'D3_HEIDELPAY_PAYMENT_WT'                                           => 'Masterpass',
    'D3_HEIDELPAY_PAYMENT_HP'                                           => 'easyCredit',
    'D3_HEIDELPAY_METHOD_RG'                                            => 'Registration',
    'D3_HEIDELPAY_METHOD_PA'                                            => 'Reservation',
    'D3_HEIDELPAY_METHOD_DB'                                            => 'Debit',
    'D3_HEIDELPAY_METHOD_RF'                                            => 'Refund',
    'D3_HEIDELPAY_METHOD_RB'                                            => 'Rebill',
    'D3_HEIDELPAY_METHOD_CP'                                            => 'Capture',
    'D3_HEIDELPAY_METHOD_RC'                                            => 'Receipt',
    'D3_HEIDELPAY_METHOD_RV'                                            => 'Reversal',
    'D3_HEIDELPAY_METHOD_FI'                                            => 'Finalize',
    'D3_HEIDELPAY_METHOD_IN'                                            => 'Initialize',
    'D3_HEIDELPAY_IS_DEMO'                                              =>
        'Demo-Modus aktiv! Sie können das Modul nur im Testmodus verwenden.<br>'
        . 'Die Lizenz können Sie unter /Modul-Connector/Modulverwaltung/Heidelpay/ einsehen und ändern.',
    'D3_HEIDELPAY_UPDATE_OXCONTENTITEMS'                                =>
        'Es sind CMS-Seiten vorhanden, welche ggf. aktualisiert werden müssen. '
        . PHP_EOL
        . 'Der Inhalt kann leider nicht automatisch aktualisiert werden. '
        . PHP_EOL
        . 'Bitte überprüfen Sie diese unter:'
        . PHP_EOL
        . PHP_EOL
        . 'Shopadmin->Kundeninformationen->CMS-Seiten->Idents: '
        . PHP_EOL
        . '- d3_hp_vorkassemail_cust_text'
        . PHP_EOL
        . '- d3_hp_vorkassemail_cust_subject'
        . PHP_EOL
        . '- d3_hp_vorkassemail_cust_plain'
        . PHP_EOL
        . '- d3_hp_vorkassemail_owner_text'
        . PHP_EOL
        . '- d3_hp_vorkassemail_owner_subject'
        . PHP_EOL
        . '- d3_hp_vorkassemail_owner_plain'
        . PHP_EOL
        . PHP_EOL
        . 'Im Installationsverzeichnis unter setup+doku/CMS finden Sie '
        . 'zum Vergleich je eine TXT-Datei, benannt nach dem Ident der entsprechenden CMS-Seite.',
    'D3_HEIDELPAY_UPDATE_CHANNELCONFIGURATIONS' => 'Die Konfiguration der Channeldaten hat sich verändert.'
        .PHP_EOL.'Die bestehende Konfiguration wird in einen neuen Admin Bereich migriert.'
        .PHP_EOL.'Der neue Admin Bereich ist unter /D³ Module/Heidelpay/Channel-Konfigurationen/ zu finden.'
        .PHP_EOL.'Auf unserer Hilfe Seite bekommen Sie eine Übersicht, welche Einstellungen sich geändert haben: https://docs.oxidmodule.com/Heidelpay/6.1.0.0/changelog/Channel_Rekonfiguration.html'
        .'<br>',
    'D3_Heidelpay_models_update_legacy_assigments_updatemessage'        =>
        'In diesem Schritt werden die Zuordnungen von den Shop-Zahlungsarten zu Heidelpay über ein Script aktualisiert.'
        . PHP_EOL
        . 'Um fortzufahren klicken Sie auf "Installationsschritt ausführen...".'
        . PHP_EOL
        . PHP_EOL
        . 'Hinweis: Dieser Schritt ist nur in den automatischen Installationen möglich.',
    'd3\heidelpay\models\payment\creditcard'                            => 'Kreditkarte',
    'd3\heidelpay\models\payment\debitcard'                             => 'Debitkarte',
    'd3\heidelpay\models\payment\directdebit'                           => 'Lastschrift (Bankeinzug)',
    'd3\heidelpay\models\payment\directdebit\secured'                   => 'Lastschrift mit Zahlungssicherung',
    'd3\heidelpay\models\payment\prepayment'                            => 'autom. Vorkasse',
    'd3\heidelpay\models\payment\postfinance'                           => 'PostFinance',
    'd3\heidelpay\models\payment\sofortueberweisung'                    => 'Sofort',
    'd3\heidelpay\models\payment\ideal'                                 => 'iDeal',
    'd3\heidelpay\models\payment\giropay'                               => 'Giropay',
    'd3\heidelpay\models\payment\eps'                                   => 'EPS',
    'd3\heidelpay\models\payment\invoice\secured'                       => 'Rechnungskauf mit Zahlungssicherung',
    'd3\heidelpay\models\payment\invoice\unsecured'                     => 'Rechnungskauf ohne Zahlungssicherung',
    'd3\heidelpay\models\payment\paypal'                                => 'PayPal',
    'd3\heidelpay\models\payment\przelewy24'                            => 'Przelewy24',
    'd3\heidelpay\models\payment\masterpass'                            => 'MasterPass',
    'd3\heidelpay\models\payment\easycredit'                            => 'easyCredit',
    'd3\heidelpay\models\payment\btobbillpurchase'                      => 'B2B Rechnungskauf',
    'd3\heidelpay\models\settings\channels\creditcard'                  => 'Kreditkarte',
    'd3\heidelpay\models\settings\channels\debitcard'                   => 'Debitkarte',
    'd3\heidelpay\models\settings\channels\directdebit\secured'         => 'Lastschrift mit Zahlungssicherung',
    'd3\heidelpay\models\settings\channels\directdebit\unsecured'       => 'Lastschrift (Bankeinzug)',
    'd3\heidelpay\models\settings\channels\easycredit'                  => 'easyCredit',
    'd3\heidelpay\models\settings\channels\eps'                         => 'EPS',
    'd3\heidelpay\models\settings\channels\sofort'                      => 'Sofort',
    'd3\heidelpay\models\settings\channels\giropay'                     => 'Giropay',
    'd3\heidelpay\models\settings\channels\prepayment'                  => 'autom. Vorkasse',
    'd3\heidelpay\models\settings\channels\ideal'                       => 'iDeal',
    'd3\heidelpay\models\settings\channels\invoice\secured'             => 'Rechnungskauf mit Zahlungssicherung',
    'd3\heidelpay\models\settings\channels\invoice\unsecured'           => 'Rechnungskauf ohne Zahlungssicherung',
    'd3\heidelpay\models\settings\channels\masterpass'                  => 'MasterPass',
    'd3\heidelpay\models\settings\channels\paypal'                      => 'PayPal',
    'd3\heidelpay\models\settings\channels\przelewy24'                  => 'Przelewy24',
    'd3\heidelpay\models\settings\channels\postfinance'                 => 'PostFinance',
    'd3\heidelpay\models\settings\channels\btobbillpurchase'            => 'B2B Rechnungskauf',
    'D3_HEIDELPAY_RESTRICTIONINFO_ORDER'                                => 'Sie verwenden Heidelpay \'Basic\', daher werden Ihnen die Zahloptionen (\'Refund\' etc.) zwar gezeigt, führen jedoch keine Transaktion aus.<br>Wenn Sie alle Möglichkeiten des Moduls nutzen möchten, erwerben Sie bitte Heidelpay \'Premium\'.',
    'D3_HEIDELPAY_UPDATE_CHANGE_HAENDLERKONTO'                          => 'Wichtige Hinweise zu Ihrem Heidelpay-Händlervertrag (betrifft Updates von kleiner 4.0.5.0 auf aktuelle Modulversion)'
        . PHP_EOL . PHP_EOL
        . 'Nur relevant bei Zahltyp "Sofort". '
        . PHP_EOL
        . 'Das Modul nutzt für Sofort eine spezielle Option der Heidelpay-Konfiguration. Der Endkunde gibt seine Bankdaten erst auf der Webseite von Sofort ein. Diese Option wird in Ihrem Händlerkonto eingerichtet.'
        . PHP_EOL
        . 'Nur mit dieser Einstellung ist eine Nutzung des Zahltyps "Sofort" möglich!'
        . PHP_EOL . PHP_EOL
        . 'Kontaktieren Sie vor dem Livegang des Moduls Ihren Heidelpay-Händlerbetreuer, so dass diese Option für Ihr Händlerkonto aktiviert werden kann.'
        . PHP_EOL . PHP_EOL
        . 'Wichtig: Sofern Sie ein Update des Moduls vornehmen, ist die oben genannte Option eventuell inaktiv. Bitte lassen Sie von Ihrem Heidelpay-Händlerbetreuer die genannte Option prüfen, bevor Sie das Modul-Update einspielen.
    ',
    'D3DYN_HEIDELPAY_ORDER_EXECUTE_POST_FIELDS'                         => 'Pflichtfelder für den Bestellabschluss',
    'D3DYN_HEIDELPAY_ADDITIONAL_URL_PARAMETER'                          => 'zusätzliche URL Parameter für Tracking',
    'D3HEIDELPAY_sD3HpHFOrderPendingTime'                               => 'Lebenszeit einer PENDING-Bestellung (in Stunden)',
    'D3HEIDELPAY_sD3HpHFOrderCancelType'                                => 'Aktion nach Lebenszeit',
    'D3HEIDELPAY_sD3HpHFOrderCancelType_PLEASE_CHOOSE'                  => 'Bitte w&auml;hlen',
    'D3HEIDELPAY_sD3HpHFOrderCancelType_CANCEL_ORDER'                   => 'stornieren',
    'D3HEIDELPAY_sD3HpHFOrderCancelType_DELETE_ORDER'                   => 'l&ouml;schen',
    'D3HEIDELPAY_sD3HpHFOrderLimit'                                     => 'Setzen Sie ein Limit an Bestellungen f&uuml;r den Cronjob.',
    'D3HEIDELPAY_blD3HpHFSetZeroOrderNumber'                            => 'generiere PENDING-Bestellungen mit Bestellnummer 0',
    'D3HEIDELPAY_SETTINGS_FOR_IDEAL_AND_P24_CRONJOB'                    => 'Cronjob Einstellungen (iDeal und Przelewy24)',
    'D3DYN_HEIDELPAY_LOGIN_LIVE_HEADER'                                 => 'Login Daten Liveumgebung',
    'D3DYN_HEIDELPAY_LOGIN_TEST_HEADER'                                 => 'Login Daten Testumgebung',
    'D3DYN_HEIDELPAY_EXTENDED_SETTINGS'                                 => 'Erweiterte Einstellungen zu den Heidelpay-Zahlarten',
    'D3DYN_HEIDELPAY_LOG_AND_SECURITY'                                  => 'Einstellungen zu Modul-Logging, Störungsfälle und Sprache',
    'D3HEIDELPAY_DIFFERENCE_IN_ORDER_SUBJECT'                           => 'Differenz zwischen Bestellung und Transaktion festgestellt! Bestellnr: ',
    'D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMESSAGE'                     => 'Es wurde eine Differenz festgestellt, zwischen dem bestellten Warenkorbwert und dem gebuchten Transaktionswert (Zahlung bei Heidelpay).' //
        . '<br>Bitte überprüfen Sie die Bestellung "%1$s" und die Transaktion bei Heidelpay mit der UniqueID  "%2$s".' //
        . '<br>In der Transaktion wurden "%3$s" gebucht und an der Bestellung sind "%4$s" hinterlegt.' //
        . '<br><br>Es kann sich zum Beispiel um in technischen Fehler oder einen un/wissentlichen Betrugsversuch handeln.',
    'D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORMAIL'                        => 'E-Mailadresse für erkannte Störungsfälle',
    'D3HEIDELPAY_DIFFERENCE_IN_ORDER_ERRRORSTATUS'                      => 'Bestellstatus für erkannte Störungsfälle',
    'D3HEIDELPAY_ERRRORMESSAGE_NORORDER_BUT_TRANSACTION_SUBJECT'        => '"%1$s": eine erfolgreiche Transaktion ohne Bestellung ist eingegangen. ShortID: ',
    'D3HEIDELPAY_ERRRORMESSAGE_NORORDER_BUT_TRANSACTION_TEXT'           => 'Eine erfolgreiche Transaktion ist von Heidelpay eingegangen. Es wurde versucht die Bestellung anzulegen, dies wurde shopseitig abgelehnt.<br>'//
        . 'Vermutlich muss die Transaktion dem Kunden wieder gut geschrieben werden!(Refund) <br>Bei Fragen konsultieren Sie Ihren Shopbetreuer und leiten Sie Ihm diese Nachricht weiter.<br><br>Shop Details: <br>',
    'D3HEIDELPAY_ERRRORMESSAGE_NORORDER_BUT_TRANSACTION_DETAILS'        => '<br>Transaktion Details: ',
    'D3HEIDELPAY_CARDTYPE_TIMEOUT'                                      => 'Zeitbeschränkung für die Karteneingabe (iFrame)',
    'D3HEIDELPAYNOTESHOWNFORSTOREDDATA'                                 => 'Es wurden gespeicherte Zahlungsdaten gefunden.' //
        . '<br>Diese können Debit\'s (DB) und Registrierungen (RG) enthalten.' //
        . '<br>Zukünftig wird eine Registrierung (RG) für Folgezahlungen benötigt.' //
        . '<br>Die automatische Installation entfernt im nächsten Schritt alle gespeicherten Zahlungsdaten die keine Registrierungen (RG) und vom Typ Kredit- oder Debitkarte sind.' //
        . '<br><br>Zusätzlich wird der aktive Haken bei "Registierung für Karten nutzen (Kreditkarte, Debitkarte)" vorausgesetzt (ggf. wird diese Option in einem späteren Installationsschritt automatisch gesetzt).' //
        . '<br>Die Registrierung (RG) ist eine zusätzliche Transaktion und ist kostenpflichtig.' //
        . '<br><br>Wenn Sie diese Option nicht nutzen möchten, deaktivieren Sie bitte den Haken "Gespeicherte Daten dem Kunden anbieten?" und "Registierung für Karten nutzen (Kreditkarte, Debitkarte)".' //
        . '<br>Diese finden Sie unter /D&sup3; Module/Heidelpay/Einstellungen/.' //
        . '<br><br>Bankdaten werden seit der Modul-Version 5.2.0.0 direkt im Shop gespeichert und sind nicht betroffen.' //
        . '<br><br>Mit Klick auf "Installationsschritt ausführen..." nehmen Sie die Löschung der nicht mehr nutzbaren Daten zur Kenntnis. ',
    'D3HEIDELPAYNOTESTOREDDATAWITHOUTRG'                                => 'Sie nutzen die Option "Gespeicherte Daten dem Kunden anbieten?".' //
        . '<br>Für den zukünftigen Gebrauch der Option, wird die aktive Einstellung "Registierung für Karten nutzen (Kreditkarte, Debitkarte)" benötigt.' //
        . '<br>Diese wird mit diesem Installationsschritt aktiviert und kann bei Bedarf unter /Heidelpay/Einstellungen/ deaktiviert werden.' //
        . '<br><br>Info zu der Einstellung "Registierung für Karten nutzen (Kreditkarte, Debitkarte)":',
    'D3HEIDELPAYNOTESTOREDDATAWITHOUTRG_SAVING'                         => 'Sie nutzen die Option "Gespeicherte Daten dem Kunden anbieten?".' //
        . '<br>Für den zukünftigen Gebrauch der Option, wird die aktive Einstellung "Registierung für Karten nutzen (Kreditkarte, Debitkarte)" benötigt.'
        . '<br>Die Einstellung hat das Modul automatisch gesetzt und kann bei Bedarf deaktiviert werden.',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_CRITERIONTAGS'      => 'Zusätzliche Parameter für die Transaktion',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_DETAILS'            => 'Übergebene Parameter für die Transaktion',
    'criterion_paypal_payer_id'                                         => 'Paypal Payer ID',
    'criterion_paypal_reg_token'                                        => 'Paypal Referenz Token',
    'criterion_ideal_entrancecode'                                      => 'iDeal entrance code',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_HOLDER'             => 'Empfänger',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_BANKNAME'           => 'Bank',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_IBAN'               => 'IBAN',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_BIC'                => 'BIC',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_AMOUNT'             => 'Betrag',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_REASON'             => 'Verwendungszweck',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_UNIQUEID'           => 'UniqueID',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_TRANSACTIONID'      => 'Transaktionsident',
    'D3_HEIDELPAY_CONTROLLERS_ADMIN_ORDER_HEIDELPAY_BANKTRANSFERDATA'   => 'Hier können Sie die Transferinformationen für den Endkunden einsehen.',
    'D3DYN_HEIDELPAY_PARAM_CSSPATH'                                     => 'CSS-Datei für iFrame vom Modul erkannt?',
    'D3DYN_HEIDELPAY_PARAM_CSSPATH_LINK'                                => 'Zur CSS-Datei',
    'D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES'                      => 'mehrsprachige Konfigurationen erlauben',
    'D3DYN_HEIDELPAY_PARAM_ALLOWMULTIPLELANGUAGES_REACTIVATE'           => 'Option &quot;mehrsprachige Konfigurationen erlauben&quot; aktivieren',
    'D3DYN_HEIDELPAY_PARAM_REMOVEMULTIPLELANGUAGES'                     => 'mehrsprachige Konfigurationen entfernen',
    'D3DYN_HEIDELPAY_HASMULTILANGCONFIGBUTNOSETTING'                    => 'Es wurde eine Konfiguration in einer anderen Sprache gefunden!<br>Soll/en die Konfiguration/en entfernt werden?',
    'D3HEIDELPAY_MULTIPLE_LANGUAGECONFIGURATIONS_FOUND'                 => 'Heidelpay: Es wurde eine Konfiguration in einer anderen Sprache gefunden!<br>Bitte gehen im Admin Sie unter /Heidelpay/Einstellungen/Stamm/ und folgen Sie der Anweisung.<br>Dieser Schritt wird Ihnen erst angezeigt, wenn die Heidelpay-Modul Installation fertig ist.',
    'D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMINIMUM'                      => 'Mindest-Bestellwert für EasyCredit',
    'D3DYN_HEIDELPAY_PARAM_EASYCREDITLIMITMAXIMUM'                      => 'Höchst-Bestellwert für EasyCredit',
    'D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMINIMUM'                  => 'Mindest-Bestellwert für gesichert. Rechnungskauf',
    'D3DYN_HEIDELPAY_PARAM_INVOICESECUREDLIMITMAXIMUM'                  => 'Höchst-Bestellwert für gesichert. Rechnungskauf',
    'D3HEIDELPAY_SETTINGS_NOTIFY_LABEL'                                 => 'Einstellungen und Info. zu Push Benachrichtigungen',
    'D3HEIDELPAY_SETTINGS_NOTIFYURL_INFO'                               => 'Damit Sie die Pushbenachrichtigungen nutzen können, muss bei Heidelpay die untenstehende Url der Empfängerdatei dem Heidelpay Support mitgeteilt werden.'
        . '<br>Die Url wird dann am Händler-Account durch den Heidelpay Support eingetragen.'
        . '<br>Erst dann kann der Shop die Push Benachrichtungen empfangen!',
    'D3HEIDELPAY_SETTINGS_NOTIFYURL'                                    => 'Push Benachrichtigungs Url',
    'd3_heidelpay_controllers_admin_channels_base'                      => 'Channel-Konfigurationen',
    'd3_heidelpay_controllers_admin_channels_main'                      => 'Einstellungen',
    'd3_heidelpay_controllers_admin_channels_payments'                  => 'Zahlungsarten',
    'd3_heidelpay_controllers_admin_payment_heidelpay'                  => 'Heidelpay',
    'D3HEIDELPAY_CONFIG_TITLE'                                          => 'Titel',
    'D3HEIDELPAY_CONFIG_CHANNEL'                                        => 'Channel',
    'D3HEIDELPAY_CONFIG_LOGLEVEL'                                       => 'Log Einstellungen',
    'D3HEIDELPAY_CONFIG_ISTESTCONFIG'                                   => 'Test Modus',
    'D3HEIDELPAY_INACTIVE'                                              => 'inaktiv',
    'D3HEIDELPAY_CONFIG_ALREADY_ASSIGNED_TO_OTHER_CONFIG'               => 'Diese Konfiguration ist bereits einer anderen Konfiguration zugeordnet',
    'D3HEIDELPAY_CONFIG_STATUS'                                         => 'Status',
    'D3HEIDELPAY_CONFIG_SHOPPAYMENT'                                    => 'Shop-Zahlungsart',
    'D3HEIDELPAY_CONFIG_ISASSIGNED'                                     => 'Zugeordnet?',
    'D3HEIDELPAY_CONFIG_UNASSIGNED'                                     => 'keine Zuordnung',
    'D3HEIDELPAY_CONFIG_CHANNELCONFIGURATION'                           => 'Channel-Konfiguration',
    'D3HEIDELPAY_NEW_CONFIG_CHANNEL'                                    => 'neue Channel-Konfiguration erstellen',
    'D3_HEIDELPAY_THIS_PAYMENT_RESTRICTIONINFO'                         => 'Sie möchten eine Premium Zahlungsart nutzen.' //
        .'<br>Der Aktiv Haken der Channel-Konfiguration und die Zuordnungen der Shop-Zahlungsarten werden nicht gespeichert!'//
        .'<br>Sie können das Premium Modul in unsererem <a href="https://www.oxidmodule.com/" title="oxidmodule.com" target="https://www.oxidmodule.com/">Onlineshop</a> erwerben.',
);
