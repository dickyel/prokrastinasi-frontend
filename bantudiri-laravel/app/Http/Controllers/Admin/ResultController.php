<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class ResultController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $data = Answer::with(['question', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();

            $formattedData = [];

            foreach ($data as $answer) {
                $name = $answer->user->name;

                if (!isset($formattedData[$name])) {
                    $formattedData[$name] = [
                        'DT_RowIndex' => count($formattedData) + 1,
                        'name' => $name,
                        'jenjang' => $answer->user->jenjang, // Add jenjang field
                        'date_test' => $answer->user->date_test, // Add date_test field
                        'questions' => [],
                        'total_score' => 0,
                        'level' => '',
                    ];
                }

                $formattedData[$name]['questions'][] = [
                    'question' => $answer->question->question,
                    'response' => $answer->response,
                ];

                // Assuming response is numeric, you may need to adjust based on your actual scoring system
                $formattedData[$name]['total_score'] += intval($answer->response);
            }

            // Define your level logic based on the total score
            foreach ($formattedData as &$data) {
                $totalScore = $data['total_score'];

                // Define your level thresholds as needed
                if ($totalScore >= 76 && $totalScore <= 100) {
                    $data['level'] = 'Berat';
                } elseif ($totalScore >= 50 && $totalScore <= 75) {
                    $data['level'] = 'Sedang';
                } elseif ($totalScore >= 25 && $totalScore <= 49) {
                    $data['level'] = 'Ringan';
                } else {
                    $data['level'] = 'Invalid Level'; // Handle the case where the total score is outside the specified ranges
                }
            }

            // Return DataTables response
            return DataTables::of($formattedData)
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.admin.result.index');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
