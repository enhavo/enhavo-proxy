#!/usr/bin/env bash

echo "varnish restart"
#if [[ $(`varnishd -Cf /etc/varnish/default.vcl 2>&1 >/dev/null | grep 'VCL compilation failed'`) ]]; then
#    echo "VCL compilation failed"
#else
    # Generate a unique timestamp ID for this version of the VCL
    TIME=$(date +%s)
    # Load the file into memory
    varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 vcl.load varnish_$TIME /etc/varnish/default.vcl
    # Active this Varnish config
    varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 vcl.use varnish_$TIME
    echo "VCL reloaded"
#fi