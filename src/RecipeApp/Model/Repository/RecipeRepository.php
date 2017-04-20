<?php
namespace HelloFresh\Model\Repository;

use Doctrine\ORM\EntityRepository;
use HelloFresh\Model\Entity\Recipe;
use HelloFresh\Model\Entity\RecipeRate;
use Symfony\Component\HttpFoundation\Request;

class RecipeRepository extends EntityRepository
{


    public function getAllRecipes()
    {

        $query = $this->getEntityManager()->createQuery('SELECT r.id, r.name, r.prep_time, r.difficulty, r.vegetarian FROM RecipeApp\Model\Entity\Recipe r');
        $result = $query->getResult();
        return $result;
    }

    public function getRecipeById($recipeId)
    {
        $recipe = $this->getEntityManager()->getRepository('RecipeApp\Model\Entity\Recipe')->find($recipeId);
        if(!$recipe instanceof Recipe) {
            throw new \Exception("Recipe Not found");
        }else{
            return array(
                'name' => $recipe->getName(),
                'difficulty' => $recipe->getDifficulty(),
                'prep_time' => $recipe->getPrepTime(),
                'vegetarian' => $recipe->getVegetarian()
            );
        }
    }


    public function createRecipe($request)
    {
        $recipe = new Recipe();
        $recipe->setName($request->get('name'));
        $recipe->setDifficulty($request->get('difficulty'));
        $recipe->setPrepTime($request->get('prep_time'));
        $recipe->setVegetarian($request->get('vegetarian'));

        try{
            $this->getEntityManager()->persist($recipe);
            $this->getEntityManager()->flush();
            return $recipe;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    public function updateRecipe($data, $recipeId)
    {
        $recipe = $this->getEntityManager()->getRepository('RecipeApp\Model\Entity\Recipe')->find($recipeId);
        if(!$recipe instanceof Recipe) {
            throw new \Exception("Recipe Not found");
        }

        $name = (!empty($data['name'])) ? $data['name'] : $recipe->getName();
        $difficulty = (!empty($data['difficulty'])) ? $data['difficulty'] : $recipe->getDifficulty();
        $prep_time = (!empty($data['prep_time'])) ? $data['prep_time'] : $recipe->getPrepTime();
        $vegetarian = (!empty($data['vegetarian'])) ? $data['vegetarian'] : $recipe->getVegetarian();
        $recipe->setName($name);
        $recipe->setDifficulty($difficulty);
        $recipe->setPrepTime($prep_time);
        $recipe->setVegetarian($vegetarian);

        try{
            $this->getEntityManager()->persist($recipe);
            $this->getEntityManager()->flush();
            return $recipe;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

    public function deleteRecipe($recipeId)
    {
        $recipe = $this->getEntityManager()->getRepository('RecipeApp\Model\Entity\Recipe')->find($recipeId);
        if(!$recipe instanceof Recipe) {
            throw new \Exception("Recipe Not found");
        }

        try{
            $this->getEntityManager()->remove($recipe);
            $this->getEntityManager()->flush();
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function rateRecipe($recipeId, $rate)
    {
        $recipe = $this->getEntityManager()->getRepository('RecipeApp\Model\Entity\Recipe')->find($recipeId);
        if(!$recipe instanceof Recipe) {
            throw new \Exception("Recipe Not found");
        }

        try{
            $recipeRate = new RecipeRate();
            $recipeRate->setRecipe($recipe);
            $recipeRate->setRate($rate);
            $recipe->setRates(array($recipeRate));


            $this->getEntityManager()->persist($recipeRate);
            $this->getEntityManager()->persist($recipe);
            $this->getEntityManager()->flush();
            return $recipe;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}