# Mashup-applikation
##Projektidé

Min idé är en applikation som kombinerar giantbomb.coms databas med utvecklare och företag och individuella utvecklare med gamesradar.coms databas med spelrecensioner. Denna data skall sedan användas för att kartlägga kvaliteten på de spel som de olika utvecklarna och företagen varit delaktiga i. Informationen skall redovisas i form av till exemepel grafer och genomsnittssiffror. Man skulle även kunna ta yttelrigare steg och gruppa ihop utvecklare tillsammans för att se hur de arbetar tillsammans, hur de arbetar på ett visst företag, hur olika företag (till exempel utvecklingsstudio/utgivare) fungerar tillsammans.

*Läs igenom dokumentationen till de API:er du använder. Vad är dina tankar om den?*

Gamesradars dokumentation verkar väldigt utförlig och beskriver i detalj all data som kan hämtas med exempel. Den senaste versionen av dokumentationen är dock fem år gammal, vilket innebär att det är oklart om plattformar som släppts sedan dess är inkluderade i API:et.
Giantbombs dokumentation kommer i form av ett dokument som beskriver vad det är för data som kan hämtas, samt ett forum med med guider och frågor. Det faktum att det finns ett forum där man kan ställa frågor känns ytterst fördelaktigt, förutsatt att det finns andra utvecklare där som kan svara.

*Vilket/vilka dataformat kan dina valda API:er leverera?*

Gamesradar levererar data som i XML-format, Giantbomb erbjuder XML och Json.

*Finns det några speciella krav för att använda de API:er du valt? Kostnad, begränsningar e.c.t*

Giantbomb är liberala i sina villkor och kräver endast att applikationen är icke-komersiell, inte konkurerar med giantbomb.com, länkar till giantbomb där api:et används och att deras information inte manipuleras.
Gamesradar verkar betydligt striktare, främst då man anger en begränsing på ett anrop i sekunden, max 10000 anrop per dag, max 40K per fil. De tillåter inte heller att man modifierar deras data och kräver att man anger dem som källa.
Båda siterna använder sig av ett key-system, giantbomb kräver endast att man registrerar sig för att få en nyckel medan gamesradar kräver att man uttryckligen ber om en nyckel som man sedan får skickad till sig mot en beskrivning av sin applikation.

*Vilka risker ser du med att bygga en tjänst kring de API:er du valt?*
Både siterna reserverar rätten att med omedelbar verkan inaktivera api-nyckeln om de av någon anledning skulle vilja det. Det är särskilt viktigt i gamesradars fall där man angen en utrycklig gräns för hur mycket data man får hämta.

##Fallstudie

*Varför är denna applikation ett bra exempel på mashup-applikation?*

Det som gör omvard.se bra är att den lyckats samla information från väldigt många olika källor. Det som gör den bra ur ett mashup-perspektiv är att den lyckas presentera all denna information med en tilltalande och luftig deisgn med mycket grafer, utan att informationen begravs i menyer och submenyer, nåt jag själv tycker låter väldigt svårt när det finns 15 olika källor att hålla reda på och dessutom finns egen data att presentera (i det här fallet, alla användarinlägg). Applikationen är även bra på att informera om när det INTE finns information, genom att till exempel använda utgråade knappar och dylikt. 
Något som applikationen behöver mer av är dock dessa användarinlägg. Det finns givetvis många vårdcentraler och mycket att kommentera, men hade applikationen helt enkelt varit mer populär och man fått mer feedback från patienterna hade applikationen kunnat kännas ännu mer komplett.

*På vilket sätt kombineras datakällorna och vilken ny effekt får dessa tillsammans?*

Genom att hämta och presentera data från alla diverse api:er samtidigt som man samlar in information från faktiska patienter får man flera perspektiv när man ser på datan. Man får dels kall, hård statistik samtidigt som man i löpande text får synpunkter och åsikter från slutanvändare. Applikationen är mycket fokuserad på att hämta information och visa den, snarare än att skapa något nytt och jordomskakande genom fusion av informationen, men bara det faktum att den presenteras sida vid sida gör att den används väl.