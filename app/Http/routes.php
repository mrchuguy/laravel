<?php

use Illuminate\Http\Request;
use App\Task;

Route::get('/', function () {
    $task = new Task();
    return view('tasks', [
	'tasks'=>$task->all()
    ]);
});
Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
    'name' => 'required|max:255',
  ]);

  if ($validator->fails()) {
    return redirect('/')
      ->withInput()
      ->withErrors($validator);
  }
  
  $new_task = new Task();
  $new_task->name = $request->name;
  $new_task->save();
  return redirect('/');
});
