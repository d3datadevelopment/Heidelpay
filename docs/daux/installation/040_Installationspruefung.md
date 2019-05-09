---
title: Installationsprüfung
---

Um die erfolgreiche Installation zu prüfen, können Sie die folgende(n) Checkliste(n) verwenden:

## Einstellungsunabhängige Prüfungen

### Backend

* das Modul ist unter [ Erweiterungen ] / [ Module ] aktiv geschaltet
* das Modul ist unter [ (D3) Module ] / [ Modul-Connector ] / [ Modulverwaltung ] aktiv geschaltet
* das Modul zeigt unter [ (D3) Module ] / [ {$menutitle} ] einen eigenen Bereich für Einstellungen, Logging und die Transaktionsübersicht
* das Modul zeigt unter [Bestellungen verwalten] / [Bestellungen] einen neuen Tab [{$menutitle}]

## Einstellungsabhängige Prüfungen
### Frontend
* Im Bestellschritt 3 (Versand & Zahlungsart) werden Icons zu den konfigurierten Zahlungsarten angezeigt
* der Shop zeigt nach Absenden des Bestellschritt 4 (Überprüfen & Absenden) folgendes Verhalten:
    * bei Kreditkarte, Debitkarte ein Eingabeformular / eine Auswahl zu gespeicherten Daten
    * bei Paypal, Sofort by Klarna, iDeal (und andere OT Zahlungsarten) eine Weiterleitung zum Zahlungsanbieter
