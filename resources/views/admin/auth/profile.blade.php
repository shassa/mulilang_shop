{{-- @profile([
    'username'=>'{{Auth::guard('admin')->user()->name}}',
    'useremail'=>'{{Auth::guard('admin')->user()->email}}',
    'userimage'=>'{{asset('public/assets/admin/images/portrait/small/avatar-s-19.png')}}'
    ])
 @endprofile --}}

<x-profile
    :username="Auth::guard('admin')->user()->name"
    :useremail="Auth::guard('admin')->user()->email"
    :userimage="asset('public/assets/admin/images/portrait/small/avatar-s-19.png')"
 />

{{--
@component('layouts.components.profile')
@slot('username')
{{Auth::guard('admin')->user()->name}}
@endslot
@slot('useremail')
{{Auth::guard('admin')->user()->email}}
@endslot
@slot('userimage')
{{asset('public/assets/admin/images/portrait/small/avatar-s-19.png')}}
@endslot
@endcomponent --}}

