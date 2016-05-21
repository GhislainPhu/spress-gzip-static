# Spress Gzip Static

![Spress 2 ready](https://img.shields.io/badge/Spress%202-ready-brightgreen.svg?style=flat)

[Spress](https://github.com/spress/Spress) plugin to create a gzipped version of your compiled files.

This plugin is intended to be used in conjunction with NGINX's [gzip_static](http://nginx.org/en/docs/http/ngx_http_gzip_static_module.html) module.

## Getting Started

Add the following lines to your `composer.json` and run `composer update`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/GhislainPhu/spress-gzip-static"
    }
],
"require": {
    "ghislainphu/spress-gzip-static": "dev-master"
}
```

Add these lines to your `config.yml`:

```yaml
# Empty by default
gzip_static_extensions: [ html, css, js, xml, txt ]

# Excluded files (optional)
# gzip_static_exclude: [ rss.xml ]

# Compression Level (optional, default: -1)
# See: https://secure.php.net/manual/function.gzencode.php
# gzip_static_compression_level: 6
```

## License

This project is licensed under the MIT License.

See [LICENSE.md](https://github.com/GhislainPhu/spress-gzip-static/blob/master/LICENSE.md) for more informations.
