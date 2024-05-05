<div id="modalChangeAddress" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h2 class="text-2xl font-bold text-[#F12E52]">Update Location</h2>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modalChangeAddress">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="userLocationForm">
                <div class="p-4 md:p-5 space-y-4">
                    <div class="max-w-2xl px-4 py-8 mx-auto">
                        <div>
                            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                                <div class="w-full">
                                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900">
                                        Province
                                    </label>
                                    <select name="input_province" id="input_province"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        required>
                                        <option value="">Select Province</option>
                                        <option value="Aceh">Aceh</option>
                                        <option value="Bali">Bali</option>
                                        <option value="Bangka Belitung">Bangka Belitung</option>
                                        <option value="Banten">Banten</option>
                                        <option value="Bengkulu">Bengkulu</option>
                                        <option value="Gorontalo">Gorontalo</option>
                                        <option value="DKI Jakarta">DKI Jakarta</option>
                                        <option value="Jambi">Jambi</option>
                                        <option value="Jawa Barat">Jawa Barat</option>
                                        <option value="Jawa Tengah">Jawa Tengah</option>
                                        <option value="Jawa Timur">Jawa Timur</option>
                                        <option value="Kalimantan Barat">Kalimantan Barat</option>
                                        <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                        <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                        <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        <option value="Kalimantan Utara">Kalimantan Utara</option>
                                        <option value="Kepulauan Riau">Kepulauan Riau</option>
                                        <option value="Lampung">Lampung</option>
                                        <option value="Maluku">Maluku</option>
                                        <option value="Maluku Utara">Maluku Utara</option>
                                        <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                        <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                        <option value="Papua">Papua</option>
                                        <option value="Papua Barat">Papua Barat</option>
                                        <option value="Riau">Riau</option>
                                        <option value="Sulawesi Barat">Sulawesi Barat</option>
                                        <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                        <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                        <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                        <option value="Sulawesi Utara">Sulawesi Utara</option>
                                        <option value="Sumatra Barat">Sumatra Barat</option>
                                        <option value="Sumatra Selatan">Sumatra Selatan</option>
                                        <option value="Sumatra Utara">Sumatra Utara</option>
                                        <option value="Yogyakarta">Yogyakarta</option>
                                    </select>
                                </div>
                                <div class="w-full">
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900">
                                        City
                                    </label>
                                    <select name="input_city" id="input_city"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                        required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center space-x-4 p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="submit" id="btn_user_address"
                        class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save
                    </button>
                    <button type="button" data-modal-hide="modalChangeAddress"
                        class="text-yellow-400 inline-flex items-center hover:text-white border border-yellow-400 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cityOptions = {
            "Aceh": ["Banda Aceh", "Aceh Barat", "Aceh Barat Daya", "Aceh Besar", "Aceh Jaya", "Aceh Selatan", "Aceh Singkil", "Aceh Tamiang", "Aceh Tengah", "Aceh Tenggara", "Aceh Timur", "Aceh Utara", "Bener Meriah", "Bireuen", "Gayo Lues", "Langsa", "Lhokseumawe", "Nagan Raya", "Pidie", "Pidie Jaya", "Sabang", "Simeulue"],
            "Bali": ["Denpasar", "Badung", "Bangli", "Buleleng", "Gianyar", "Jembrana", "Karangasem", "Klungkung", "Tabanan"],
            "Bangka Belitung": ["Pangkal Pinang", "Bangka", "Bangka Barat", "Bangka Selatan", "Bangka Tengah", "Belitung", "Belitung Timur"],
            "Banten": ["Serang", "Tangerang", "Tangerang Selatan", "Cilegon", "Kabupaten Lebak", "Kabupaten Pandeglang", "Kabupaten Serang", "Kabupaten Tangerang"],
            "Bengkulu": ["Bengkulu", "Bengkulu Selatan", "Bengkulu Tengah", "Bengkulu Utara", "Kaur", "Kepahiang", "Lebong", "Mukomuko", "Rejang Lebong", "Seluma"],
            "Gorontalo": ["Gorontalo", "Kabupaten Boalemo", "Kabupaten Bone Bolango", "Kabupaten Gorontalo", "Kabupaten Gorontalo Utara", "Kabupaten Pohuwato"],
            "DKI Jakarta": ["Jakarta Barat", "Jakarta Pusat", "Jakarta Selatan", "Jakarta Timur", "Jakarta Utara"],
            "Jambi": ["Jambi", "Kabupaten Bungo", "Kabupaten Kerinci", "Kabupaten Merangin", "Kabupaten Muaro Jambi", "Kabupaten Sarolangun", "Kabupaten Tanjung Jabung Barat", "Kabupaten Tanjung Jabung Timur", "Kabupaten Tebo"],
            "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Cimahi", "Cirebon", "Depok", "Sukabumi", "Tasikmalaya", "Kabupaten Bandung", "Kabupaten Bandung Barat", "Kabupaten Bekasi", "Kabupaten Bogor", "Kabupaten Ciamis", "Kabupaten Cianjur", "Kabupaten Cirebon", "Kabupaten Garut", "Kabupaten Indramayu", "Kabupaten Karawang", "Kabupaten Kuningan", "Kabupaten Majalengka", "Kabupaten Pangandaran", "Kabupaten Purwakarta", "Kabupaten Subang", "Kabupaten Sukabumi", "Kabupaten Sumedang", "Kabupaten Tasikmalaya"],
            "Jawa Tengah": ["Magelang", "Pekalongan", "Salatiga", "Semarang", "Surakarta", "Tegal", "Kabupaten Banjarnegara", "Kabupaten Banyumas", "Kabupaten Batang", "Kabupaten Blora", "Kabupaten Boyolali", "Kabupaten Brebes", "Kabupaten Cilacap", "Kabupaten Demak", "Kabupaten Grobogan", "Kabupaten Jepara", "Kabupaten Karanganyar", "Kabupaten Kebumen", "Kabupaten Kendal", "Kabupaten Klaten", "Kabupaten Kudus", "Kabupaten Magelang", "Kabupaten Pati", "Kabupaten Pekalongan", "Kabupaten Pemalang", "Kabupaten Purbalingga", "Kabupaten Purworejo", "Kabupaten Rembang", "Kabupaten Semarang", "Kabupaten Sragen", "Kabupaten Sukoharjo", "Kabupaten Tegal", "Kabupaten Temanggung", "Kabupaten Wonogiri", "Kabupaten Wonosobo"],
            "Jawa Timur": ["Surabaya", "Batu", "Blitar", "Kediri", "Madiun", "Malang", "Mojokerto", "Pasuruan", "Probolinggo", "Surabaya", "Banyuwangi", "Blitar", "Bojonegoro", "Bondowoso", "Gresik", "Jember", "Jombang", "Kediri", "Lamongan", "Lumajang", "Madiun", "Magetan", "Malang", "Mojokerto", "Nganjuk", "Ngawi", "Pacitan", "Pamekasan", "Pasuruan", "Ponorogo", "Probolinggo", "Sampang", "Sidoarjo", "Situbondo", "Sumenep", "Tuban", "Tulungagung"],
            "Kalimantan Barat": ["Pontianak", "Singkawang", "Kabupaten Bengkayang", "Kabupaten Kapuas Hulu", "Kabupaten Kayong Utara", "Kabupaten Ketapang", "Kabupaten Kubu Raya", "Kabupaten Landak", "Kabupaten Melawi", "Kabupaten Mempawah", "Kabupaten Sambas", "Kabupaten Sanggau", "Kabupaten Sekadau", "Kabupaten Sintang"],
            "Kalimantan Selatan": ["Banjarmasin", "Banjarbaru", "Kabupaten Balangan", "Kabupaten Banjar", "Kabupaten Barito Kuala", "Kabupaten Hulu Sungai Selatan", "Kabupaten Hulu Sungai Tengah", "Kabupaten Hulu Sungai Utara", "Kabupaten Kotabaru", "Kabupaten Tabalong", "Kabupaten Tanah Bumbu", "Kabupaten Tanah Laut", "Kabupaten Tapin"],
            "Kalimantan Tengah": ["Palangka Raya", "Kabupaten Barito Selatan", "Kabupaten Barito Timur", "Kabupaten Barito Utara", "Kabupaten Gunung Mas", "Kabupaten Kapuas", "Kabupaten Katingan", "Kabupaten Kotawaringin Barat", "Kabupaten Kotawaringin Timur", "Kabupaten Lamandau", "Kabupaten Murung Raya", "Kabupaten Pulang Pisau", "Kabupaten Sukamara", "Kabupaten Seruyan"],
            "Kalimantan Timur": ["Balikpapan", "Bontang", "Samarinda", "Kabupaten Berau", "Kabupaten Kutai Barat", "Kabupaten Kutai Kartanegara", "Kabupaten Kutai Timur", "Kabupaten Mahakam Hulu", "Kabupaten Paser", "Kabupaten Penajam Paser Utara"],
            "Kalimantan Utara": ["Tanjung Selor", "Kabupaten Bulungan", "Kabupaten Malinau", "Kabupaten Nunukan", "Kabupaten Tana Tidung"],
            "Kepulauan Riau": ["Tanjung Pinang", "Batam", "Kabupaten Bintan", "Kabupaten Karimun", "Kabupaten Kepulauan Anambas", "Kabupaten Lingga", "Kabupaten Natuna"],
            "Lampung": ["Bandar Lampung", "Kota Metro", "Kabupaten Lampung Barat", "Kabupaten Lampung Selatan", "Kabupaten Lampung Tengah", "Kabupaten Lampung Timur", "Kabupaten Lampung Utara", "Kabupaten Mesuji", "Kabupaten Pesawaran", "Kabupaten Pesisir Barat", "Kabupaten Pringsewu", "Kabupaten Tanggamus", "Kabupaten Tulang Bawang", "Kabupaten Tulang Bawang Barat", "Kabupaten Way Kanan"],
            "Maluku": ["Ambon", "Tual", "Kabupaten Buru", "Kabupaten Buru Selatan", "Kabupaten Kepulauan Aru", "Kabupaten Maluku Barat Daya", "Kabupaten Maluku Tengah", "Kabupaten Maluku Tenggara", "Kabupaten Seram Bagian Barat", "Kabupaten Seram Bagian Timur"],
            "Maluku Utara": ["Ternate", "Tidore Kepulauan", "Kabupaten Halmahera Barat", "Kabupaten Halmahera Tengah", "Kabupaten Halmahera Utara", "Kabupaten Halmahera Selatan", "Kabupaten Kepulauan Sula", "Kabupaten Pulau Morotai"],
            "Nusa Tenggara Barat": ["Mataram", "Bima", "Kabupaten Bima", "Kabupaten Dompu", "Kabupaten Lombok Barat", "Kabupaten Lombok Tengah", "Kabupaten Lombok Timur", "Kabupaten Lombok Utara", "Kabupaten Sumbawa", "Kabupaten Sumbawa Barat"],
            "Nusa Tenggara Timur": ["Kupang", "Atambua", "Kabupaten Alor", "Kabupaten Belu", "Kabupaten Ende", "Kabupaten Flores Timur", "Kabupaten Kupang", "Kabupaten Lembata", "Kabupaten Malaka", "Kabupaten Manggarai", "Kabupaten Manggarai Barat", "Kabupaten Manggarai Timur", "Kabupaten Nagekeo", "Kabupaten Ngada", "Kabupaten Rote Ndao", "Kabupaten Sabu Raijua", "Kabupaten Sikka", "Kabupaten Sumba Barat", "Kabupaten Sumba Barat Daya", "Kabupaten Sumba Tengah", "Kabupaten Sumba Timur", "Kabupaten Timor Tengah Selatan", "Kabupaten Timor Tengah Utara"],
            "Papua": ["Jayapura", "Kabupaten Asmat", "Kabupaten Biak Numfor", "Kabupaten Boven Digoel", "Kabupaten Deiyai", "Kabupaten Dogiyai", "Kabupaten Intan Jaya", "Kabupaten Jayapura", "Kabupaten Jayawijaya", "Kabupaten Keerom", "Kabupaten Kepulauan Yapen", "Kabupaten Lanny Jaya", "Kabupaten Mamberamo Raya", "Kabupaten Mamberamo Tengah", "Kabupaten Mappi", "Kabupaten Merauke", "Kabupaten Mimika", "Kabupaten Nabire", "Kabupaten Nduga", "Kabupaten Paniai", "Kabupaten Pegunungan Bintang", "Kabupaten Puncak", "Kabupaten Puncak Jaya", "Kabupaten Sarmi", "Kabupaten Supiori", "Kabupaten Tolikara", "Kabupaten Waropen", "Kabupaten Yahukimo", "Kabupaten Yalimo"],
            "Papua Barat": ["Manokwari", "Sorong", "Kabupaten Fakfak", "Kabupaten Kaimana", "Kabupaten Manokwari", "Kabupaten Manokwari Selatan", "Kabupaten Maybrat", "Kabupaten Raja Ampat", "Kabupaten Sorong", "Kabupaten Sorong Selatan", "Kabupaten Tambrauw", "Kabupaten Teluk Bintuni", "Kabupaten Teluk Wondama"],
            "Riau": ["Pekanbaru", "Dumai", "Kabupaten Bengkalis", "Kabupaten Indragiri Hilir", "Kabupaten Indragiri Hulu", "Kabupaten Kampar", "Kabupaten Kepulauan Meranti", "Kabupaten Kuantan Singingi", "Kabupaten Pelalawan", "Kabupaten Rokan Hilir", "Kabupaten Rokan Hulu", "Kabupaten Siak"],
            "Sulawesi Barat": ["Mamuju", "Majene", "Kabupaten Mamasa", "Kabupaten Mamuju", "Kabupaten Mamuju Utara", "Kabupaten Polewali Mandar"],
            "Sulawesi Selatan": ["Makassar", "Palopo", "Parepare", "Kabupaten Bantaeng", "Kabupaten Barru", "Kabupaten Bone", "Kabupaten Bulukumba", "Kabupaten Enrekang", "Kabupaten Gowa", "Kabupaten Jeneponto", "Kabupaten Kepulauan Selayar", "Kabupaten Luwu", "Kabupaten Luwu Timur", "Kabupaten Luwu Utara", "Kabupaten Maros", "Kabupaten Pangkajene dan Kepulauan", "Kabupaten Pinrang", "Kabupaten Sidenreng Rappang", "Kabupaten Sinjai", "Kabupaten Soppeng", "Kabupaten Takalar", "Kabupaten Tana Toraja", "Kabupaten Toraja Utara", "Kabupaten Wajo"],
            "Sulawesi Tengah": ["Palu", "Kabupaten Banggai", "Kabupaten Banggai Kepulauan", "Kabupaten Banggai Laut", "Kabupaten Buol", "Kabupaten Donggala", "Kabupaten Morowali", "Kabupaten Morowali Utara", "Kabupaten Parigi Moutong", "Kabupaten Poso", "Kabupaten Sigi", "Kabupaten Tojo Una-Una", "Kabupaten Toli-Toli"],
            "Sulawesi Tenggara": ["Kendari", "Baubau", "Kabupaten Bombana", "Kabupaten Buton", "Kabupaten Buton Selatan", "Kabupaten Buton Tengah", "Kabupaten Buton Utara", "Kabupaten Kolaka", "Kabupaten Kolaka Timur", "Kabupaten Kolaka Utara", "Kabupaten Konawe", "Kabupaten Konawe Kepulauan", "Kabupaten Konawe Selatan", "Kabupaten Konawe Utara", "Kabupaten Muna", "Kabupaten Wakatobi"],
            "Sulawesi Utara": ["Manado", "Bitung", "Kotamobagu", "Tomohon", "Kabupaten Bolaang Mongondow", "Kabupaten Bolaang Mongondow Selatan", "Kabupaten Bolaang Mongondow Timur", "Kabupaten Bolaang Mongondow Utara", "Kabupaten Kepulauan Sangihe", "Kabupaten Kepulauan Siau Tagulandang Biaro", "Kabupaten Kepulauan Talaud", "Kabupaten Minahasa", "Kabupaten Minahasa Selatan", "Kabupaten Minahasa Tenggara", "Kabupaten Minahasa Utara"],
            "Sumatra Barat": ["Padang", "Bukittinggi", "Padang Panjang", "Pariaman", "Payakumbuh", "Sawahlunto", "Solok", "Kabupaten Agam", "Kabupaten Dharmasraya", "Kabupaten Kepulauan Mentawai", "Kabupaten Lima Puluh Kota", "Kabupaten Padang Pariaman", "Kabupaten Pasaman", "Kabupaten Pasaman Barat", "Kabupaten Pesisir Selatan", "Kabupaten Sijunjung", "Kabupaten Solok", "Kabupaten Solok Selatan", "Kabupaten Tanah Datar"],
            "Sumatra Selatan": ["Palembang", "Lubuklinggau", "Pagar Alam", "Prabumulih", "Kabupaten Banyuasin", "Kabupaten Empat Lawang", "Kabupaten Lahat", "Kabupaten Muara Enim", "Kabupaten Musi Banyuasin", "Kabupaten Musi Rawas", "Kabupaten Musi Rawas Utara", "Kabupaten Ogan Ilir", "Kabupaten Ogan Komering Ilir", "Kabupaten Ogan Komering Ulu", "Kabupaten Ogan Komering Ulu Selatan", "Kabupaten Ogan Komering Ulu Timur", "Kabupaten Penukal Abab Lematang Ilir"],
            "Sumatra Utara": ["Medan", "Binjai", "Pematangsiantar", "Tanjungbalai", "Tebingtinggi", "Kabupaten Asahan", "Kabupaten Batubara", "Kabupaten Dairi", "Kabupaten Deli Serdang", "Kabupaten Humbang Hasundutan", "Kabupaten Karo", "Kabupaten Labuhan Batu", "Kabupaten Labuhan Batu Selatan", "Kabupaten Labuhan Batu Utara", "Kabupaten Langkat", "Kabupaten Mandailing Natal", "Kabupaten Nias", "Kabupaten Nias Barat", "Kabupaten Nias Selatan", "Kabupaten Nias Utara", "Kabupaten Padang Lawas", "Kabupaten Padang Lawas Utara", "Kabupaten Pakpak Bharat", "Kabupaten Samosir", "Kabupaten Serdang Bedagai", "Kabupaten Simalungun", "Kabupaten Tapanuli Selatan", "Kabupaten Tapanuli Tengah", "Kabupaten Tapanuli Utara", "Kabupaten Toba Samosir"],
            "Yogyakarta": ["Yogyakarta", "Bantul", "Gunung Kidul", "Kulon Progo", "Sleman"]
        };

        const provinceSelect = document.getElementById('input_province');
        const citySelect = document.getElementById('input_city');

        function populateCities() {
            const selectedProvince = provinceSelect.value;
            const cities = cityOptions[selectedProvince] || [];

            citySelect.innerHTML = '';

            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;
                citySelect.appendChild(option);
            });
        }

        provinceSelect.addEventListener('change', populateCities);

        populateCities();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userLocationForm = document.getElementById('userLocationForm');
        const apiToken = document.querySelector('meta[name="api-token"]').getAttribute('content');

        $('#btn_user_address').click(function(event) {
            event.preventDefault();

            var address = {
                us_city: $("#input_city").val(),
                us_province: $("#input_province").val(),
            }

            $.ajax({
                url: '{{ route('edit_my_address') }}',
                type: 'POST',
                data: address,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + apiToken
                },
                success: function(response) {
                    console.log('response: ', response);
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data change successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON;
                    var errorMessage = response.message;
                    Swal.fire({
                        icon: "error",
                        title: "Oops..",
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>