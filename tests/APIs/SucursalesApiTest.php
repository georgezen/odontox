<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSucursalesTrait;
use Tests\ApiTestTrait;

class SucursalesApiTest extends TestCase
{
    use MakeSucursalesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sucursales()
    {
        $sucursales = $this->fakeSucursalesData();
        $this->response = $this->json('POST', '/api/sucursales', $sucursales);

        $this->assertApiResponse($sucursales);
    }

    /**
     * @test
     */
    public function test_read_sucursales()
    {
        $sucursales = $this->makeSucursales();
        $this->response = $this->json('GET', '/api/sucursales/'.$sucursales->id);

        $this->assertApiResponse($sucursales->toArray());
    }

    /**
     * @test
     */
    public function test_update_sucursales()
    {
        $sucursales = $this->makeSucursales();
        $editedSucursales = $this->fakeSucursalesData();

        $this->response = $this->json('PUT', '/api/sucursales/'.$sucursales->id, $editedSucursales);

        $this->assertApiResponse($editedSucursales);
    }

    /**
     * @test
     */
    public function test_delete_sucursales()
    {
        $sucursales = $this->makeSucursales();
        $this->response = $this->json('DELETE', '/api/sucursales/'.$sucursales->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/sucursales/'.$sucursales->id);

        $this->response->assertStatus(404);
    }
}
