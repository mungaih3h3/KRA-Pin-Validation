<?php
use Illuminate\Support\Facades\Route;

function is_kra_pin(string $pin) {
	//case insensitive
	$pattern = "/^[A-Z]\d{9}[A-Z]$/i";
	return preg_match($pattern, $pin) == 1;
}

Route::get("/test", function() {
	try {
		//valid by definition -> alphabet + 9 numbers + alphabet
		$valid_pins = ["B013078900W", "z112233445w"];
	
		foreach($valid_pins as $pin) {
			assert(is_kra_pin($pin));
		}
	
		//first one is shorter, second one is a double valid pin, third one has a double A at the beginning
		$invalid_pins = ["A8900W", "A013078900WA013078900W", "AA13078900W"];
		foreach($invalid_pins as $pin) {
			assert(is_kra_pin($pin) == false);
		}
		return response("Working", 200);
	} catch(\Exception $e) {
		return response("Not working", 500);
	}
});

Route::get("/is_kra/{pin}", function (string $pin) {
	$pattern = "/^[A-Z]\d{9}[A-Z]$/i";
	return response()->json([
		"match" => preg_match($pattern, $pin) == 1
	]);
});
