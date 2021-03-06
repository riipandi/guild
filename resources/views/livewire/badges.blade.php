<div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">Your Guild Badges!</h3>

                    <p class="mt-1 text-sm text-gray-600">
                        Win badges for your accomplishments.
                    </p>
                </div>
                <div class="px-4 pt-10 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">Your Badges</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        @forelse(auth()->user()->badges()->get() as $badge)
                            <span class="inline-flex px-2 text-xs font-semibold leading-5 text-{{ $badge->color }}-800 bg-{{ $badge->color }}-100 rounded-full">
                                {{ $badge->name }}
                            </span>
                        @empty
                            You don't have any badges
                        @endforelse
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                @if(auth()->user()->hasTeamRole(auth()->user()->currentTeam, 'manager'))
                    @if($updateMode)
                        @include('livewire.editBadge')
                    @else
                        @include('livewire.addBadge')
                    @endif
                @endif
            </div>
        </div>
        <div class="flex flex-col mt-10">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Value
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Color
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($badges as $badge)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $badge->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $badge->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $badge->requirement_class }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $badge->requirement_value }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 text-xs font-semibold leading-5 text-{{ $badge->color }}-800 bg-{{ $badge->color }}-100 rounded-full">
                                                Color
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            @if(auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'update'))
                                                <button wire:click="edit({{ $badge->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                            @endif
                                            @if(auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'delete'))
                                                <button wire:click="delete({{ $badge->id }})" class="text-indigo-600 hover:text-indigo-900">Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>