@extends('layouts.master')

@section('title', 'Tra cứu đặt vé')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-md-4 m-auto">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" id="phone_number" placeholder="Số điện thoại"
                            aria-label="Search" />
                        <button class="btn btn-outline-success" type="button" onclick="get_tickets()">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-9 m-auto text-center">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Id</th>
                                <th>Thời gian đặt</th>
                                <th>Tuyến</th>
                                <th>Ga lên</th>
                                <th>Ga xuống</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="table_tickets"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const phone_number = document.querySelector('#phone_number');
        const table_tickets = document.querySelector('#table_tickets');

        const get_tickets = () => {
            if (is_valid_phone_number()) {
                table_tickets.innerHTML = `<tr><td colspan="7">Đang tìm kiếm thông tin đặt vé...</td></tr>`;
                fetch('/api/get_tickets', {
                    method: 'post',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        phone_number: phone_number.value
                    })
                }).then((res) => res.json()).then((tickets) => {
                    console.log(tickets);
                    if (tickets.length == 0) {
                        table_tickets.innerHTML =
                            `<tr><td colspan="7" class="text-danger">Không tìm thấy thông tin đặt vé</td></tr>`;
                        return false;
                    }
                    let ticketsHTML = ``;
                    tickets.map((ticket, index) => {
                        ticketsHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${new Date(ticket.created_at).toLocaleString('en-GB').replace(',', '')}</td>
                                <td>${ticket.route_name}</td>
                                <td>${ticket.pickup_station_name}</td>
                                <td>${ticket.dropdown_station_name}</td>
                                <td>${ticket.quantity}</td>
                                <td>${ticket.sum_total.toLocaleString()} đ</td>
                            </tr>
                        `;
                    })
                    table_tickets.innerHTML = ticketsHTML;
                })
            }
        }

        const is_valid_phone_number = () => {
            if (phone_number.value == '') {
                table_tickets.innerHTML =
                    `<tr><td colspan="7" class="text-danger">Vui lòng nhập số điện thoại</td></tr>`;
                return false;
            } else {
                const regex = /^(\+84|84|0)([0-9]{9})$/;
                if (!phone_number.value.match(regex)) {
                    table_tickets.innerHTML =
                        `<tr><td colspan="7" class="text-danger">Số điện thoại không hợp lệ, vui lòng kiểm tra lại</td></tr>`;
                    return false;
                } else {
                    phone_number.value = phone_number.value.replace(regex, '0$2')
                    return true;
                }
            }
        }

        get_tickets();
    </script>
@endsection
