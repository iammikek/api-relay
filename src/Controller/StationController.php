<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;


/**
 * Brand controller.
 *
 * @Route("/api/V1")
 */
class StationController extends Controller
{

    /**
     * @FOSRest\Get("/stations")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStationsAction()
    {
        return $this->getAdmiraltyData('Stations');
    }


    /**
     * @param $stationId
     *
     * @FOSRest\Get("/stations/{stationId}")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function showAction($stationId)
    {
        return $this->getAdmiraltyData('Stations/' . $stationId);
    }


    /**
     * @param $station
     * @param $duration
     *
     * @FOSRest\Get("/stations/{station}/events/{duration}")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function showEventsAction($station, $duration = 1)
    {
        return $this->getAdmiraltyData('Stations/' . $station . '/TidalEvents?duration=' . $duration);
    }


    /**
     * @param $uri - uri of endpoint
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getAdmiraltyData($uri): Response
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://admiraltyapi.azure-api.net/uktidalapi/api/V1/',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

        $headers = ['Ocp-Apim-Subscription-Key' => getenv('APP_ADMIRALTY_API')];

        $request = new GuzzleRequest('GET', $uri, $headers);

        $apiResponse = $client->send($request, ['timeout' => 4]);

        if ($apiResponse) {
            $body = $apiResponse->getBody();

            $response = new Response();

            $response->setContent($body);

            $response->headers->set('Content-Type', 'application/json');
            // Allow all websites
            $response->headers->set('Access-Control-Allow-Origin', '*');

            return $response;
        }

        return new Response('', 500);
    }


}