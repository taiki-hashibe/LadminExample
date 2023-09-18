<?php

namespace LowB\Ladmin\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Database\Eloquent\Model;

class MakeControllerCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'ladmin:make:controller {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make admin crud controller';

    /**
     * @var string
     */
    protected $controllerName;

    /**
     * @var string
     */
    protected $modelName;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->modelName = $this->getModelInput();
        if (!$this->modelExists()) {
            $this->error('Model does not exists !');

            return false;
        }
        $this->controllerName = class_basename($this->modelName) . 'CrudController';

        $name = $this->qualifyClass(config('ladmin.namespace.controller') . '\\' . $this->controllerName);
        $path = $this->getPath($name);
        $this->makeDirectory($path);
        $this->files->put($path, $this->sortImports($this->buildClass($name)));
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getModelInput()
    {
        return trim($this->argument('model'));
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function getStub()
    {
        return __DIR__ . '\\..\\stubs\\Controllers\\CrudController.stub';
    }

    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace(
            [
                'DummyNamespace',
                'DummyControllerName',
            ],
            [
                'test/test\\test/\test\/',
                $this->controllerName,
            ],
            $stub
        );
    }

    protected function modelExists()
    {
        if (empty($this->modelName)) {
            return true;
        }

        return class_exists($this->modelName) && is_subclass_of($this->modelName, Model::class);
    }
}
