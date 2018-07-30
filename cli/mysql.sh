#! /bin/bash

source ./.env
docker-compose exec -e COLUMNS="$(tput cols)" -e LINES="$(tput lines)" db mysql -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE
