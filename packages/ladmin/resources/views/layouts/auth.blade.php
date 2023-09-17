<x-layouts-ladmin>
    <x-slot name="header">
        <section class="relative w-full px-8 text-gray-700 bg-white body-font border"
            data-tails-scripts="//unpkg.com/alpinejs" {!! $attributes ?? '' !!}>
            <div
                class="container flex flex-col flex-wrap items-center justify-between py-3 mx-auto md:flex-row max-w-7xl">
                <a href="#_"
                    class="relative z-10 flex items-center w-auto text-2xl font-extrabold leading-none text-black select-none">{{ config('app.name') }}</a>

                <nav
                    class="top-0 left-0 z-0 flex items-center justify-center w-full h-full py-5 -ml-0 space-x-5 text-base md:-ml-5 md:py-0 md:absolute">
                    @foreach ($headerNavigation as $item)
                        <a href="{{ $item->getRoute() }}"
                            class="relative font-medium leading-6 text-gray-600 transition duration-150 ease-out hover:text-gray-900"
                            x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
                            <span class="block">{{ $item->getLabel() }}</span>
                            <span class="absolute bottom-0 left-0 inline-block w-full h-0.5 -mb-1 overflow-hidden">
                                <span x-show="hover"
                                    class="absolute inset-0 inline-block w-full h-1 h-full transform bg-gray-900"
                                    x-transition:enter="transition ease duration-200" x-transition:enter-start="scale-0"
                                    x-transition:enter-end="scale-100"
                                    x-transition:leave="transition ease-out duration-300"
                                    x-transition:leave-start="scale-100" x-transition:leave-end="scale-0"></span>
                            </span>
                        </a>
                    @endforeach
                </nav>

                <div x-data="{
                    dropdownOpen: false
                }" class="relative">

                    <button @click="dropdownOpen=true"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">Open</button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen=false"
                        x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2"
                        x-transition:enter-end="translate-y-0"
                        class="absolute top-0 z-50 w-56 mt-12 -translate-x-1/2 left-1/2" x-cloak>
                        <div
                            class="p-1 mt-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                            <a href="#_" @click="menuBarOpen=false"
                                class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                <span>New Tab</span>
                                <span
                                    class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘T</span>
                            </a>
                            <a href="#_" @click="menuBarOpen=false"
                                class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                <span>New Window</span>
                                <span
                                    class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘N</span>
                            </a>
                            <div @click="menuBarOpen=false"
                                class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none"
                                data-disabled>
                                <span>New Private Window</span>
                                <span
                                    class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⇧⌘N</span>
                            </div>
                            <div class="relative w-full group">
                                <div
                                    class="flex cursor-default select-none items-center rounded px-2 hover:bg-neutral-100 py-1.5 outline-none">
                                    <span>More Tools</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 ml-auto">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                                <div data-submenu
                                    class="absolute top-0 right-0 invisible mr-1 duration-200 ease-out translate-x-full opacity-0 group-hover:mr-0 group-hover:visible group-hover:opacity-100">
                                    <div
                                        class="z-50 min-w-[8rem] overflow-hidden rounded-md border bg-white p-1 shadow-md animate-in slide-in-from-left-1 w-48">
                                        <div @click="contextMenuOpen=false"
                                            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            Save Page As...<span
                                                class="ml-auto text-xs tracking-widest text-muted-foreground">⇧⌘S</span>
                                        </div>
                                        <div @click="contextMenuOpen=false"
                                            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            Create Shortcut...</div>
                                        <div @click="contextMenuOpen=false"
                                            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            Name Window...</div>
                                        <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                                        <div @click="contextMenuOpen=false"
                                            class="relative flex cursor-default select-none items-center rounded px-2 py-1.5 hover:bg-neutral-100 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            Developer Tools</div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                            <div x-data="{ showBookmarks: true }" @click="showBookmarks=!showBookmarks; contextMenuOpen=false"
                                class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                                <span x-show="showBookmarks"
                                    class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg></span>
                                <span>Show Bookmarks Bar</span>
                                <span
                                    class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘⇧B</span>
                            </div>
                            <div x-data="{ showFullUrl: false }" @click="showFullUrl=!showFullUrl; contextMenuOpen=false"
                                class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                                <span x-show="showFullUrl"
                                    class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg></span>
                                <span>Show Full URLs</span>
                            </div>
                            <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                            <div x-data="{ contextMenuPeople: 'adam' }" class="relative">
                                <div @click="contextMenuPeople='adam'; contextMenuOpen=false"
                                    class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                                    <span x-show="contextMenuPeople=='adam'"
                                        class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-2 h-2 fill-current">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg></span>
                                    <span>Adam Wathan</span>
                                </div>
                                <div @click="contextMenuPeople='caleb'; contextMenuOpen=false"
                                    class="relative flex cursor-default select-none items-center rounded py-1.5 pl-8 pr-2 hover:bg-neutral-100 outline-none data-[disabled]:opacity-50">
                                    <span x-show="contextMenuPeople=='caleb'"
                                        class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="w-2 h-2 fill-current">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg></span>
                                    <span>Caleb Porzio</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="w-full px-8 py-3 border mb-4">
            <h2>// item label //</h2>
        </div>
    </x-slot>
    <x-slot name="content">
        @isset($content)
            {{ $content }}
        @endisset
    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-layouts-ladmin>
