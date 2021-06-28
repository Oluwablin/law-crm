<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon;
use DB, Auth;
use Notification;
use App\Notifications\ClientWelcomeMail;

class ClientController extends Controller
{
    /**
     * List all clients
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::where([
            ['last_name', '!=', null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('last_name', 'LIKE', '%' . $search . '%')->get();
                }
            }]
        ])
        ->orderBy('id', 'DESC')
        ->simplePaginate(10);

        return view('clients.index', compact('clients'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $user = User::all();

        return view('clients.create', compact('clients', 'user'));
    }

    /**
     * Create Client's Profile
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'unique:clients', 'max:255'],
            'date_profiled' => ['required', 'date'],
            'primary_legal_counsel' => ['required', 'string', 'max:255'],
            'case_details' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'profile_image' => ['nullable', 'image','mimes:jpeg,png,jpg,svg|max:250'], //Max 250KB
        ]);

        if ($request->hasFile('profile_image')) {
            $fileExt = $request->profile_image->getClientOriginalExtension();
            $name = $request->profile_image.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
            $imageName = config('app.url').'/assets/avatars/'.$name;
            $storeFile = $request->profile_image->move(public_path('assets/avatars'), $imageName);
        } else {
            $imageName = null;
        }

        $client = new Client;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->date_profiled = $request->date_profiled;
        $client->primary_legal_counsel = $request->primary_legal_counsel;
        $client->date_of_birth = $request->date_of_birth;
        $client->case_details = $request->case_details;
        $client->profile_image = $imageName;
        $client->created_by = Auth::id();
        if($client->save()){
            Notification::route('mail' , $client->email)->notify(new ClientWelcomeMail($client));

            return redirect()->route('client_index')->with('success', 'Client Profile created successfully');
        }else{
            return redirect()->back()->withErrors('Your client profile could not be created at this time.');
        }
    }

    /**
     * Show a Client's Profile
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $client = Client::find($id);

        if($client){
            return view('clients.view', compact('client'));
        }else{
            return redirect()->back()->withErrors('Client could not be found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $client = Client::find($id);

        return view('clients.edit', compact('client'));
    }

    /**
     * Update Client's Profile
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'date_profiled' => ['required', 'date'],
            'primary_legal_counsel' => ['required', 'string', 'max:255'],
            'case_details' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'profile_image' => ['nullable', 'image','mimes:jpeg,png,jpg,svg|max:250'], //Max 250KB
        ]);

        $client = Client::find($id);
        if ($request->hasFile('profile_image')) {
            $fileExt = $request->profile_image->getClientOriginalExtension();
            $name = $request->profile_image.'_'. date("Y-m-d").'_'.time().'.'.$fileExt;
            $imageName = config('app.url').'/assets/avatars/'.$name;
            $storeFile = $request->profile_image->move(public_path('assets/avatars'), $imageName);
        } else {
            $imageName = $client->profile_image;
        }

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->date_profiled = $request->date_profiled;
        $client->primary_legal_counsel = $request->primary_legal_counsel;
        $client->date_of_birth = $request->date_of_birth;
        $client->case_details = $request->case_details;
        $client->profile_image = $imageName;
        $client->updated_by = Auth::id();
        if($client->update()){
            return redirect()->route('client_index')->with('success', 'Client Profile updated successfully');
        }else{
            return redirect()->back()->withErrors('Your client profile could not be updated at this time.');
        }
    }

    /**
     * Delete Client's Profile
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect()->back()->with('success', 'Client profile deleted successfully');
    }
}
