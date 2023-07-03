<div class="sender-info">
<h4 class="brief">Sender Details</h4>
<div class="x_content">
    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
        <tbody class="fw-semibold text-gray-600">
            <tr>
                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Name :
                    </div>
                </td>
                <td class="fw-bold text-end">{{$address->fname}} {{$address->lname}}</td>
            </tr>
            <tr>
                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Email :
                    </div>
                </td>
                <td class="fw-bold text-end">
                    {{$address->email}}
                </td>
            </tr>
            <tr>
                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Phone :
                    </div>
                </td>
                <td class="fw-bold text-end">{{$address->phone_no}}</td>
            </tr>
            <tr>

                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Address :
                    </div>
                </td>
                <td class="fw-bold text-end">
                {{$address->door_number}} {{$address->address}},{{$address->city}}
                    {{$address->postal_code}}
                </td>

            </tr>
        </tbody>
    </table>
</div>
</div>

<div class="recive-info">
<h4 class="brief">Reciver  Details</h4>
<div class="x_content">
    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
        <tbody class="fw-semibold text-gray-600">
            <tr>
                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Name :
                    </div>
                </td>
                <td class="fw-bold text-end">{{$address->receiver_fname}} {{$address->receiver_lname}}</td>
            </tr>
            <tr>
                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Email :
                    </div>
                </td>
                <td class="fw-bold text-end">
                    {{$address->receiver_email}}
                </td>
            </tr>
            <tr>
                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Phone :
                    </div>
                </td>
                <td class="fw-bold text-end">{{$address->receiver_phone_no}}</td>
            </tr>
            <tr>

                <td class="text-muted">
                    <div class="d-flex align-items-center">
                        Address :
                    </div>
                </td>
                <td class="fw-bold text-end">
                {{$address->door_number}} {{$address->receiver_address}},{{$address->receiver_city}}
                    {{$address->receiver_postal_code}}
                </td>

            </tr>
        </tbody>
    </table>
</div>
</div>
