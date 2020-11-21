<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;

class RecievePosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = env('API_ENDPOINT');

        $client = new Client(); //GuzzleHttp\Client

        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        if($responseBody->data){
            $admin = User::where('profile_id', Profile::where('is_admin', true)->pluck('id'))->first();
            $data=$responseBody->data;
            foreach($data as $item){
                if(!Post::where('publication_date', $item->publication_date)->first()){
                    Post::create([
                        'user_id'=>$admin->id,
                        'title'=>$item->title,
                        'description'=>$item->description,
                        'publication_date'=>$item->publication_date,
                        'active'=>true
                        ]);
                }
            }

            return 1;
        }

        return 0;
    }
}
