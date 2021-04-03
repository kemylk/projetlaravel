<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PdoGsb;

class EtatFraisTest extends TestCase
{
    /**
     * @test
     */
    public function selectionMois()
    {
        $visiteur = PdoGsb::getInfosVisiteur('toto','titi');
        session(['visiteur' => $visiteur]);
        $response = $this->get("/selectionMois");
        $response->assertStatus(200);
        $response->assertSessionHas('visiteur');
        $response->assertSeeText("Mois à sélectionner");
        $response->assertSeeText('02/2021');
    }


        /**
     * @test
     */
    public function testListeFrais()
    {
        $visiteur = PdoGsb::getInfosVisiteur('toto','titi');
        session(['visiteur' => $visiteur]);
        $response = $this->post("/listeFrais", ["lstMois" => "202101"]);
        $response->assertStatus(200);
        $response->assertSessionHas('visiteur');
        $response->assertSeeText("Montant validé : 0.00");
        $response->assertViewHas("lesMois");//voir si une variable est présente
        $response->assertViewHas("montantValide", 0);//voir si une variable est présente
    }
}
