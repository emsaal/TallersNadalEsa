<strong>Autor: Emma S. Albano</strong>
<strong>Data: 12/05/2023</strong>
<hr>
<strong>COM DESPLEGAR EL PROJECTE</strong>

-   Abans de tot, anar a C:\Windows\System32\drivers\etc i afegir aquesta linea "127.0.0.1 TallersNadalEsa.com" al arxiu de HOSTS
-   Seguidament anar al terminal a la carpeta del projecte i executar <code>php artisan serve --host=TallersNadalEsa.com --port=8001</code> ".
-   Executem les migracions: <code>php artisan migrate</code>
Finalment anar a tallersnadalesa.com:8001

<strong>CANVIS AL .ENV </strong>

ID del google auth. S'hauria de canviar per que el login funciones correctament. Simplement afegint el propi<code>GOOGLE_OAUTH_ID="831786524398-d2b86ds9oistjgk0i5ei2f09fepjnsc1.apps.googleusercontent.com</code><br>
El mateix amb la KEY<code>GOOGLE_OAUTH_KEY="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</code><br>
Correu de el usuari que volem com a super admin <code>SUPERADMIN_MAIL="cicles@sapalomera.cat"</code><br>

<strong>ESPECIFICACIONS</strong>
<ul>
<li> L'actualització de les dades dels usuaris es realitza tota a partir del arxiu que es troba a /storage/data/usuaris.txt. Agafa tots els usuaris (alumnes i professors) i els edita si son existents, sinó els guarda com a nous usuaris. He editat l'arxiu perquè separi els camps a partir de tabuladors i he esborrat les primeres línies d'introdució. Si un nou alumne s'ha incorporat al centre. El admin i superadmin el poden introduir manualment desde gestionar alumnat->afegir alumne. Allà es poden especificar les seves dades, a més a més d'apuntar-lo als tallers. Un alumne es pot apuntar a un taller on el que no està destinat.
</li>
<li> Un alumne només podrà crear un taller cada any, si no ha creat un altre abans. A més a més haurà d'estar registrat en la base de dades. Si l'alumne intenta crear mes d'un taller sortira error. 
</li>
<li>El admin i super admin poden introduir manualment els tallers dels alumnes si hi ha la necessitat. A mes desde gestionar alumnat poden veure un llistat dels ALUMNES SENSE TALLER <em>Per apuntar als alumnes als tallers s'ha de clicar a editar el alumne, allà es poden editar les dades i afegir els tallers amb les prioritats</em></li> 
<li>Als tallers, els admins i superadmins poden asignar qui seràn els ajudants, clicant a Afegir responsable, s'afegeix un nou select amb la disponibilitat d'alumnes que hi han. Un alumne o professor pot ser ajudant en mes d'un taller. Si en el formulari no es selecciona cap ajudant, no passa res. Els tallers no tenen el requeriment de tenir ajudant</li>
</ul>
<li>Els alumnes poden decidir la prioritat dels tallers en els que volen participar. La conexió dels tallers i usuaris està feta amb una taula amb claus foranes i una columna anomenada positon. Aquesta fa referència a la prioritat en la que han escolit els tallers: <ul><li>[Position] 1 = Prioritat màxima</li>
<li>[Position] 2 = Prioritat mitja</li>
<li>[Position] 3 = Prioritat mínima</li></ul></li>
<li><em> Des de la fitxa del taller s'ha de poder accedir a la llista de "alumnes per taller"</em> Aquesta part no em quedava clar, així que ho he fet d'aquesta manera:<br>Quan un usuari li dona a "Detalls" en un taller, anirà a una pagina amb tots els detalls del taller, observacions, materials, el número d'alumnes apuntats, etc. Allà hi ha un enllaç on redirigirà al llistat dels alumnes apuntats al taller. Si es dona a tornar, torna als detalls del mateix taller</li>




