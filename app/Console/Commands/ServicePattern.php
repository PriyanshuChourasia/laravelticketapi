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
    public string $serviceProvider = '';



    /**
     * Execute the console command.
     */
    public function handle()
    {

        $folderPrefixName = 'Services';
        $folderInterfacePrefix = 'Interfaces';
        $this->serviceProvider = 'ServicesServiceProvider';
        // Take input from artisan command
        $path  = $this->argument('path');
        $pathArray = explode('/', $path);






        if (count($pathArray) > 1) {
            // Convert string into Array
            $folder = explode("/", $path);
            $folder = explode("/", $path);
            // Filter the array if any empty string is there
            $filterFolder = array_filter($folder);

            $this->fileName = array_pop($filterFolder);
            $this->folders = implode('/', $filterFolder);
        } else {
            $this->fileName = $path;
        }

        $providerPath =  base_path('app/Providers/');
        $providerFilePath = $providerPath . DIRECTORY_SEPARATOR . $this->serviceProvider . '.php';



        if (!File::exists($providerFilePath)) {
            echo $this->serviceProvider;
            File::put($providerFilePath, "<?php namespace // File created");
            $this->info("Provider created successfully");
        } else {
            $this->warn('File aready exists');
        }

        $classNamePath = "App\\Providers\\{$this->serviceProvider}";

        if (class_exists($classNamePath)) {
            $hasBootMethod = method_exists($classNamePath, 'boot');
            if ($hasBootMethod) {
                $fileContent = File::get($providerFilePath);
                $bootMethodPosition = strpos($fileContent, 'public function boot()');
                $methodEndPosition = strpos($fileContent, '}', $bootMethodPosition);
                $bootMethodContent = substr($fileContent, $bootMethodPosition, $methodEndPosition - $bootMethodPosition + 1);
                $newBootContent = str_replace(
                    '}',
                    "\n \$this->app->bind({$this->fileName}::class);\n
                }",
                    $bootMethodContent
                );

                $updatedContent = str_replace($bootMethodContent, $newBootContent, $fileContent);

                File::put($providerFilePath, $updatedContent);

                $this->info("Code added to the boot method successfully.");
            } else {
                $this->warn('Boot method does not exist in the class.');
            }
        } else {
            $this->error("The class name {$classNamePath}");
        }









        // Namespace
        $namespace = 'App\\' . $folderPrefixName . ($this->folders ? '\\' . str_replace('/', '\\', $this->folders) : '');
        $interfaceNamespace = 'App\\' . "$folderPrefixName\Interfaces" . ($this->folders ? '\\' . str_replace('/', '\\', $this->folders) : '');
        $interfacePath = 'App\\' . "$folderPrefixName\Interfaces" . ($this->folders ? '\\' . str_replace('/', '\\', "$this->folders\I$this->fileName") : "\I$this->fileName");

        // Custom Stub will be used to generate this file
        $stubServicePath = resource_path('stubs/service.stub');
        $stubInterfacePath = resource_path('stubs/serviceInterface.stub');

        // Service Provider file path







        // Stub content is being loaded and modified;
        $sContent = file_get_contents($stubServicePath);
        $serviceContent = str_replace(
            ['{{ namespace }}', '{{ classInterfacePath }}', '{{ className }}', '{{ classInterface }}'],
            [$namespace, $interfacePath, $this->fileName, 'I' . $this->fileName],
            $sContent
        );

        $sInterfaceContent = file_get_contents($stubInterfacePath);
        $serviceInterfaceContent = str_replace(
            ['{{ namespace }}', '{{ serviceInterface }}'],
            [$interfaceNamespace, 'I' . $this->fileName],
            $sInterfaceContent
        );



        $folderPath = base_path("app/$folderPrefixName" . ($this->folders ? "/$this->folders" : ''));


        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
            $this->info("Services '[$folderPath]' created successfully");
        }

        $interfaceFolderPath = base_path("app/$folderPrefixName/$folderInterfacePrefix" . ($this->folders ? "/$this->folders" : ''));


        if (!File::exists($interfaceFolderPath)) {
            File::makeDirectory($interfaceFolderPath, 0755, true);
            $this->info("Service Interface '[$interfaceFolderPath]' created successfully");
        }


        $filePath = $folderPath . DIRECTORY_SEPARATOR . $this->fileName . '.php';

        //File path if file not created
        if (!File::exists($filePath)) {
            // file_put_contents($filePath, $serviceContent);
            File::put($filePath, $serviceContent);
            $this->info("File '$this->fileName' created successfully in '$folderPrefixName'.");
        } else {
            $this->warn("File '$this->fileName' already exists in '$folderPrefixName'.");
        }



        // Service Interface File Path
        $interfaceFilePath = $interfaceFolderPath . DIRECTORY_SEPARATOR . "I$this->fileName" . '.php';



        // Iterface File Path
        if (!File::exists($interfaceFilePath)) {
            File::put($interfaceFilePath, $serviceInterfaceContent);
            $this->info("File [$this->fileName] Interface created successfully in '$folderInterfacePrefix'.");
        } else {
            $this->warn("File '$this->fileName' already exists in '$folderInterfacePrefix'.");
        }

        return Command::SUCCESS;
    }
}
