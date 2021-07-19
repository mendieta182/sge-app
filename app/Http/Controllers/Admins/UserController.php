<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->has('perPage') ? $request->perPage : 5;
        $emailSearch = $request->has('emailSearch') ? $request->emailSearch : '';

        $users=User::where('is_admin',0)
                ->where('email','LIKE','%'.$emailSearch.'%')
                ->paginate($perPage)->withQueryString();

        $roles=Role::all();

        return Inertia::render('Admins/Users/Index',[
            'perPage'=>$perPage,
            'emailSearch'=>$emailSearch,
            'users' => $users,
            'roles' => $roles,
        ]);

//        request()->validate([
//            'direction'=>['in:asc,desc'],
//            'field'=>['in:name,email'],
//        ]);
//
//
//        $query = User::query();
//
//        $perPage = request('perPage') ? request('perPage') : 5;
//
//        if (request('search')){
//            $query->where('name','LIKE','%'.request('search').'%');
//        }
//
//        if (request()->has(['field','direction'])){
//            $query->orderBy(request('field'),request('direction'));
//        }
//
//        return Inertia::render('Admins/Users/Index',[
//            'users'=>$query->paginate(),
//            'filters'=>request()->all('search','field','direction'),
//            'perPage'=>$perPage
//        ]);
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
        $this->validate($request,[
                'name'=>['required','max:25','min:2'],
                'email'=>['required','max:25','min:2','email','unique:users,email'],
            ]
        );
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'is_admin'=>0,
            'password'=>Hash::make('password'),
        ]);
        $role=Role::where('id',5)->first();
        $user->syncRoles($role);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
                'name'=>['required','max:50','min:2'],
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore($user->id)],
            ]
        );
        if ($request->roles[0]===null) {
            return back()->withErrors(['roles' => 'The role field is required']);
        }

        if ($request->roles[0]['id'] != 5){
            $adminRole = Role::where('id',$request->roles[0]['id'])->first();
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'is_admin'=>1,
            ]);
            $user->syncRoles($adminRole);
            return back();
        }else{
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'is_admin'=>0,
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
