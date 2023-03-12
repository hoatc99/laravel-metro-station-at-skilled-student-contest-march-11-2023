@extends('layouts.master')

@section('title', 'Đặt vé')

@section('content')
    <section>
        <div class="container-fluid">
            <form class="row g-3 needs-validation border rounded-3 p-2 mt-3 w-75 m-auto bg-info bg-opacity-10"
                id="form_ticket" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <label for="select_route" class="form-label fw-bold">Tuyến</label>
                        <select name="route_id" id="select_route" class="form-select" required></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="select_pickup_station" class="form-label fw-bold">Ga lên</label>
                        <select name="pickup_station_id" id="select_pickup_station" class="form-select" required></select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="select_dropdown_station" class="form-label fw-bold">Ga xuống</label>
                        <select name="dropdown_station_id" id="select_dropdown_station" class="form-select"
                            required></select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="input_quantity" class="form-label fw-bold">Số lượng đặt (tối đa 20 vé)</label>
                        <input type="number" name="quantity" id="input_quantity" class="form-control" value="1"
                            min="1" max="20" required />
                        <div class="invalid-feedback">Số lượng đặt không hợp lệ</div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="phone_number" class="form-label fw-bold">Điện thoại</label>
                        <input type="text" name="phone_number" id="input_phone_number" class="form-control"
                            pattern="^(0)(3|5|7|8|9)([0-9]{8})$" maxlength="10" required />
                        <div class="invalid-feedback">Số điện thoại không hợp lệ</div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="" class="form-label fw-bold">Thành tiền</label>
                        <h4 id="h4_sum_total" class="fw-bold"></h4>
                    </div>
                    <div class="col-md-6 mt-3">
                        <button type="submit" id="button_create_ticket" class="btn btn-primary w-50">
                            Đặt vé
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const form_ticket = document.querySelector('#form_ticket');
        const select_route = document.querySelector('#select_route');
        const select_pickup_station = document.querySelector('#select_pickup_station');
        const select_dropdown_station = document.querySelector('#select_dropdown_station');
        const input_quantity = document.querySelector('#input_quantity');
        const input_phone_number = document.querySelector('#input_phone_number');
        const h4_sum_total = document.querySelector('#h4_sum_total');
        const button_create_ticket = document.querySelector('#button_create_ticket');

        const is_form_validated = () => {
            const regex = /^(0)(3|5|7|8|9)([0-9]{8})$/;
            if (select_pickup_station.value == select_dropdown_station.value) {
                alert('Ga lên và ga xuống không được trùng nhau')
                return false;
            }
            if (!input_phone_number.value.match(regex)) {
                return false;
            }
            return true;
        }

        const get_routes = () => {
            fetch('/api/get_routes', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then((res) => res.json()).then((routes) => {
                routes.map((route) => {
                    select_route.appendChild(new Option(route.name, route.id))
                })
                get_stations();
            })
        }

        const get_stations = () => {
            fetch('/api/get_stations', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    route_id: select_route.value
                })
            }).then((res) => res.json()).then((stations) => {
                select_pickup_station.length = 0;
                select_dropdown_station.length = 0;
                stations.map((station) => {
                    select_pickup_station.appendChild(new Option(station.name, station.pivot.id))
                    select_dropdown_station.appendChild(new Option(station.name, station.pivot.id))
                })
                calc_sum_total();
            })
        }

        const calc_sum_total = () => {
            h4_sum_total.innerText = "Đang tính toán..."
            fetch('/api/calc_sum_total', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(get_ticket_fields())
            }).then((res) => res.json()).then((sum_total) => {
                h4_sum_total.innerText = sum_total.toLocaleString() + ' đồng';
            })
        }

        const store_ticket = () => {
            if (is_form_validated()) {
                button_create_ticket.disabled = true;
                button_create_ticket.innerText = "Đang đặt vé..."
                fetch('/api/store_ticket', {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(get_ticket_fields())
                }).then((res) => res.json()).then((result) => {
                    if (result) {
                        alert('Đặt vé thành công. Nhấn OK để đến trang tra cứu đặt vé.');
                        window.location.href = '{{ route('searchticket') }}'
                    } else {
                        alert('Đặt vé thất bại. Vui lòng kiểm tra lại.');
                        button_create_ticket.disabled = false;
                        button_create_ticket.innerText = "Đặt vé"
                    }
                })
            }
        }

        const get_ticket_fields = () => {
            return {
                route_id: select_route.value,
                quantity: input_quantity.value,
                phone_number: input_phone_number.value,
                pickup_station_id: select_pickup_station.value,
                dropdown_station_id: select_dropdown_station.value,
            }
        }

        get_routes();

        select_route.addEventListener('change', () => {
            get_stations();
        })

        select_pickup_station.addEventListener('change', () => {
            calc_sum_total();
        })

        select_dropdown_station.addEventListener('change', () => {
            calc_sum_total();
        })

        input_quantity.addEventListener('input', () => {
            calc_sum_total();
        })

        form_ticket.addEventListener('submit', (e) => {
            e.preventDefault();
            store_ticket();
        })
    </script>

    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity() || !is_form_validated()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
