<?php

namespace App\Http\Controllers;

use App\Game;
use App\GameGenre;
use App\GamePlatform;
use App\Genre;
use App\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function test()
    {
        $games = Game::get();
        $genres = Genre::get();
        $platforms = Platform::get();
        return view('test', [
            'games' => $games,
            'genres' => $genres,
            'platforms' => $platforms
        ]);
    }

    public function change_test()
    {
        $games = Game::get();
        $genres = Genre::get();
        $platforms = Platform::get();
        return view('change_test', [
            'games' => $games,
            'genres' => $genres,
            'platforms' => $platforms
        ]);
    }

    public function add_game(Request $request)
    {
        $messages = [
            'game_name.unique' => 'Такая игра уже в каталоге.',
            'amount.numeric' => 'В поле "Количество" вводимое значение должно быть числовым'
        ];

        $request->validate([
            'game_name' => 'max:255|unique:games,name',
            'amount' => 'numeric|max:255',
        ], $messages);

        $game = new Game();
        $game->name = $request->game_name;
        $game->year = $request->year;
        $game->price = $request->price;
        $game->amount = $request->amount;
        $game->description = $request->description;
        $game->image = $request->image;
        $game->save();


        foreach ($request->genre_name as $genre) {
            $game_genres = GameGenre::firstOrCreate(

                ['game_name' => $request->game_name, 'genre_name' => $genre],

                ['game_name' => $request->game_name, 'genre_name' => $genre]

            );
        }

        $game_platform = GamePlatform::firstOrCreate(

            ['game_name' => $request->game_name, 'platform_name' => $request->platform_name],

            [
                'game_name' => $request->game_name,
                'platform_name' => $request->platform_name,
            ]

        );

        return Redirect::route('test');
    }

    public function add_genre(Request $request)
    {
        $messages = [
            'genre_name.unique' => 'Такой жанр уже добавлен.',
        ];

        $request->validate([
            'genre_name' => 'max:255|unique:genres,name',
        ], $messages);

        $genre = new Genre();
        $genre->name = $request->genre_name;
        $genre->save();

        return Redirect::route('test');
    }

    public function add_platform(Request $request)
    {
        $messages = [
            'platform_name.unique' => 'Такая платформа уже добавлена.',
        ];

        $request->validate([
            'platform_name' => 'max:255|unique:platforms,name',
        ], $messages);

        $platform = new Platform();
        $platform->name = $request->platform_name;
        $platform->picture = $request->platform_picture;
        $platform->save();

        return Redirect::route('test');
    }

    public function game_genre(Request $request)
    {
//        dd($request->genre_name);
        foreach ($request->genre_name as $genre) {
            $game_genres = GameGenre::firstOrCreate(

                ['game_name' => $request->game_name, 'genre_name' => $genre],

                ['game_name' => $request->game_name, 'genre_name' => $genre]

            );
        }

        return Redirect::route('change_test');
    }

    public function game_platform(Request $request)
    {
        $game_platform = GamePlatform::firstOrCreate(

            ['game_name' => $request->game_name, 'platform_name' => $request->platform_name],

            [
                'game_name' => $request->game_name,
                'platform_name' => $request->platform_name,
            ]

        );

        return Redirect::route('change_test');
    }

    public function change_game_amount(Request $request)
    {
        $game = DB::table('games')->where('name', $request->game_name)->get();
        $change = Game::find($game[0]->id);
        $change->amount = $request->new_amount;
        $change->save();

        return Redirect::route('change_test');
    }

    public function change_description(Request $request)
    {
        $game = DB::table('games')->where('name', $request->game_name)->get();
        $change = Game::find($game[0]->id);
        $change->description = $request->new_description;
        $change->save();

        return Redirect::route('change_test');
    }

    public function change_game_image(Request $request)
    {
        $game = DB::table('games')->where('name', $request->game_name)->get();
        $change = Game::find($game[0]->id);
        $change->image = $request->new_image;
        $change->save();

        return Redirect::route('change_test');
    }
}
