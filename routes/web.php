<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/get/{folderA}/{folderB}','ImageController@get');
Route::post('/post','ImageController@post')->name('post');
Auth::routes([
    'register' => false,
]);
Route::group(['middleware' => ['auth'],],function(){

    Route::get('/home',function(){
        return view('home');
    })->name('home')->middleware('student');

    Route::get('/profile','StudentController@profile')->name('profile');
        
    // ADMIN FUNCTIONS
    Route::group(['prefix' => 'admin','middleware' => ['admin'],],function()
    {
        // students
        Route::get('/add-student','AdminController@getAddStudent')->name('add.student');
        Route::post('/add-student','AdminController@postAddStudent')->name('add.student');
        Route::get('/edit-student/{name}', 'AdminController@getUpdateStudent')->name('edit.student');
        Route::post('/update-student/{name}', 'AdminController@postUpdateStudent')->name('update.student');
        Route::get('/students','AdminController@getListStudents')->name('list.student');
        Route::get('/student/{name}', 'AdminController@getViewStudent')->name('view.student');
        Route::post('/delete-student/{user_name}', 'AdminController@deleteStudent')->name('delete.student');


        // Courses
        Route::get('/add-course','AdminController@getAddCourse')->name('add.course');
        Route::post('/add-course','AdminController@postAddCourse')->name('add.course');
        Route::get('/courses', 'AdminController@getListCourses')->name('list.course');
        Route::get('/edit-course/{code}', 'AdminController@getUpdateCourse')->name('edit.course');
        Route::post('/update-course/{code}', 'AdminController@postUpdateCourse')->name('update.course');
        Route::get('/course/{code}', 'AdminController@postUpdateCourse')->name('view.course');
        Route::post('/delete-course/{code}', 'AdminController@deleteCourse')->name('delete.course');

        // halls
        Route::get('/halls','AdminController@listHalls')->name('list.hall');
        Route::get('/add-hall','AdminController@createHall')->name('add.hall');
        Route::post('/add-hall','AdminController@storeHall')->name('add.hall');
        Route::get('/hall/{id}','AdminController@showHall')->name('update.hall');
        Route::get('/edit-hall/{id}','AdminController@editHall')->name('edit.hall');
        Route::post('/update-hall/{id}','AdminController@updateHall')->name('update.hall');
        Route::post('/delete-hall/{id}', 'AdminController@deleteHall')->name('delete.hall');
        Route::get('/assign-hall/{id}','AdminController@getAssignHall')->name('assign.hall');
        Route::post('/assign-hall/{id}','AdminController@postAssignHall')->name('assign.hall');


        // instructors
        Route::get('/instructors','AdminController@listInstructors')->name('list.instructor');
        Route::get('/add-instructor','AdminController@createInstructor')->name('add.instructor');
        Route::post('/add-instructor','AdminController@storeInstructor')->name('add.instructor');
        Route::get('/instructor/{id}','AdminController@showInstructor')->name('update.instructor');
        Route::get('/edit-instructor/{id}','AdminController@editInstructor')->name('edit.instructor');
        Route::post('/update-instructor/{id}','AdminController@updateInstructor')->name('update.instructor');
        Route::get('/assign-course/{user_name}', 'AdminController@getAssignInstructor')->name('assign.instructor');
        Route::post('/assign-course/{course_id}/{user_name}','AdminController@postAssignCourses')->name('assign.course');
        Route::post('/unassign-course/{course_id}/{user_name}','AdminController@postUnassignCourses')->name('unassign.course');
        Route::post('/delete-instructor/{user_name}', 'AdminController@deleteInstructor')->name('delete.instructor');

    });   
    
    // STUDENT FUNCTIONS
    Route::post('first-login','StudentController@firstLogin')->name('first-login');
    Route::group(['middleware' => ['student'],],function(){
        Route::post('update-profile','StudentController@updateProfile')->name('update.profile');
        Route::get('regitser-courses','StudentController@getRegisterCourses')->name('regitser.courses');
        Route::post('register-course/{course_id}/{student_id}','StudentController@postRegisterCourses')->name('post.register.course');
        Route::post('unregister-course/{course_id}/{student_id}','StudentController@postUnregisterCourses')->name('post.unregister.course');
        Route::get('show-regestered-courses', 'StudentController@getShowRegesteredCourses')->name('get.show.course');
    });

    // INSTRUCTOR FUNCTIONS
    Route::get('/courses/{user_name}', 'InstructorController@getListCourses')->name('list.course.instructor');
    Route::post('/register-course/{course_id}','InstructorController@postRegisterCourses')->name('register.course.instructor');
    Route::post('/unregister-course/{course_id}','InstructorController@postUnregisterCourses')->name('unregister.course.instructor');

});
        
