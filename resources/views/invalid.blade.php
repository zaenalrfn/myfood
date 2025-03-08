<x-layouts.app>
    <div class="grid h-screen bg-white place-content-center font-poppins">
        <img src="{{ asset('assets/images/bg-cart-empty.png') }}" alt="Tidak ada data"
            class="w-full overflow-hidden rounded-3xl" />
        <div class="w-full mt-4 text-center">
            <p class="text-lg font-semibold text-black-80">
                Kode QR tidak valid
            </p>
            <p class="mt-2 text-sm font-medium text-black-50">
                Ingin memindai ulang?
            </p>
            <a href="/scan" wire:navigate
                class="flex items-center justify-center w-full gap-2 px-6 py-3 mt-4 font-semibold rounded-full bg-primary-50 text-black-10">
                Pindai Ulang
            </a>
        </div>
    </div>
</x-layouts.app>
