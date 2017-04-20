<?php
namespace HelloFresh\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="RecipeApp\Model\Repository\RecipeRepository")
 * @Table(name="recipe")
 * Class Recipe
 */
class Recipe
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     * @var
     */
    private $id;

    /**
     * @Column(type="string")
     * @var
     */
    private $name;

    /**
     * @Column(type="integer")
     * @var
     */
    private $prep_time;

    /**
     * @Column(type="integer")
     * @var
     */
    private $difficulty;

    /**
     * @Column(type="boolean")
     * @var
     */
    private $vegetarian;

    /**
     * @OneToMany(targetEntity="RecipeRate", mappedBy="recipe")
     * @var
     */
    private $rates;

    public function __construct()
    {
        $this->rates = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getRates()
    {
        $avg = 0;
        foreach($this->rates as $rate){
            $avg += $rate;
        }
        var_dump($this->rates, sizeof($this->rates));die;
        $avg = $avg / sizeof($this->rates);
        return floor($avg);
    }

    /**
     * @param mixed $rates
     */
    public function setRates($rates)
    {
        $this->rates = $rates;
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrepTime()
    {
        return $this->prep_time;
    }

    /**
     * @param mixed $prep_time
     */
    public function setPrepTime($prep_time)
    {
        $this->prep_time = $prep_time;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return mixed
     */
    public function getVegetarian()
    {
        return $this->vegetarian;
    }

    /**
     * @param mixed $vegetarian
     */
    public function setVegetarian($vegetarian)
    {
        $this->vegetarian = $vegetarian;
    }
}