<!doctype html>
<html lang="en">
@include('livewire.admin.partials.head')

<body class="vertical light ltr">
    <x-banner />

    <div class="wrapper">

        @include('livewire.admin.partials.header')

        @include('livewire.admin.partials.sidebar')


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->

        <main role="main" class="main-content">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </main>

    </div>

    @include('livewire.admin.partials.scripts')

    @stack('scripts')

    @livewireScripts
</body>

</html>
