<?php namespace Tony\Console\Commands\Generate;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Composer;

abstract class AbstractGenerate
{
    protected $file;
    protected $composer;
    protected $dirTpl;

    const DS = DIRECTORY_SEPARATOR;

    /**
     * @param Filesystem $file
     * @param Composer $composer
     */
    public function __construct(Filesystem $file, Composer $composer)
    {
        $this->file = $file;
        $this->composer = $composer;

        $this->dirTpl = app_path('Console') . self::DS . 'Commands' . self::DS . 'Generate' . self::DS . 'tpl';
    }

    /**
     * @param $class
     * @return string
     * @throws GenerateException
     */
    protected function normalize($class)
    {
        if (is_string($class))
            return ucwords(str_singular(camel_case(strtolower($class))));

        throw new GenerateException(sprintf('wrong class name %s', $class));
    }

    /**
     * Get the stored template, and insert into the given wrapper.
     *
     * @param  string $wrapper
     * @param  string $placeholder
     * @param string $template file template
     * @return mixed
     */
    protected function insert($wrapper, $placeholder, $template)
    {
        return str_replace('{{' . $placeholder . '}}', $wrapper, $template);
    }

    /**
     * schema seed, migration or blade
     *
     * @param $name
     * @param string $dir
     * @return string
     * @throws GenerateException
     */
    protected function getSchemaTemplate($name, $dir = '')
    {
        $template = $this->dirTpl;
        $template .= $dir ? self::DS . $dir . self::DS . $name . '.tpl' : self::DS . $name . '.tpl';

        if (file_exists($template)) {
            return file_get_contents($template);
        }

        throw new GenerateException(sprintf("doesn't find schema seeder, %s, %s", __METHOD__, $template));
    }

    /**
     * return all schema template with resource name
     *
     * @return array
     * @throws GenerateException
     */
    protected function geAllBladeSchemaTemplate()
    {
        $allSchema = [];
        if ($templates = glob($this->dirTpl . self::DS . 'blade' . self::DS . "*.tpl")) {
            foreach ($templates as $template) {
                if (preg_match('/([a-z]+)\.tpl/', $template, $m))
                    $allSchema[$m[1]] = $this->getSchemaTemplate($m[1], 'blade');
            }
        }

        return $allSchema;
    }

}