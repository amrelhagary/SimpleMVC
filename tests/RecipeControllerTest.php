<?php

use PHPUnit\Framework\TestCase;
use SimpleMVC\Framework;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;


class RecipeControllerTest extends TestCase
{
    private $client;
    private $recipeId;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://172.18.0.5'
        ]);
    }

    public function testGetRecipe()
    {
        $response  = $this->client->get('/recipe');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        list(,$recipe) = each($data);
        $this->assertArrayHasKey('name', $recipe);
        $this->assertArrayHasKey('prep_time', $recipe);
        $this->assertArrayHasKey('difficulty', $recipe);
        $this->assertArrayHasKey('vegetarian', $recipe);
    }

    public function testPostRecipe()
    {
        $response  = $this->client->post('/recipe',[
            'form_params' => [
                'name' => 'test recipe',
                'prep_time' => 20,
                'difficulty' => 5,
                'vegetarian' => 1
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('message', $data);
        $this->assertArrayHasKey('id', $data);
        $this->recipeId = $data['id'];
    }
}
