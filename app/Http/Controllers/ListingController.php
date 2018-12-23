<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Auth;
use Validator;

class ListingController extends Controller
{
    public function __construct()
    {
//        ミドルウェアでログインしていなければログインさせる
        $this->middleware('auth');
    }

    public function index()
    {
        $listings = Listing::where('user_id',Auth::user()->id)
            ->orderBy('created_at','asc')
            ->get();

        return view('listing/index',['listings'=>$listings]);
    }

    public function new()
    {
        return view('listing/new');
    }

    public function store(Request $request)
    {
//        バリデーション（名前）
        $validator = Validator::make($request->all(),['list_name'=>'required|max:255',]);
//        バリデーションエラー
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
//        TODO　
        $listing = new Listing;
        $listing->title = $request->list_name;
//        ユーザーIDを付与
        $listing->user_id = Auth::user()->id;
        $listing->save();
        return redirect('/');
    }

    public function edit($listing_id)
    {
        $listing = Listing::find($listing_id);

        return view('listing/edit',['listing'=>$listing]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),['list_name'=>'required|max:255',]);

        if ($validator->fails()){
            return redirect()->back()->withErros($validator->errors())->withInput();
        }

        $listing =Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->save();
        return redirect('/');
    }


    public function destroy($listing_id)
    {
//        削除するリストのIDを検索
        $listing = Listing::find($listing_id);

//        削除
        $listing->delete();
        return redirect('/');
    }
}
