COM DESPLEGAR EL PROJECTE

-   Abans de tot, anar a C:\Windows\System32\drivers\etc i afegir aquesta linea "127.0.0.1 TallersNadalEsa.com" al arxiu de HOSTS
-   Seguidament anar al terminal a la carpeta del projecte i executar "php artisan serve --host=TallersNadalEsa.com --port=8001 ".
Finalment anar a tallersnadalesa.com:8001

- [x] INICI SESSIÓ
- [x] PERMISOS ESPECIALS
- [x] CREACIÓ DE TALLERS
- [ ] GENERACIÓ D'INFORMES
- [ ] TRACTAMENT D'IMATGES

-   L'actualització de les dades dels usuaris es realitza tota a partir del arxiu que es troba a /storage/data/usuaris.txt. Agafa tots els usuaris (alumnes i professors) i els edita si son existents, sinó els guarda com a nous usuaris. He editat l'arxiu perquè separi els camps a partir de tabuladors i he esborrat les primeres línies d'introdució.

