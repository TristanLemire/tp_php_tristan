<?php


namespace App\Service;

use Symfony\Component\GuzzleHttp\Client;

class EtablissementPublicApi
{
    public function getEtablissement($postalcode,$type): array
    {
        $client = new \GuzzleHttp\Client();
        $uri = "https://etablissements-publics.api.gouv.fr/v3/communes/".$postalcode."/".$type;

        try {
            $response = $client->request('GET', $uri);
        } catch (Exception $e) {
            return ["error" => "Serveur indisponible"];
        }
        $json = $response->getBody();
        return json_decode($json, true);
    }
}