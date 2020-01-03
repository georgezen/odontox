<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Sucursales;
use App\Repositories\SucursalesRepository;

trait MakeSucursalesTrait
{
    /**
     * Create fake instance of Sucursales and save it in database
     *
     * @param array $sucursalesFields
     * @return Sucursales
     */
    public function makeSucursales($sucursalesFields = [])
    {
        /** @var SucursalesRepository $sucursalesRepo */
        $sucursalesRepo = \App::make(SucursalesRepository::class);
        $theme = $this->fakeSucursalesData($sucursalesFields);
        return $sucursalesRepo->create($theme);
    }

    /**
     * Get fake instance of Sucursales
     *
     * @param array $sucursalesFields
     * @return Sucursales
     */
    public function fakeSucursales($sucursalesFields = [])
    {
        return new Sucursales($this->fakeSucursalesData($sucursalesFields));
    }

    /**
     * Get fake data of Sucursales
     *
     * @param array $sucursalesFields
     * @return array
     */
    public function fakeSucursalesData($sucursalesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $sucursalesFields);
    }
}
