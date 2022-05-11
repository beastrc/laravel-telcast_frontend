<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Live;
use App\Models\Media;
use App\Models\Movie;
use App\Models\Season;
use App\Models\Show;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class PaginationController extends Controller
{
    public function genres(Request $request)
    {
        $data = Genre::where('name', 'LIKE', "%{$request->term}%")->paginate(10);
        $data->transform(function ($row) {
            $row->text = $row->name;
            return $row;
        });

        return $data;
    }

    public function categories(Request $request)
    {
        $data = Category::where('title', 'LIKE', "%$request->term%")->paginate(10);
        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function networkOperators(Request $request)
    {
        $data = Auth::user()
            ->network()
            ->first()
            ->operators()
            ->where('name', 'LIKE', "%$request->term%")
            ->paginate(10);

        $data->transform(function ($row) {
            $row->text = $row->name;
            return $row;
        });

        return $data;
    }

    public function languages(Request $request)
    {
        $data = Language::where('title', 'LIKE', "%$request->term%")->paginate(10);
        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function shows(Request $request)
    {
        $data = Show::where('title', 'LIKE', "%$request->term%")->paginate(10);
        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function seasons(Request $request)
    {
        $data = Season::where('title', 'LIKE', "%$request->term%")->paginate(10);
        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function showSeasons(Request $request)
    {
        $show = Show::find($request->show);
        $seasons = $show->seasons()->where('title', 'LIKE', "%$request->term%")->paginate(10);

        $seasons->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $seasons;
    }

    public function media(Request $request)
    {
        switch ($request->type) {
            case 'video':
                $type = [
                    'video/mp4',
                    'video/webm',
                    'video/x-ms-asf',
                    'video/x-ms-wmv',
                    'video/ogg',
                    'video/x-msvideo',
                    'video/quicktime',
                    'video/x-flv',
                    'video/x-matroska',
                ];
                break;

            case 'image':
                $type = [
                    'image/jpeg',
                    'image/gif',
                    'image/png',
                    'image/bmp',
                    'image/svg+xml',
                ];
                break;

            case 'subtitle':
                $type = [
                    'text/vtt',
                    'text/plain',
                ];
                break;
        }

        if ($request->has('term'))
            $data = Media::where('title', 'LIKE', "%$request->term%")->whereIn('type', $type)->latest()->paginate(10);
        else
            $data = Media::whereIn('type', $type)->latest()->paginate(10);

        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function channels(Request $request)
    {
        $data = \App\Models\Channel::where('title', 'LIKE', "%$request->term%")->paginate(10);
        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function spotlights(Request $request)
    {
        $genre = Genre::findOrFail($request->genre);

        switch ($request->segment) {
            case 'movie':
                if ($request->has('term'))
                    $data = $genre->movies()->where('title', 'LIKE', "%$request->term%")->latest()->paginate(10);
                else
                    $data = $genre->movies()->latest()->paginate(10);;
                break;

            case 'show':
                if ($request->has('term'))
                    $data = $genre->shows()->where('title', 'LIKE', "%$request->term%")->latest()->paginate(10);
                else
                    $data = $genre->shows()->latest()->paginate(10);;
                break;

            case 'season':
                if ($request->has('term'))
                    $data = $genre->seasons()->where('title', 'LIKE', "%$request->term%")->latest()->paginate(10);
                else
                    $data = $genre->seasons()->latest()->paginate(10);;
                break;

            case 'episode':
                if ($request->has('term'))
                    $data = $genre->episodes()->where('title', 'LIKE', "%$request->term%")->latest()->paginate(10);
                else
                    $data = $genre->episodes()->latest()->paginate(10);;
                break;

            case 'live':
                if ($request->has('term'))
                    $data = $genre->lives()->where('title', 'LIKE', "%$request->term%")->latest()->paginate(10);
                else
                    $data = $genre->lives()->latest()->paginate(10);;
                break;

            case 'sport':
                if ($request->has('term'))
                    $data = $genre->sports()->where('title', 'LIKE', "%$request->term%")->latest()->paginate(10);
                else
                    $data = $genre->sports()->latest()->paginate(10);;
                break;
        }

        $data->transform(function ($row) {
            $row->text = $row->title;
            return $row;
        });

        return $data;
    }

    public function search(Request $request)
    {
        if(empty($request->term)){
            return response()->json(['data' => []]);
        }

        $data = Search::new()
            ->add(Movie::class, 'title')
            ->add(Show::class, 'title')
            ->add(Season::class, 'title')
            ->add(Episode::class, 'title')
            ->add(Live::class, 'title')
            ->add(Sport::class, 'title')
            ->orderByDesc()
            ->paginate(20)
            ->beginWithWildcard()
            ->get($request->term);

        $data->transform(function ($row) {
            $modal = getModelName($row);

            $row->modal = getModelName($row);
            $row->poster = getPoster($row);
            $row->route = getRoute($row);

            switch ($modal){
                case 'live':
                    $row->duration = 'live';
                    break;

                default:
                    $row->duration = getDuration($row);
                    break;
            }

            $row->created_at_ago = Carbon::parse($row->created_at)->diffForHumans();

            return $row;
        });

        return $data;
    }
}