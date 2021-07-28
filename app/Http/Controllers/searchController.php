<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Ext\Table\Table;

class searchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get("q");
        $type = $request->get("type") ?? "title";
        if ( $type == "any" ) {
            $searchResult = DB::select("select * from videos where title LIKE '%$query%' OR genre LIKE '%$query%' OR director LIKE '%$query%' OR producer LIKE '%$query%'");
        } else {
            if ($query != "*") {
                $searchResult = DB::select("select * from videos where $type LIKE '%$query%'");
            } else if (\strlen($query) > 0) {
                $searchResult = DB::select("select * from videos");
            }
        }

        // dd($searchResult);
        return view('search',[
            "query" => $query,
            "type" => $type,
            "searchResult" => $searchResult
        ]);
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
}
