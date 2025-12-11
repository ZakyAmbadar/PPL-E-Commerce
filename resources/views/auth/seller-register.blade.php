<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Registrasi Data Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Formulir Registrasi Data Penjual
                </h2>
            </div>
            
            @php
                $provinceCitiesConfig = config('locations.province_cities', []);
                $cityVillagesConfig = config('locations.city_villages', []);
            @endphp
            <form class="mt-8 space-y-6" action="{{ route('seller.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 p-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-4 text-red-700 bg-red-50 p-2 rounded">
                        <strong>Terdapat beberapa kesalahan pada form:</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Toko -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Toko</h3>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="store_name" class="block text-sm font-medium text-gray-700">Nama Toko *</label>
                           <input type="text" id="store_name" name="store_name" required 
                               value="{{ old('store_name') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('store_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="store_description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat *</label>
                        <textarea id="store_description" name="store_description" rows="3" required
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('store_description') }}</textarea>
                        @error('store_description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informasi PIC -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Data PIC</h3>
                    </div>

                    <div>
                        <label for="pic_name" class="block text-sm font-medium text-gray-700">Nama PIC *</label>
                           <input type="text" id="pic_name" name="pic_name" required
                               value="{{ old('pic_name') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('pic_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div>
                        <label for="pic_phone" class="block text-sm font-medium text-gray-700">NO HP PIC *</label>
                           <input type="tel" id="pic_phone" name="pic_phone" required
                               value="{{ old('pic_phone') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('pic_phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email PIC *</label>
                           <input type="email" id="email" name="email" required
                               value="{{ old('email') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Alamat PIC</h3>
                    </div>

                    <div class="md:col-span-2">
                        <label for="street_address" class="block text-sm font-medium text-gray-700">Jalan *</label>
                           <input type="text" id="street_address" name="street_address" required
                               value="{{ old('street_address') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('street_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div>
                        <label for="rt_rw" class="block text-sm font-medium text-gray-700">RT/RW *</label>
                        <input type="text" id="rt_rw" name="rt_rw" placeholder="001/002" required
                               value="{{ old('rt_rw') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('rt_rw')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                     <div>
                        <label for="village" class="block text-sm font-medium text-gray-700">Kelurahan *</label>
                        <input type="text" id="village_text" name="village" required
                            placeholder="Isi Kelurahan (contoh: Kebon Jeruk)"
                            value="{{ old('village') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('village')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Kota *</label>
                        <select id="city" name="city" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Kota</option>
                            <!-- Kota akan dipopulasi oleh JS berdasarkan provinsi yang dipilih -->
                        </select>
                        @error('city')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Provinsi *</label>
                        <select id="province" name="province" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Provinsi</option>
                            @foreach(array_keys($provinceCitiesConfig) as $provOption)
                                <option value="{{ $provOption }}" @selected(old('province') === $provOption)>{{ $provOption }}</option>
                            @endforeach
                        </select>
                        @error('province')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dokumen -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen Identitas PIC</h3>
                    </div>

                    <div>
                        <label for="id_card_number" class="block text-sm font-medium text-gray-700">NO. KTP PIC *</label>
                           <input type="text" id="id_card_number" name="id_card_number" required
                               value="{{ old('id_card_number') }}"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('id_card_number')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div>
                        <label for="id_card_file" class="block text-sm font-medium text-gray-700">File KTP *</label>
                           <input type="file" id="id_card_file" name="id_card_file" accept=".jpg,.jpeg,.png,.pdf" required
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                           @error('id_card_file')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="pic_photo" class="block text-sm font-medium text-gray-700">Foto PIC *</label>
                           <input type="file" id="pic_photo" name="pic_photo" accept=".jpg,.jpeg,.png" required
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                           @error('pic_photo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <!-- Password / Keamanan Akun -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Keamanan Akun</h3>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password *</label>
                           <input type="password" id="password" name="password" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password *</label>
                           <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                           @error('password_confirmation')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                           @enderror
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Registrasi Penjual
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('seller.login') }}" class="text-blue-600 hover:text-blue-500">
                        Sudah punya akun? Login di sini
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    (function() {
        // Pemetaan Provinsi -> Kota berdasarkan konfigurasi
        const provinceCities = @json($provinceCitiesConfig);

        // Pemetaan city -> kelurahan berdasarkan konfigurasi
        const cityVillages = @json($cityVillagesConfig);

        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');

        function populateCitiesForProvince(province, selectCityValue = null) {
            province = (province || '').trim();
            // Clear current options
            citySelect.innerHTML = '';
            const placeholderCity = document.createElement('option');
            placeholderCity.value = '';
            placeholderCity.textContent = 'Pilih Kota';
            citySelect.appendChild(placeholderCity);
            // Default: nonaktifkan select Kota sampai mapping ditemukan atau ada nilai lama
            citySelect.disabled = true;
            citySelect.style.display = 'none';

            if (!province || !provinceCities[province]) {
                // Jika mapping tidak ditemukan, biarkan placeholder saja; jika ada kota lama, tambahkan nilai tersebut
                if (selectCityValue) {
                    const opt = document.createElement('option');
                    opt.value = selectCityValue;
                    opt.textContent = selectCityValue;
                    opt.selected = true;
                    citySelect.appendChild(opt);
                    // Aktifkan select hanya jika ada nilai kota lama agar dapat diklik
                    citySelect.disabled = false;
                }
                return;
            }

            console.debug('populateCitiesForProvince', province, provinceCities[province] ? provinceCities[province].length : 0);
            provinceCities[province].forEach(city => {
                const opt = document.createElement('option');
                opt.value = city;
                opt.textContent = city;
                if (selectCityValue && selectCityValue === city) {
                    opt.selected = true;
                }
                citySelect.appendChild(opt);
            });
            // Pastikan select Kota aktif saat mapping tersedia
            citySelect.disabled = false;
            citySelect.style.display = '';
            // Jika ada nilai kota yang ingin dipilih (mis. karena old() ), set dan trigger change untuk mengisi kelurahan
            if (selectCityValue) {
                citySelect.value = selectCityValue;
                citySelect.dispatchEvent(new Event('change'));
            }
        }

        // Pasang event pada elemen provinsi.
        // Be resilient: attach to change and input so different browsers/input methods trigger it.
        function onProvinceChange() {
            const p = (provinceSelect.value || '').trim();
            console.debug('onProvinceChange:', p, 'mappingExists:', !!provinceCities[p]);
            populateCitiesForProvince(p);
            // Reset kelurahan jika provinsi (dan kota) berubah
            populateVillagesForCity(null);
        }
        provinceSelect.addEventListener('change', onProvinceChange);
        provinceSelect.addEventListener('input', onProvinceChange);
        provinceSelect.addEventListener('blur', onProvinceChange);

        // Saat halaman dimuat, pulihkan nilai lama jika ada (helper 'old' Laravel)
        const oldProvince = @json(old('province')) || '';
        const oldCity = @json(old('city')) || '';
        const oldVillage = @json(old('village')) || '';
        if (oldProvince) {
            provinceSelect.value = oldProvince;
            populateCitiesForProvince(oldProvince, oldCity);
        }

        // Jika pengguna memilih provinsi saat pemuatan awal (tanpa nilai lama), isi daftar kota
        if (!oldProvince && provinceSelect.value) {
            populateCitiesForProvince(provinceSelect.value);
            if (citySelect.value) {
                populateVillagesForCity(citySelect.value);
            }
        }
        // Ensure we catch any other cases where the user might have selected a province via keyboard or other method
        // (call handler once to initialize if needed)
        if (provinceSelect.value) {
            onProvinceChange();
        }
        // Jika provinsi tidak dipilih, nonaktifkan select Kota sampai provinsi dipilih
        if (!provinceSelect.value) {
            citySelect.disabled = true;
        } else {
            citySelect.disabled = false;
        }

        // ---- Kota -> Kelurahan
        const villageSelect = document.getElementById('village_select');
        const villageText = document.getElementById('village_text');
        const villageManualFlag = document.getElementById('village_manual');

            function populateVillagesForCity(city, selectVillageValue = null) {
            city = (city || '').trim();
            console.debug('populateVillagesForCity', city, 'mappingExists:', !!cityVillages[city]);
            // Reset
            villageSelect.innerHTML = '';
            const villagePlaceholderTop = document.createElement('option');
            villagePlaceholderTop.value = '';
            villagePlaceholderTop.textContent = 'Pilih Kelurahan';
            villageSelect.appendChild(villagePlaceholderTop);

            // Default: show select with only Lainnya option; hide text input by default
            villageSelect.style.display = '';
            villageSelect.disabled = true;
            villageText.style.display = 'none';
            villageText.name = '';
            villageSelect.name = 'village';
            villageManualFlag.value = 0;

            if (!city || !cityVillages[city]) {
                // Tidak ada mapping: reset select to just the default and Lainnya so user can manually fill
                villageSelect.innerHTML = '';
                const villagePlaceholderAbsent = document.createElement('option');
                villagePlaceholderAbsent.value = '';
                villagePlaceholderAbsent.textContent = 'Pilih Kelurahan';
                placeholder.disabled = true;
                placeholder.selected = true;
                villageSelect.appendChild(placeholder);
                const other = document.createElement('option');
                other.value = '__OTHER__';
                other.textContent = 'Lainnya (isi manual)';
                other.setAttribute('data-manual', '1');
                villageSelect.appendChild(other);
                villageSelect.disabled = false;
                villageText.style.display = 'none';
                villageText.name = '';
                villageSelect.name = 'village';
                villageManualFlag.value = 0;
                // restore old village if provided
                if (selectVillageValue) {
                    // if oldVillage present we should pre-select Lainnya and show manual input
                    villageSelect.value = '__OTHER__';
                    villageText.style.display = '';
                    villageText.name = 'village';
                    villageText.value = selectVillageValue;
                    villageManualFlag.value = 1;
                    villageSelect.name = '';
                }
                return;
            }

            // Ada mapping => pakai select
            // Pastikan placeholder
                villageSelect.innerHTML = '';
            const villagePlaceholderPresent = document.createElement('option');
            villagePlaceholderPresent.value = '';
            villagePlaceholderPresent.textContent = 'Pilih Kelurahan';
            villagePlaceholderPresent.disabled = true;
            villageSelect.appendChild(villagePlaceholderPresent);
            cityVillages[city].forEach(v => {
                const opt = document.createElement('option');
                opt.value = v;
                opt.textContent = v;
                if (selectVillageValue && selectVillageValue === v) {
                    opt.selected = true;
                }
                villageSelect.appendChild(opt);
            });

            // Tambahkan opsi Lainnya sebelum menampilkan select
            const other = document.createElement('option');
            other.value = '__OTHER__';
            other.textContent = 'Lainnya (isi manual)';
            other.setAttribute('data-manual', '1');
            villageSelect.appendChild(other);
            // Tampilkan select, sembunyikan text input
            villageSelect.style.display = '';
            villageSelect.disabled = false;
            villageSelect.name = 'village';
            villageText.name = '';
            villageText.style.display = 'none';
            villageText.value = '';
            villageManualFlag.value = 0;
        }

        // Saat kota berubah, update kelurahan
        citySelect.addEventListener('change', function () {
            populateVillagesForCity(this.value);
        });

        // Saat kelurahan select berubah, jika pilih 'Lainnya' tampilkan input text manual
        villageSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            if (!selected) return;
            const manual = selected.getAttribute('data-manual');
            if (manual === '1') {
                villageText.style.display = '';
                villageText.name = 'village';
                villageSelect.name = '';
                villageManualFlag.value = 1;
            } else {
                villageText.style.display = 'none';
                villageText.name = '';
                villageSelect.name = 'village';
                villageManualFlag.value = 0;
            }
        });

        // Pastikan jika ada nilai lama pada village, kita restore ke control yang tepat
        if (oldCity) {
            populateVillagesForCity(oldCity, oldVillage);
        }
    })();
</script>
</html>