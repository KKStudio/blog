Blog module for KK Studio CMS
===
This package is written for KK Studio's CMS available at [GitHub](https://github.com/KKStudio/cms)

Install through [Composer](http://getcomposer.org)

```
"kkstudio/blog": "dev-master"
```

Add service provider to your *config/app.php* file:

```
$providers = [
  ...
  'Kkstudio\Blog\BlogServiceProvider'
];
```

Finally run

```
composer update
```