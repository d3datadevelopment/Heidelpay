---
title: Datenbank bereinigen
---
  
Das Modul legt Informationen in der Datenbank ab. Sofern diese Daten nicht mehr benötigt werden, können diese gelöscht werden. 

> [!] Legen Sie sich vorab bitte unbedingt eine Sicherung an, um die Daten im Zweifelsfall wiederherstellen zu können.
    
Für das Modul **{$modulename}** sind dies die folgende Tabellen und Felder:

* die komplette Tabelle `d3hpuid`
* die komplette Tabelle `d3hperrortexts`

    
und diese Felder in bestehenden Tabellen:

* in Tabelle `oxorder`:  
  * das Feld `D3HEIDELPAYVOUCHERS`
  
sowie diese Einträge in bestehenden Tabellen:

* in Tabelle `d3_cfg_mod`:  
  * den/die Eintrag/Einträge `oxmodid = "{$moduleConfigurationident}"`
