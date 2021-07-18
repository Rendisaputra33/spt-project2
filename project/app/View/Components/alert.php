<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alert extends Component
{
    public $type, $message, $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'success', $message = '', $icon = 'fas fa-times-circle')
    {
        $this->type = $type;
        $this->message = $message;
        $this->icon = $icon;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
