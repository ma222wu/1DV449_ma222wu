# Del 1 - Optimering

## Fj�rrbel�gen CSS i mess.php
*I mess.php h�mtas tv� .css-filer fr�n en fj�rrbel�gen server. Genom att l�gga de p� den lokala servern 
g�r laddningstiden p� sidan fr�n lite mer �n 2 sekunder till ungef�r 300 millisekunder. *

## Saknade .js-filer i mess.php
*Filerna js/ajax_minified.js och js/longpoll.js finns inte p� servern. Genom att ta bort referenser till dessa filer 
sjunker laddningstiden sjunker laddningstiden till mellan 150 och 300 millisekunder. *

## Alla meddelanden h�mtas individuellt
* I javascript-funktionen g�rs ett ajax-anrop per meddelande med hj�lp av php-funtionen getMessage. Genom att skapa funktionen getAllMessages som h�mtar alla meddelanden 
g�rs bara ett ajax-anrop och en l�sning ur databasen oavsett hur m�nga meddelanden som finns. N�gon st�rre skillnad m�rks inte n�r det finns f� meddelanden, men n�r jag l�gger till
 40 meddelanden f�r en viss producent tar det ungef�r 200 millisekunder f�re mina redigeringar och 50 millisekunder efter. *

## Oanv�nda .js-filer
* Enligt High Performance Websites �kar sitens prestanda ju f�rre filer man h�mtar. Genom att radera referenser till filerna modernizr.custom.js och ajax_minified.js tar det nu 
200 millisekunder ist�llet f�r 300 innnan min webbl�sare rapporterar DOMContentLoaded. *

## Sleep i middle.php
* Av n�gon anledning kallas php-funktionen sleep(2) i middle.php, varefter man redirectas till mess.php. Detta g�r att det automatiskt br�nns 2 sekunder varje g�ng en inloggning sker. 
Varf�r man g�r s� h�r vet jag inte, men jag utg�r fr�n att det �r f�r laborationens skull. *

## On�dig redirect i check.php
* Enligt kapitel 11 i boken High Performance Websites b�r man undvika redirects. Genom att helt strunta i att redirecta fr�n check.php till middle.php och vidare till mess.php och ist�llet
 g� direkt fr�n check till mess undviks en redirect jag utg�r fr�n �r helt on�dig. Resultatet blir emellertid endast ett f�tal sparade millisekunder, f�ga imponerande efter de 2 sekunder 
f�rra steget resulterade i. *

# Del 2 - S�kerhet
## Ifyllda anv�ndaruppgifter
* I index.php skrivs anv�ndarnamn och korrekt l�senord f�r admin ut som default i inloggningsf�lten. Detta g�r att vem som helst kan logga in som anv�ndaren admin utan problem. 
Jag tar bort dessa defaultv�rden fr�n formul�ret.*

## Valfri namngivning vid meddelande
* N�r anv�ndaren vill skriva ett nytt meddelande kan han ange vilken namn han vill. Man kan s�ledes posta meddelanden som kan se ut att vara fr�n vem som helst.
Jag raderar f�ltet f�r namn och ser till s� att $_SESSION['user'] alltid s�tts som f�rfattare n�r ett nytt meddelande skickas. *

## Tags till�ts i meddelanden
* En anv�ndare kan skriva html-tags i sina meddelanden. Detta g�r att anv�ndare till exempel skulle kunna posta scripts som k�rs varje g�ng meddelandet laddas.
 Jag �tg�rdar detta med php-funktionen strip_tags och tar d�rmed bort alla tags n�r meddeleanden sparas. *

## L�senord lagrade som plain text
* I databasen ligger l�senorden lagrade som plain text. Om en utomst�ende f�r tag p� informationen i databasen skulle denne ha tillg�ng till alla anv�ndares uppgifter och kunna logga in som dem. 
Genom att hasha l�senorden med sha512 och anv�nda motsvarande hashning n�r l�senorden kollas �tg�rdas problemet. *

# Del 3 - AJAX
*Problembeskrivingen �r gener�s nog att beskriva hur krav "b�r" uppn�s, och inte hur de "ska" uppn�s. Jag skriver s�ledes en enkel l�sning d�r funktionen getProducer kallas p� efter ett lyckat meddelande vilket g�r att meddelandena laddas om.
F�r att sortera dem efter datum �ndrar jag p� hur meddelandena skrivs ut genom att skriva funktionen getAllMessages, som h�mtar alla meddelande sorterade efter variabeln serial.
D� serial �r autoinkrementerane skrivs meddelandena ut i den ordning de skapades, s� l�nge databasen inte manipuleras.*