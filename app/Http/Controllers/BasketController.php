<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Game;
use App\GameGenre;
use App\GamePlatform;
use App\Genre;
use App\Platform;
use App\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BasketController extends UserController
{
    public function basket()
    {
        $game_name_in_basket = DB::table('baskets')->where('user_name', 'Admin')->pluck('game_name');

        $games_in_basket = DB::table('baskets')->where('user_name', 'Admin')->get();

        $games = DB::table('games')->whereIn('name', $game_name_in_basket)->get();

        $total = 0;

        foreach ($games_in_basket as $game){
            $variable = DB::table('games')->where('name', $game->game_name)->get();
            $price = ($variable[0]->price) * ($game->amount);
            $total = $total + $price;
        }

        return view('basket', [
            'games_in_basket' => $games_in_basket,
            'games' => $games,
            'total' => $total
        ]);
    }

    public function addToBasket(Request $request)
    {

        Basket::updateOrCreate(
            ['product_id' => $request->product_id, 'user_id' => $request->user_id],
            ['quantity' => "1"]
        );

        return back();

    }

    public function change_amount_game_to_basket(Request $request)
    {
        $game_amount = DB::table('games')->where('name', "$request->game_name")->pluck('amount');

//        dd($request->game_amount);

        if ($request->change == '-') {
            if ($request->game_amount - 1 == 0) {
                DB::table('baskets')
                    ->where('user_name', 'Admin')
                    ->where('game_name', "$request->game_name")
                    ->delete();
            } else {
                $subtract_game_amount_basket = Basket::updateOrCreate(

                    ['game_name' => $request->game_name, 'user_name' => $request->user_name],

                    [
                        'amount' => $request->game_amount - 1
                    ]

                );
            }
        } else {
            if ($game_amount[0] > $request->game_amount) {
                $add_game_amount_basket = Basket::updateOrCreate(

                    ['game_name' => $request->game_name, 'user_name' => $request->user_name],

                    [
                        'amount' => $request->game_amount + 1
                    ]

                );
            }
        }

        return redirect('basket');
    }

    public function clear_basket()
    {
        $deletedRows = DB::table('baskets')->where('user_name', 'Admin')->delete();

        return redirect('basket');
    }

    public function price_of_all_games_in_basket()
    {
        $games = DB::table('baskets')->where('user_name', 'Admin')->get();


    }
}
