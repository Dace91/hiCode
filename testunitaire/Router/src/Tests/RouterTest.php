<?php

namespace Tests;

use Services\Router\Router;
use Symfony\Component\Yaml\Yaml;

/**
 * Description of RouterTest
 *
 * @author antoine
 */
class RouterTest extends \PHPUnit_Framework_TestCase
{

    protected $router;
    protected $urls;

    public function setUp()
    {
        $this->router = new Router;
        $this->urls = Yaml::parse(__DIR__ . '/Fixtures/urls.yml');
    }
    
    public function assertPreConditions()
    {
        $this->assertEquals(0, count($this->router));
    }

    public function testAddRoute()
    {
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $this->assertEquals(5, count($this->router));
    }

    public function testAddSameRoute()
    {
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $this->setExpectedException('RuntimeException', 'Cannot override route "BlogController_index".');
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes2.yml'));
    }
    
    public function testGetParamsToUrlAndMatches()
    {
        
    }

    public function testUrlBlogControllerShowId()
    {
        // on ajoute les def des routes à la classe Routes
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $id = 0;
        foreach ($this->urls['BlogController_show'] as $url) {
            $this->assertEquals(json_encode([
                'controller' => 'Controllers\BlogController',
                'action' => 'show',
                'params' => [
                    'id' => (string) ++$id
                ]
                    ]), json_encode($this->router->getRoute($url)));
        }
    }
    
    public function testBadUrl()
    {
        $this->router->addRoute(Yaml::parse(__DIR__ . '/Fixtures/routes.yml'));
        $this->setExpectedException('RuntimeException', 'bad route exception');
        $this->router->getRoute('lsdlqksdq/qlsdkqlkds/qlsklqskdlkd/199');
    }

}
