# Del 1 - Optimering

## Fjärrbelägen CSS i mess.php
*I mess.php hämtas två .css-filer från en fjärrbelägen server. Genom att lägga de på den lokala servern 
går laddningstiden på sidan från lite mer än 2 sekunder till ungefär 300 millisekunder.

## Saknade .js-filer i mess.php
*Filerna js/ajax_minified.js och js/longpoll.js finns inte på servern. Genom att ta bort referenser till dessa filer 
sjunker laddningstiden sjunker laddningstiden till mellan 150 och 300 millisekunder. Varför laddningstiden ibland förblir oförändrad och ibland inte känner jag inte till, men 
gissar på att det nu är klientsidan som bildar flaskhalsen och inte servern.*

## Inline CSS i index.php
**

# Del 2 - Säkerhet

# Del 3 - AJAX
*Problembeskrivingen är generös nog att beskriva hur krav "bör" uppnås, och inte hur de "ska" uppnås. Jag skriver således en enkel lösning där funktionen getProducer kallas på efter ett lyckat meddelande vilket gör att meddelandena laddas om.
För att sortera dem efter datum ändrar jag på hur meddelandena skrivs ut genom att skriva funktionen getAllMessages, som hämtar alla meddelande sorterade efter variabeln serial.
Då serial är autoinkrementerane skrivs meddelandena ut i den ordning de skapades, så länge databasen inte manipuleras.*