<?php

namespace App\Providers;

use App\Contracts\FileValidatorInterface;
use App\Contracts\TemporaryFileManagerInterface;
use App\Converters\AudioConverter;
use App\Converters\DocumentConverter;
use App\Converters\ImageConverter;
use App\Converters\PresentationConverter;
use App\Converters\SpreadsheetConverter;
use App\Converters\VideoConverter;
use App\Services\ConverterRegistry;
use App\Services\ConversionService;
use App\Services\FileValidator;
use App\Services\TemporaryFileManager;
use Illuminate\Support\ServiceProvider;

class ConverterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ConverterRegistry::class, function () {
            $registry = new ConverterRegistry();

            $registry->register(new ImageConverter());
            $registry->register(new VideoConverter());
            $registry->register(new AudioConverter());
            $registry->register(new DocumentConverter());
            $registry->register(new SpreadsheetConverter());
            $registry->register(new PresentationConverter());

            return $registry;
        });

        $this->app->bind(FileValidatorInterface::class, FileValidator::class);
        $this->app->bind(TemporaryFileManagerInterface::class, TemporaryFileManager::class);

        $this->app->singleton(ConversionService::class, function ($app) {
            return new ConversionService(
                $app->make(ConverterRegistry::class),
                $app->make(FileValidatorInterface::class),
                $app->make(TemporaryFileManagerInterface::class),
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
