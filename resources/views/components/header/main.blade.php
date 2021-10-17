<nav id="inicio" x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto py-2 px-8">
        <div class="flex h-8">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{asset('img/1.jpg')}}" width="70px">
                    <div class="w-96 mt-2 italic text-lg font-bold text-red-500">Granja Doble T</div>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-full ">
                    {{--<x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard')
                    </x-jet-nav-link>--}}
                </div>
            </div>
           <!-- login -->
            <div class="flex flex-row-reverse items-center w-full ">
                <div class="flex items-center transition-all duration-500 md:border-b-4 hover:border-transparent transform hover:-translate-y-1 cursor-pointer">
                    @if (Auth::check())
                        <a class=" flex mt-2 ml-2" href="{{ route('login') }}" class="text-sm text-gray-700">
                            <i class="far fa-user mr-2 mt-1"></i>
                            <span class="hidden md:flex">
                                {{auth()->user()->name}}
                            </span>
                        </a>
                    @else
                        <a class="flex items-center text-xs" href="{{ route('login') }}">
                            <i class="far fa-user mr-2"></i>
                            <span class="hidden md:flex">
                                Iniciar sesión
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
