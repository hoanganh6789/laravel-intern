<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Alert;
use App\Helper\Toastr;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserAddresses;
use Flasher\Toastr\Laravel\Facade\Toastr as FacadeToastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private const VIEW_PATH = 'admin.users.';
    public function index()
    {
        $users = User::query()->latest('id')->paginate(10);

        $trashs = User::query()->onlyTrashed()->latest('id')->paginate(10);

        // dd($trashs->toArray());

        if ($users->currentPage() > $users->lastPage()) {
            return redirect()->route('admin.users.index', parameters: ['page' => $users->lastPage()]);
        }

        return view(self::VIEW_PATH . __FUNCTION__, compact(['users', 'trashs']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::VIEW_PATH . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $image = null;
        try {
            DB::transaction(function () use ($request, &$image) {
                $dataUser = $request->user;
                $dataAddress = $request->address;

                $dataUser['is_active'] = isset($dataUser['is_active']);
                $dataUser['password'] = Hash::make($dataUser['password']);

                if ($request->hasFile('user.avatar')) {
                    $image = Storage::put('users', $request->file('user.avatar'));
                    $dataUser['avatar'] = $image;
                }
                $user = User::query()->create($dataUser);

                $dataAddress['user_id'] = $user->id;
                $address = UserAddresses::create($dataAddress);
            }, 3);

            Toastr::success(null, 'Thêm user thành công');
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            Alert::error(null, $th->getMessage());
            Log::error($th->getMessage());

            if (Storage::exists($image)) {
                Storage::delete($image);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view(self::VIEW_PATH . __FUNCTION__, compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->user;
            $data['is_active'] = $request->has('user.is_active');
            $data['password'] = $request->filled('user.password') ?
                Hash::make($request->user['password']) : $user->password;

            if ($request->hasFile('user.avatar')) {
                $data['avatar'] = Storage::put('users', $request->file('user.avatar'));
            }

            $imageOld = $user->avatar;

            $user->update($data);

            if ($request->hasFile('user.avatar') && Storage::exists($imageOld)) {
                Storage::delete($imageOld);
            }
            Toastr::success(null, 'Cập nhật user thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error(null, $th->getMessage());
            Log::error($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user) {
            $user->addresses->delete();
            $user->delete();
            Alert::success("Xóa user: {$user->name} thành công", 'Thao tác thành công');
            return redirect()->back();
        }
    }

    public function trashs(string $id)
    {

        try {
            DB::transaction(function () use ($id) {
                $user = User::withTrashed()
                    ->findOrFail($id);

                if ($user) {
                    $user->addresses->forceDelete();
                    $user->forceDelete();
                }

                Alert::success("Xóa user: {$user->name} thành công", 'Thao tác thành công');
                return redirect()->back();
            });
        } catch (\Throwable $th) {
            Alert::error('Đã có lỗi xảy ra', 'Xóa user thất bại.');
            Log::error($th->getMessage());
            return redirect()->back();
        }
    }

    public function handleActiveMenu(Request $request)
    {

        if ($request->has('tab')) {
            return 'active';
        }

        return '';
    }
}
