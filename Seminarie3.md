# Mashup-applikation
##Projektid�

Min id� �r en applikation som kombinerar giantbomb.coms databas med utvecklare och f�retag och individuella utvecklare med gamesradar.coms databas med spelrecensioner. Denna data skall sedan anv�ndas f�r att kartl�gga kvaliteten p� de spel som de olika utvecklarna och f�retagen varit delaktiga i. Informationen skall redovisas i form av till exemepel grafer och genomsnittssiffror. Man skulle �ven kunna ta yttelrigare steg och gruppa ihop utvecklare tillsammans f�r att se hur de arbetar tillsammans, hur de arbetar p� ett visst f�retag, hur olika f�retag (till exempel utvecklingsstudio/utgivare) fungerar tillsammans.

*L�s igenom dokumentationen till de API:er du anv�nder. Vad �r dina tankar om den?*

Gamesradars dokumentation verkar v�ldigt utf�rlig och beskriver i detalj all data som kan h�mtas med exempel. Den senaste versionen av dokumentationen �r dock fem �r gammal, vilket inneb�r att det �r oklart om plattformar som sl�ppts sedan dess �r inkluderade i API:et.
Giantbombs dokumentation kommer i form av ett dokument som beskriver vad det �r f�r data som kan h�mtas, samt ett forum med med guider och fr�gor. Det faktum att det finns ett forum d�r man kan st�lla fr�gor k�nns ytterst f�rdelaktigt, f�rutsatt att det finns andra utvecklare d�r som kan svara.

*Vilket/vilka dataformat kan dina valda API:er leverera?*

Gamesradar levererar data som i XML-format, Giantbomb erbjuder XML och Json.

*Finns det n�gra speciella krav f�r att anv�nda de API:er du valt? Kostnad, begr�nsningar e.c.t*

Giantbomb �r liberala i sina villkor och kr�ver endast att applikationen �r icke-komersiell, inte konkurerar med giantbomb.com, l�nkar till giantbomb d�r api:et anv�nds och att deras information inte manipuleras.
Gamesradar verkar betydligt striktare, fr�mst d� man anger en begr�nsing p� ett anrop i sekunden, max 10000 anrop per dag, max 40K per fil. De till�ter inte heller att man modifierar deras data och kr�ver att man anger dem som k�lla.
B�da siterna anv�nder sig av ett key-system, giantbomb kr�ver endast att man registrerar sig f�r att f� en nyckel medan gamesradar kr�ver att man uttryckligen ber om en nyckel som man sedan f�r skickad till sig mot en beskrivning av sin applikation.

*Vilka risker ser du med att bygga en tj�nst kring de API:er du valt?*
B�de siterna reserverar r�tten att med omedelbar verkan inaktivera api-nyckeln om de av n�gon anledning skulle vilja det. Det �r s�rskilt viktigt i gamesradars fall d�r man angen en utrycklig gr�ns f�r hur mycket data man f�r h�mta.

##Fallstudie

*Varf�r �r denna applikation ett bra exempel p� mashup-applikation?*

Det som g�r omvard.se bra �r att den lyckats samla information fr�n v�ldigt m�nga olika k�llor. Det som g�r den bra ur ett mashup-perspektiv �r att den lyckas presentera all denna information med en tilltalande och luftig deisgn med mycket grafer, utan att informationen begravs i menyer och submenyer, n�t jag sj�lv tycker l�ter v�ldigt sv�rt n�r det finns 15 olika k�llor att h�lla reda p� och dessutom finns egen data att presentera (i det h�r fallet, alla anv�ndarinl�gg). Applikationen �r �ven bra p� att informera om n�r det INTE finns information, genom att till exempel anv�nda utgr�ade knappar och dylikt. 
N�got som applikationen beh�ver mer av �r dock dessa anv�ndarinl�gg. Det finns givetvis m�nga v�rdcentraler och mycket att kommentera, men hade applikationen helt enkelt varit mer popul�r och man f�tt mer feedback fr�n patienterna hade applikationen kunnat k�nnas �nnu mer komplett.

*P� vilket s�tt kombineras datak�llorna och vilken ny effekt f�r dessa tillsammans?*

Genom att h�mta och presentera data fr�n alla diverse api:er samtidigt som man samlar in information fr�n faktiska patienter f�r man flera perspektiv n�r man ser p� datan. Man f�r dels kall, h�rd statistik samtidigt som man i l�pande text f�r synpunkter och �sikter fr�n slutanv�ndare. Applikationen �r mycket fokuserad p� att h�mta information och visa den, snarare �n att skapa n�got nytt och jordomskakande genom fusion av informationen, men bara det faktum att den presenteras sida vid sida g�r att den anv�nds v�l.