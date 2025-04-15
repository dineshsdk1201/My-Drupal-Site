<?php


namespace Drupal\module_recipes\Service;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Datetime\DateFormatterInterface;
class PrepareIngredients{
    protected $user;
    protected $date;
    public function __construct(AccountProxyInterface $user,DateFormatterInterface $date ){
        $this->user=$user;
        $this->date=$date;
    }
    public $f;
    
    public function prepareIngredient($dish){
        $this->f=$dish;
        $timestamp=time();
        $u=$this->user->getDisplayName();
        $d=$this->date->format($timestamp,"custom","Y-m-D H:i:s");
        // $interval=$this->date->formatInterval(time()-947116800);
        return "Ingredients Prepared for {$this->f} and prepared by {$u} on {$d}";


    }
}
