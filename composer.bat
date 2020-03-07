#!/bin/bash

args="$@"
commandd="composer $args"
echo "$commandd"
docker exec -it laravel-app bash -c "sudo -u devuser /bin/bash -c \"$commandd\""