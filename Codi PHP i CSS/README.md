# Codi PHP i CSS

## Codi PHP

En la nostra pàgina web hem decidit triar el famós llenguatge PHP, on amb aquest gràcies a extensions i altres accedirem a la base de dades per a veure les dades i corroborar els "logins" de cadascun dels nostres pacients i metges.

En el cas dels pacients, és perquè ells accedeixin a les seves anàlisis sense la necessitat explicada en el resum, moure's de nou cap a les nostres clíniques i hospitals.

Mentre que en el cas dels metges serà poder accedir amb un usuari (DNI) i una contrasenya a la seva elecció, tots aquests creats amb anterioritat perquè puguin inserir dades, que aquests es trobaran en un arxiu JSON.

## Codi CSS

Òbviament, a l'ésser una pàgina web relacionada amb la sanitat, ha de ser seriosa i formal, amb colors molt nets i sense intents creatius.

Encara que la creativitat sigui la força de l'ésser humà, cal ser discrets i formals quan es tracta sobre dades personals sobre la salut cal ser molt categòriques.

Per tant, hem preferit triar 3 colors, blau, negre i blanc. Colors que es poden relacionar amb una clínica/hospital.

## Funcionament

En aquesta carpeta tot el nostre treball relacionat amb el codi PHP i CSS.

### Connexió a la Base de Dades

Per poder utilitzar les dades de la BD ens [connectarem](index.php) amb codi PHP per poder treballar amb el "include" que té el llenguatge per defecte.

### Inici

En el nostre codi està en diferents arxius, un d'ells òbviament és el nostre [inici](index.php). On podem veure que té la nostra plana i un petit resum de què volem aconseguir.

### Àrea Pacient

Quan accedim a [l'àrea del pacient](login_pacient.php) podem trobar el "login" del pacient on haurà d'accedir amb el seu DNI i l'ID de la prova.

Després d'això tindrà el [resultat de l'anàlisi](resultat_analisis.php) en un format taula totalment visible i entenedor.

### Àrea del Mèdic

Ara pels nostres mèdics tenen també el seu [espai](login_medic.php), per accedir a aquest ha de posar l'usuari o DNI, a elecció del mèdic i una contrasenya. Amb això accedirem al seu espai on podrem [inserir les dades](enviar_resultats.php) que té l'anàlisi del pacient.
