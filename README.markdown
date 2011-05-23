# Publicize for Kohana

Ever wanted to include static files within a Kohana module
but don't want to run them through a Controller everytime they
are required? Publicize is a tiny module that enables your
modules to contain static content such as .css and .js files
inside a folder called `public`.

## Environment

Dependant on your `Kohana::$environment`, Publicize will act in
different ways.

### Development

The file will be found and served via `Controller_Publicize`. This
will affect the performance of your application however it will
mean all assets shared by modules will be up to date.

### Testing and Staging

The first load of the file will go via `Controller_Publicize`
which will copy the file into `DOCROOT`, and send the file inline.
Thereafter it will be served as a static file.

### Production

The route will not be set by default in the production
environment for performance reasons.

## History

This module started as a [gist][].

[gist]: https://gist.github.com/899531

## Requires

 - PHP 5.3 +
 - Kohana 3.1 +
 
## Author

Luke Morton a.k.a. DrPheltRight

and contributors ^__^ Thank you!!

## License

Licensed under [MIT][].

[MIT]: http://opensource.org/licenses/mit-license.php