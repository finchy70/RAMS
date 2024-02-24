<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome to EPS-RAMS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class=" shadow-sm sm:rounded-lg">
                <div class="overflow-hidden rounded-lg p-6 bg-gray-100 border border-gray-300">
                    @guest
                        <div class="w-1/2 mx-auto my-4 text-center">
                            <h2 class="text-2xl mb-4" data-testId="welcomeheading">Welcome to EPS-RAMS</h2>
                            <a href="{{ route('login') }}" data-testId="loginbutton" class="w-max mt-4 bg-indigo-500 px-4 py-2 text-gray-100 font-bold rounded-lg shadow">Login</a>
                        </div>
                    @else
                        <div class="bg-white shadow overflow-hidden sm:rounded-md">
                            <ul class="divide-y divide-gray-200">
                                <li>
                                    <a href="#" class="block hover:bg-gray-50" data-testId="ramsmenu">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage RAMS</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create a set of RAMS.
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{route('setup.index')}}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage Setups</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create or Edit a Setup.
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{route('prelims.index')}}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage Preliminaries</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create of Edit a Preliminary.
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('methods.index') }}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage Method Statements</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create or Edit a Method Statement.
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('risks.index') }}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage Risk Assessments</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create or Edit a Risk Assessment.
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{route('ppe.index')}}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage PPE</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create or Edit an item of PPE.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{route('clients.index')}}" class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-6 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-lg font-medium text-gray-600 truncate">Manage Clients</p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                Create or Edit a Client.
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <!-- Heroicon name: solid/chevron-right -->
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>


                            </ul>
                        </div>

                        <div class="bg-white shadow sm:rounded-md">
                            <ul class="divide-y-4 divide-indigo-100">
                                <li>
                                    <a href="{{ route('rams.create') }}" class="block hover:bg-gray-50">
                                        <div class="border border-indigo-800 px-4 py-6 sm:px-6">
                                            <div class="text-center items-center justify-between">
                                                <p class="text-2xl text-indigo-800 font-bold truncate">
                                                    Create a set of RAMS
                                                </p>
                                                <p class="text-sm text-indigo-500 font-bold italic">Create a set of RAMS from existing generic method statements and risk assessments.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{route('methods.create')}}" class="block hover:bg-gray-50">
                                        <div class="border border-indigo-800 px-4 py-6 sm:px-6">
                                            <div class="text-center items-center justify-between">
                                                <p class="text-2xl text-indigo-800 font-bold truncate">
                                                    Manage Method Statements
                                                </p>
                                                <p class="text-sm text-indigo-500 font-bold italic">Create a new Method Statement, edit an existing one, or associate risks to a method statement.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="block hover:bg-gray-50">
                                        <div class="border border-indigo-800 px-4 py-6 sm:px-6">
                                            <div class="text-center items-center justify-between">
                                                <p class="text-2xl text-indigo-800 font-bold truncate">
                                                    Manage Risk Assessments
                                                </p>
                                                <p class="text-sm text-indigo-500 font-bold italic">Create new Risk Assessments to be associated with a Method Statement.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="block hover:bg-gray-50">
                                        <div class="border border-indigo-800 px-4 py-6 sm:px-6">
                                            <div class="text-center items-center justify-between">
                                                <p class="text-2xl text-indigo-800 font-bold truncate">
                                                    Manage Clients
                                                </p>
                                                <p class="text-sm text-indigo-500 font-bold italic">Add a new client, or edit an existing one.</p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
