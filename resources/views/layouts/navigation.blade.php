<div x-cloak x-data="{open : false, mobileOpen: false}">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex justify-between h-16">

                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        @Auth
                            <!-- Mobile menu button -->
                            <button type="button" @click="mobileOpen = !mobileOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <!--
                                  Icon when menu is closed.
                                -->
                                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <!--
                                  Icon when menu is open.
                                -->
                                <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endAuth
                    </div>

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-12 w-auto" src="{{asset('/images/EPS new logo 300x150.png')}}" alt="EPS">
                        <img class="hidden lg:block h-12 w-auto" src="{{asset('/images/EPS new logo 300x150.png')}}" alt="EPS">
                    </div>
                    @Auth
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <!-- Current: "border-indigo-500 text-gray-900", Default: "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700" -->
                            <a href="{{route('dashboard')}}" class="{{request()->route()->named('dashboard*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{route('prelims')}}" class="{{request()->route()->named('prelims*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Prelims
                            </a>
                            <a href="{{route('setup')}}" class="{{request()->route()->named('setup*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Set Ups
                            </a>
                            <a href="{{route('methods')}}" class="{{request()->route()->named('methods*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Methods
                            </a>
                            <a href="{{route('ppe')}}" class="{{request()->route()->named('ppe*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                PPE
                            </a>
                            <a href="{{route('controls')}}" class="{{request()->route()->named('controls*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Controls
                            </a>
                            </a>
                            <a href="{{route('risks')}}" class="{{request()->route()->named('risks*')?'border-indigo-500 text-gray-900':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Risks
                            </a>
                            @if(request()->route()->named('data-setup.*') || request()->route()->named('control-types.*'))
                                <a href="{{route('data-setup.index')}}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Data Setup
                                </a>
                            @else
                                <a href="{{route('data-setup.index')}}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Data Setup
                                </a>
                            @endif
                        </div>
                    @endAuth
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button @click="open = !open" @click.away="open = false" type="button" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                @auth
                                    {{Auth::user()->name}}
                                @endAuth
                            </button>
                        </div>
                        <div x-show="open" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            @auth
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" id="user-menu-item-0">{{Auth::user()->name}}</a>
                                <form id="logout-form1" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 font-bold py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" id="user-menu-item-1">
                                        Sign Out
                                    </button>
                                </form>
                            @endAuth
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @Auth
            <div x-show="mobileOpen" class="md:hidden" id="mobile-menu">
                <div class="pt-2 pb-4 space-y-1">
                    <a href="{{route('dashboard')}}#" class="{{request()->route()->named('dashboard*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Dashboard</a>
                    <a href="{{route('prelims')}}#" class="{{request()->route()->named('prelims*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Prelims</a>
                    <a href="{{route('setup')}}#" class="{{request()->route()->named('setup*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Set Ups</a>
                    <a href="{{route('methods')}}#" class="{{request()->route()->named('methods*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Methods</a>
                    <a href="{{route('ppe')}}#" class="{{request()->route()->named('ppe*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">PPE</a>
                    <a href="{{route('controls')}}#" class="{{request()->route()->named('risks*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Controls</a>
                    <a href="{{route('risks')}}#" class="{{request()->route()->named('risks*')?'text-indigo-400 bg-gray-50':'text-gray-500'}} border-transparent  hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">Risks</a>
                    <a href="#" class="border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" onclick="event.preventDefault(); document.getElementById('logout-form1').submit();">Sign Out</a>
                </div>
            </div>
        @endAuth
    </nav>
</div>
