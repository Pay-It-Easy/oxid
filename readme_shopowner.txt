Modul: Pay It Easy Zahlungsmodul

Version: 1.2.0

Beschreibung: Zahlungsmodul zur Durchführung einer Zahlung über das "Pay It Easy" System

Getestet mit Shop-System: Oxid v.4.7.4_57063, 4.8.0, 4.8.4
--------------------------------------------------------------------------------

1	Installation
--------------------------------------------------------------------------------
1.1 Installation des Plug-Ins
	a) Laden Sie die Installationsdatei "oxid_Pay-It-Easy_1.2.0.zip" auf dem Shop-Server in ein temporäres Verzeichnis (/tmp) hoch.
	b) Entpacken Sie die Datei in das /tmp Verzeichnis (unzip oxid_Pay-It-Easy_1.2.0.zip).
	c) Kopieren Sie den Inhalt des Verzeichnisses "copy_this" in das Root-Verzeichnis des Shops.
	d) Stellen Sie sicher, dass die neu erstellten Dateien und Verzeichnisse für den Shop lesbar/ausführbar sind (Berechtigung 755).
1.2	Aktivierung des Zahlungsmoduls
	a) Leeren Sie den Cache und aktualisieren Sie das Administrations Backend des Shops (entfernen Sie die Dateien aus dem Verzeichnis "tmp" im Root-Verzeichnis des Shops).
	b) Öffnen Sie im Browser die Administrationsansicht des Shops und melden Sie sich als Administrator an.
	c) Im Hauptmenü wählen Sie unter Erweiterungen > Module das Modul Pay It Easy aus und wählen Sie "Aktivieren".
	d) Laden Sie die Administrationsseite neu.

2 Konfiguration
--------------------------------------------------------------------------------
2.1 Konfiguration des Plug-Ins im Shopsystem
	a) Öffnen Sie im Browser die Administrationsansicht des Shops und melden Sie sich als Administrator an.
	b) Gehen Sie auf Pay It Easy und tragen Sie die Ihnen zugewiesene Händlerkennung in das Feld "Händlerkennung" ein.
	c) Tragen Sie den Ihnen zugewiesenen MAC-Schlüssel in das Feld "MAC-Schlüssel" ein.
	d) Klicken Sie auf den Button "Speichern".
	e) Klicken Sie auf den Button "Zahlungsarten installieren".
	f) Gehen Sie auf Sie auf Shopeinstellungen > Zahlungsarten und wählen Sie die zu aktivierende Zahlungsmethode.
	g) Klicken Sie auf "Benutzergruppen zuordnen" und weisen Sie die entsprechenden Benutzergruppen zu.
	h) Gehen Sie zum Tab Länder, klicken Sie auf "Länder zuordnen" und weisen Sie die entsprechenden Länder zu.
	i) Im Hauptmenü wählen Sie unter Shopeinstellungen > Versandarten die Versandmethode aus (z.B. Standard) und gehen Sie zum Tab Zahlungsarten.
	j) Klicken Sie auf "Zahlungsarten zuordnen" und weisen Sie die entsprechenden Zahlungsarten zu.

