<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
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
   * @return \Illuminate\Contracts\View\View
   */
  public function render(): View {
    return view('components.card-admin');
  }
}
