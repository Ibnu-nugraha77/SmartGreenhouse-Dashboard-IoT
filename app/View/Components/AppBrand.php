<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppBrand extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return <<<'HTML'
                <a href="/" wire:navigate>
                    <!-- Hidden when collapsed -->
                    <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
                        <div class="flex items-center gap-2 w-fit">
                            <x-icon name="o-home-modern" class="w-15 -mb-1.5 text-blue-500" />
                            <span class="font-bold text-2xl me-3 bg-gradient-to-r from-blue-500 to-green-300 bg-clip-text text-transparent ">
                                SMART GREENHOUSE
                            </span>
                        </div>
                    </div>

                    <!-- Display when collapsed -->
                    <div class="display-when-collapsed hidden mx-5 mt-5 mb-1 h-[28px]">
                        <x-icon name="o-home-modern" class="w-10 -mb-1.5 text-blue-500" />
                    </div>
                </a>
            HTML;
    }
}
