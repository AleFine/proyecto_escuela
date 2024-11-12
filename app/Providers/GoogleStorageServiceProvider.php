<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\FileSystem as UtilsFileSystem;

class GoogleStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Storage::extend('gcs', function($app, $config) {
            $storage = new StorageClient([
                'projectId' => $config['project_id'],
                'keyFilePath' => $config['key_file'],
            ]);
            
            $bucket = $storage->bucket($config['bucket']);
            
            $adapter = new GoogleCloudStorageAdapter($bucket, '');
            
            return new FilesystemAdapter(
                new Filesystem($adapter, ['visibility' => 'public']),
                $adapter,
                $config
            );
        });
        
    }
}
