<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $appid = '6433c1f8';
        $appkey = 'acf4191deb52673bc8bcbf205e8c2ccc';
        $q = htmlspecialchars($request->search);
        $client = new Client([
            'base_uri' => 'https://api.edamam.com',
        ]);
        $search = 'search?q='.$q.'&app_id='.$appid.'&app_key='.$appkey.'&from=0&to=12';
        $req = $client->request('GET', $search);
        $data = json_decode($req->getBody(), true);


        $results = [];
        $keyword = $data['q'];
        foreach($data['hits'] as $arr){
            $results[] = [
                'uri'=>$arr['recipe']['uri'],
                'shareAs'=>$arr['recipe']['shareAs'],
                'sourceUrl'=>$arr['recipe']['url'],
                'label'=>$arr['recipe']['label'],
                'image'=>$arr['recipe']['image'],
                'source'=>$arr['recipe']['source'],
                'calories'=>$arr['recipe']['calories'],
                'ingredients'=>count($arr['recipe']['ingredients'])
            ];
        }
        return view('search.resultview')->withKeyword($keyword)->withResults($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function single($uri)
    {
        $r = urlencode('http://www.edamam.com/ontologies/edamam.owl#'.trim($uri));
        $appid = '6433c1f8';
        $appkey = 'acf4191deb52673bc8bcbf205e8c2ccc';
        $client = new Client([
            'base_uri' => 'https://api.edamam.com',
        ]);
        $search = 'search?r='.$r.'&app_id='.$appid.'&app_key='.$appkey;
        $req = $client->request('GET', $search);
        $datas = json_decode($req->getBody(), true);

        foreach($datas as $data){
            $results = [
            'uri'=>$data['uri'],
            'url'=>$data['url'],
            'shareAs'=>$data['shareAs'],
            'sourceUrl'=>$data['url'],
            'label'=>$data['label'],
            'image'=>$data['image'],
            'source'=>$data['source'],
            'calories'=>$data['calories'],
            'ingredients'=>$data['ingredients'],
            'totalNutrients'=>$data['totalNutrients']
            ];
            $label = $data['label'];
        }

//        foreach($results['totalNutrients'] as $res => $val){
//            echo $val['label'];
//            echo '<pre>';
//            print_r($val);
//            echo '<pre>';
//        }
//        die();
        return view('search.single')->withLabel($label)->withResult($results);
    }


}
