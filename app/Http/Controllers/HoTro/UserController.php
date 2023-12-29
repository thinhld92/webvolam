<?php

namespace App\Http\Controllers\HoTro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Closure;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function edit(){
      $user = auth()->user();
      // dd($user);
      return view('hotro.users.edit', compact(
        'user',
      ));
    }

    public function update(UserRequest $request){
      $data = $request->all();
      if ($request->cPassWord) {
        $data['cPassWord'] = md5($request->cPassWord);
      }
      if ($request->cPassWord) {
        $data['cSecPassword'] = md5($request->cSecPassword);
      }
      $user = auth()->user();
      $user->update($data);
      return redirect()->route('hotro.dashboard')->with('success', 'Cập nhật thông tin thành công.');
    }

    public function uploadAvatar(Request $request){
      if ($request->file('avatar')) {
        $file = $request->file('avatar');
        $directory = storage_path('app/public/users/avatars/');
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0775, true);
        }
        $fileName = substr(md5(uniqid().time()),6,6) . $file->getClientOriginalName();
        $filePath = $directory . '/' . $fileName;
        $manager = ImageManager::gd();
        $image = $manager
                ->read($file)
                ->resize(500,500)
                ->save($filePath);
        $urlFile = env('APP_URL').'/storage/users/avatars/' . $fileName;

        $user = auth()->user();
        $user->avatar = $urlFile;
        $user->save();
        return response()->json([
            'urlFile' => $urlFile,
        ]);
      }

    }

    public function resetAvatar(Request $request){
      if ($request->avatar_url) {
        $avatar_url = parse_url($request->avatar_url, PHP_URL_PATH);
        $user = auth()->user();
        $user->avatar = $avatar_url;
        $user->save();
        return response()->json([
            'urlFile' => $avatar_url,
        ]);

      }
    }

    public function showKickAccForm(){
      return view('hotro.users.kickacc');
    }

    public function kickAcc(Request $request){
      $user = auth()->user();
      $rules = [
        'currentPassword' => [
            'required',
            function (string $attribute, mixed $value, Closure $fail) use ($user) {
                if (md5($value) !== $user->cPassWord) {
                    $fail("Mật khẩu xác nhận không chính xác");
                }
            },
        ],
      ];

      $message = [
        'required' => ':attribute bắt buộc phải nhập',
      ];

      $attributes = [
        'currentPassword' => "Mật khẩu xác nhận",
      ];

      $request->validate($rules, $message, $attributes);

      $user->iClientID = 0;
      $user->save();

      return redirect()->route('hotro.dashboard')->with('success', 'Kick kẹt acc thành công');
      
    }


    
}
