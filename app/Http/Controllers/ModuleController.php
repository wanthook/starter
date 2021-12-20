<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Module;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;
use Auth;
use Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.administrator.module.index');
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
        try
        {
            $validation = Validator::make($request->all(), 
                [
                    'nama'   => 'required',
                    'deskripsi'      => 'required',
                ],
                [
                    'nama.required'  => 'Kode harus diisi.',
                    'deskripsi.required'     => 'Nama harus diisi.',
                ]);

            if($validation->fails())
            {
                return response()->json(array(
                    'status' => 0,
                    'msg'   => $validation->errors()->all()
                ));
            }
            else
            {
                $req = $request->all();

                if(empty($req['id']))
                {
                    $req['updated_by']   = Auth::user()->id;
                    $req['created_by']   = Auth::user()->id;
                    
                    if(!$req['route'])
                    {
                        $req['route'] = '#';
                    }

                    Module::create($req);
                    
                    return response()->json(array(
                        'status' => 1,
                        'msg'   => 'Data berhasil disimpan'
                    ));
                }
                else
                {
                    $req['updated_by']   = Auth::user()->id;        
                    $req['updated_at']   = Carbon::now();

                    if(!$req['route'])
                    {
                        $req['route'] = '#';
                    }

                    Module::find($req['id'])->fill($req)->save();
                    
                    return response()->json(array(
                        'status' => 1,
                        'msg'   => 'Data berhasil diubah'
                    ));
                    
                }
            }
        }
        catch (QueryException $er)
        {
            return response()->json(array(
                'status' => 0,
                'msg'   => 'Data gagal disimpan'
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterOption  $masterOption
     * @return \Illuminate\Http\Response
     */
    public function show(MasterOption $masterOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterOption  $masterOption
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterOption $masterOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterOption  $masterOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterOption $masterOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterOption  $masterOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $req = $request->all();
        try 
        {
            Module::find($req['sId'])->delete();
            
            return response()->json(array(
               "status" => 1,
                "msg"   => "Data berhasil dihapus."
            ));
        } 
        catch (QueryException $ex) 
        {
            return response()->json(array(
               "status" => 0,
                "msg"   => "Data gagal dihapus."
            ));
        }
    }
    
    public function dt(Request $request)
    {
        $req    = $request->all();
        
        $datas   = Module::with('users', 'ancestors');  
        
        if(!empty($req['search']))
        {
            $datas->where(function($q) use($req)
            {
                $q->where('nama', $req['search']);
                $q->orWhere('deskripsi', $req['search']);
            });
        }

        $datas->orderBy('id','asc');
        
        return  Datatables::of($datas)
                ->editColumn('id', '{{$id}}')
                ->make(true);
    }


    
    public function selectparent(Request $request)
    {
        $tags = null;
        
        $term = trim($request->input('q'));
        $tags = Module::where(function($q) use($term)
        {
            $q->where('nama','like','%'.$term.'%')
              ->orWhere('deskripsi','like','%'.$term.'%')
              ->orWhere('route','like','%'.$term.'%')
              ->orWhere('id',$term);
        })->limit(100)->get()->toTree();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama.' - '.$tag->deskripsi];
        }
        return response()->json(array('items' => $formatted_tags));
    }
    
    public function selecttree(Request $request)
    {
        $tags = null;
        
        $term = trim($request->input('q'));
        $tags = Module::where(function($q) use($term)
        {
            $q->where('nama','like','%'.$term.'%')
              ->orWhere('deskripsi','like','%'.$term.'%')
              ->orWhere('route','like','%'.$term.'%')
              ->orWhere('id',$term);
        })->limit(100)->get()->toTree();
        $formatted_tags = [];
        foreach ($tags as $tag) {
            $child = [];
            
            if(count($tag->children))
            {
                foreach($tag->children as $cil)
                {
                    $child[] = ['id' => $cil->id, 'text' => $cil->nama];
                }
            }
            
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->nama, 'children' => $child];
        }
        return response()->json(array('items' => $formatted_tags));
    }
}
