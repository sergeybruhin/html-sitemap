# Laravel Html Sitemap

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sergeybruhin/html-sitemap.svg?style=flat-square)](https://packagist.org/packages/sergeybruhin/html-sitemap)
[![Total Downloads](https://img.shields.io/packagist/dt/sergeybruhin/html-sitemap.svg?style=flat-square)](https://packagist.org/packages/sergeybruhin/html-sitemap)

Basic and simple package to help you generate html sitemap inside your blade layout.

## Installation

You can install the package via composer:

```bash
composer require sergeybruhin/html-sitemap
```

## Publish Css File

```php
php artisan vendor:publish --provider="SergeyBruhin\HtmlSitemap\Providers\HtmlSitemapServiceProvider"
```

## Compose Sitemap in Controller
In controller do whatever you want just don't forget to pass **$htmlSitemap** to view. Cache this in a way you need.
```php
<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use SergeyBruhin\HtmlSitemap\Dto\HtmlSitemapCategory;
use SergeyBruhin\HtmlSitemap\HtmlSitemap;

class HtmlSitemapController
{
    public function __invoke(): View
    {
        $htmlSitemap = new HtmlSitemap;
        $htmlSitemap->addCategory($this->getPagesCategory());
        $htmlSitemap->addCategory($this->getPostsCategory());

        return view('your-layout-here')
            ->with('htmlSitemap', $htmlSitemap);
    }

    private function getPagesCategory(): HtmlSitemapCategory
    {
        $category = new HtmlSitemapCategory('Pages', route('pages'));
        Page::each(function (Page $page) use ($category) {
            $category->addLink($page->name, route('page', $page->slug));
        });
        return $category;
    }

    private function getPostsCategory(): HtmlSitemapCategory
    {
        $category = new HtmlSitemapCategory('News', route('posts'));
        Post::each(function (Post $post) use ($category) {
            $category->addLink($post->name, route('blog.show', $post->slug));
        });
        return $category;
    }

}
```

## Render Sitemap
Feel free to render sitemap in place you prefer.
```php
 @include('html-sitemap::widget')
```
Widget will be rendered if variable **$htmlSitemap** is set.

## Register route for your Controller
Not restrictions on url or route name, do there what you want.
```php
Route::get('sitemap', HtmlSitemapController::class)
    ->middleware('cache.headers:private;max_age=3600;etag')
    ->name('html-sitemap');
```
### Testing (Not yet 💁‍♂️)

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email sundaycreative@gmail.com instead of using the issue tracker.

## Credits

- [Sergey Bruhin](https://github.com/sergeybruhin)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
