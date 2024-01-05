<!-- resources/views/user/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Welcome, {{ $user->name }}!</h3>
                    <a href="{{ route('user.showUploadForm') }}" class="btn btn-success">Upload File</a>
                    @if(count($files) > 0)
                        <h4 class="text-md font-semibold mb-2"></h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <td>{{ $file->file_name }}</td>
                                        <td>
                                            <a href="{{ url('storage/' . $file->file_path) }}" class="btn btn-primary btn-sm" target="_blank">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No files uploaded yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
