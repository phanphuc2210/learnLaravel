{{-- Thông báo lỗi của hàm valiate --}}
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Thông báo lỗi khi đăng nhập lấy từ Sesion --}}
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
    </div>
@endif

{{-- Thông báo thành công khi đăng nhập lấy từ Sesion --}}
@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif