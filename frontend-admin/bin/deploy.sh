#!/bin/bash

docker run --rm --interactive --tty --volume $PWD:/app composer install

docker compose up
