<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;
use App\CounterController;
use App\Employees;
use App\Sector;
use App\City;
use App\Category;
use App\Classification;
use App\InstanceService;

class InstanceController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $cases = Instance::where('approved', true)->inRandomOrder()->get();
            $casesFiltered = $this->filter($request->input('employees'), 0) == null ? $cases : $this->filter($request->input('employees'),0);
            $citiesFiltered = $this->filter($request->input('cities'), 1) == null ? $cases : $this->filter($request->input('cities'),1);
            $sectorFiltered = $this->filter($request->input('sectors'), 2) == null ? $cases : $this->filter($request->input('sectors'),2);
            $categoryFiltered = $this->filter($request->input('categories'), 3) == null ? $cases : $this->filter($request->input('categories'),3);
            $serviceFiltered = $this->filter($request->input('services'), 4) == null ? $cases : $this->filter($request->input('services'), 4);
            $classificationFiltered = $this->filter($request->input('classification'), 5) == null ? $cases : $this->filter($request->input('classification'), 5);
            $yearFiltered = $this->filter($request->input('year'), 6) == null ? $cases : $this->filter($request->input('year'), 6);
            
            return response()->json($citiesFiltered->intersect($casesFiltered)->intersect($sectorFiltered)->intersect($categoryFiltered)->intersect($serviceFiltered)->intersect($classificationFiltered)->intersect($yearFiltered));
        }
        return view('index-cases', [
            'cases'  => Instance::where('approved', true)->inRandomOrder()->get(),
            'employees_range' => Employees::all(),
            'sectors' => Sector::all(),
            'cities' => City::all(),
            'sectors' => Sector::all(),
            'categories' => Category::all(),
            'classifications' => Classification::all(),
            'key' => null,
            'id' => null
            ]);
    }

    public function indexWithParameters($key, $id) //keys: 0 = services , 1 = sector , 2 = classification, 3 = employees, 4 = city , 5 = year
    {
        return view('index-cases', [
            'cases'  => Instance::where('approved', true)->inRandomOrder()->get(),
            'employees_range' => Employees::all(),
            'sectors' => Sector::all(),
            'cities' => City::all(),
            'sectors' => Sector::all(),
            'categories' => Category::all(),
            'classifications' => Classification::all(),
            'key' => $key,
            'id' => $id
            ]);   
    }

    private function filter($data, $type) //types: 0 = employees, 1 = cities, 2 = sectors, 3 = categories
    {            
        $cases = Instance::where('approved', true)->inRandomOrder()->get();
        $instances = collect();
        if($data == null)
            return null;
        foreach ($data as $selection) {
            foreach ($cases as $case) {
                switch ($type) {
                    case 0:
                        if($case->employees_range == $selection)
                            $instances->push($case);
                        break;
                    case 1:
                        if($case->city_id == $selection)
                            $instances->push($case);
                        break;
                    case 2:
                        if($case->classification()->get()->first()->sector_id == $selection)
                            $instances->push($case);
                        break;
                    case 3:
                        if($case->isCategory($selection))
                            $instances->push($case);
                        break;
                    case 4:
                        if($case->isService($selection))
                            $instances->push($case);
                        break;
                    case 5:
                        if($case->classification_id == $selection)
                            $instances->push($case);
                        break;
                    case 6:
                        if($case->year == $selection)
                            $instances->push($case);
                        break;
                }
            }
        }
        return $instances;
    }

    public function classifications()
    {
        return Classification::all();
    }

    public function images()
    {
        $instances = Instance::where('approved', true)->get();
        $images = collect();
        foreach ($instances as $instance) {
            $images->push(['id' => $instance->id , 'image'=>$instance->image]);
        }
        return $images;
    }
   
    public function show(Instance $instance)
    {
        $instance->counter(request()->ip());
        return view('cases',[
            'instance' => $instance,
            'provider' => $instance->provider()->first(),
            'cases' => $instance->related(3)
            ]);
    }

}


