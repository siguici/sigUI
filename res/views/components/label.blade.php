<label @isset($for)for="{{ $for }}"@endisset>
    @if ($text)
    <x-ui::text :value="$text"/>
    @else
    {{ $slot }}
    @endif
</label>
