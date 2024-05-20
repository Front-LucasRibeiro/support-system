<?php
namespace App\Http\Controllers;

use App\Models\Called;
use Illuminate\Http\Request;

class CalledController extends Controller {

  public function index(){
    $calleds = Called::query()->orderBy('title')->get();
    return view('calleds.index')-> with('calleds', $calleds);
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

    if ($request->hasFile('attachments')) {
      $attachmentPaths = [];
      foreach ($request->file('attachments') as $file) {
        $path = $file->store('attachments', 'public');
        $attachmentPaths[] = $path;
      }
      $called->attachments = json_encode($attachmentPaths);
    }

    $called->save();

    return redirect('/chamados')->with('status', 'success');
  }

  public function show($id)
  {
    $called = Called::findOrFail($id);
    return view('calleds.show', compact('called'));
  }

}
