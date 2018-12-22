<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Auth;
use Validator;

class ListingController extends Controller
{
    public function __contsruct()
    {
//        ログインしていなければログインさせる
        $this->middleware('auth');
    }

    public function index()
    {
        $listings = Listing::where('user_id',Auth::user()->id)
            ->orderBy('current_at','asc')
            ->get();

        return view('listing/index',['listings'=>$listings]);
    }

    public function new()
    {
        return view('listing/new');
    }

    public function store(Request $request)
    {
//        バリデーション
        $validator = Validator::make($request->all(),['list_name'=>'required|max255',]);

//        バリデーションエラー
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors()->withInput());
        }
//        TODO　ヘルパ関数調べる

    }
}
