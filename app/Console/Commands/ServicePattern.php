<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ServicePattern extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'make:service-pattern  {folderName?} {fileName}';
    protected $signature = 'make:service-pattern {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Service Interface pattern to bind with controller';



    /***
     * variable names
     */

    public string $fileName = '';
    public string $folders = '';



    /**
     * Execute the console command.
     */
    public function handle()
    {

        $folderPrefixName = 'Services';
        // Take input from artisan command
        $path  = $this->argument('path');
        $pathArray = explode('/', $path);


        // Custom Stub will be used to generate this file
        $stubServicePath = resource_path('stubs/service.stub');
        $stubInterfacePath = resource_path('stubs/serviceInterface.stub');



        // Stub content is being loaded and modified;
        $sContent = file_get_contents($stubServicePath);
        $serviceContent = str_replace(
            ['{{className}}', '{{classInterface}}'],
            [$this->fileName, 'I' . $this->fileName],
            $sContent
        );






        if (count($pathArray) > 1) {
            // Convert string into Array
            $folder = explode("/", $path);
            $folder = explode("/", $path);
            // Filter the array if any empty string is there
            $filterFolder = array_filter($folder);

            $this->fileName = array_pop($filterFolder);
            dd($this->fileName);
            return;
            $this->folders = implode('/', $filterFolder);
        } else {
            $this->fileName = $path;
        }


        $folderPath = base_path("app/$folderPrefixName" . ($this->folders ? "/$this->folders" : ''));

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
            $this->info("Services '[$folderPath]' created successfully");
        }


        $filePath = $folderPath . DIRECTORY_SEPARATOR . $this->fileName . '.php';

        //File path if file not created
        if (!File::exists($filePath)) {
            File::put($filePath, "<?php \n\n// This is the $this->fileName file.\n");
            $this->info("File '$this->fileName' created successfully in '$folderPrefixName'.");
        } else {
            $this->warn("File '$this->fileName' already exists in '$folderPrefixName'.");
        }

        return Command::SUCCESS;
    }
}
