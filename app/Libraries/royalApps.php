<?php

namespace App\libraries;

use Illuminate\Support\Facades\Http;

class RoyalApps
{

    private $base_url = "https://candidate-testing.api.royal-apps.io/api/v2";
    public function __construct()
    {

    }
    public function deleteRequest($url, $body=null)
    {
        try {
            //code...
            $response = Http::withHeaders([
                'Authorization' => auth()->user()->token ?? null,
            ])->delete($this->base_url . $url, $body);
    
            return ['status_code' => $response->status(), 'response' => json_decode($response->body())];
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
      
    }
    public function getRequest($url, $body=null)
    {
        try {
            //code...
            $response = Http::withHeaders([
                'Authorization' => auth()->user()->token ?? null,
            ])->get($this->base_url . $url, $body);
    
            return ['status_code' => $response->status(), 'response' => json_decode($response->body())];
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
      
    }

    public function postRequest($url, $body)
    {   
    try {
        //code...
        $response = Http::withHeaders([
            'Authorization' => auth()->user()->token ?? null,
        ])->post($this->base_url . $url, $body);
        return ['status_code' => $response->status(), 'response' => json_decode($response->body())];
    } catch (\Throwable $th) {
        //throw $th;
        dd($th->getMessage());
    }
      
    }
    public function putRequest($url, $body)
    {
        try {
            //code...
            $response = Http::withHeaders([
                'Authorization' => auth()->user()->token ?? null,
            ])->put($this->base_url . $url, $body);
            return ['status_code' => $response->status(), 'response' => json_decode($response->body())];
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
      
    }
    public function login($request)
    {
        $response = $this->postRequest('/token', $request);
        return $response; //returns a JSON object with access_token and token_type fields
    }

    public function authors($request = null)
    {
        $response = $this->getRequest('/authors', $request);
        return $response;
    }
    public function deleteAuthor($id)
    {   
        $url='/authors/'.$id;
        $response = $this->deleteRequest( $url);
        return $response;
    }
    public function author($id)
    {   
        $url='/authors/'.$id;
        $response = $this->getRequest( $url);
        return $response;
    }
    
    public function storeAuthor($request){
        $response = $this->postRequest('/authors', $request);
        return $response; 
    }
    
    public function storeBook($request){
    
        $response = $this->postRequest('/books', $request);
        return $response; 
    }
    public function deleteBook($id)
    {   
        $url='/books/'.$id;
        $response = $this->deleteRequest( $url);
        return $response;
    }
}
