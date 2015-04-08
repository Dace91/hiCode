<?php namespace Tony\Console\Commands\Generate;


use Carbon\Carbon;

class MakeSeed extends AbstractGenerate
{

    use TraitDatabase;

    /**
     *  build partial seeder
     *
     * @param $seeds
     * @return array
     * @throws SeedGenerateException
     */
    protected function getSeeds($seeds)
    {
        if (preg_match('/([a-zA-Z:,]*)/', $seeds)) {
            $syntax = "\t\t\t" . '[' . "\n";
            foreach (explode(',', $seeds) as $s) {
                $s = explode(':', $s);
                $name = $this->getField($s[0]);
                $value = count($s) == 2 ? (strtolower($s[1]) == 'now' ? Carbon::now() : $s[1]) : '';

                $syntax .= "\t\t\t\t" . sprintf("'%s' =>'%s',", $name, $value) . "\n";
            }
            $syntax .= "\t\t\t" . "]" . "\n";

            return $syntax;
        }

        throw new SeedGenerateException("wrong syntax for your seed");
    }

    /**
     * @param $tableSeeder
     * @param $syntax
     * @param $table
     * @return bool
     * @throws GenerateException
     */
    private function create($tableSeeder, $syntax, $table)
    {

        $template = $this->getSchemaTemplate('seeds');

        $content = $this->insert($syntax, 'seeds', $template);
        $content = $this->insert($tableSeeder, 'class', $content);
        $content = $this->insert($table, 'table', $content);

        if ($this->file->put($this->getDirDatabase() .self::DS. 'seeds' .self::DS. $tableSeeder . '.php', $content)) {
            return true;
        }

        $this->composer->dumpAutoloads();

        throw new GenerateException('problem when creating your seeds file');
    }

    /**
     * build seeders
     *
     * @param $resource
     * @param $seeds
     * @throws SeedGenerateException
     */
    public function make($resource, $seeds)
    {
        $table = str_plural(strtolower($resource));
        $tableSeeder = $this->normalize($resource) . 'TableSeeder';
        $seeds = $this->getSeeds($seeds);
        $this->create($tableSeeder, $seeds, $table);
    }

}