<?php

namespace App\Console\Commands;

use Spatie\Crawler\Url;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // modify this to your own needs
        Sitemap::create()
            ->add(config('app.url'))
            ->add('/property-search')
            ->add('/listing')
            ->writeToFile(public_path('sitemap.xml'));
    }
}