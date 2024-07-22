<div>
    <input wire:model.live="search">

    <div>
        <ul>
        @foreach ($constituencies as $constituency)
            <a class="no-underline" wire:navigate href="/constituency/{{$constituency->gss_code}}">
                <li>{{ $constituency->name }}</li>
            </a>
        @endforeach
        </ul>
    </div>
</div>
