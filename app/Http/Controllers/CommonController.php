<?php

namespace App\Http\Controllers;

use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;
use MenaraSolutions\Geographer\State;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function get_states(Request $request)
    {
        $code = $request->code;
        $earth = new Earth();
        $country = $earth->findOne(['code' => $code]);
        $states = $country->getStates()->useShortNames()->toArray();
        return response()->json(['status' => true, 'data' => $states]);
    }

    public function get_cities(Request $request)
    {
        $code = $request->code;
        $earth = new Earth();
        $state = State::build($code);
        $cities = $state->getCities()->useShortNames()->toArray();
        return response()->json(['status' => true, 'data' => $cities]);
    }
}
