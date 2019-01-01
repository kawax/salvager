# Salvager

WebCrawler.

Build with Laravel Dusk and Symfony DomCrawler.

- https://github.com/laravel/dusk
- https://github.com/symfony/dom-crawler

## Requirements
- PHP >= 7.1.3
- Latest Chrome. Linux, Mac, Windows.

## Installation

```
composer require revolution/salvager
```

### Laravel config(Option)
```
php artisan vendor:publish --provider="Revolution\Salvager\Providers\SalvagerServiceProvider"
```

### Lumen, Laravel Zero
- ServiceProvider: `Revolution\Salvager\Providers\SalvagerServiceProvider::class,`
- Facade: `Revolution\Salvager\Facades\Salvager::class,`

## Plain PHP Demo by Docker

```
git clone https://github.com/kawax/salvager.git salvager && cd $_

docker-compose run --rm composer install

docker-compose run --rm example google.php
//Show Google search results.
//Store screenshot at ./examples/screenshots/
```

## Usage(Laravel)

You can use the `Salvager` Facade anywhere. Controller, Command, Job...

```php
use Laravel\Dusk\Browser;
use Symfony\Component\DomCrawler\Crawler;

use Revolution\Salvager\Facades\Salvager;

class SalvagerController
{
    public function __invoke()
    {
        Salvager::browse(function (Browser $browser) use (&$crawler) {
            $crawler = $browser->visit('https://www.google.com/')
                               ->keys('input[name=q]', 'Laravel', '{enter}')
                               ->screenshot('google-laravel')
                               ->crawler();
        });

        /**
         * @var Crawler $crawler
         */
        $crawler->filter('.r')->each(function (Crawler $node) {
            dump($node->filter('h3')->text());
            dump($node->filter('a')->attr('href'));
        });
    }
}
```

https://github.com/kawax/salvager-project

## LICENSE
MIT  
Copyright kawax
