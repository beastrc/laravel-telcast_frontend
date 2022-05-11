<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('remoteUpload')) {
	function remoteUpload($path, $url)
	{
		$extension = pathinfo($url, PATHINFO_EXTENSION);
		$filename = Str::random(40) . '.' . $extension;
		$filepath = $path . '/' . $filename;
		$contents = file_get_contents($url);
		
		Storage::disk('public')->put($filepath, $contents);
		
		return $filepath;
	}
}