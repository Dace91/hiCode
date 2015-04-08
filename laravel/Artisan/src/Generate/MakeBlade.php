<?php namespace Tony\Console\Commands\Generate;

class MakeBlade extends AbstractGenerate
{

    protected $layoutName = 'layouts.master';


    protected function getPathViews()
    {
        return dirname(app_path()) . self::DS . 'resources' . self::DS . 'views';
    }

    /**
     * make resource
     *
     * @param $resource
     * @throws GenerateException
     */
    public function make($resource)
    {

        //$this->createLayout();
        $this->create($resource);

    }

    /**
     *  build resource
     *
     * @param $resource
     * @throws GenerateException
     */
    protected function create($resource)
    {
        try {

            $templates = $this->geAllBladeSchemaTemplate('blade');

            $resourceView = $this->getPathViews() . self::DS . str_singular($resource);
            if (!$this->file->exists($resourceView)) $this->file->makeDirectory($resourceView);

            foreach ($templates as $name => $template) {
                $content = $this->insert($resource, 'resource', $template);
                $content = $this->insert($this->layoutName, 'layout', $content);
                $this->file->put($resourceView . self::DS . $name . '.blade.php', $content);
            }
        } catch (\IOException $e) {
            throw new GenerateException($e->getMessage());
        }

    }


    /**
     * @todo
     */
    protected function createLayout()
    {

    }


}