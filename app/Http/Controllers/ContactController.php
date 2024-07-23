<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('user_id',auth()->id())->paginate(5);
        
        return view('index', compact('contacts'));
    }
    
    public function add(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
        Contact::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'company' => $request->company,
            'email'  => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect('/');
    }
    public function edit(Request $request, string $id)
    {
        $contact = Contact::findOrFail($id);
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
        $contact->update([
            'name' => $request->name,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $contact->save();
        return redirect('/');
    }
    public function delete(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect('/');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $out = '';
            $query = $request->get('search');
            if ($query != '') {
                $data = DB::table('contacts')
                    ->where('user_id', auth()->id())
                    ->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name', 'like', '%'.$query.'%')
                            ->orWhere('company', 'like', '%'.$query.'%')
                            ->orWhere('phone', 'like', '%'.$query.'%')
                            ->orWhere('email', 'like', '%'.$query.'%');
                    })
                    ->get();
            } else {
                $data = DB::table('contacts')
                    ->where('user_id', auth()->id())
                    ->orderBy('id', 'asc')
                    ->get();
            }
            
             
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $row)
                {
                    $out .= '
                    <div class="card">
                    <div>'.$row->name.'</div>
                    <div>'.$row->company.'</div>
                    <div>'.$row->phone.'</div>
                    <div>'.$row->email.'</div>
                    <div>
                        <div style="display: flex; flex-direction: row;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_contact">
                                Edit
                            </button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmation_delete">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>';
                }
            } else {
                $out = '<p>No contacts found.</p>';
            }
        }
    }
}
