<?php

namespace Sigui\UI\Components;

use Illuminate\Support\Collection;
use Sigui\UI\Component;

class Flashes extends Component
{
    /**
     * @var Collection<int|string,string>
     */
    public Collection $messages;

    /**
     * @param  array<int|string,string>  $messages
     */
    public function __construct(
        array $messages = [],
        public string $tag = 'ul',
        public string $flashTag = 'li',
        public ?string $icon = null,
    ) {
        $messages = collect($messages)
            ->map(function ($message, $type) {
                /** @var string */
                $message = is_int($type) ? session($message, '') : session($type, $message);

                return $message;
            })
            ->filter(fn ($message) => ! empty($message));
        $this->messages = $messages;
    }
}
