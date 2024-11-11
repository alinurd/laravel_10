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

        $createLang = $this->confirm("Do you want to create the route file for module '{$modul}'?", true);

        if ($createLang) {
            $this->createRoute($modul, $controllerName);
        } else {
            $createLang = $this->confirm("Do you want to create the lang file for module '{$modul}'?", true);
            if ($createLang) {
                $this->createLangFile($modul, $controllerName);
            }
        }
    }

    private function createLangFile($modul, $controllerName)
    {
        $langPath = resource_path("lang/en/{$modul}.php");

        if (File::exists($langPath)) {
            $this->info("Lang file for '{$modul}' already exists.");
            return;
        }

        $titleTranslation = $this->ask("Enter translation for title");
        $pageTranslation = $this->ask("Enter translation for page");

        $langContent = "<?php\n\nreturn [\n";
        $langContent .= "    'title' => '{$titleTranslation}',\n";
        $langContent .= "    'page' => '{$pageTranslation}',\n";

        foreach ($this->list as $field) {
            $fieldName = $field['field'];
            $translation = $this->ask("Enter translation for {$fieldName}");
            $langContent .= "    '{$fieldName}' => '{$translation}',\n";
        }

        $langContent .= "];\n";

        File::put($langPath, $langContent);

        $this->info("Lang file for '{$modul}' created successfully at '{$langPath}'.");
    }

    private function createRoute($modul, $controllerName)
    {
        $routePath = base_path('routes/web.php');

        $useEntry = "use App\Http\Controllers\\{$controllerName};\n";
        $routeEntry = "    Route::resource('{$modul}', {$controllerName}::class)->only(['index', 'store', 'update', 'destroy', 'create', 'edit', 'print']);\n";

        if (!File::exists($routePath)) {
            $this->error("Route file not found.");
            return;
        }

        $routeFileContent = File::get($routePath);

        if (strpos($routeFileContent, $useEntry) === false) {
            $lastUsePosition = strrpos($routeFileContent, 'use App\Http\Controllers\\');

            if ($lastUsePosition !== false) {
                $insertionPoint = strpos($routeFileContent, "\n", $lastUsePosition) + 1;
                $routeFileContent = substr_replace($routeFileContent, $useEntry, $insertionPoint, 0);
            } else {
                $routeFileContent = $useEntry . $routeFileContent;
            }
        }

        if (strpos($routeFileContent, "Route::resource('{$modul}'") !== false) {
            $this->info("Route for '{$modul}' already exists in routes/web.php.");
            return;
        }

        $groupPattern = "/Route::group\(\[('|\")middleware('|\")\s*=>\s*\[(.*?)\]\],\s*function\s*\(\)\s*{/";

        if (preg_match($groupPattern, $routeFileContent, $matches, PREG_OFFSET_CAPTURE)) {
            $insertionPoint = $matches[0][1] + strlen($matches[0][0]);
            $newRouteFileContent = substr_replace($routeFileContent, "\n" . $routeEntry, $insertionPoint, 0);

            File::put($routePath, $newRouteFileContent);
            $this->info("Route for '{$modul}' added successfully in routes/web.php within the Route::group.");
            $createLang = $this->confirm("Do you want to create the lang file for module '{$modul}'?", true);
            if ($createLang) {
                $this->createLangFile($modul, $controllerName);
            }
        } else {
            $newRouteFileContent = $routeFileContent . "\n// Route untuk modul {$modul}\nRoute::group(['middleware' => ['web', 'auth', 'verified']], function () {\n{$routeEntry}});\n";

            File::put($routePath, $newRouteFileContent);
            $this->info("Route group for '{$modul}' created and route added in routes/web.php.");
        }
    }
}
