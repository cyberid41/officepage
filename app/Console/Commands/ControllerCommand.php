<?php namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ControllerCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'app:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('plain')) {
            return __DIR__ . '/stubs/controller.plain.stub';
        }

        return __DIR__ . '/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['plain', null, InputOption::VALUE_NONE, 'Generate an empty controller class.'],
        ];
    }

}
