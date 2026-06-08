@extends ('layouts.sidebar')

@section('content')
<main class="relative min-h-screen transition-all duration-200 ease-in-out lg:ml-72">
    <div class="px-8 py-8">

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Tambah Lapangan
                </h1>
            </div>
            <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('dashboard.lapangan.form')
            </form>
        </div>
    </div>
</main>

@endsection