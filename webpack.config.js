const Encore = require('@symfony/webpack-encore');
const EnhavoEncore = require('@enhavo/core/EnhavoEncore');

Encore
  .setOutputPath('public/build/enhavo/')
  .setPublicPath('/build/enhavo')
  .enableSingleRuntimeChunk()
  .enableSourceMaps(!Encore.isProduction())
  .splitEntryChunks()
  .autoProvidejQuery()
  .enableVueLoader()
  .enableSassLoader()
  .enableTypeScriptLoader()
  .enableVersioning(Encore.isProduction())

  .addEntry('enhavo/main', './assets/enhavo/main')
  .addEntry('enhavo/index', './assets/enhavo/index')
  .addEntry('enhavo/view', './assets/enhavo/view')
  .addEntry('enhavo/form', './assets/enhavo/form')
  .addEntry('enhavo/dashboard', './assets/enhavo/dashboard')
  .addEntry('enhavo/delete', './assets/enhavo/delete')
  .addEntry('enhavo/list', './assets/enhavo/list')
  .addEntry('enhavo/login', './assets/enhavo/login')
  .addEntry('enhavo/varnish', './assets/enhavo/varnish')
  .addEntry('enhavo/nginx', './assets/enhavo/nginx')
;

enhavoConfig = EnhavoEncore.getWebpackConfig(Encore.getWebpackConfig());
enhavoConfig.name = 'enhavo';

module.exports = [enhavoConfig];