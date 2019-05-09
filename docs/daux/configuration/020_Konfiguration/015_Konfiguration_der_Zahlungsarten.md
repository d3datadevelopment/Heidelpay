---
title: Konfiguration der Zahlungsarten
---

Ihnen stehen folgende **Zahltypen** für Heidelpay zur Verfügung:
- Kreditkarte
- Debitkarte
- Bankeinzug
- automatische Vorkasse
- Sofort by Klarna
- BillSAFE (nur Bestandskunden)
- Giropay
- iDeal (Niederlande)
- EPS (Österreich)
- Rechnungskauf (ohne Zahlungssicherung)
- Rechnungskauf (mit Zahlungssicherung)
- Przelewy 24
- EasyCredit
- PayPal
- MasterPass

Kreditkarte, Bankeinzug und Vorkasse existieren bereits als Shop-Standard-**Zahlungsarten** im Admin-Bereich:
([ Shopeinstellungen ] / [ Zahlungsarten ]).<br>
Alle weiteren Zahlungsarten werden durch den Installationsassistenten hinzugefügt.

> [i] Achten Sie darauf, dass die gewünschten Zahlungsarten aktiviert, vollständig konfiguriert und im Frontend einstellungsabhängig sichtbar sind.

Gehen Sie anschließend in den Menüpunkt [ (D3) Module ] / [ {$menutitle} ] / [ Einstellungen ] und ordnen Sie auf der rechten Seite die gewünschten **Zahlungsarten** den Heidelpay-**Zahltypen** zu.

> [i] Sie können weitere Zahlungsarten im Shop anlegen (z.B.: um für 
      Auslandskunden eine separate Zahlungsart anzuzeigen).
      Ordnen Sie diese Zahlart einfach der gewünschten Heidelpay-Zahlart zu.

Bei allen **Online-Transfer-Zahlungsarten** (Sofort by Klarna, Giropay etc.), sowie
**BillSAFE**, **Rechnungskauf mit Zahlungssicherung**, **EasyCredit**, **Przelewy24**, **iDeal**
und **PayPal** müssen eigene Channels eingetragen werden.<br>
Die Channel ID's erhalten Sie von Heidelpay

> [i] Für die jeweilige Nutzung muss zwingend der passende Channel
      eingetragen werden, auch wenn dieser mit dem Standard-Channel identisch ist.
