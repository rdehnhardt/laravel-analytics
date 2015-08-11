var elixir = require('laravel-elixir');

elixir(function (mix) {

    mix.scripts(["resources/assets/analytics,js"], 'resources/assets/analytics.min.js', './');

});
