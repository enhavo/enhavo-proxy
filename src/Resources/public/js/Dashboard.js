define(['jquery', 'app/Router', 'app/Admin'], function($, router, admin) {
  return new (function()
  {
    var self = this;

    this.init = function() {
      self.initRestartNginx();
      self.initCompileNginx();
      self.initRestartVarnish();
      self.initCompileVarnish();
    };

    this.initRestartNginx = function() {
      $('[data-nginx-restart]').click(function (event) {
        event.preventDefault();
        var url = '/admin/nginx/restart';
        $.ajax({
          'url': url,
          success: function(data) {
            admin.overlay('<div class="console-output"><div class="output-container">'+data+'</div></div>');
          }
        });
      });
    };

    this.initCompileNginx = function() {
      $('[data-nginx-compile]').click(function (event) {
        event.preventDefault();
        var url = '/admin/nginx/compile';
        $.ajax({
          'url': url,
          success: function(data) {
            admin.overlay('<div class="console-output"><div class="output-container">'+data+'</div></div>');
          }
        });
      });
    };

    this.initRestartVarnish = function() {
      $('[data-varnish-restart]').click(function (event) {
        event.preventDefault();
        var url = '/admin/varnish/restart';
        $.ajax({
          'url': url,
          success: function(data) {
            admin.overlay('<div class="console-output"><div class="output-container">'+data+'</div></div>');
          }
        });
      });
    };

    this.initCompileVarnish = function() {
      $('[data-varnish-compile]').click(function (event) {
        event.preventDefault();
        var url = '/admin/varnish/compile';
        $.ajax({
          'url': url,
          success: function(data) {
            admin.overlay('<div class="console-output"><div class="output-container">'+data+'</div></div>');
          }
        });
      });
    };

    this.init();
  });
});