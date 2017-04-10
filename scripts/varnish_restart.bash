#!/usr/bin/env bash
# Generate a unique timestamp ID for this version of the VCL
TIME=$(date +%s)

echo 'hello' > /Users/gseidel/Workspace/xqweb/xqweb-cache/build/hello

#check compile
#varnishd -C -f /etc/varnish/default.vcl

# Load the file into memory
varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 vcl.load varnish_$TIME /etc/varnish/default.vcl

# Active this Varnish config
varnishadm -S /etc/varnish/secret -T 127.0.0.1:6082 vcl.use varnish_$TIME