#! /bin/bash

docker-compose run --rm oauth_server php bin/console $@
