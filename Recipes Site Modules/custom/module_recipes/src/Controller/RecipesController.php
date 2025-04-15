<?php
namespace Drupal\module_recipes\Controller;
use Drupal\Core\Controller\ControllerBase;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\module_recipes\Service\MyCustomService;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\module_recipes\Service\WelcomeService;
use Drupal\module_recipes\Service\RecipeService;


class RecipesController extends ControllerBase{


/**
   * The logger service.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;
  protected MyCustomService $myCustomService;
  protected CurrentPathStack $myCurrentPath;
  protected DateFormatterInterface $dateFormatter;
  protected WelcomeService $welcomeService;
  protected RecipeService $recipeService;
  /**
   * Constructor for Dependency Injection.
   */
  public function __construct(LoggerInterface $logger,MyCustomService $myCustomService,CurrentPathStack $myCurrentPath,DateFormatterInterface $dateFormatter, WelcomeService $welcomeService, RecipeService $recipeService) {
    $this->logger = $logger;
    $this->welcomeService = $welcomeService;
    $this->myCustomService = $myCustomService;
    $this->myCurrentPath = $myCurrentPath;
    $this->dateFormatter = $dateFormatter;
    $this->recipeService = $recipeService;
  }
 
  /**
   * Service container for Dependency Injection.
   */
  public static function create(ContainerInterface $container) {
    return new static(
$container->get('logger.channel.default'), // Injecting logger service
$container->get('module_recipes.my_custom_service'), //Injecting mycustom service
$container->get('path.current'), //Injucting path current service
$container->get('date.formatter'),//Injecting date formatter service
$container->get('module_recipes.my_welcome_service'), //Injecting me welcome greeting service
$container->get('module_recipes.my_chef_service'),  //Injecting Recipe Service
    );
  }
 
  /**
   * Route callback function to log a custom message.
   */
  public function logExample() {
    // Log a custom message.
    $coreService=$this->myCurrentPath->getPath();
    $this->logger->info('This is a custom log message from ExampleController.');
    $this->logger->info('I am a path current Service'.$coreService);
    $this->logger->notice("This is a Notice to adds");
    \Drupal::messenger()->addMessage('This are a information Messages');
    // Return a message on the page.
    return [
      '#markup' => 'Log entry created successfully!'.'<br>'. $coreService,
    ];
  }


  public function showRecipe($recipeName) {
    $message1 = $this->myCustomService->getRecipeMessage($recipeName);
    $message2 = $this->myCustomService->getMessage();
    // Log the message using the injected logger
    $this->logger->info('Recipe displayed: ' . $recipeName);
    $fd=$this->dateFormatter->format(time(),'custom','l,j F Y - H:i A');
    return [
      '#markup' => "<p>$message1</p><h1>$message2</h1>"."<br>".$fd,
    ];
  }

  // Example method to display the message
    public function showMessage() {
        $message = $this->myCustomService->getMessage();
        $this->myCustomService->setName("Dinesh");
        $message2=$this->myCustomService->getName();
        $message3=$this->welcomeService->getWelcomeMessage();
        
        return [
            '#markup' => "<p>$message</p>"."<br>"."<p>$message2</p>"."<p>".$message3."</p>",
        ];
    }


    function RecipesList(){
       
        $recipes=[
            ['name'=>'Veg Puloa'],
            ['name'=>'Dosa'],
            ['name'=>'Biryani'],
            ['name'=>'Margherita Pizza'],
            ['name'=>'Chicken Pizza'],
           
        ];
        $message2 = $this->myCustomService->getMessage();
        // \Drupal::messenger()->addMessage("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh");

        // $recipesList='<ul>';
        // foreach($recipes as $recipe){
        //     $recipesList .='<li>' . $recipe['name'] . '</li>';

        // }
        // $recipesList .='</ul>';
        
    // Format recipes as an unordered list with a class
    $common_recipes='<h4 class="note">Rcipes Available in our Site from Starting.</h4>';

    $recipesList = '<ul class="recipes-list">';
    foreach ($recipes as $recipe) {
        $recipesList .= '<li class="recipe-item">' . htmlspecialchars($recipe['name']) . '</li>';
    }
    
    $recipesList .= '</ul>';
   
    $h3tag='<h3>'.$message2.'</h3>';
 
    // Return markup with the recipes list
    return [
        '#type' => 'markup',
        '#markup' => $common_recipes .'<br>'.$recipesList. '<br>'. $h3tag.'<br>',
        '#attached' => [
            'library' => [
                'module_recipes/recipes_styles',
            ],
        ],
    ];
}


function AboutUS(){
    $details="We are a newely developing company with some standards which includes customer satisfaction
    ,Providing the best possible outcomes to the customers. We are progressing on that, Hope we will be 
    achieve our goal with the dedication and hardwork we have been putting so for";
    $demo="This is a demo message";

    $user=\Drupal::currentUser();
    // \Drupal::messenger()->addMessage($user);
    // \Drupal::logger("demo")->notice($user->id());
    // \Drupal::logger("demo")->notice($user->getDisplayName());
    // \Drupal::logger("demo")->notice($user->getAccountName());
    // \Drupal::logger("demo")->notice($user->getEmail());

    //I am not passing this demo var in to twig file, because i passed this through module file and adde demo="" or null
    //it directly assign as null or empty string
    $our_values=['Integrity','Safety','Trustworthy'];
    return[
        '#theme' => "about_theme",
        '#details' => $details,
        '#values' => $our_values,
        '#attached' => [
            'library' => [
                'module_recipes/about_us_styles',
            ],
        ],
    ];
}

public function Prepare($recipe){
    $dish=$this->recipeService->prepareRecipe($recipe);
    return [
        "#type" =>"markup",
        "#markup" => $dish,
    ];
}

// public function Prepare(){
//     $dish=$this->recipeService->prepareRecipe("Biriyani");
//     return [
//         "#type" =>"markup",
//         "#markup" => $dish,
//     ];
// }
}
?>