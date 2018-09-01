<?php

namespace App\Http\Controllers\Admin\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Survey as Survey;
use App\Question as Question;
use App\SurveyQuestion as SurveyQuestion;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $survey = Survey::find($request->input('survey'));
        return view('admin.survey.question-create')->with(compact('survey'));
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
            'question' => 'required|string|min:4',
            'type' => 'required|integer|not_in:0',
        ];
        $messages = [
            'question.required' => 'Debe ingresar la pregunta.',
            'question.min' => 'El nombre debe ser de al menos 4 caracteres.',
            'type.required' => 'Se debe seleccionar el tipo de pregunta',
            'type.integer' => 'Se debe seleccionar el tipo de pregunta',
            'type.not_in' => 'Se debe seleccionar el tipo de pregunta',
        ];
        $this->validate($request, $rules, $messages);
        $question = Question::create([
            'question' => $request->input('question'),
            'question_type_id' => $request->input('type'),
        ]);
        $survey = $request->input('survey');
        $maxOrder = SurveyQuestion::where('survey_id', $survey)->get()->max('order');
        SurveyQuestion::create([
            'question_id' => $question->id,
            'survey_id' => $survey,
            'order' => $maxOrder+1
        ]);
        return redirect('admin/surveys/'.$survey)->withSuccess( 'Pregunta agregada corretamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
