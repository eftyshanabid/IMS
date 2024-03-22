<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserColumnVisibility;
use App\Models\User;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use \Modules\Subscriber\app\Models\Subscription;
use \Modules\Subscriber\app\Models\SubscriptionPayment;
use \Modules\Plan\app\Models\Plan;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::layouts.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function myAccount()
    {
        $title = "My Accounts | Settings";
        $user = Auth::user();

        return view('admin::myAccount.index', compact('title', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => ['required', 'string', 'max:15'],
            'email' => ['nullable', 'string', 'max:100', 'unique:users,email,' . $id],
            'username' => ['nullable', 'string', 'max:50', 'unique:users,username,' . $id],
        ]);

        $input = $request->except('_token');
        $user = User::findOrFail($id);

        if (!$user) {
            return $this->backWithError('This User is not registered yet.');
        }

        if (!empty($request->password)) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input['password'] = $user->password;
        }

        DB::beginTransaction();
        try {

            $avatarPath = '';
            if ($request->hasFile('avatar')) {
                $avatarPath = $this->fileUpload($request->file('avatar'), 'uploads/users');
                $input['avatar'] = $avatarPath;
                if (!empty($user) && file_exists($user->avatar)) {
                    unlink($user->avatar);
                }
            }
            $user = $user->update($input);

            DB::commit();
            return $this->redirectBackWithSuccess('User updated successfully', 'my.account');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->backWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function updateUserColumnVisibilities(Request $request)
    {
        UserColumnVisibility::updateOrCreate([
            'user_id' => auth()->user()->id,
            'url' => $request->url
        ], [
            'columns' => json_encode($request->columns)
        ]);
    }
}
