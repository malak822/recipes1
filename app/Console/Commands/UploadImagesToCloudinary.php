<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

class UploadImagesToCloudinary extends Command
{
    protected $signature = 'upload:images';
    protected $description = 'Upload local images to Cloudinary';

    public function handle()
    {
        $cloudinary = new Cloudinary(
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => 'dzi7f2bhs',
                    'api_key'    => '836764113334569',
                    'api_secret' => '_LP9oB7ciMDPq9odvoeJnKQP8ZA',
                ],
                'api' => [
                    'secure' => true,
                ],
                'http' => [
                    'verify' => false,
                ]
            ])
        );

        $recipes = DB::table('recipes')->get();

        foreach ($recipes as $recipe) {
            $localPath = storage_path('app/public/' . $recipe->image);
            
            if (file_exists($localPath)) {
                $this->info("Uploading: " . $recipe->title);
                
                $result = $cloudinary->uploadApi()->upload($localPath, [
                    'folder' => 'recipes'
                ]);
                
                DB::table('recipes')
                    ->where('id', $recipe->id)
                    ->update(['image' => $result['secure_url']]);
                    
                $this->info("Done: " . $result['secure_url']);
            }
        }
        
        $this->info('All images uploaded!');
    }
}
