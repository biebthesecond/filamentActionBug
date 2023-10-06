<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;

class IndexAwareTextInput extends TextInput
{
    protected $index;

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }
}
