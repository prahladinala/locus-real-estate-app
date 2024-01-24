<?php

namespace App\Traits;

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Client;



/**
 * trait ZoomMeetingTrait
 */
trait ZoomMeetingTrait
{
    public $zoom_api_key;
    public $zoom_secret_key;
    private $zoom_api_url = "https://api.zoom.us/v2/";

    private function get_zoom_keys()
    {
    }

    private function generateZoomToken()
    {


        $zoom_api_key = get_settings('zoom_api_key');
        $zoom_secret_key = get_settings('zoom_secrect_key');


        $key = $zoom_api_key;                //  env('ZOOM_API_KEY', '');
        $secret = (string)$zoom_secret_key;            //env('ZOOM_API_SECRET', '');
        $payload = [
            'iss' => $key,
            'exp' => strtotime('+1 minute'),
        ];


        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    private function retrieveZoomUrl()
    {
        return  "https://api.zoom.us/v2/"; // env('ZOOM_API_URL', '');
    }

    private function zoomRequest()
    {

        $jwt = $this->generateZoomToken();

        return \Illuminate\Support\Facades\Http::withHeaders([
            'authorization' => 'Bearer ' . $jwt,
            'content-type' => 'application/json',
        ]);
    }

    public function zoomGet(string $path, array $query = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->get($url . $path, $query);
    }

    public function zoomPost(string $path, array $body = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->post($url . $path, $body);
    }

    public function zoomPatch(string $path, array $body = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->patch($url . $path, $body);
    }

    public function zoomDelete(string $path, array $body = [])
    {
        $url = $this->retrieveZoomUrl();
        $request = $this->zoomRequest();
        return $request->delete($url . $path, $body);
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        $date = date('d-m-Y H:i:s', (int)$dateTime);


        try {
            $date = new \DateTime($date);
            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : ' . $e->getMessage());
            return '';
        }
    }

    public function toUnixTimeStamp(string $dateTime, string $timezone)
    {
        try {
            $date = new \DateTime($dateTime, new \DateTimeZone($timezone));
            return $date->getTimestamp();
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toUnixTimeStamp : ' . $e->getMessage());
            return '';
        }
    }
}
