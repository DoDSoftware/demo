<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PlacesApiController extends Controller
{

    public function countries(Request $request, $id = null)
    {
        if ($id) {
            $response = Country::find($id);
        }
        else if ($searchTerm = $request->input('q')) {
            $response = Country::where('name', 'LIKE', '%'.$searchTerm.'%')->paginate(20);
        } else {
            $response = Country::paginate(1000);
        }
        return $response;
    }
    public function states(Request $request, $id = null)
    {
        $countryId = $this->getFormValue('country_id');
        if ($id) {
            $response = State::find($id);
        }
        else if ($searchTerm = $request->input('q')) {
            $builder = State::where('name', 'LIKE', '%'.$searchTerm.'%');
            if ($countryId) {
                $builder->where('country_id', $countryId);
            }
            $response = $builder->paginate(200);
        }
        else if ($countryId) {
            $response = State::where('country_id', $countryId)->paginate(200);
        } else {
            $response = State::paginate(200);
        }
        return $response;
    }
    public function cities(Request $request, $id = null)
    {
        $stateId = $this->getFormValue('state_id');
        if ($id) {
            $response = City::find($id);
        } else {
            if ($searchTerm = $request->input('q')) {
                $builder = City::where('name', 'LIKE', '%'.$searchTerm.'%');
                if ($stateId) {
                    $builder->where('state_id', $stateId);
                }
                $response = $builder->paginate(200);
            } else {
                if ($stateId) {
                    $response = City::where('state_id', $stateId)->paginate(200);
                } else {
                    $response = City::paginate(200);
                }
            }
        }
        return $response;
    }

    private function getFormValue($key) {
        if (!isset($this->_formValues)) {
            $this->_formValues = [];
            if ($formElements = request()->input('form')) {
                foreach ($formElements as $formElement) {
                    $name = Arr::get($formElement, 'name');
                    $value = Arr::get($formElement, 'value');
                    if ($name && $value) {
                        $this->_formValues[$name] = $value;
                    }
                }
            }
        }
        return Arr::get($this->_formValues, $key);
    }
}
