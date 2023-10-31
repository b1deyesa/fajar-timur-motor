@if(session()->has('message'))
    <div class="alert" id="alert" onclick="$('#alert').hide()">
        <div class="container">
            <div class="head">
                <p class="title">Notifikasi</p>
                <button class="close" autofocus>X</button>
            </div>
            <div class="content">
                <p>{{ session('message') }}</p>
            </div>
        </div>
    </div>
@endif