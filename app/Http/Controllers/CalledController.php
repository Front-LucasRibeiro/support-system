<?php

namespace App\Http\Controllers;

use App\Mail\CalledsCreatedMail;
use App\Models\Called;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CalledController extends Controller
{

  public function index(Request $request)
  {
    $userId = Auth::id();
    $query = Called::query();

    if (Auth::user()->user_type === 'Colaborador') {
      $query->orderBy('created_at', 'desc');
    } else {
      $query->where('user_id', $userId)->orderBy('created_at', 'desc');
    }

    if ($request->input('action') === 'search' && $request->filled('search')) {
      $search = $request->input('search');
      $query->where(function ($q) use ($search) {
        $q->where('title', 'like', "%{$search}%")
        ->orWhere('id', 'like', "%{$search}%");
      });
    }

    if ($request->input('action') === 'clear') {
      return redirect('/chamados');
    }

    $calleds = $query->get();

    $messageSuccess = $request->session()->get('message.success');
    $request->session()->forget('message.success');

    return view('calleds.index', compact('calleds', 'messageSuccess'));
  }


  public function create()
  {
    return view('calleds.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'attachments.*' => 'nullable|mimes:jpg,jpeg,png,pdf,txt,doc,docx|max:2048',
    ]);

    $title = $request->input('title');
    $description = $request->input('description');
    $status = 'Aberto';

    $called = new Called();
    $called->title = $title;
    $called->description = $description;
    $called->status = $status;
    $called->user_id = Auth::id();;

    $attachmentPaths = [];

    if ($request->hasFile('attachments')) {
      foreach ($request->file('attachments') as $file) {
        $path = $file->store('attachments', 'public');
        $attachmentPaths[] = $path;
      }
      $called->attachments = json_encode($attachmentPaths);
    }

    $collaborators = User::where('user_type', 'Colaborador')->get();
    foreach ($collaborators as $collaborator) {
      Mail::to($collaborator->email)->queue(new CalledsCreatedMail($title, $description, $attachmentPaths));
    }

    $called->save();

    return redirect('/chamados')->with('status', 'success')->with('message.success', 'Chamado criado com sucesso.');
  }

  public function update(Request $request)
  {
    $this->validate($request, [
      'message' => 'nullable|string',
      'attachments.*' => 'nullable|mimes:jpg,jpeg,txt,png,pdf,doc,docx|max:2048',
    ]);

    $called = Called::find($request->input('called_id'));

    if (!$called) {
      return redirect('/chamados')->with('status', 'error')->with('message.error', 'Chamado não encontrado.');
    }

    if (Auth::user()->user_type === 'Colaborador') {
      $called->status = 'Em atendimento';

      if($request->input('called_finish') === 'finish'){
        $called->status = 'Finalizado';
      }
    }

    $message = $request->input('message');
    $name = Auth::user()->name;
    $attachmentPaths = [];

    if ($request->hasFile('attachments')) {
      foreach ($request->file('attachments') as $file) {
        $path = $file->store('attachments', 'public');
        $attachmentPaths[] = $path;
      }
    }

    $chatMessage = [
      'name' => $name,
      'message' => $message,
      'attachments' => $attachmentPaths ? json_encode($attachmentPaths) : null,
    ];

    $chat = $called->chat ? json_decode($called->chat, true) : [];
    $chat[] = $chatMessage;
    $called->chat = json_encode($chat);

    $called->save();

    return redirect('/chamados')->with('status', 'success')->with('message.success', 'Chamado atualizado com sucesso.');
  }


  public function show($id)
  {
    $called = Called::findOrFail($id);
    return view('calleds.show', compact('called'));
  }
}
