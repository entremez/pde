<?php

namespace App\Http\Controllers\Admin\Survey;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ResponseChoice as ResponseChoice;
use App\Response as Response;
use App\Question as Question;

class ResponseChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $question = Question::find($request->input('question'));
        return view('admin.survey.response_choises-index')->with(compact('question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $question = Question::find($request->input('question'));
        return view('admin.survey.response-create')->with(compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = new ResponseChoice();
        $response->question_id = $request->input('question');
        $response->response = $request->input('response');
        $response->weight = $request->input('weight');
        $response->save();
        return redirect('admin/response_choices/?question='.$request->input('question'));
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
        $response = ResponseChoice::find($id);
        $response->response = $request->input('response');
        $response->weight = $request->input('weight');
        $response->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $responseChoice = ResponseChoice::find($id);
        $responseChoice->delete();
        if($request->ajax())
            return response()->json([
                'message' => 'Ok'
            ]);
        return redirect()->back();
    }
}
