<?php namespace Tony\Console\Commands\Generate;


class MakeMigration extends AbstractGenerate
{

    use TraitDatabase;

    /**
     * build partial migration
     *
     * @param $migrations
     * @return string
     * @throws
     * @throws GenerateException
     */
    protected function getMigrations($migrations)
    {
        if (preg_match('/([a-zA-Z:,]*)/', $migrations)) {
            $syntax = '';
            foreach (explode(',', $migrations) as $m) {
                $m = explode(':', $m);
                if (count($m) != 2)
                    throw GenerateException("wrong syntax give type:name");

                $type = $this->getField($m[0]);

                $s = $m[0] == 'e' ? "\$table->%s('%s', [''])->default('')" : "\$table->%s('%s')";

                $syntax .= "\t\t\t" . sprintf($s, $type, $m[1]) . ";" . "\n";
            }

            return $syntax;
        }

        throw new GenerateException("wrong syntax for your migration");
    }


    /**
     * Create file Migrations
     *
     * @param $resource
     * @param $syntax string
     * @param $table name of table
     * @return bool
     * @throws GenerateException
     */
    private function create($resource, $syntax, $table)
    {
        $template = $this->getSchemaTemplate('migrations');

        $content = $this->insert($syntax, 'migrations', $template);
        $content = $this->insert($resource, 'class', $content);
        $content = $this->insert($table, 'table', $content);

        if ($this->file->put($this->getDirDatabase() . self::DS . 'migrations' . self::DS . date('Y_m_d_His') . '_create_' . $table . '_table.php', $content)) {
            return true;
        }

        $this->composer->dumpAutoloads();

        throw new GenerateException('problem when creating your migrations file');
    }

    /**
     * build migrations
     *
     * @param $resource
     * @param $migrations
     * @throws SeedGenerateException
     */
    public function make($resource, $migrations)
    {
        $table = str_plural(strtolower($resource));
        $resource = 'Create' . $this->normalize($resource) . 'sTable';
        $migrations = $this->getMigrations($migrations);
        $this->create($resource, $migrations, $table);
    }

}