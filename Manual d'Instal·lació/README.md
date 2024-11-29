# Manual d'Instal·lació

## Index

1. [Preparació del Servidor](#preparació-del-servidor)
2. [Configuració del Servidor Apache2](<Apache2/README.md>)
3. [Configuració del Servidor MySQL](<Codi SQL/README.md>)
4. [Creació del Codi PHP](<Codi PHP, JS i CSS/README.md>)

## Preparació del Servidor

### Instal·lació d'Apache2, MySQL i PHP

#### Actualització dels paquets

Per començar necesitarem un Servidor Ubuntu 22.04 o 24.04, els dos LTS. Amb aixà fet instal·larem els paquets que es requereixen, abans de tot farem:

```:
sudo apt update && upgrade
```

#### Instal·lació d'Apache2

Amb tots el paquets actualizats començarem amb l'instal·lació del servei Apache2:

```:
sudo apt install apache2 -y
```

I iniciarem el servei.

```:
sudo systemctl start apache2
```

#### Instal·lació de PHP

Ara amb aquest servei iniciat, instal·larem el paquet per poder utilitzar el paquet PHP:

```:
sudo apt install php
```

Pero per que Apache pugui llegir els PHP's necesitarem instal·lar-li una llibreria:

```:
sudo apt install libapache2-mod-php
```

#### Instal·lació de MySQL

Ara que el nostre Apache qque pot veure els PHP's instal·larem el servei MySQL.

```:
sudo apt install mysql-server
```

I iniciarem el servei.

```:
sudo systemctl start mysql
```

Amb aixo finalment, tenim el servidor preparat.
