@extends('admin.layouts.admin')

@section('title', 'Pengaturan')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Situs</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $pengaturan->site_name ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                    <input type="file" name="logo"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    @if(isset($pengaturan) && $pengaturan->logo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$pengaturan->logo) }}" class="h-20 w-20 object-cover rounded">
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Favicon</label>
                    <input type="file" name="favicon"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    @if(isset($pengaturan) && $pengaturan->favicon)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$pengaturan->favicon) }}" class="h-20 w-20 object-cover rounded">
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Footer</label>
                    <textarea name="footer" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ old('footer', $pengaturan->footer ?? '') }}</textarea>
                </div>

                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Copyright</label>
                    <input type="text" name="copyright" value="{{ old('copyright', $pengaturan->copyright ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
