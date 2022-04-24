<?php

namespace App\View\Components\forms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /** @var string */
    public $name;

    /** @var string */
    public $label;

    /** @var string */
    private $selected;

    public function __construct(string $name,
                                string $selected = null,
                                string $label = null)
    {
        $this->name = $name;

        $this->label = $label;

        $this->selected = old($name, $selected);

    }

    public function isSelected(string $optionName): bool
    {
        return $optionName === $this->selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
