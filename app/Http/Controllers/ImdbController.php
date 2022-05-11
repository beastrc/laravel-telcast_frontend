<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Language;
use App\Models\Media;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Imdb\Title;

class ImdbController extends Controller
{
	public function fetchTitle(Request $request)
	{
		$request->validate([
			'title' => ['required'],
		]);
		
		$title = new Title($request->title);
		$genres_ = $title->genres();
		$languages_ = $title->languages();
		
		$genres = Genre::where(function ($q) use ($genres_) {
			foreach ($genres_ as $genre) {
				$q->orWhere('name', 'LIKE', '%' . $genre . '%');
			}
		})->get(['id', 'name']);
		
		$languages = Language::where(function ($q) use ($languages_) {
			foreach ($languages_ as $language) {
				$q->orWhere('title', 'LIKE', '%' . $language . '%');
			}
		})->get(['id', 'title']);
		
		// Download photo from url to folder and create media
		$photo = remoteUpload('posters/episodes', $title->photo());
		$path = storage_path("app/public/$photo");
		$media = Media::create([
			'title' => basename($photo),
			'type' => File::mimeType($path),
			'size' => File::size($path),
			'extension' => File::guessExtension($path),
			'path' => $photo,
		]);
		
		$release_date = collect($title->releaseInfo())->where('country', 'USA')->first();
		
		return response()->json([
			'status' => true,
			'data' => [
				'genres' => $genres,
				'languages' => $languages,
				'title' => $title->title(),
				'description' => $title->plotoutline(),
				'actors' => $title->actor_stars(),
				'directors' => $title->director(),
				'imdb_rating' => $title->rating(),
				'release_date' => Carbon::parse($release_date['year'] . '-' . $release_date['mon'] . '-' . $release_date['day'])->format('Y-m-d'),
				'poster' => $media,
			],
		]);
	}
	
	public function fetchEpisode(Request $request)
	{
		$request->validate([
			'title' => ['required'],
		]);
		
		$title = new Title($request->title);
		$duration = CarbonInterval::minutes($title->runtime());
		
		// Download photo from url to folder and create media
		$photo = remoteUpload('posters/episodes', $title->photo());
		$path = storage_path("app/public/$photo");
		$media = Media::create([
			'title' => basename($photo),
			'type' => File::mimeType($path),
			'size' => File::size($path),
			'extension' => File::guessExtension($path),
			'path' => $photo,
		]);
		
		$release_date = collect($title->releaseInfo())->where('country', 'USA')->first();
		
		return response()->json([
			'status' => true,
			'data' => [
				'title' => $title->title(),
				'description' => implode($title->plot()),
				'imdb_rating' => $title->rating(),
				'release_date' => Carbon::parse($release_date['year'] . '-' . $release_date['mon'] . '-' . $release_date['day'])->format('Y-m-d'),
				'poster' => $media,
			],
		]);
	}
}
