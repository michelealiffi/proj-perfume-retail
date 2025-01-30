@extends('layouts.app')

@section('title', 'Perfume Shop')

@section('content')
    <ul class="container list-group list-group-horizontal mb-2">
        <li class="m-3 list-group-item border-0">
            <a class="logo-color fw-semibold mx-5 text-uppercase" href="">Brands</a>
        </li>
        <li class="m-3 list-group-item border-0">
            <a class="logo-color fw-semibold mx-5 text-uppercase" href="">Top Ten</a>
        </li>
        <li class="m-3 list-group-item border-0">
            <a class="logo-color fw-semibold mx-3 text-uppercase" href="">Profumi</a>
        </li>
        <li class="m-3 list-group-item border-0">
            <a class="logo-color fw-semibold mx-3 text-uppercase" href="">Viso e Corpo</a>
        </li>
        <li class="m-3 list-group-item border-0">
            <a class="logo-color fw-semibold mx-5 text-uppercase" href="">Ambiente</a>
        </li>
        <li class="m-3 list-group-item border-0">
            <a class="logo-color fw-semibold mx-5 text-uppercase" href="">Novità</a>
        </li>
    </ul>

    <img class="py-3" src="/storage/images/pink-bloom-perfume-gucci-4k-jncnu583h0ou7083.jpg"
        style="height: 700px; width: 100%;">

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Cerca per nome o brand...">
            </div>
            <div class="col-md-3">
                <select id="priceFilter" class="form-control">
                    <option value="">Filtra per prezzo</option>
                    <option value="low">Meno di 50€</option>
                    <option value="medium">50€ - 100€</option>
                    <option value="high">Più di 100€</option>
                </select>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="perfumesContainer">
            @foreach ($perfumes as $index => $perfume)
                <div class="col perfume-card {{ $index >= 4 ? 'd-none' : '' }}">
                    <div class="m-2 card h-100">
                        <div class="image-container position-relative">
                            <img src="{{ Storage::url($perfume->image) }}" class="card-img-top" alt="{{ $perfume->name }}"
                                style="object-fit: cover; height: 300px;">
                            <a href=""
                                class="btn btn-color position-absolute bottom-70 start-50 translate-middle-x mb-3">
                                Acquista
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $perfume->name }}</h5>
                            <p class="card-text text-muted text-center">{{ $perfume->brand }}</p>
                            <p class="card-text h5 logo-color text-center">{{ $perfume->price }}€</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($perfumes) > 4)
            <div class="text-center mt-5">
                <button class="btn btn-secondary" id="showMoreBtn">Mostra più</button>
                <button class="btn btn-secondary d-none" id="showLessBtn">Mostra meno</button>
            </div>
        @endif
    </div>

    <div class="bg-image py-5">
        <h2 class="text-center pt-5">Vieni e prova anche tu...</h2>
        <div class="row justify-content-center">
            <p class="text-center py-3 col-2 text-box">
                Immergiti in un mondo di fragranze uniche, create per avvolgere te e il tuo ambiente in un'aura di eleganza
                e benessere. Scopri le essenze che trasformano ogni momento in un'esperienza sensoriale esclusiva, pensate
                per esaltare la tua personalità e arricchire ogni spazio con lusso e armonia. Fragranze che parlano di te,
                per rendere unica ogni stanza della tua casa e ogni attimo della tua giornata.
            </p>
        </div>
    </div>

    <style>
        .text-box {
            background-color: rgba(255, 255, 255, 0.7);
            /* Bianco trasparente */
            padding: 15px;
            border-radius: 10px;
            /* Angoli arrotondati */
            backdrop-filter: blur(5px);
            /* Effetto sfocato dietro */
        }

        .bg-image {
            background-image: url("/storage/images/Banners-Montale.webp");
            background-repeat: no-repeat;
            background-size: 100%, 100px;
        }

        .image-container {
            position: relative;
        }

        .image-container:hover .card-img-top {
            opacity: 0.8;
        }

        .image-container:hover .btn {
            display: block;
        }

        .card-img-top {
            transition: opacity 0.3s ease;
        }

        .btn-color {
            background-color: #ff385c;
            color: white;
            display: none;
        }

        .btn-color:hover {
            background-color: #be2b46;
            color: white;

        }

        .bottom-70 {
            bottom: 70px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('showMoreBtn');
            const showLessBtn = document.getElementById('showLessBtn');
            const allPerfumes = document.querySelectorAll('.perfume-card');

            if (showMoreBtn && showLessBtn) {
                showMoreBtn.addEventListener('click', function() {
                    allPerfumes.forEach(perfume => perfume.classList.remove('d-none')); // Mostra tutto
                    showMoreBtn.classList.add('d-none'); // Nasconde "Mostra più"
                    showLessBtn.classList.remove('d-none'); // Mostra "Mostra meno"
                });

                showLessBtn.addEventListener('click', function() {
                    allPerfumes.forEach((perfume, index) => {
                        if (index >= 4) perfume.classList.add('d-none'); // Nasconde le extra
                    });
                    showLessBtn.classList.add('d-none'); // Nasconde "Mostra meno"
                    showMoreBtn.classList.remove('d-none'); // Mostra "Mostra più"
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const priceFilter = document.getElementById('priceFilter');
            const showMoreBtn = document.getElementById('showMoreBtn');
            const showLessBtn = document.getElementById('showLessBtn');
            const allPerfumes = document.querySelectorAll('.perfume-card');

            function filterPerfumes() {
                const searchText = searchInput.value.toLowerCase();
                const priceValue = priceFilter.value;

                allPerfumes.forEach(perfume => {
                    const name = perfume.querySelector('.card-title').textContent.toLowerCase();
                    const brand = perfume.querySelector('.card-text.text-muted').textContent.toLowerCase();
                    const price = parseFloat(perfume.querySelector('.card-text.h5').textContent.replace('€',
                        ''));

                    let matchesSearch = name.includes(searchText) || brand.includes(searchText);
                    let matchesPrice =
                        (priceValue === '' ||
                            (priceValue === 'low' && price < 50) ||
                            (priceValue === 'medium' && price >= 50 && price <= 100) ||
                            (priceValue === 'high' && price > 100));

                    if (matchesSearch && matchesPrice) {
                        perfume.classList.remove('d-none');
                    } else {
                        perfume.classList.add('d-none');
                    }
                });
            }

            // Event listener per la ricerca
            searchInput.addEventListener('input', filterPerfumes);
            priceFilter.addEventListener('change', filterPerfumes);

            // Mostra/Nasconde più prodotti
            if (showMoreBtn && showLessBtn) {
                showMoreBtn.addEventListener('click', function() {
                    allPerfumes.forEach(perfume => perfume.classList.remove('d-none'));
                    showMoreBtn.classList.add('d-none');
                    showLessBtn.classList.remove('d-none');
                });

                showLessBtn.addEventListener('click', function() {
                    allPerfumes.forEach((perfume, index) => {
                        if (index >= 4) perfume.classList.add('d-none');
                    });
                    showLessBtn.classList.add('d-none');
                    showMoreBtn.classList.remove('d-none');
                });
            }
        });
    </script>
@endsection
