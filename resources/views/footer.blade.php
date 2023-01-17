{{-- <footer class="p-3 mb-2 m-t d-none d-lg-block w-100">
    <div class="text-center user-select-none">
        <p class="small m-0">
            Cette application est une creation de Goseck Technologie. 2021 - 2024<br>
            <a href="#" target="_blank" rel="noopener">
                Currently v1.0
            </a>
        </p>
    </div>
</footer> --}}
@guest
    <p>Crafted with <span class="me-1">❤️</span> by Jonathan Mupene</p>
@else

    <div class="text-center user-select-none">
        <p class="small m-0">
            <p>Crafted with <span class="me-1">❤️</span> by Jonathan Mupene</p> 2016 - {{date('Y')}}<br>
            <a href="" target="_blank" rel="noopener">
                {{ __('Actuellement') }} v {{ Env('APP_VERSION') }}
            </a>
        </p>
    </div>
@endguest
