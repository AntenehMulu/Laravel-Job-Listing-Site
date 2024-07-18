<x-layout>
    @guest
    @include('partials.hero')
    @endguest
    @include('partials.search')
    @unless (count($listings)==0)
    <div
    class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 pb-48"
    >
    @foreach ($listings as $listing)
    <x-list :listing="$listing" />
    @endforeach
    @else
    <p>Nothing post found</p>
    @endunless
    <div class="mt-6 p-4">
        {{ $listings->links()}}
    </div>
    </div>

</x-layout>


