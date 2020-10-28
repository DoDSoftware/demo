<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlaceRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\Place;
use App\Models\State;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class PlaceCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PlaceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        $this->crud->setModel(Place::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/place');
        $this->crud->setEntityNameStrings('place', 'places');
    }

    protected function setupListOperation()
    {
        $columns = [
            [
                'name'  => 'name',
                'label' => 'Display Name',
                'type'  => 'text',
            ],
            [
                'name'         => 'country', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Country', // Table column heading
                // OPTIONAL
                'entity'    => 'country', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => Country::class, // foreign key model
            ],
            [
                'name'         => 'state', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'State', // Table column heading
                // OPTIONAL
                'entity'    => 'state', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => State::class, // foreign key model
            ],
            [
                'name'         => 'city', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'City', // Table column heading
                // OPTIONAL
                'entity'    => 'city', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => City::class, // foreign key model
            ],
        ];
        $this->crud->setColumns($columns);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PlaceRequest::class);
        $fields = [
            [
                'name'  => 'name',
                'label' => 'Name',
                'type'  => 'text',
            ],
            [   // 1-n relationship
                'label'       => "Country", // Table column heading
                'type'        => "select2_from_ajax",
                'name'        => 'country_id', // the column that contains the ID of that connected entity
                'entity'      => 'country', // the method that defines the relationship in your Model
                'attribute'   => "name", // foreign key attribute that is shown to user
                'data_source' => url("api/countries"), // url to controller search function (with /{id} should return model)

                // OPTIONAL
                'placeholder'             => "Select a country", // placeholder for the select
                'minimum_input_length'    => 0, // minimum characters to type before querying results
                'model'                   => Country::class, // foreign key model
                // 'dependencies'            => ['category'], // when a dependency changes, this select2 is reset to null
                // 'method'                  => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
                // 'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
            ],
            [   // 1-n relationship
                'label'       => "State", // Table column heading
                'type'        => "select2_from_ajax",
                'name'        => 'state_id', // the column that contains the ID of that connected entity
                'entity'      => 'state', // the method that defines the relationship in your Model
                'attribute'   => "name", // foreign key attribute that is shown to user
                'data_source' => url("api/states"), // url to controller search function (with /{id} should return model)

                // OPTIONAL
                'placeholder'             => "Select a state", // placeholder for the select
                'minimum_input_length'    => 0, // minimum characters to type before querying results
                'model'                   => State::class, // foreign key model
                'dependencies'            => ['country_id'], // when a dependency changes, this select2 is reset to null
                // 'method'                  => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
            ],
            [   // 1-n relationship
                'label'       => "City", // Table column heading
                'type'        => "select2_from_ajax",
                'name'        => 'city_id', // the column that contains the ID of that connected entity
                'entity'      => 'city', // the method that defines the relationship in your Model
                'attribute'   => "name", // foreign key attribute that is shown to user
                'data_source' => url("api/cities"), // url to controller search function (with /{id} should return model)

                // OPTIONAL
                'placeholder'             => "Select a city", // placeholder for the select
                'minimum_input_length'    => 0, // minimum characters to type before querying results
                'model'                   => City::class, // foreign key model
                'dependencies'            => ['country_id', 'state_id'], // when a dependency changes, this select2 is reset to null
                // 'method'                  => 'GET', // optional - HTTP method to use for the AJAX call (GET, POST)
                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
            ],
        ];
        $this->crud->addFields($fields);

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
        $this->crud->setOperationSetting('contentClass', 'col-md-12');

    }

}
