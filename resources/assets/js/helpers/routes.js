(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["POST"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\AuthController@getLogout"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"dashboard","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/dv","name":"terceros.dv","action":"App\Http\Controllers\Admin\TerceroController@dv"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/rcree","name":"terceros.rcree","action":"App\Http\Controllers\Admin\TerceroController@rcree"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/search","name":"terceros.search","action":"App\Http\Controllers\Admin\TerceroController@search"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros","name":"terceros.index","action":"App\Http\Controllers\Admin\TerceroController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/create","name":"terceros.create","action":"App\Http\Controllers\Admin\TerceroController@create"},{"host":null,"methods":["POST"],"uri":"terceros","name":"terceros.store","action":"App\Http\Controllers\Admin\TerceroController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/{terceros}","name":"terceros.show","action":"App\Http\Controllers\Admin\TerceroController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"terceros\/{terceros}\/edit","name":"terceros.edit","action":"App\Http\Controllers\Admin\TerceroController@edit"},{"host":null,"methods":["PUT"],"uri":"terceros\/{terceros}","name":"terceros.update","action":"App\Http\Controllers\Admin\TerceroController@update"},{"host":null,"methods":["PATCH"],"uri":"terceros\/{terceros}","name":null,"action":"App\Http\Controllers\Admin\TerceroController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos","name":"modelos.index","action":"App\Http\Controllers\Tecnico\ModeloController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos\/create","name":"modelos.create","action":"App\Http\Controllers\Tecnico\ModeloController@create"},{"host":null,"methods":["POST"],"uri":"modelos","name":"modelos.store","action":"App\Http\Controllers\Tecnico\ModeloController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos\/{modelos}","name":"modelos.show","action":"App\Http\Controllers\Tecnico\ModeloController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"modelos\/{modelos}\/edit","name":"modelos.edit","action":"App\Http\Controllers\Tecnico\ModeloController@edit"},{"host":null,"methods":["PUT"],"uri":"modelos\/{modelos}","name":"modelos.update","action":"App\Http\Controllers\Tecnico\ModeloController@update"},{"host":null,"methods":["PATCH"],"uri":"modelos\/{modelos}","name":null,"action":"App\Http\Controllers\Tecnico\ModeloController@update"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // Route.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // Route.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // Route.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // Route.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // Route.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // Route.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.Route = laroute;
    }

}).call(this);
