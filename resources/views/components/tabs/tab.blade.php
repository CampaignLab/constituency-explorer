<button type="button" {{ $attributes->class(['constituency-tab', 'constituency-tab-active' => $active]) }} x-bind:class="{
    'constituency-tab-active': tab === @js($i),
    'constituency-tab-inactive': tab !== @js($i)
}" x-on:click="tab = @js($i)">
    {{ $slot }}
</button>
