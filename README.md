# DockerPress

O objetivo deste projeto é criar um workflow para o desenvolvimento de sites com Wordpress utilizando o Docker.

## Como Instalar

Você vai precisar de Docker e do Docker-Compose.  
A bordamos aqui a instalação do docker e docker-compose, para usuários que utilizam distribuições Linux baseada no Debian

#### Instalação do Docker

```sh
$ sudo apt-get install curl -y  
$ curl -fsSL get.docker.com -o get-docker.sh  
$ sudo sh get-docker.sh  
$ sudo usermod -aG docker $USER
```

#### Instalação do Docker-Compose

```sh
$ sudo curl -L https://github.com/docker/compose/releases/download/1.18.0/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
$ sudo chmod +x /usr/local/bin/docker-compose
```
Para maiores detalhes da instalação do docker e docker-compose:
 
[Docker](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/)  
[Docker-Compose](https://docs.docker.com/compose/install/#install-compose)

#### Clonar o repositório e executar o docker-compose

```sh
$ git clone git@github.com:lazarocastro/DockerPress.git
$ cd DockerPress
$ docker-compose up -d
```

## Como Utilizar

Se você executou os paços acima, então significa que o subiu os containers com o wordpress, mysql e o phpmyadmin.
para acessa-los basta digitar [localhost:8000](http://localhost:8000) (para o wordpress) e [localhost:8080](http://localhost:8080) (para o phpmyadmin).

## Como gerenciar os containers  
# EM BREVE...
