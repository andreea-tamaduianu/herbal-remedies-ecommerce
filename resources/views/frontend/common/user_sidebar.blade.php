@php
$id = Auth::user()->id;
$user = App\Models\User::find($id);
@endphp

<div class="col-md-2">
    <br>
    <img class="card-img-top" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" style="border-radius: 50%;" height="150%" width="100%">
    <br><br>
    <ul class="list-group list-group-flush">
        <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile</a>
        <a href="{{route('user.change.password')}}" class="btn btn-primary btn-sm btn-block">Change password</a>
        <a href="{{route('my.orders')}}" class="btn btn-primary btn-sm btn-block">Order history</a>
        <a href="{{ route('return.order.list') }}" class="btn btn-primary btn-sm btn-block">Return requests</a>
        <a href="{{ route('cancel.orders') }}" class="btn btn-primary btn-sm btn-block">Cancelled orders</a>
        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
    </ul>
</div> <!-- // end col md 2 -->