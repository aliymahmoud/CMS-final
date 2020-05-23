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
            $event->menu->add([
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
                            'text' => 'level_one',
                            'url'  => '#',
                        ],
                        
                        [
                            'text' => 'level_one',
                            'url'  => '#',
                        ],
                    
                    ],
                ],
                [
                    'text'    => 'Instructors',
                    'icon'    => 'fas fa-fw fa-share',
                    'submenu' => [
                        [
                            'text' => 'level_one',
                            'url'  => '#',
                        ],
                        
                        [
                            'text' => 'level_one',
                            'url'  => '#',
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
          else {
            $event->menu->add(['header' => 'Courses']);
          }
        }
      });
    }
}
