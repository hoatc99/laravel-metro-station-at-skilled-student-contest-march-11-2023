@extends('layouts.master')

@section('title', 'Trang chủ')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="route-list-container d-flex justify-content-center">
                @foreach ($routes as $route)
                    <button type="button" onclick="get_route_stations({{ $route->id }}, this)"
                        class="btn btn-outline-primary mx-2 rounded-pill btn-select-route">{{ $route->name }}</button>
                @endforeach
            </div>
            <div id="route_container" class="my-5 text-center">
                <p class="text-center text-danger my-3 fw-bold h5">Vui lòng chọn tuyến để xem chi tiết các ga</p>
            </div>
        </div>
    </section>

    @include('partials.slider')
@endsection

@section('scripts')
    <script>
        const btn_select_route = document.querySelectorAll('.btn-select-route');
        const route_container = document.querySelector('#route_container');

        let current_active_btn = null;

        const get_route_stations = (id, btn) => {
            route_container.innerText = 'Đang tải thông tin tuyến...';
            fetch('/api/get_route_stations', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    route_id: id
                })
            }).then((res) => res.json()).then((route) => {
                let stationHTML = ``;
                route.stations.map((station) => {
                    let routeNumberHTML = `Tuyến`;
                    station.routes.map((route) => {
                        routeNumberHTML +=
                            `<span class='route-number'>${route.name.replace('Tuyến số ', '')}</span>`;
                    })

                    stationHTML += `
                        <div class="station-container">
                            <label for="${station.name}" class="station-name">${station.name}</label>
                            <input type="radio" name="station-dot" id="${station.name}" class="station-dot" data-bs-toggle="tooltip"
                                data-bs-placement="bottom" data-bs-html="true"
                                data-bs-title="${routeNumberHTML}" checked />
                            <div class="station-line"></div>
                        </div>
                    `;
                })

                let routeHTML = `
                    <div class="route-container">
                        <div class="route-head-container">
                            <span class="route-name">${route.name}</span>
                        </div>
                        <div class="route-body-container">${stationHTML}</div>
                        <div class="route-foot-container">
                            <div class="route-info">
                                <i class="fa-solid fa-clock"></i>
                                <span>${route.uptime}</span>
                            </div>
                            <div class="route-info">
                                <i class="fa-solid fa-arrows-left-right-to-line"></i>
                                <span>${route.distance}km</span>
                            </div>
                        </div>
                    </div>
                `;

                route_container.innerHTML = routeHTML;

                current_active_btn && current_active_btn.classList.toggle('active');
                btn.classList.toggle('active');
                current_active_btn = btn;

                const tooltipTriggerList = document.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'
                );
                const tooltipList = [...tooltipTriggerList].map(
                    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
                );
            })
        }
    </script>
@endsection
