<?php
namespace HelloFresh\Model\Entity;
/**
 * @Entity(repositoryClass="RecipeApp\Model\Repository\RecipeRateRepository")
 * @Table(name="recipe_rate")
 * Class Recipe
 */
class RecipeRate
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Recipe", inversedBy="rates", cascade={"persist"})
     * @JoinColumn(name="recipe_id", referencedColumnName="id")
     * @var
     */
    private $recipe;

    /**
     * @Column(type="integer")
     * @var
     */
    private $rate;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * @return mixed
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param mixed $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    public function __toString()
    {
        return $this->rate;
    }
}