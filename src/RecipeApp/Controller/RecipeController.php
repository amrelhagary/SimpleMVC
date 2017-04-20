<?php
namespace HelloFresh\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use HelloFresh\Model\Entity\Recipe;
use HelloFresh\Model\DB\EM;

class RecipeController
{
    private $em;

    public function __construct()
    {
        $this->em = EM::getInstance();
    }

    public function indexAction(Request $request)
    {

        try{
            $recipes = $this->em->getRepository('RecipeApp\Model\Entity\Recipe')->getAllRecipes();
            return new JsonResponse($recipes);
        }catch (\Exception $e){
            return new JsonResponse(array("message" => $e->getMessage()), 500);
        }
    }

    public function getAction(Request $request, $recipeId)
    {
        try{
            $recipe = $this->em->getRepository('RecipeApp\Model\Entity\Recipe')->getRecipeById($recipeId);
            return new JsonResponse(array($recipe));
        }catch (\Exception $e){
            return new JsonResponse(array("message" => $e->getMessage()), 500);
        }
    }

    public function createAction(Request $request)
    {
        // @TODO Validator
        try{
            $recipe = $this->em->getRepository('RecipeApp\Model\Entity\Recipe')->createRecipe($request);
            return new JsonResponse(array("message" => "Recipe saved successfully with Id ". $recipe->getId(), 'id' => $recipe->getId()));
        }catch (\Exception $e){
            return new JsonResponse(array("message" => $e->getMessage()), 500);
        }
    }

    public function updateAction(Request $request, $recipeId)
    {
        // parse string into variables
        parse_str($request->getContent(), $data);

        // @TODO Validator
        try{
            $recipe = $this->em->getRepository('RecipeApp\Model\Entity\Recipe')->updateRecipe($data, $recipeId);
            return new JsonResponse(array("message" =>"Recipe saved successfully with Id ". $recipe->getId()));
        }catch (\Exception $e){
            return new JsonResponse(array("message" => $e->getMessage()), 500);
        }
    }

    public function deleteAction(Request $request, $recipeId)
    {
        // @TODO Validator
        try{
            $this->em->getRepository('RecipeApp\Model\Entity\Recipe')->deleteRecipe($recipeId);
            return new JsonResponse(array("message" =>"Recipe Id: ". $recipeId. " Deleted Successfully"));
        }catch (\Exception $e){
            return new JsonResponse(array("message" => $e->getMessage()), 500);
        }
    }

    public function rateAction(Request $request, $recipeId, $rate)
    {
        try{
            $recipe = $this->em->getRepository('RecipeApp\Model\Entity\Recipe')->rateRecipe($recipeId, $rate);
            return new JsonResponse(array("message" => "You Gave Recipe: ". $recipe->getName() . ", Rate: " . $rate));
        }catch (\Exception $e){
            return new JsonResponse(array("message" => $e->getMessage()), 500);
        }
    }
}