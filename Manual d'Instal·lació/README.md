# Manual d'Instal·lació

## Índex

1. [Preparació del Servidor](#preparació-del-servidor)
2. [Configuració del Servidor Apache2](<Apache2/README.md>)
3. [Configuració del Servidor MySQL](<MySQL/README.md>)
4. [Creació del Codi PHP](<../Codi PHP, JS i CSS/README.md>)

## Preparació del Servidor

### Instal·lació d'Apache2, MySQL i PHP

#### Actualització dels paquets

Per començar necessitarem un Servidor Ubuntu 22.04 o 24.04, els dos LTS. Amb aixà fet instal·larem els paquets que es requereixen, abans de tot farem:

```:
sudo apt update && sudo apt upgrade -y
```

#### Instal·lació d'Apache2

Amb tots els paquets actualitzats començarem amb la instal·lació del servei Apache2:

```:
sudo apt install apache2
```

I iniciarem el servei.

```:
sudo systemctl start apache2
```

#### Instal·lació de PHP

Ara amb aquest servei posat en marxa, instal·larem el paquet per poder utilitzar el paquet PHP:

```:
sudo apt install php
```

Però perquè Apache pugui llegir els PHP's necessitarem instal·lar-li una llibreria:

```:
sudo apt install libapache2-mod-php
```

#### Instal·lació de MySQL

Ara que el nostre Apache que pot veure els PHP's instal·larem el servei MySQL.

```:
sudo apt install mysql-server
```

I iniciarem el servei.

```:
sudo systemctl start mysql
```

Amb això finalment, tenim el servidor preparat.
