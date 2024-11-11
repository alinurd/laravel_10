<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateController extends Command
{
    protected $signature = 'make:templateController {name} {modul}';
    protected $description = 'Generate a custom controller with template';

    
    protected $list = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
         
        $controllerName = $this->argument('name');
        $modul = $this->argument('modul');

         
        while (true) {
            $field = $this->ask('Please enter a field (or type "n" to finish):');
            if (strtolower($field) === 'n') {
                break;
            }

             
            $type = $this->ask("Please enter type for field '{$field}' (default: text):", 'text');

            
            $option = [];
            if ($type === 'select') {
                $this->info("You can add multiple options. Type 'n' when you are finished.");

                while (true) {
                    $optionInput = $this->ask("Enter an option for field '{$field}' (format: id:value), or type 'n' to finish:");
                    if (strtolower($optionInput) === 'n') {
                        break;
                    }

                   
                    list($id, $value) = explode(':', $optionInput);
                    $option[] = ['id' => trim($id), 'value' => trim($value)];
                }
            }

            
            $this->list[] = [
                'field' => $field,
                'type' => $type,
                'filter' => false,
                'position' => false,
                'show' => true,
                'required' => true,
                'rules' => ['required', 'string'],  
                'option' => $option,  
            ];
        }

      
        $templatePath = resource_path('stubs/controller.stub');

    
        if (!File::exists($templatePath)) {
            $this->error("Template file not found.");
            return;
        }

        $stub = File::get($templatePath);
        $stub = str_replace('{{ControllerName}}', $controllerName, $stub);
        $stub = str_replace('{{modul}}', $modul, $stub);

         
        $listString = '';
        foreach ($this->list as $field) {
            $fieldString = "
            [
                'field' => '{$field['field']}',
                'type' => '{$field['type']}',
                'filter' => " . var_export($field['filter'], true) . ",
                'position' => " . var_export($field['position'], true) . ",
                'show' => " . var_export($field['show'], true) . ",
                'required' => " . var_export($field['required'], true) . ",
                'rules' => " . var_export($field['rules'], true);

            
            if (!empty($field['option'])) {
                $optionString = '';
                foreach ($field['option'] as $option) {
                    $optionString .= "
                    [
                        'id' => {$option['id']},
                        'value' => '{$option['value']}'
                    ],";
                }
                 
                $optionString = rtrim($optionString, ',');
                $fieldString .= ",
                'option' => [$optionString]";
            }
 
            $fieldString .= "
            ],";

             $listString .= $fieldString;
        }

         $stub = str_replace('{{list}}', rtrim($listString, ','), $stub);

         $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

         File::put($controllerPath, $stub);

         
    $this->info("Controller '{$modul}' created successfully at '{$controllerPath}'.");

 
         $createLang = $this->confirm("Do you want to create the lang file for module '{$modul}'?", true);

        if ($createLang) {
            $this->createLangFile($modul, $controllerName);
        }
    }

    private function createLangFile($modul, $controllerName)
    {
        $langPath = resource_path("lang/en/{$modul}.php");
    
        if (File::exists($langPath)) {
            $this->info("Lang file for '{$modul}' already exists.");
            return;
        }
    
        // Meminta pengguna mengisi nilai untuk title dan page
        $titleTranslation = $this->ask("Enter translation for title");
        $pageTranslation = $this->ask("Enter translation for page");
    
        // Buat file lang baru dengan title dan page yang diisi pengguna
        $langContent = "<?php\n\nreturn [\n";
        $langContent .= "    'title' => '{$titleTranslation}',\n";
        $langContent .= "    'page' => '{$pageTranslation}',\n";
    
        // Menambahkan setiap field sebagai key untuk file lang
        foreach ($this->list as $field) {
            $fieldName = $field['field'];
            $translation = $this->ask("Enter translation for {$fieldName}");
            $langContent .= "    '{$fieldName}' => '{$translation}',\n";
        }
    
        $langContent .= "];\n";
    
        // Simpan file lang
        File::put($langPath, $langContent);
    
        $this->info("Lang file for '{$modul}' created successfully at '{$langPath}'.");

        $createLang = $this->confirm("Do you want to create the route file for module '{$modul}'?", true);

        if ($createLang) {
            $this->createRoute($modul, $controllerName);
        }

    }
    
    private function createRoute($modul, $controllerName)
{
    // Path ke file route
    $routePath = base_path('routes/web.php');
    
    // Buat entry untuk 'use' dan route baru
    $useEntry = "use App\Http\Controllers\\{$controllerName};\n";
    $routeEntry = "    Route::resource('{$modul}', {$controllerName}::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print']);\n";
    
    // Periksa apakah file route ada
    if (!File::exists($routePath)) {
        $this->error("Route file not found.");
        return;
    }
    
    // Ambil isi dari file route
    $routeFileContent = File::get($routePath);
    
    // Cek apakah controller sudah di-import
    if (strpos($routeFileContent, $useEntry) === false) {
        // Temukan posisi terakhir dari "use App\Http\Controllers\" dalam file
        $lastUsePosition = strrpos($routeFileContent, 'use App\Http\Controllers\\');
        
        if ($lastUsePosition !== false) {
            // Sisipkan 'use' statement setelah baris terakhir "use App\Http\Controllers\"
            $insertionPoint = strpos($routeFileContent, "\n", $lastUsePosition) + 1;
            $routeFileContent = substr_replace($routeFileContent, $useEntry, $insertionPoint, 0);
        } else {
            // Jika tidak ada "use App\Http\Controllers\" di file, tambahkan di atas
            $routeFileContent = $useEntry . $routeFileContent;
        }
    }
    
    // Cek apakah route resource untuk modul ini sudah ada
    if (strpos($routeFileContent, "Route::resource('{$modul}'") !== false) {
        $this->info("Route for '{$modul}' already exists in routes/web.php.");
        return;
    }
    
    // Cari Route::group dengan middleware tertentu
    $groupPattern = "/Route::group\(\[('|\")middleware('|\")\s*=>\s*\[(.*?)\]\],\s*function\s*\(\)\s*{/";
    
    if (preg_match($groupPattern, $routeFileContent, $matches, PREG_OFFSET_CAPTURE)) {
        // Jika Route::group ditemukan, masukkan route baru di dalamnya
        $insertionPoint = $matches[0][1] + strlen($matches[0][0]);
        $newRouteFileContent = substr_replace($routeFileContent, "\n" . $routeEntry, $insertionPoint, 0);
        
        // Simpan perubahan ke file
        File::put($routePath, $newRouteFileContent);
        $this->info("Route for '{$modul}' added successfully in routes/web.php within the Route::group.");
    } else {
        // Jika tidak ada Route::group, tambahkan route dan group baru di akhir file
        $newRouteFileContent = $routeFileContent . "\n// Route untuk modul {$modul}\nRoute::group(['middleware' => ['web', 'auth', 'verified']], function () {\n{$routeEntry}});\n";
        
        // Simpan perubahan ke file
        File::put($routePath, $newRouteFileContent);
        $this->info("Route group for '{$modul}' created and route added in routes/web.php.");
    }
}


}
