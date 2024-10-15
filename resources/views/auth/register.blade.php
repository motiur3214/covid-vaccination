<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                          autofocus autocomplete="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- NID -->
        <div class="mt-4">
            <x-input-label for="nid" :value="__('Nid')"/>
            <x-text-input id="nid" class="block mt-1 w-full border-gray-300 focus:border-indigo-500
            focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nid" :value="old('nid')" required/>
            <x-input-error :messages="$errors->get('nid')" class="mt-2"/>
        </div>

        <!-- Vaccination Center Dropdown -->
        <div class="mt-4">
            <x-input-label for="vaccination_center" :value="__('Vaccination Center')"/>
            <!-- Search input for vaccination centers -->
            <input type="text" id="vaccinationCenterSearch" placeholder="Search for a center..."
                   class="block mt-1 w-full border-gray-300 focus:border-indigo-500
                   focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="off" style="display: none;">
            <!-- Dropdown for vaccination centers -->
            <select id="vaccination_center" name="vaccination_center_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500
                    focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">{{ __('Select a vaccination center') }}</option>
            </select>
            <x-input-error :messages="$errors->get('vaccination_center_id')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        let currentPage = 1;
        const perPage = 10;


        function loadVaccinationCenters(query = '', page = 1) {
            const dropdown = document.getElementById('vaccination_center');
            dropdown.innerHTML = ''; // Clear the dropdown

            // Add the static "Select a vaccination center" option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select a vaccination center';
            dropdown.appendChild(defaultOption);

            fetch(`/vaccination-centers?query=${encodeURIComponent(query)}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(center => {
                        const option = document.createElement('option');
                        option.value = center.id;
                        option.textContent = center.name;
                        dropdown.appendChild(option);
                    });

                    if (data.current_page < data.last_page) {
                        const loadMoreOption = document.createElement('option');
                        loadMoreOption.value = 'load_more';
                        loadMoreOption.textContent = 'Load More...';
                        dropdown.appendChild(loadMoreOption);
                    }
                })
                .catch(error => {
                    console.error('Error fetching vaccination centers:', error);
                    dropdown.innerHTML = '<option value="">Error fetching data</option>';
                });
        }


        document.getElementById('vaccinationCenterSearch').addEventListener('input', function() {
            const query = this.value;
            currentPage = 1;
            loadVaccinationCenters(query, currentPage);
        });

        document.getElementById('vaccination_center').addEventListener('change', function() {
            if (this.value === 'load_more') {
                currentPage++;
                const query = document.getElementById('vaccinationCenterSearch').value; // Get current search query
                loadVaccinationCenters(query, currentPage); // Load more results
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            loadVaccinationCenters();
        });;
    </script>
</x-guest-layout>
