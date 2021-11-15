@extends('layouts.layout')
@section('page_title', 'Result List')
@section('content')

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Result List</h1>
                <div class="w-full mt-6">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('results.create') }}">
                            <button class="text-xl pb-3 flex items-center px-4 py-2 my-2 text-white bg-blue-600">
                            <i class="fas fa-list mr-3"></i> Result Form
                        </button>
                        </a>
                        <select id="class" class="col-end-7 text-xl pb-3 flex items-center px-4 py-2 my-2 text-white bg-blue-600">
                            <option value="">All Class</option>
                            @foreach ($classes as $class)
                                <option value="{{$class->name}}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                        
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white" id="myTable">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student ID</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student's Class</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student Name</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Total Marks</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Result</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700" id="result">
                                @forelse ($results as $result)
                                    <tr id="myTR">
                                        <td class="w-1/3 text-left py-3 px-4">{{ $result->student_id }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $result->students->classnames->name }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $result->students->name }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $result->sum }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">
                                            @if ($result->sum > 99)
                                                <div class="text-green-600">Passed</div>
                                            @else
                                                <div class="text-red-600">Failed</div>
                                                
                                            @endif
                                        </td>
                                        <td class="w-1/3 text-left py-3 px-4">
                                            <a href="{{ route('students.show',$result->student_id) }}">
                                                <button class="text-sm pb-3 flex items-center px-4 py-2 my-2 text-white bg-blue-600">Details</button>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="w-1/3 text-center py-3 px-4" colspan="6">("No list found")</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
        <script>
            $(document).ready(function(){
                $("#class").on("change", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable #myTR").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                });
            });
        </script>
        
@endsection
