<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Department Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your hospital and deparment information") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('staff.profile.select_hospital') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="hospital" :value="__('Hospital')" />
            <select required name="hospital" id="hospital" class="mt-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="">Select an option</option>
            @foreach ($hospitals as $hospital)
                <option {{ isset($selected_hospital) && $selected_hospital->id == $hospital->id ? "selected" : null }} value={{$hospital->id}}>{{$hospital->name}}</option>
            @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('hospital')" />
        </div>
    </form>

    @if (isset($selected_hospital))
    <form method="POST" action="{{ route('staff.profile.update_department')}}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        
            <x-input-label for="department" :value="__('Department')" />
                <select required name="department" id="department" class="mt-3 bg-gray-700 border border-gray-600 placeholder-gray-400 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Select an option</option>
                    @foreach ($selected_hospital->departments as $deparment)
                        <option {{isset($selected_department) && $selected_department->id == $deparment->id ? "selected" : null}} value={{$deparment->id}}>{{$deparment->name}}</option>
                    @endforeach
                </select>
            <x-input-error class="mt-2" :messages="$errors->get('department')" />
        

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
    @endif
</section>


<script>
    let quantities = document.querySelectorAll('#hospital');
    quantities.forEach(input => {
        input.onchange = () => input.parentElement.parentElement.submit();
    });
</script>
