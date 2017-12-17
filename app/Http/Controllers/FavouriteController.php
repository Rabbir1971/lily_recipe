<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Favourite;
use Auth;
use Session;
use GuzzleHttp\Client;
class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $r = urlencode('http://www.edamam.com/ontologies/edamam.owl#'.trim($uri));
        $appid = '6433c1f8';
        $appkey = 'acf4191deb52673bc8bcbf205e8c2ccc';
        $client = new Client([
            'base_uri' => 'https://api.edamam.com',
        ]);

        $user = User::findorFail(Auth::user()->id)->first();
        $results = [];
        foreach($user->favourites()->orderBy('id','desc')->get() as $fav => $val){
            $r =  urlencode('http://www.edamam.com/ontologies/edamam.owl#'.$val['uri']);
            $search = 'search?r='.$r.'&app_id='.$appid.'&app_key='.$appkey;
            $req = $client->request('GET', $search);
            $datas = json_decode($req->getBody(), true);

            foreach($datas as $arr){
                $results[] = [
                    'id' => $val['id'],
                    'uri'=>$arr['uri'],
                    'shareAs'=>$arr['shareAs'],
                    'sourceUrl'=>$arr['url'],
                    'label'=>$arr['label'],
                    'image'=>$arr['image'],
                    'source'=>$arr['source'],
                    'calories'=>$arr['calories'],
                    'ingredients'=>count($arr['ingredients'])
                ];
            }
        }
        return view('search.favourites')->withResults($results);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'uri'=>'required'
        ]);
        $uri = str_replace('http://www.edamam.com/ontologies/edamam.owl#','',trim($request->uri));
        if(Favourite::where('uri',$uri)->exists()){
            $favourite = Favourite::where('uri',$uri)->first();
            if($favourite->users()->where('id',Auth::user()->id)){
                Session::flash('error','Already Added In Your Favourites!');
                return redirect()->route('view.favourites');
            }
            else{
                $favourite->users()->attach(Auth::user()->id);
                Session::flash('success','Successfully Added To Favourites!');
                return redirect()->route('view.favourites');
            }
        }
        else{
            $favourite = new Favourite;
            $favourite->uri = $uri;
            $favourite->save();
            $favourite->users()->attach(Auth::user()->id);

            Session::flash('success','Successfully Added To Favourites!');
            return redirect()->route('view.favourites');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request)
    {
        $user = User::findorFail(Auth::user()->id)->first();
        $user->favourites()->detach($request->id);
        Session::flash('success','Successfully Deleted!');
        return redirect()->route('view.favourites');
    }
}
