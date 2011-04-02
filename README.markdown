# Publicize for Kohana

Ever wanted to include static files within a Kohana module
but don't want to run them through a Controller everytime they
are required? Publicize is a tiny module that enables your
modules to contain static content such as .css and .js files
inside a folder called `public`.

You can then access these files publically, the first time the
file and folder structure will be copied to your DOCROOT. By
default Publicize will only be enabled when your application is
not in Kohana::PRODUCTION.

This module started as a gist: [https://gist.github.com/899531](https://gist.github.com/899531)

## Requires

 - PHP 5.3 +
 - Kohana 3.1 +
 
## Author

Luke Morton a.k.a. DrPheltRight

## License

[http://creativecommons.org/licenses/MIT/](http://creativecommons.org/licenses/MIT/)