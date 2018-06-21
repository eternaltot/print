<?php

namespace App\Http\Controllers\Admin;

use App\Frame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FramesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $frames = Frame::where('tag', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $frames = Frame::paginate($perPage);
        }

        return view('admin.frames.index', compact('frames'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.frames.create');
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
        $this->validate($request, ['name' => 'required','horizontal'=>'required','vertical'=>'required']);
        $data = $request->all();
        $request->file("horizontal")->move(public_path('images'.'/frame/'),$data["name"]."-horizontal.png");
        $request->file("vertical")->move(public_path('images'.'/frame/'),$data["name"]."-vertical.png");
        $data['horizontal'] = $data['name']."-horizontal.png";
        $data['vertical'] = $data['name']."-vertical.png";
        $frame = Frame::create($data);
        // foreach ($request->roles as $role) {
        //     $user->assignRole($role);
        // }

        return redirect('admin/frames')->with('flash_message', 'Frame added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $frame = Frame::findOrFail($id);

        return view('admin.frames.show', compact('frame'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $frame = Frame::select('id', 'name','use','default')->findOrFail($id);
        return view('admin.frames.edit', compact('frame'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, ['name' => 'required']);
        $frame = Frame::findOrFail($id);
        $data = array();
        $data = $request->all();
        if($request->horizontal <> null && $request->vertical <> null){
          $request->file("horizontal")->move(public_path('images'.'/frame/'),$data["name"]."-horizontal.png");
          $data['horizontal'] = $data['name']."-horizontal.png";
          $request->file("vertical")->move(public_path('images'.'/frame/'),$data["name"]."-vertical.png");
          $data['vertical'] = $data['name']."-vertical.png";
          $data['use'] = $request->use <> 1 ? 0:1;
          $data['default'] = $request->default <> 1 ? 0:1;
        }elseif ($request->horizontal <> null && $request->vertical == null) {
          $data['name'] = $request->name;
          $request->file("horizontal")->move(public_path('images'.'/frame/'),$data["name"]."-horizontal.png");
          $data['horizontal'] = $data['name']."-horizontal.png";
          $data['use'] = $request->use <> 1 ? 0:1;
          $data['default'] = $request->default <> 1 ? 0:1;
        }elseif ($request->horizontal == null && $request->vertical <> null) {
          $data['name'] = $request->name;
          $request->file("vertical")->move(public_path('images'.'/frame/'),$data["name"]."-vertical.png");
          $data['vertical'] = $data['name']."-vertical.png";
          $data['use'] = $request->use <> 1 ? 0:1;
          $data['default'] = $request->default <> 1 ? 0:1;
        }else{
          $data['name'] = $request->name;
          $data['use'] = $request->use <> 1 ? 0:1;
          $data['default'] = $request->default <> 1 ? 0:1;
        }
        $frame->update($data);

        return redirect('admin/frames')->with('flash_message', 'Frame updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Frame  $frame
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frame = Frame::findOrFail($id);
        $path = public_path('images/frame/');
        unlink($path.$frame->horizontal);
        unlink($path.$frame->vertical);
        //
        Frame::destroy($id);

        return redirect('admin/frames')->with('flash_message', 'Frame deleted!');
    }
}
