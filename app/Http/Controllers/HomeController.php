<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use DB;
use Response;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $userId = auth()->user()->id;
        $user =  User::find($userId);
        // echo '<pre>';
        // print_r($user->posts);
        // exit;

        $companies = Company::all();
        return view('home.index')->with('companies', $companies);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|unique:companies,email|regex:/(.+)@(.+)\.(.+)/i',
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100',
            'website' => 'url'
        ]);

        //handles file upload
        if ($request->hasFile('logo')) {

            $fileNameWithExt = $request->file('logo')->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $fileExtention = $request->file('logo')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtention;

            $path = $request->file('logo')->storeAs('/logo', $fileNameToStore, 'public');
        } else {
            $fileNameToStore = 'default.jpg';
        }

        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->logo = $fileNameToStore;
        $company->created_at = time();
        $company->save();

        return redirect('/')->with('success', 'Company Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('home.edit')->with('company', $company);
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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'email||regex:/(.+)@(.+)\.(.+)/i|unique:companies,email,' . $request['id'],
            'logo' => 'image|nullable|max:1999|dimensions:min_width=100,min_height=100',
            'website' => 'url'
        ]);

        //handles file upload
        if ($request->hasFile('logo')) {

            $fileNameWithExt = $request->file('logo')->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            $fileExtention = $request->file('logo')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExtention;

            $path = $request->file('logo')->storeAs('/logo', $fileNameToStore, 'public');
        }

        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        //        'updated_at' => time()
        //        $company->timestamps();


        if ($request->hasFile('logo')) {
            $company->logo = $fileNameToStore;
        }
        $company->save();

        return redirect('/')->with('success', 'Company Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $company = Company::find($id);

        if ($company->logo !== 'default.jpg') {
            Storage::delete('/logo/' . $company->logo);
        }

        $company->delete();
        return response()->json([
            'success' => 'Company Deleted successfully!.'
        ]);
    }
}
