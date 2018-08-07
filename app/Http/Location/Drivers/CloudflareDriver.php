<?php
namespace App\Http\Location\Drivers;

use App\Helpers\RequestHelper;
use Illuminate\Support\Fluent;
use Stevebauman\Location\Position;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Drivers\Driver;

class CloudflareDriver extends Driver
{
    public function url()
    {
        return;
    }

    protected function hydrate(Position $position, Fluent $location)
    {
        $position->countryCode = $location->country_code;

        return $position;
    }

    protected function process($ip = null)
    {
        if (! is_null($ip))
        {
            return $this->fallback->get($ip);
        }

        try {
            $country = Request::header('Cf-Ipcountry');
            if (! is_null($country))
            {
                $response = [ 'country_code' => $country ];
                return new Fluent($response);        
            }

            return $this->fallback->get(RequestHelper::ip());
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }}