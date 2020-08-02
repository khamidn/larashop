<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spanduk;

class SpandukController extends Controller
{
    
    public function index(Request $request)
    {
        $status = $request->status;
        $keyword = $request->keyword ? $request->keyword : '';
        if($status){
            $spanduks = Spanduk::where('name', 'LIKE', "%$keyword%")
                        ->where('status',strtoupper($status))
                        ->paginate(10);
        }

        else{
            $spanduks = Spanduk::where('name', 'LIKE', "%$keyword%")
                        ->paginate(10);
        }
        
        return view('spanduks.index', ['spanduks' => $spanduks]);
    }

    
    public function create()
    {
        return view('spanduks.create');
    }

    
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "name" => "required",
            "image" => "required",
            "creator" => "required",
            "categories" => "required",
            "description" => "required"
        ])->validate();

        $new_spanduk = new Spanduk;

        $name = $request->name;
        $new_spanduk->name = $name;
        $new_spanduk->slug = str_slug($name);

        $image = $request->file('image');

        if($image){
            $image_path = $image->store('spanduks', 'public');
            $new_spanduk->image = $image_path;
        }
        
        $new_spanduk->creator = $request->creator;
        $new_spanduk->category = json_encode($request->categories);
        $new_spanduk->description = $request->description;
        $new_spanduk->status = $request->save_action;
        $new_spanduk->created_by = \Auth::user()->id;

        $new_spanduk->save();

        // dd($new_spanduk);

        if($request->save_action == 'PUBLISH'){
            
            return redirect()->route('spanduks.create')->with('status', 'Spanduk successfully saved and published');
        }

        else {

            return redirect()->route('spanduks.create')->with('status', 'Spanduk saved as draft');
        }

    }

   
    public function show($id)
    {
        
    }

   
    public function edit($id)
    {
        $spanduk = Spanduk::findOrFail($id);
        return view('spanduks.edit', ['spanduk' => $spanduk]);
    }

    
    public function update(Request $request, $id)
    {
        $spanduk = Spanduk::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required",
            "creator" => "required",
            "categories" => "required",
            "description" => "required",
            "status" => "required"
        ])->validate();

        $spanduk->name = $request->name;

        $new_image = $request->file('image');

        if($new_image){
            if($spanduk->image && file_exists(storage_path('app/public/'. $spanduk->image))){
                \Storage::delete('public/'. $spanduk->image);
            }

            $new_cover_path = $new_image->store('spanduks', 'public');
            $spanduk->image = $new_cover_path;
        }
        
        $spanduk->slug = $request->slug;
        $spanduk->creator = $request->creator;
        $spanduk->category = json_encode($request->categories);
        $spanduk->description = $request->description;
        $spanduk->status = $request->status;
        $spanduk->updated_by = \Auth::user()->id;

        $spanduk->save();

        return redirect()->route('spanduks.edit', ['id' => $spanduk->id])->with('status', 'Spanduk successfully updated');
    }

    public function destroy($id)
    {
        $spanduk = Spanduk::findOrFail($id);

        $spanduk->delete();

        return redirect()->route('spanduks.index')->with('status', 'Spanduk successfully moved to trash');
    }

    public function trash(Request $request){
        $keyword = $request->keyword ? $request->keyword : '';

        $deleted_spanduk = Spanduk::where('name', 'LIKE', "%$keyword%")
                            ->onlyTrashed()
                            ->paginate(10);

        return view('spanduks.trash', ['spanduks' => $deleted_spanduk]);
    }

    public function restore($id){
        $spanduk = Spanduk::withTrashed()->findOrFail($id);

        if($spanduk->trashed()){
            $spanduk->restore();
            return redirect()->route('spanduks.trash')->with('status', 'Spanduk successfully restored');
        }
        else{
            return redirectt()->route('spanduks.trash')->with('status', 'Spanduk is not in trash!');
        }
    }

    public function deletePermanent($id){
        $spanduk = Spanduk::withTrashed()->findOrFail($id);

        if(!$spanduk->trashed()){
            return redirect()->route('spanduks.trash')->with('status', 'Spanduk is not in trash!')->with('status_type', 'alert');
        }

        else{
            $spanduk->forceDelete();

            return redirect()->route('spanduks.trash')->with('status', 'Spanduk permanently deleted!');
        }
    }
}
