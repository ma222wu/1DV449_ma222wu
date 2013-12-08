# Del 1 - Optimering

## Fjärrbelägen CSS i mess.php
*I mess.php hämtas två .css-filer från en fjärrbelägen server. Genom att lägga de på den lokala servern 
går laddningstiden på sidan från lite mer än 2 sekunder till ungefär 300 millisekunder. *

## Saknade .js-filer i mess.php
*Filerna js/ajax_minified.js och js/longpoll.js finns inte på servern. Genom att ta bort referenser till dessa filer 
sjunker laddningstiden sjunker laddningstiden till mellan 150 och 300 millisekunder. *

## Alla meddelanden hämtas individuellt
* I javascript-funktionen görs ett ajax-anrop per meddelande med hjälp av php-funtionen getMessage. Genom att skapa funktionen getAllMessages som hämtar alla meddelanden 
görs bara ett ajax-anrop och en läsning ur databasen oavsett hur många meddelanden som finns. Någon större skillnad märks inte när det finns få meddelanden, men när jag lägger till
 40 meddelanden för en viss producent tar det ungefär 200 millisekunder före mina redigeringar och 50 millisekunder efter. *

## Oanvända .js-filer
* Enligt High Performance Websites ökar sitens prestanda ju färre filer man hämtar. Genom att radera referenser till filerna modernizr.custom.js och ajax_minified.js tar det nu 
200 millisekunder istället för 300 innnan min webbläsare rapporterar DOMContentLoaded. *

## Sleep i middle.php
* Av någon anledning kallas php-funktionen sleep(2) i middle.php, varefter man redirectas till mess.php. Detta gör att det automatiskt bränns 2 sekunder varje gång en inloggning sker. 
Varför man gör så här vet jag inte, men jag utgår från att det är för laborationens skull. *

## Onödig redirect i check.php
* Enligt kapitel 11 i boken High Performance Websites bör man undvika redirects. Genom att helt strunta i att redirecta från check.php till middle.php och vidare till mess.php och istället
 gå direkt från check till mess undviks en redirect jag utgår från är helt onödig. Resultatet blir emellertid endast ett fåtal sparade millisekunder, föga imponerande efter de 2 sekunder 
förra steget resulterade i. *

# Del 2 - Säkerhet
## Ifyllda användaruppgifter
* I index.php skrivs användarnamn och korrekt lösenord för admin ut som default i inloggningsfälten. Detta gör att vem som helst kan logga in som användaren admin utan problem. 
Jag tar bort dessa defaultvärden från formuläret.*

## Valfri namngivning vid meddelande
* När användaren vill skriva ett nytt meddelande kan han ange vilken namn han vill. Man kan således posta meddelanden som kan se ut att vara från vem som helst.
Jag raderar fältet för namn och ser till så att $_SESSION['user'] alltid sätts som författare när ett nytt meddelande skickas. *

## Tags tillåts i meddelanden
* En användare kan skriva html-tags i sina meddelanden. Detta gör att användare till exempel skulle kunna posta scripts som körs varje gång meddelandet laddas.
 Jag åtgärdar detta med php-funktionen strip_tags och tar därmed bort alla tags när meddeleanden sparas. *

## Lösenord lagrade som plain text
* I databasen ligger lösenorden lagrade som plain text. Om en utomstående får tag på informationen i databasen skulle denne ha tillgång till alla användares uppgifter och kunna logga in som dem. 
Genom att hasha lösenorden med sha512 och använda motsvarande hashning när lösenorden kollas åtgärdas problemet. *

# Del 3 - AJAX
*Problembeskrivingen är generös nog att beskriva hur krav "bör" uppnås, och inte hur de "ska" uppnås. Jag skriver således en enkel lösning där funktionen getProducer kallas på efter ett lyckat meddelande vilket gör att meddelandena laddas om.
För att sortera dem efter datum ändrar jag på hur meddelandena skrivs ut genom att skriva funktionen getAllMessages, som hämtar alla meddelande sorterade efter variabeln serial.
Då serial är autoinkrementerane skrivs meddelandena ut i den ordning de skapades, så länge databasen inte manipuleras.*