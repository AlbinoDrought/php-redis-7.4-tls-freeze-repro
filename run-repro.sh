#!/bin/sh

cp /app/redis-certs/ca.pem /usr/local/share/ca-certificates/sample-ca.crt
update-ca-certificates --fresh

while true; do php repro.php; done
