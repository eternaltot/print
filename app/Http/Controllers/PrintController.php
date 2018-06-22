<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Image;
use Intervention\Image\ImageManager;
use Session;

class PrintController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view("printer");
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
    if($request->has('frames')){
      return view("printer")->with(array("frames"=>$request->get('frames'),"choose"=>$choose));
    }else{
      return view("printer")->with(array("choose"=>$choose));
    }
  }

  //   public function printImage(Request $request){
  //       // create an image manager instance with favored driver

  //       $array_img = $request->images;
  //       $num = $request->num;
  //       $array_print_pic = array();
  //       print_r($num);
  //       foreach ($array_img as $value) {
  //           $filename = basename($value);
  //           $new_name = explode(".",$filename);
  //           $new_path_name = public_path('images/print/bitmap/'.$new_name[0].".bmp");
  //           $command = "java -jar ".public_path('java/'."convert.jar")." ".$value." ".$new_path_name;
  //           array_push($array_print_pic,$new_path_name);
  // 	shell_exec($command);
  //       }

  // print_r($array_print_pic);
  //       $handle = printer_open("HP LaserJet 500 color MFP M570 PCL 6");
  // $j=0;
  //       foreach ($array_print_pic as $value) {
  // 	printer_start_doc($handle,"Picture");
  //           printer_set_option($handle, PRINTER_MODE, "raw");
  // 	$img = Image::make($array_img[$j]);

  // 	// if($img->width()>$img->height()){
  // 	// 	printer_set_option($handle,PRINTER_ORIENTATION,PRINTER_ORIENTATION_LANDSCAPE);
  // 		printer_set_option($handle,PRINTER_RESOLUTION_Y,300);
  // 		printer_set_option($handle,PRINTER_RESOLUTION_X,300);
  // 	// 	$height = 1500;
  // 	// 	$width = 2100;
  // 	// }else{
  // 	// 	printer_set_option($handle,PRINTER_ORIENTATION,PRINTER_ORIENTATION_PORTRAIT);
  // 		printer_set_option($handle,PRINTER_RESOLUTION_Y,300);
  // 		printer_set_option($handle,PRINTER_RESOLUTION_X,300);
  // 	// 	$height = 2100;
  // 	// 	$width = 1500;
  // 	// }
  //           for($i=1;$i<=$num;$i++){
  //               printer_start_page($handle);

  //               printer_draw_bmp($handle, $value, 1, 1);
  // 		//printer_write($handle,$value);
  //               printer_end_page($handle);
  //           }
  // 	$j++;
  // 	printer_end_doc($handle);
  //       }

  //       printer_close($handle);
  //       return redirect("/picture/all/กะทิชาวเกาะ");
  //   }
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
      $command = "java -jar ".public_path('java/'."printer.jar")." ".$value." ".$num;
      shell_exec($command);
    }
    File::deleteDirectory(public_path('images/temp'));
    return redirect("/picture/all/");
  }
}
