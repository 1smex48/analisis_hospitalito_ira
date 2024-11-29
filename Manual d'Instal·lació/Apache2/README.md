# Conguració del servidor Apache2

## Carpeta arrel del Site

Ara per que el servidor Apache pugui detectar la nostra plana, nosaltres em escollit crear una carpeta dins de /var/www/html anonemada analisis_hospitalito_ira.

```:
mkdir /var/www/html/analisis_hospitalito_ira 
```

## Configuració de l'arxiu .conf

Amb aixo fet configurarem el site d'Apache que s'anomenara hospitalitoira.cat.conf

```:
touch /etc/apache2/sites-available/hospitalitoira.cat.conf
```

Aquest fitxer contindra:

```:
<VirtualHost *:443>
    SSLEngine On
    SSLCertificateFile /home/iflor/hospitalitoira.com.crt
    SSLCertificateKeyFile /home/iflor/hospitalitoira.com.key
    ServerName hospitalitoira.com
    ServerAlias www.hospitalitoira.com
    DocumentRoot /var/www/html/analisis_hospitalito_ira

    <Directory /var/www/html/analisis_hospitalito_ira>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/hospitalitoira.com_error.log
    CustomLog ${APACHE_LOG_DIR}/hospitalitoira.com_access.log
</VirtualHost>
```

## SSL i HTTPS

Com es pot veure en la configuració es veu que hi ha SSL, per fer-ho vaig fer aquest processos:

Primer de tot vaig tenir que instal·lar el servei openssl-server.

```:
sudo apt install openssl
```

Amb aixo instal·lat farem aquest passos.

Crearem un CA (Certificate Authenticator), de la següent manera:

```:
openssl req -nodes -x509 -newkey rsa:2048 -days 1460 -keyout CA_IRA.key -out CA_IRA.crt
```

Amb el CA fet, farem el certificat.

```:
openssl req -new -x509 -nodes -days 1460 -keyout hospitalitoira.com.key -out hospitalitoira.com.crt
```

Ara caldrà fer el CSR (Certificate Signing Request):

```:
openssl req -new -key hospitalitoira.com.key -out hospitalitoira.com.csr
```

A més, actualment els navegadors consideren que el Common Name no és un paràmetre vàlid i s’han de generar amb el paràmetre SAN (Subject Alternative Name).
Per això caldrà que fem un fitxer addicional on hi indicarem els paràmetres SAN.

```:
nano hospitalitoira.com.ext
```

El contingut del fitxer es:

```:
subjectAltName = @alt_names
[alt_names]
DNS.1 = *.hospitalitoira.com
DNS.2 = hospitalitoira.com
```

Finalment farem que el CA autentifiqui el nostre fitxer.

```:
openssl x509 -CA CA_IRA.crt -CAkey CA_IRA.key -req -in hospitalitoira.com.csr -days 1460 -CAcreateserial -sha256 -out hospitalitoira.com.crt -extfile hospitalitoira.com.ext
```

Fora del servidor tindrem que importar el certificat CA al nostre navegador.

Despres d'això, activarem el modul que permet que el servidor Apache detecti el SSL i el port 443 (HTTPS).

```:
sudo a2enmod ssl
sudo a2nsite default-ssl.conf
```

## Activació del nostre Site

Amb aixo fet finalment podem activar el nostre site:

```:
sudo a2ensite hospitalitoira.cat.conf
```
