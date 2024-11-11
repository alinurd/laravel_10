<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateController extends Command
{
    protected $signature = 'make:templateController {name} {modul}';
    protected $description = 'Generate a custom controller with template';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controllerName = $this->argument('name');
        $modul = $this->argument('modul');

        // Tentukan path template controller
        $templatePath = resource_path('stubs/controller.stub');

        // Cek apakah template file ada
        if (!File::exists($templatePath)) {
            $this->error("Template file not found.");
            return;
        }

        // Ambil template dan ganti placeholder dengan nilai parameter
        $stub = File::get($templatePath);
        $stub = str_replace('{{ControllerName}}', $controllerName, $stub);
        $stub = str_replace('{{modul}}', $modul, $stub);

        // Tentukan path controller yang akan dibuat
        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

        // Simpan file controller
        File::put($controllerPath, $stub);

        $this->info("Controller {$controllerName} created successfully!");
    }
}
