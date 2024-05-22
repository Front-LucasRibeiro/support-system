<?php
namespace App\Http\Controllers;

use App\Mail\CalledsCreatedMail;
use App\Models\Called;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CalledController extends Controller {

  public function index(Request $request){
    $calleds = Called::query()->orderBy('created_at', 'desc')->get();

    $messageSuccess = $request->session()->get('message.success');
    $request->session()->forget('message.success');

    return view('calleds.index')-> with('calleds', $calleds)->with('messageSuccess', $messageSuccess);
  }

  public function create(){
    return view('calleds.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'attachments.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
    ]);

    $title = $request->input('title');
    $description = $request->input('description');
    $status = 'Aberto';

    $called = new Called();
    $called->title = $title;
    $called->description = $description;
    $called->status = $status;

    $attachmentPaths = [];
    
    if ($request->hasFile('attachments')) {
      foreach ($request->file('attachments') as $file) {
        $path = $file->store('attachments', 'public');
        $attachmentPaths[] = $path; 
      }
      $called->attachments = json_encode($attachmentPaths); 
    }

    Mail::to('lksribeiro2014@gmail.com')->send(new CalledsCreatedMail($title, $description, $attachmentPaths));

    $called->save();

    return redirect('/chamados')->with('status', 'success')->with('message.success', 'Chamado criado com sucesso.');
  }

  public function show($id)
  {
    $called = Called::findOrFail($id);
    return view('calleds.show', compact('called'));
  }

}
