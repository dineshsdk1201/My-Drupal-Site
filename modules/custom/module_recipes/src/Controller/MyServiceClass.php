<?php
namespace Drupal\module_recipes\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\module_recipes\Service\MyService;
use Symfony\Component\DependencyInjection\ContainerInterface;
class MyServiceClass extends ControllerBase{
protected MyService $myservice;
    /**
     * impletents class method for my service
     */
    public function __construct(MyService $myservice){
        $this->myservice=$myservice;
    }
     public static function create(ContainerInterface $container){
        return new static (
            $container->get("module_recipes_my_service")
        );
     }

     public function MyServiceMethod(){
    $data=$myservice->myservice();
    return $data;
     }

    }