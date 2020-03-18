<?php

namespace App\Service;

use Symfony\Component\GuzzleHttp\Client;

class GeoApi
{
    public function getCommune($cityName,$postalcode): array
    {
        $client = new \GuzzleHttp\Client();
        if($cityName === ""){
            $uri = "https://geo.api.gouv.fr/communes?codePostal=".$postalcode."&fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre";
        } elseif ($postalcode === ""){
            $uri = "https://geo.api.gouv.fr/communes?nom=".$cityName."&fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre";
        }
        else {
            $uri = "https://geo.api.gouv.fr/communes?codePostal=".$postalcode."&nom=".$cityName."&fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre";
        }

        try {
            $response = $client->request('GET', $uri);
        } catch (Exception $e) {
            return ["error" => "Serveur indisponible"];
        }
        $json = $response->getBody();
        return json_decode($json, true);
    }
}