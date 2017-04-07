include "backend.vcl";

acl local {
  "localhost";
}

sub vcl_recv
{
    call pipe_uncorrect_request_header;
    call common_recv;
    include "domain.vcl";
    set req.http.x-Redir-Url = "https://www.xq-web.de";
    error 750 req.http.x-Redir-Url;
}

sub common_recv
{
    /* Forward client ip */
    if (client.ip !~ local) {
       	set req.http.X-Forwarded-For = regsub(client.ip, ":.*", "");
    }

    /* We only deal with GET and HEAD by default */
#    if (req.request != "GET" && req.request != "HEAD")
#    {
#        return (pass);
#    }
}

sub pipe_uncorrect_request_header
{
#    if (req.request != "GET" &&
#    req.request != "HEAD" &&
#    req.request != "PUT" &&
#    req.request != "POST" &&
#    req.request != "TRACE" &&
#    req.request != "OPTIONS" &&
#    req.request != "DELETE") {
#
#    /* Non-RFC2616 or CONNECT which is weird. */
#      return (pipe);
#    }
}

/* fetch */

sub vcl_fetch
{

}

/* deliver */

sub vcl_deliver
{
    call edit_deliver_header;
}


sub edit_deliver_header
{
    unset   resp.http.Server;
    unset   resp.http.Age;
    unset   resp.http.X-Varnish;
    unset   resp.http.Via;
    unset   resp.http.X-Powered-By;
    set     resp.http.X-Served-By   = server.hostname;
}

#sub vcl_error {
#    set obj.http.Content-Type = "text/html; charset=utf-8";
#    synthetic {"
#    <?xml version="1.0" encoding="utf-8"?>
#    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
#    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
#    <html>
#    <head>
#      <title>404</title>
#      <style src="css/style.css"></style>
#    </head>
#    <body>
#    <h1>The server is being updated</h1>
#    <p>Please check back later. Meanwhile, here's a picture of a rabbit with a pancake on its head:</p>
#    <img src="img/wabbit.jpg" alt="awwwww!" />
#    </body>
#   </html>"};
#}

sub vcl_error {
    if (obj.status == 750) {
        set obj.http.Location = obj.response;
        set obj.status = 302;
        return (deliver);
    }
}