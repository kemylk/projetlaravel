<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use MyDate; //ajouté pour pouvoir utiliser la classe

class MyDateTest extends TestCase
{
    /**
     * @test
     */
    // public function extraireMois()
    // {
    //     $mois = MyDate::extraireMois("202102");
    //     $this->assertEquals('02', $mois);
    // }

    /**
    *@test
    */
    // public function extraireAnnee()
    // {
    //     $annee = MyDate::extraireAnnee("202005");
    //     $this->assertEquals('2020', $annee);
    // }

    /**
    *@test
    */
    public function getAnneeMoisCourant()
    {
        $anneeMoisCourant = MyDate::getAnneeMoisCourant();
        $this->assertEquals("2021", $anneeMoisCourant['numAnnee']);
    }
}
