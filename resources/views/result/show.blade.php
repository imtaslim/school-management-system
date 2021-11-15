@extends('layouts.layout')
@section('page_title', 'Single Student Details')
@section('content')

<div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
        <h1 class="text-3xl text-black pb-6">Single Student Details</h1>
        <div class="w-full mt-6">
            <p class="text-xl pb-3 flex items-center px-4 my-2 text-black">Name: {{ $students->name }}</p>
            <p class="text-xl pb-3 flex items-center px-4 my-2 text-black">Email: {{ $students->email }}</p>
            <div class="bg-white overflow-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Subject</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Mark</th>
                        </tr>
                    </thead>
                    @php
                        $total = 0;
                    @endphp
                    <tbody class="text-gray-700">
                        @forelse ($results as $result)
                            <tr>
                                <td class="w-1/3 text-left py-3 px-4">{{ $result->subjects->subjects }}</td>
                                <td class="w-1/3 text-left py-3 px-4">
                                    @if ($result->marks > 33)
                                        <div>{{ $result->marks }}</div>
                                    @else
                                        <div class="text-red-600">{{ $result->marks }}</div>
                                        
                                    @endif
                                </td>
                            </tr>
                            @php
                                $total += $result->marks;
                            @endphp
                        @empty
                            <tr>
                                <td class="w-1/3 text-center py-3 px-4" colspan="3">("No list found")</td>
                            </tr>
                        @endforelse
                            <tr class="bg-blue-200">
                                <td class="w-1/3 text-right py-3 px-4">Total =</td>
                                <td class="w-1/3 text-left py-3 px-4">
                                    @if ($total > 99)
                                        <div>{{ $total }}</div>
                                    @else
                                        <div class="text-red-600">{{ $total }}</div>
                                        
                                    @endif
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
            <p class="pb-3 flex items-center px-4 my-2 text-black">
                @if ($total > 99)
                    <div class="text-green-600 text-2xl">Congratulations, You Are Passed</div>
                @else
                    <div class="text-red-600 text-2xl">Sorry, You Are Failed</div>
                    
                @endif
                <a href="<?php echo env('APP_URL'); ?>/pdfview/{{ $students->id }}">
                    <button class="text-xl pb-3 flex items-center px-4 py-2 my-2 text-white bg-blue-600">
                    <i class="fas fa-list mr-3"></i> Download Result
                </button>
                </a>
            </p>
        </div>
    </main>
</div>

@endsection
