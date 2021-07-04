<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Servicio') }}
		</h2>
	</x-slot>

	<div class="py-12 ">
		<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
			<div>

				
					@livewire('servicio.show-servicio', ['servicio' => $servicio])
				

			</div>
		</div>
	</div>
</x-app-layout>