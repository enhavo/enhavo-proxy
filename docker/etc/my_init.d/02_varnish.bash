#!/usr/bin/env bash
set -e
if [[ ! -f /etc/varnish/default.vcl ]]; then
    echo "init varnish config"
fi

service varnish start