<?php

namespace App\Http\Controllers\Admin\Survey;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Survey as Survey;
use App\Traits\SurveyJsonTrait;


class SurveyController extends Controller
{
    use SurveyJsonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::get();
        return view('admin.survey.survey-index')->with(compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.survey.survey-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:4',
            'description' => 'required|string|max:255',
        ];
        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
            'name.min' => 'El nombre debe ser de al menos 4 caracteres.',
            'description.required' => 'Debe ingresar una descripción',
            'description.max' => 'La descripción debe tener menos de 256 caracteres',
        ];
        $this->validate($request, $rules, $messages);
        Survey::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('surveys.index')->withSuccess( 'Encuesta agregada corretamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        return view('admin.survey.survey-show', [
                'survey' => $survey,
                'responses' => $this->getJson($survey)
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $survey = Survey::find($id);
        return view('admin.survey.survey-edit')->with(compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->input('active')){
            $activeSurvey = Survey::where('active', true)->first();
            $activeSurvey->active = false;
            $activeSurvey->save();
            $survey = Survey::find($id);
            $survey->active = true;
            $survey->save();
            return response()->json([
                'id'      => $id,
                'message' => "activado"
            ]);
        }
        $rules = [
            'name' => 'required|string|min:4',
            'description' => 'required|string|max:255',
        ];
        $messages = [
            'name.required' => 'Debe ingresar el nombre.',
            'name.min' => 'El nombre debe ser de al menos 4 caracteres.',
            'description.required' => 'Debe ingresar una descripción',
            'description.max' => 'La descripción debe tener menos de 256 caracteres',
        ];
        $this->validate($request, $rules, $messages);
        $survey = Survey::find($id);
        $survey->name = $request->input('name');
        $survey->description = $request->input('description');
        $survey->save();
        return redirect()->route('surveys.index')->withSuccess( 'Encuesta actualizada corretamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $survey = Survey::find($id);
        $survey->delete();

        if ($request->ajax()) {
            return response()->json([
                'id'      => $id,
                'message' => "Encuesta eliminada"
            ]);
        }

        return redirect()->route('surveys.index');
    }
}
