@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header')
            <img src="https://lirp.cdn-website.com/3c853351/dms3rep/multi/opt/logo-361940ec-640w.png" alt="COMIDA REGIONAL TPP">
        @endcomponent
    @endslot
    {{-- Body --}}
    # Solicitud para Cambiar de contraseña

    Tengo un Buen día, {{ $user->nombres }} {{ $user->ap_paterno }} {{ $user->ap_materno }} con el correo {{ $user->email }} y cuyo DNI es  {{ $user->dni }}, ha solicitado una petición de cambio de contraseña, en este caso presione en el boton para cambiar su contraseña.
@component('mail::button', ['url' => 'https://localhost:4200/recuperar?token='.$token, 'color' => 'primary'])
Recuperar contraseña
@endcomponent

    {{-- Footer --}}
    @slot('footer')
    
        @component('mail::footer')
        Gracias, Soporte Tecnico
            © {{ date('Y') }} COMIDA REGIONAL TPP. Todos los derechos reservados. 
        @endcomponent
    @endslot

@endcomponent