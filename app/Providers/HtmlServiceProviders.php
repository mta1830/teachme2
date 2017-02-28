<?php
namespace TeachMe\Providers;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProviders;
use TeachMe\Components\HtmlBuilder;

class HtmlServiceProviders extends CollectiveHtmlServiceProviders
{
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('html', function ($app) {
            return new HtmlBuilder($app['url']);
        });
    }
}
