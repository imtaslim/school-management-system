@extends('layouts.layout')
@section('page_title', 'Student List')
@section('content')

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Student List</h1>
                <div class="w-full mt-6">
                    <a href="{{ route('students.create') }}">
                        <button class="text-xl pb-3 flex items-center px-4 py-2 my-2 text-white bg-blue-600">
                            <i class="fas fa-list mr-3"></i> Student Form
                        </button>
                    </a>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student ID</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student's Class</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student Name</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student Email</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($students as $student)
                                    <tr>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $student->id }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $student->classnames->name }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $student->name }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $student->email }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">Edit | Delete</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="w-1/3 text-center py-3 px-4" colspan="5">("No subject found")</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>

@endsection
