<?php

namespace App\View\Components;

use Illuminate\View\Component;

class profile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $username;
    public $useremail;
    public $userimage;

    public function __construct($username,$useremail,$userimage)
    {
        $this->$userimage =$userimage;
        $this->$username = $username;
        $this->$useremail = $useremail;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.profile');
    }
}
