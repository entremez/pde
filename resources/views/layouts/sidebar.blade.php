@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/simple-sidebar.css') }}">
@endsection
@section('content')

<div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">

                    </a>
                </li>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('providers') }}">Empresas</a>
                </li>
                <li>
                    <a href="#">Proveedores</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <hr style="color: #FFFFFF; size: 10; border-top: 1px solid">
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        @yield('content')
    </div>




@endsection
