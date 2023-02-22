<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalSimple extends Component
{
    public $modal, $form, $method, $title, $close, $button;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modal, $form, $method, $title, $close, $button)
    {
        $this->form=$form;
        $this->modal=$modal;
        $this->title=$title;
        $this->close=$close;
        $this->method=$method;
        $this->button=$button;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal-simple');
    }
}
