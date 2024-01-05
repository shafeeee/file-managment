<!-- resources/views/user/upload_file.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Upload File</h3>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('user.uploadFile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="file" class="form-label">Select File</label>
                            <input type="file" name="file" class="form-control" required>
                            @error('file')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="alert alert-info">
                            <p>Supported format:png,jpeg,pdf and MaxSize: 2 MB</p>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Upload File</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
