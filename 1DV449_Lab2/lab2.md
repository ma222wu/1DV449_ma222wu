# Del 1 - Optimering

## Fj�rrbel�gen CSS i mess.php
*I mess.php h�mtas tv� .css-filer fr�n en fj�rrbel�gen server. Genom att l�gga de p� den lokala servern 
g�r laddningstiden p� sidan fr�n lite mer �n 2 sekunder till ungef�r 300 millisekunder.

## Saknade .js-filer i mess.php
*Filerna js/ajax_minified.js och js/longpoll.js finns inte p� servern. Genom att ta bort referenser till dessa filer 
sjunker laddningstiden sjunker laddningstiden till mellan 150 och 300 millisekunder. Varf�r laddningstiden ibland f�rblir of�r�ndrad och ibland inte k�nner jag inte till, men 
gissar p� att det nu �r klientsidan som bildar flaskhalsen och inte servern.*

## Inline CSS i index.php
**

# Del 2 - S�kerhet

# Del 3 - AJAX
*Problembeskrivingen �r gener�s nog att beskriva hur krav "b�r" uppn�s, och inte hur de "ska" uppn�s. Jag skriver s�ledes en enkel l�sning d�r funktionen getProducer kallas p� efter ett lyckat meddelande vilket g�r att meddelandena laddas om.
F�r att sortera dem efter datum �ndrar jag p� hur meddelandena skrivs ut genom att skriva funktionen getAllMessages, som h�mtar alla meddelande sorterade efter variabeln serial.
D� serial �r autoinkrementerane skrivs meddelandena ut i den ordning de skapades, s� l�nge databasen inte manipuleras.*