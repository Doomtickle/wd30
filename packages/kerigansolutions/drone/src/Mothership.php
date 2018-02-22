<?php
namespace KeriganSolutions\Drone;

use \GuzzleHttp\Client;
use App\SearchParameters;
use Illuminate\Http\Request;
use KeriganSolutions\Drone\Paginator;
use KeriganSolutions\Drone\CallsMothership as CallsMothership;

class Mothership
{
    use CallsMothership;

    protected $client;

    public function search(Request $request)
    {
        $searchTerms = new SearchParameters($request->all());
        $apiCall     = $this->get($searchTerms->getQueryString());
        $properties  = json_decode($apiCall->getBody());
        $results     = $this->paginate($properties, $request);

        return $results;
    }

    public function listing($mlsNumber)
    {
        $response = $this->get('listing/'. $mlsNumber);

        return json_decode($response->getBody());
    }

    public function agentData($email)
    {
        $response = $this->get('agentdata?email='. $email);

        if (! is_array($response)) {
            return json_decode($response->getBody());
        }

        return [];
    }

    public function agentListings($mlsId)
    {
        $response = $this->get('agentlistings?agentId='. $mlsId);

        if (! is_array($response)) {
            return json_decode($response->getBody());
        }

        return [];
    }

    public function agentListingsWithAnalytics($mlsId)
    {
        $response = $this->get('agentlistings?agentId='. $mlsId .'&analytics=true');

        if (! is_array($response)) {
            return json_decode($response->getBody());
        }

        return [];
    }

    protected function paginate($properties, $request)
    {
        $paginator = new Paginator($properties, $request);

        return $paginator->configure();
    }
}
