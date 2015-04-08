<?php namespace Tony\Console\Commands\Generate;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CommandGenerate extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate resources by Antoine07';

    protected $makeMigration;
    protected $makeSeed;
    protected $makeBlade;

    /**
     * @param MakeSeed $makeSeed
     * @param MakeMigration $makeMigration
     * @param MakeBlade $makeBlade
     * @param MakeModel $makeModel
     */
    public function __construct(MakeSeed $makeSeed, MakeMigration $makeMigration, MakeBlade $makeBlade, MakeModel $makeModel)
    {
        parent::__construct();
        $this->makeSeed = $makeSeed;
        $this->makeMigration = $makeMigration;
        $this->makeBlade = $makeBlade;
        $this->makeModel = $makeModel;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        try {
            $resource = $this->argument('resource');

            if ($seeds = $this->option('seed')) $this->makeSeed->make($resource, $seeds);

            if ($migrations = $this->option('migration')) $this->makeMigration->make($resource, $migrations);

            if ($this->option('view')) $this->makeBlade->make($resource);

            if ($this->option('model')) {
                if ($this->makeModel->make($resource))
                    $this->call('make:model', ['name' => $this->makeModel->getModelName($resource), '--no-migration' => true]);
            }

            $this->info('created successfully');

        } catch (SeedGenerateException $e) {
            $this->info($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['resource', InputArgument::REQUIRED, 'the name of resource is required'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['seed', null, InputOption::VALUE_OPTIONAL, 'separate seed with : and , ', ''],
            ['migration', null, InputOption::VALUE_OPTIONAL, 'separate migrations with type:name > and , to separate field', null],
            ['view', null, InputOption::VALUE_NONE, 'create directory and template blade associate'],
            ['model', null, InputOption::VALUE_NONE, 'create model'],
        ];
    }

}
