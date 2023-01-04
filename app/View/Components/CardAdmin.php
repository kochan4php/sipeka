<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardAdmin extends Component {
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct(
    public string $bgcolor = '',
    public string $justifyContent = '',
    public string $data = ''
  ) {
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    return view('components.card-admin');
  }
}
