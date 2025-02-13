#!/bin/sh
set -e

if [ ! -d "vendor" ]; then
  composer install --no-dev --optimize-autoloader
fi

exec "$@"