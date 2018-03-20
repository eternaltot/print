<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Controllers\Controller;
use File;
use Image;

class TagsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return void
   */
  public function index(Request $request)
  {
      $keyword = $request->get('search');
      $perPage = 15;

      if (!empty($keyword)) {
          $tags = Tag::where('tag', 'LIKE', "%$keyword%")
              ->paginate($perPage);
      } else {
          $tags = Tag::paginate($perPage);
      }

      return view('admin.tags.index', compact('tags'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return void
   */
  public function create()
  {
      // $roles = Role::select('id', 'name', 'label')->get();
      // $roles = $roles->pluck('label', 'name');

      // return view('admin.users.create', compact('roles'));
      return view('admin.tags.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   *
   * @return void
   */
  public function store(Request $request)
  {
      $this->validate($request, ['tag' => 'required']);

      $tag = Tag::create($request->all());
      // foreach ($request->roles as $role) {
      //     $user->assignRole($role);
      // }

      return redirect('admin/tags')->with('flash_message', 'Tag added!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return void
   */
  public function show($id)
  {
      $tag = Tag::findOrFail($id);

      return view('admin.tags.show', compact('tag'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return void
   */
  public function edit($id)
  {
      // $roles = Role::select('id', 'name', 'label')->get();
      // $roles = $roles->pluck('label', 'name');

      $tag = Tag::select('id', 'tag')->findOrFail($id);
      // $user_roles = [];
      // foreach ($user->roles as $role) {
      //     $user_roles[] = $role->name;
      // }

      // return view('admin.users.edit', compact('user', 'roles', 'user_roles'));
      return view('admin.tags.edit', compact('tag'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int      $id
   *
   * @return void
   */
  public function update(Request $request, $id)
  {
      $this->validate($request, ['tag' => 'required']);
      $tag = Tag::findOrFail($id);
      $tag->update($request->all());

      // $user->roles()->detach();
      // foreach ($request->roles as $role) {
      //     $user->assignRole($role);
      // }

      return redirect('admin/tags')->with('flash_message', 'Tag updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return void
   */
  public function destroy($id)
  {
      Tag::destroy($id);

      return redirect('admin/tags')->with('flash_message', 'Tag deleted!');
  }

  public function backup($id){
    $tag = Tag::findOrFail($id);
    $parent_path = public_path().'/images/backup';
    if(!File::exists($parent_path)) {
      File::makeDirectory($parent_path, $mode = 0755, true , true);
    }
    $path = public_path().'/images/backup/ig/'.$tag->id;
    if(!File::exists($path)) {
      File::makeDirectory($path, $mode = 0777, true, true);
    }
    $base_url = 'https://www.instagram.com/explore/tags/'.urlencode($tag->tag).'/?__a=1';
    $url = $base_url;
    while(1) {
      $json = json_decode(file_get_contents($url,true));
      $count = $json->graphql->hashtag->edge_hashtag_to_media->count;
      foreach ($json->graphql->hashtag->edge_hashtag_to_media->edges as $value) {
        $filename = basename($value->node->display_url);
        if(!File::exists($path.'/'.$filename)) {
          Image::make($value->node->display_url)->save($path.'/'.$filename,100);
        }
      }
      if(!$json->graphql->hashtag->edge_hashtag_to_media->page_info->has_next_page) break;
      $url = $base_url.'&max_id='.$json->graphql->hashtag->edge_hashtag_to_media->page_info->end_cursor;
    }
    return redirect('admin/tags')->with('flash_message', 'Backup Finished!');
  }
}
