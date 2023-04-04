<?php

namespace App\Http\Controllers;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class TrainingController extends Controller
{
    public function __construct()
    {
    $this->middleware('admin')->only(['edit']);
    }
    
    public function index(Request $request)
    {
        //$trainings = Training::all();
        $trainings = training::paginate(2);
        

        if($request->keyword){
            $user = auth()->user();
            $trainings = $user->trainings()
                ->where('name', 'LIKE', '%'.$request->keyword.'%')
                ->orWhere('name', 'LIKE', '%'.$request->keyword.'%')
                ->paginate(2);
        }else{
            $user = auth()->user();
            $trainings = $user->trainings()->paginate(2);
        }


        return view('trainings.index', compact('trainings'));
    }

    public function create()
    {
        return view('trainings.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'course' => 'nullable'
        ]);

        $name = $request->input('name');

        //ni try nak buat title website  changes based on nae entered
        $title = "Welcome, $name";
        
        if($name === 'ali'){
            return redirect()->route('home');
        }

        

        $training = new Training();
        $training->name = $request->name;
        $training->course = $request->course;
        $training->user_id = auth()->user()->id;
        $training->save();

        if($request->hasFile('attachment')){
            $filename = $training->id.'-'.date("Y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('', $request->attachment, $filename);

            $training->attachment = $filename;
            $training->save();
        }

        //Mail::to('azh@email.com')->send(new \App\Mail\TrainingCreated($training));
        //dispatch(new \App\Jobs\SendEmailJob($training));


        return redirect()
        ->route('trainings.index')
        ->with([
            'alert-type' => 'alert-primary',
            'alert' => 'Your registration has been saved!',
            
        ]);
        // return view('main', compact('training'));
    }

    public function show(Training $training)
    {
        $this->authorize('view', $training);
        return view('trainings.show', compact('training'));
    }

    public function edit(Training $training)
    {
        return view('trainings.edit', compact('training'));
    }

    public function update(Request $request, Training $training)
    {
        $training->name = $request->name;
        $training->course = $request->course;
        $training->save();

        return redirect()->route('trainings.index');
    }

    public function destroy(Training $training)
    {
        if($training->attachment){
            Storage::disk('public')->delete($training->attachment);
        }

        $training->delete();

        return redirect()->route('trainings.index');
    }

}
