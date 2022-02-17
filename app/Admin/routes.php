<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Это тестовое задание.';
	return AdminSection::view($content, 'Dashboard');
}]);

