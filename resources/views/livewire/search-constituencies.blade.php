<div>
    <div class="flex justify-between">
        <input wire:model.live="search" placeholder="Search by name..." class="w-[600px] rounded-lg border-neutral-300 shadow-sm px-4">

        <div class="flex gap-x-4">
            <a href="{{ route('exports.constituency-with-highest-overlaps') }}" target="_blank" class="rounded-lg bg-white px-4 py-1.5 font-semibold text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 inline-flex items-center">
                Export with LA & PCON23
            </a>

            <a href="{{ route('exports.constituency-with-all-overlaps') }}" target="_blank" class="rounded-lg bg-white px-4 py-1.5 font-semibold text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50 inline-flex items-center">
                Export all
            </a>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-6 mt-8">
        @foreach ($constituencies as $constituency)
            <a wire:navigate href="/constituency/{{$constituency->gss_code}}" class="no-underline bg-white px-6 rounded-lg py-4 text-xl font-semibold border border-neutral-300 hover:bg-neutral-50/50 text-pretty">
                {{ $constituency->name }}
            </a>
        @endforeach
    </div>
</div>
