<?php namespace Tests\Repositories;

use App\Models\Sucursales;
use App\Repositories\SucursalesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSucursalesTrait;
use Tests\ApiTestTrait;

class SucursalesRepositoryTest extends TestCase
{
    use MakeSucursalesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SucursalesRepository
     */
    protected $sucursalesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sucursalesRepo = \App::make(SucursalesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sucursales()
    {
        $sucursales = $this->fakeSucursalesData();
        $createdSucursales = $this->sucursalesRepo->create($sucursales);
        $createdSucursales = $createdSucursales->toArray();
        $this->assertArrayHasKey('id', $createdSucursales);
        $this->assertNotNull($createdSucursales['id'], 'Created Sucursales must have id specified');
        $this->assertNotNull(Sucursales::find($createdSucursales['id']), 'Sucursales with given id must be in DB');
        $this->assertModelData($sucursales, $createdSucursales);
    }

    /**
     * @test read
     */
    public function test_read_sucursales()
    {
        $sucursales = $this->makeSucursales();
        $dbSucursales = $this->sucursalesRepo->find($sucursales->id);
        $dbSucursales = $dbSucursales->toArray();
        $this->assertModelData($sucursales->toArray(), $dbSucursales);
    }

    /**
     * @test update
     */
    public function test_update_sucursales()
    {
        $sucursales = $this->makeSucursales();
        $fakeSucursales = $this->fakeSucursalesData();
        $updatedSucursales = $this->sucursalesRepo->update($fakeSucursales, $sucursales->id);
        $this->assertModelData($fakeSucursales, $updatedSucursales->toArray());
        $dbSucursales = $this->sucursalesRepo->find($sucursales->id);
        $this->assertModelData($fakeSucursales, $dbSucursales->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sucursales()
    {
        $sucursales = $this->makeSucursales();
        $resp = $this->sucursalesRepo->delete($sucursales->id);
        $this->assertTrue($resp);
        $this->assertNull(Sucursales::find($sucursales->id), 'Sucursales should not exist in DB');
    }
}
