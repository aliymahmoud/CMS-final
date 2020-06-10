<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $event)
    {
        $event->listen(BuildingMenu::class, function (BuildingMenu $event) {
        $event->menu->add(

        );
        if(\Auth::check()){
          if(\Auth::user()->role == 0){
            $event->menu->add(['header' => 'Admin']);
            $event->menu->add(
                [
                    'text'    => 'Courses',
                    'icon'    => 'fas fa-fw fa-share',
                    'submenu' => [
                        [
                            'text' => 'Add New Course',
                            'url'  =>  route('add.course'),
                        ],
                        
                        [
                            'text' => 'All Courses',
                            'url'  => route('list.course'),
                        ],
                    ],
                ],
                [
                    'text'    => 'Halls',
                    'icon'    => 'fas fa-fw fa-share',
                    'submenu' => [
                        [
                            'text' => 'Add New Hall',
                            'url'  => route('add.hall'),
                        ],
                        
                        [
                            'text' => 'All Halls',
                            'url'  => route('list.hall'),
                        ],
                    
                    ],
                ],
                [
                    'text'    => 'Instructors',
                    'icon'    => 'fas fa-fw fa-share',
                    'submenu' => [
                        [
                            'text' => 'Add New Instructor',
                            'url'  => route('add.instructor'),
                        ],
                        
                        [
                            'text' => 'All Instructors',
                            'url'  => route('list.instructor'),
                        ],
                    
                    ],
                ],
                [
                    'text'    => 'Students',
                    'icon'    => 'fas fa-fw fa-share',
                    'submenu' => [
                        [
                            'text' => 'Add New Student',
                            'url'  => route('add.student'),
                        ],
                        [
                            'text' => 'All Students',
                            'url' => route('list.student'),
                        ],
                    
                    ],
                ]
             );
          }
          if(\Auth::user()->role == 1) {
            $event->menu->add(['header' => 'Courses']);
            $event->menu->add(
                [
                'text'    => 'Register Your Courses',
                'icon'    => 'fas fa-fw fa-share',
                'url' => route('regitser.courses'),
                ],
                [
                'text'    => 'View Registerd Courses',
                'icon'    => 'fas fa-fw fa-share',
                'url' => route('get.show.course'),
                ]
            );
          }
          if(\Auth::user()->role == 2) {
            $event->menu->add(['header' => 'Courses']);
            $event->menu->add(
                [
                'text'    => 'View Your Courses',
                'icon'    => 'fas fa-fw fa-share',
                'url' => route('list.course.instructor', \Auth::user()->user_name),
                ]
            );
          }
        }
      });
    }
}
