<div>

    <div>
        <h1 class="text-lg">Seleccione el gasto a pagar...</h1>
    </div>

    <div class="py-4">
        @include('livewire.pago.partials.tabla-gastos')
    </div>

    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">

        <x-slot name="title">
            Nuevo pago
        </x-slot>

        <x-slot name="content">

            {{-- formulario --}}
            <div class="mt-10 sm:mt-0">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-6">
                                <label for="gasto" class="block text-sm font-medium text-gray-700">
                                    Gasto:
                                </label>
                                <input wire:model="gasto.descripcion" type="text" name="gasto" id="gasto" readonly
                                    class="form-control w-full">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="monto-por-pagar" class="block text-sm font-medium text-gray-700">
                                    Monto restante por pagar:
                                </label>
                                <input wire:model="gasto.saldo" type="text" name="monto-por-pagar" id="monto-por-pagar"
                                    readonly class="form-control w-full">
                            </div>

                            @if ($gasto->moneda != $moneda && $this->tasaCambio)
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="monto-por-pagar-convertido"
                                        class="block text-sm font-medium text-gray-700">
                                        Monto restante por pagar (convertido):
                                    </label>
                                    <input type="text" name="monto-por-pagar-convertido" id="monto-por-pagar-convertido"
                                        value="{{ $montoConvertido }}" readonly class="form-control w-full">
                                </div>
                            @endif

                            <div class="col-span-6">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                    Descripción:
                                </label>
                                <input wire:model.defer="descripcion" type="text" name="descripcion" id="descripcion"
                                    class="form-control w-full">
                                <x-jet-input-error for="descripcion" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="fecha" class="block text-sm font-medium text-gray-700">
                                    Fecha de pago:
                                </label>
                                <input wire:model="fecha" type="date" name="fecha" id="fecha"
                                    class="form-control w-full">
                                <x-jet-input-error for="fecha" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="forma-pago" class="block text-sm font-medium text-gray-700">
                                    Forma de pago:
                                </label>
                                <div>
                                    <select wire:model="formaPago" name="forma-pago" id="forma-pago"
                                        class="form-control w-full">
                                        <option>----</option>
                                        <option>Transferencia</option>
                                        <option>Pago móvil</option>
                                        <option>Punto de venta</option>
                                        <option>Efectivo</option>
                                        <option>Depósito</option>
                                        <option>Cheque</option>
                                    </select>
                                </div>
                                <x-jet-input-error for="formaPago" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="moneda" class="block text-sm font-medium text-gray-700">
                                    Moneda:
                                </label>
                                <select wire:model="moneda" name="moneda" id="moneda" class="form-control w-full">
                                    <option>Bolívar</option>
                                    <option>Dólar</option>
                                </select>
                                <x-jet-input-error for="moneda" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="fondo" class="block text-sm font-medium text-gray-700">
                                    Fondo:
                                </label>
                                <select wire:model="fondo.id" name="fondo" id="fondo" class="form-control w-full">
                                    <option>----</option>

                                    @foreach ($fondos as $item)
                                        <option value="{{ $item->id }}">{{ $item->descripcion }} -
                                            {{ $item->saldo }} @if ($item->moneda == 'Bolívar')Bs. @else $ @endif
                                        </option>
                                    @endforeach

                                </select>
                                <x-jet-input-error for="fondo.id" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="monto" class="block text-sm font-medium text-gray-700">
                                    Monto:
                                </label>
                                <input wire:model="monto" type="text" name="monto" id="monto"
                                    class="form-control w-full">
                                <x-jet-input-error for="monto" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="recibo" class="block text-sm font-medium text-gray-700">
                                    Número de recibo:
                                </label>
                                <input wire:model="recibo" type="text" name="recibo" id="recibo"
                                    class="form-control w-full">
                                <x-jet-input-error for="recibo" />
                            </div>

                            @switch($formaPago)
                                @case('Transferencia')
                                @case('Pago móvil')
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="referencia" class="block text-sm font-medium text-gray-700">
                                            Referencia:
                                        </label>
                                        <input wire:model="referencia" type="text" name="referencia" id="referencia"
                                            class="form-control w-full">
                                        <x-jet-input-error for="referencia" />
                                    </div>
                                @break

                                @default
                                @break
                            @endswitch

                            @if ($gasto->moneda != $moneda)
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="tasa-cambio" class="block text-sm font-medium text-gray-700">
                                        Tasa de cambio:
                                    </label>
                                    <input wire:model.lazy="tasaCambio" type="text" name="tasa-cambio" id="tasa-cambio"
                                        class="form-control w-full">
                                    <x-jet-input-error for="tasaCambio" />
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            {{-- /formulario --}}

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button wire:click="save" wire:loading.attr="disabled" class="disabled:bg-opacity-25">
                Registrar
            </x-jet-button>

        </x-slot>

    </x-jet-dialog-modal>

</div>
