<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Image;
use Intervention\Image\ImageManager;
use Session;

class ConfirmController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view("confirm");
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
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
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
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }

  public function showImage(Request $request){
    $choose = $request->get("choose");
    if($request->has('frame')){
      return view("confirm")->with(array("frame"=>$request->get('frame')));
    }else{
      return view("confirm")->with(array("choose"=>$choose));
    }
  }
  public function printImage(Request $request){
    // create an image manager instance with favored driver
    $tag = "กะทิชาวเกาะ";
    if(session('tag')){
      $tag = session('tag');
    }
    $array_img = $request->images;
    $num = $request->num;
    print_r($num);
    foreach ($array_img as $value) {
      $filename = basename($value);
      for($i =0 ; $i< $num;$i++){
        $command = "java -jar ".public_path('java/'."printer.jar")." ".$value;
        shell_exec($command);
      }
    }
    return redirect("/picture/all/".$tag);
  }
}
