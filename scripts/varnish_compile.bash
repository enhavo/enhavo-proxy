#!/usr/bin/env bash

echo "varnish compile"
BASEDIR=$(dirname $0)
cd $BASEDIR/..
app/console varnish:compile
