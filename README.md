# web_app

# 1. Descrizione generale del sito e delle sue macrosezioni:
Black Rose Tickets è un sito in cui poter acquistare biglietti di concerti online. I concerti in questione sono di
band principalmente hard rock e metal, quindi il pubblico del sito sarà principalmente gente a cui piacciono
questi generi.
- Homepage:
L’homepage (index.php) è la prima pagina che un utente può vedere. L’utente non iscritto non può
visualizzare i concerti, ma solo le band. L’utente iscritto può accedere tramite la pagina (login-form.php) e
poter usufruire di alter funzionalità: nella homepage l’utente può visualizzare, cercare e acquistare biglietti.
- Login/Registrazione oppure Logout:
Il login avviene nella pagina login-form.php che, con l’appoggio di login.php, controlla che l’utente sia
esistente nel database e, se è presente, allora lo fa entrare.
Nel caso in cui un utente non sia registrato, invece, deve registrarsi se vuole usufruire dei servizi del sito. Se
l’utente in fase di registrazione immette un’email già esistente nel database, o se inserisce due password
differenti, allora deve ricompilare il form.
Nel caso un utente si sia registrato oppure abbia effettuato il login, allora può effettuare il logout molto
semplicemente.
- Profilo:
In questa pagina l’utente che ha effettuato il login può osservare i suoi dati e può cambiare la password
immessa al momento dell’iscrizione.
- Categorie:
Qui l’utente che ha effettuato il login può selezionare una band per visualizzare direttamente I concerti
della band stessa, oppure può selezionare la categoria del genere che più gli piace e vedere le band per
ogni genere.
- Chi siamo:
La pagina about.php raccoglie le informazioni sul sito che i visitatori potrebbero chiedersi.

# 2. Funzionalità:
- Login:
La sezione login è stata sviluppata nel file login-form.php con l’aiuto di metodi implementati in login.php e
methods.php. Una volta premuto il bottone “log in”, nel caso in cui si siano seguite le istruzioni
correttamente, il sito invia la richiesta di accesso, l’email e la password al file login.php, tramite la variabile
$_POST, che controlla, utilizzando il file methods.php l’esistenza o meno dell’utente e il corretto
inserimento del nome e della password. Quindi, se l’utente esiste e la password è corretta, il server
caricherà index.php. Se, invece c’è l’email o la password errata, allora verrà stampato un errore e la pagina
caricata sarà sempre login.php.
- Registrazione:
Nel file newacc.php è presente il form che il nuovo utente deve compilare per potersi iscrivere. Sono
possibili due errori: se l’utente esiste già, ovvero se è già registrato con quella email oppure se la seconda 
password è diversa dalla prima. Nel caso in cui uno di questi errori sia presente, allora la pagina si ricarica,
stampa l’errore e l’utente deve riscrivere tutti i suoi dati.
Nel caso in cui non ci siano errori, l’utente viene inserito nel database e, per un maggiore controllo, deve
fare il login con l’email e la password immesse precedentemente.
- Logout:
Le due sessioni aperte una volta effettuato il login sono $_SESSION[‘nome’] e $_SESSION[‘login’]. Esse
servono per varie funzionalità e, soprattutto, per il logout. Una volta entrati, per uscire basta premere il
tasto del logout, le sessioni verranno chiuse e l’utente sarà indirizzato alla pagina principale.
- Sessioni, interrogazioni del db, validazione dei dati di input, sicurezza e usabilità:
Le uniche sessioni esistenti sono $_SESSION[‘login’] e $_SESSION[‘nome’]. Quella del login serve per sapere
se l’utente ha effettuato correttamente il login oppure no, mentre quella del nome serve per recuperare
immediatamente il nome dell’utente che ha effettuato il login.
Il database viene richiamato molto spesso tramite l’esecuzione di query, per questo motivo, nella cartella
“login” ho creato il file db.php che contiene la funzione per connettersi al database. Questo file viene
incluso in molti file contenenti funzioni o metodi importanti che hanno bisogno dell’integrazione con il
database. Ho adottato il meccanismo mysqli (mysql improved) per tutte le funzioni riguardanti il database.
Ogni dato di input inserito dall’utente, viene controllato tramite la funzione “filter_var($variabile da
analizzare, FILTER_SANITIZE_STRING/PASSWORD/EMAIL ecc)” in genere la variabile da analizzare viene
inviata tramite $_POST. Una particolarità sta nel fatto che la password non viene inviata direttamente al db,
ma viene prima criptata con il metodo md5($password), inserita nel db e, nel caso in cui si debba fare dei
controlli, si usa il metodo “password_verify” per confrontare la password md5 nel db e quella appena
inserita.

# 3. Front-end:
Tutto ciò che riguarda la presentazione si trova nella cartella “style” in cui sono presenti: top.php,
bottom.html, menu.php e csstot.css, file che racchiudono cose in comune a tutte le pagine importanti del
sito.
top.php e bottom.html: racchiudono il banner, il menu e il footer.
menu.php è un menù orizzontale che racchiude le pagine principali.
csstot.css contiene tutte le impostazioni di stile che servono per rendere la pagina responsive e più
bella graficamente.
Per quanto riguarda il cross-platform, il mio sito funziona correttamente sia su microsoft edge che su
google chrome con poche differenze.
Il mio progetto è illustrato nella figura 1 

# 4. Back-end e comunicazione back/front-end:
Ogni funzione php inerente un determinato argomento si trova nella cartella interessata, solitamente in un
file chiamato funtions.php o methods.php. La funzione più importante è quella che ci consente di
connetterci al database (db.php).
- Architettura: 
L’architettura back-end è formata dai seguenti file:
login.php: file utilizzato per controllare che i dati di login
inseriti dall’utente siano corretti e che l’utente sia presente nel
database.
acc.php: file utilizzato dal sito per controllare che i dati inseriti
al momento della registrazione siano corretti e che l’utente non
sia già registrato.
methods.php (in login), methods-cat.php (in cat), functionscart.php (in cart), changePsw.php (in profile) e function.php
sono i file che contengono i metodi che mi servono per
eseguire determinate azioni, ad esempio per poter cambiare la
password.
index.php: contiene una funzione JavaScript che utilizza una
query per interrogare il database e ajax per restituire la tabella
della band cercata senza dover ricaricare la pagina.
db.php: file utilizzato esclusivamente per connettersi al
database.
menu.php: file incluso in top.php (che a sua volta è incluso
nella maggior parte degli altri file) utilizzato per stampare il
menu in maniere diverse: se l’utente ha eseguito il login allora
vedrà titoli diversi (es. log out al posto di log in e “nome
utente” al posto di your profile)
- Funzioni Ajax
Come funziona la funzione per la ricerca:
1) creo il <div> con la barra di ricerca:
Figura 1: Il mio progetto 
2) Creo lo script utilizzando $.ajax:
Nel momento in cui si scrive (keyup), la
mia funzione manderà, tramite variabile
$_GET i dati inseriti al file search.php.
3) Nel file search.php eseguo la query che seleziona i concerti della band inserita nel text box.
E stampo i concerti disponibili in una tabella.
- Database:
Il database “blackrose” è composto da 4 cartelle: bands, concerti, shop e utenti.
Bands: contiene tutte le band associate a una propria id (chiave primaria, unica e che si
autoincrementa) e il genere musicale a cui appartiene. 
Concerti: contiene tutti i concerti disponibili. Ogni concerto ha la propria id, il luogo, la data, la
band e l’id della band in questione (band_id)
Utenti: contiene l’id dell’utente (chiave unica e primaria), l’email (chiave unica) e il nome e la
password criptata.
Shop: contiene l’id, l’id dell’utente (user) e l’id del concerto (concert).
- Condizioni di errore:
Le condizioni di errore sono state gestite tramite i vari file come login.php o acc.php. Nel caso in cui ci siano
degli errori allora:
 _ cambio la header: header(“Location: pagina-in-cui-ero.php?err”)
 _ nella pagina controllo se ho un $_GET[“err”] e stampo l’errore.
- Contenuto generato dall’utente:
Il contenuto generato dall’utente riguarda la possibilità di aggiungere un qualsiasi concerto nel suo carrello.
Oltre al fatto che l’utente può visualizzare i concerti che ha salvato, può anche eliminarli.
Una particolarità è che non si possono inserire più di due concerti nel proprio carrello. Quindi, se un utente
cambia idea, può cancellarne uno e sostituirlo con un altro.
L’unico errore possibile avviene quando l’utente prova ad inserire più di 2 concerti nel carrello.
L’inserimento e la cancellazione dal carrello avvengono tramite una query richiamata sul database. Nel caso
dell’inserimento si usa la funzione addToCart($id_user,$id_conc), nel caso della cancellazione si usa
deleteFromShop($id_shop,$id_user).
- Sicurezza:
Il sito è coperto da attacchi SQL injection e XSS perché viene utilizzata una funzione per cryptare le
passwrod inserite, si controllano tutti i dati di input dell’utente e l’utente che non ha effettuato il login non
può fare quasi nulla. 
