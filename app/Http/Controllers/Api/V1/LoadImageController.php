<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Admin\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class LoadImageController extends Controller
{
  public function index(Request $request)
  {

     $files = $request->file;

//    $request->file->storeAs('public', uniqid('img_') . $request->file->getClientOriginalName());
//    $request->file->Storage::disk('public')->put('/images', $request->file);

//     image will be stored at storage/app/public/uploads

//     return $request;

     if (!empty($files)) {
         foreach ($files as $file) {
             Storage::put($file->getClientOriginalName(), file_get_contents($file));
             return ['file' => $file];
         }
     }
//
     return response()->json([
         'request' => $request,
         'message' => 'idunno',
     ]);


//    $validator = Validator::make($r->all(), [
//      'image' => 'required|mimes:jpg,jpeg,png|max:2048',
//    ]);
//
//    if ($validator->fails()) {
//      return $validator->errors();
//    }
//    $file = $r->file('image');
//    $filename =  $file->getClientOriginalName();
//    $path =  $file->store('avatars');
//    return $path;
//
//
  }
//
//  public function upload(Request $request){
//
//    $request->validate([
//      'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
//    ]);
//
//    $fileUpload = new FileUpload;
//
//    if($request->file()) {
//      $file_name = time().'_'.$request->file->getClientOriginalName();
//      $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
//
//      $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
//      $fileUpload->path = '/storage/' . $file_path;
//      $fileUpload->save();
//
//      return response()->json(['success'=>'File uploaded successfully.']);
//    }
//  }



//  public function __construct()
//  {
//    $this->middleware(['auth:api'])->except([]);
//  }
//
//  public function ImageUpload(Request $r)
//  {
//    $validator = Validator::make($r->all(), [
//      'image.*' => 'required|file|image|mimes:jpeg,png,gif,svg'
//    ]);
//    if ($validator->fails()) {
//      logger(['error' => $validator->errors()]);
//      return ['status' => 0];
//    }
//    $images = $r->all();
//    $paths = [];
//    foreach ($images as $image) {
//      $extension = $image->getClientOriginalName();
//      $filename  = 'image-' . time() . '.' . $extension;
//      Storage::disk('public')->putFileAs('/images/', $image, $filename);
//      $paths[] =   url(Storage::url('images/'.$filename));
//    }
//
//    return $paths;
//  }


  public function handle(Request $request)
  {
    if($request->hasFile('image')) {
      $pathToFile = $request->file('image')->store('images/avatars', 'public');
    }


    return $pathToFile;
  }

  public function deleteAvatar(Request $request)
  {
//    Storage::delete($request);
//    $pathToFile = '/storage/app/public' . $request->path;
//    $pathToFile = unlink('/storage/app/public/' . $request->path);
//    $pathToFile = Storage::delete( $request->path );
//    $pathToFile = File::delete('storage/'.$request->path);
    $pathToFile = Storage::disk('public')->delete($request->path);
    return $pathToFile;
  }


}
