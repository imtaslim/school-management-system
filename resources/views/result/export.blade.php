<link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
    .font-family-karla { font-family: karla; }
    .bg-sidebar { background: #ff0000; }
    .cta-btn { color: #ff0000; }
    .upgrade-btn { background: #fd3300; }
    .upgrade-btn:hover { background: #dd0101; }
    .active-nav-link { background: #ee1919; }
    .nav-item:hover { background: #ee1919; }
    .account-link:hover { background: #ff0000; }
</style>

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
            </p>
        </div>
    </main>
</div>


