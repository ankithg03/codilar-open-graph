# Magento 2 Search Engine Optimization

Magento 2 Module to Improve Search Engine Optimization via OpenGraph on your Magento site.

## Documentation
```sh
https://docs.google.com/document/d/1cKSsQaRbYkRvoehY1kWexUJB6IrmgWX2Q1qQk3h_e3I/edit?usp=sharing
```
## Installation

Install the module via composer like so:

```sh
composer require ankith/open-graph-extension
```

For Magento 2.1.x use release [1.6.1](https://github.com/ankithg03/codilar-open-graph/releases/tag/1.6.1)

```sh
composer require ankith/open-graph-extension
```


## Usage

The Module will automatically optimize and improve the performance of your Magento-based store in Search Engines.

By Adding: 

- [Structured Data](http://ogp.me/)

    - For CMS Pages
        ```html
        <meta property="og:title" content="Home page" />
        <meta property="og:description" content="CMS homepage content goes here." />
        <meta property="og:url" content="http://example.com/" />
        <meta property="og:image" content="http://example.com/pub/static/logo.svg" />
        ```
        
    - For Custom Routes/Pages
        ```html
        <meta property="og:title" content="Contact" />
        <meta property="og:description" content="Contact Us for any issue you are facing" />
        <meta property="og:url" content="http://example.com/contact/" />
        <meta property="og:image" content="http://example.com/pub/static/logo.svg" />
        ```
        
    - For Categories
        ```html
        <meta property="og:title" content="Demo Category" />
        <meta property="og:url" content="http://example.com/demo-category.html" />
        <meta property="og:description" content="This is a Demo Category" />
        <meta property="og:image" content="http://example.com/media/catalog/category/demo.png" />
        ```
          
    - For Products
        ```html
        <meta property="og:title" content="Demo Product" />
        <meta property="og:description" content="Demo Product Short Description" />
        <meta property="og:image" content="http://example.com/media/catalog/product/cache/0f831c1845fc143d00d6d1ebc49f446a/o/p/demo.png" />
        <meta property="og:url" content="http://example.com/demo-product.html" />
        <meta property="og:type" content="og:product" />
        <meta property="product:price:amount" content="125.5" />
        <meta property="product:price:currency" content="CHF"/>
        ```
## Requirements

- PHP: > 7.2
- Magento 2.2.x | 2.3.x

## Test Cases

https://docs.google.com/spreadsheets/d/195jY4uHxhx19A4gZFmmm4-31g-1SZh3uThgrnCfXnxw/edit?usp=sharing

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/ankithg03/codilar-open-graph/issues).

Developer
---------
Ankith G, and all other [contributors](https://github.com/ankithg03/codilar-open-graph/contributors)
