@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow"
     x-data="{
        tipos: {{ $tipos->toJson() }},
        seleccionado: null,
        fechaFormulario: '{{ now()->format('Y-m-d') }}', // ✅ fecha normal arriba (con valor actual por defecto)
        fechaIndefinida: true,
        fechaEntrega: '', // ✅ empieza vacía
        serie: '',
        inventario: '',
        mismoValor: false,
     }"
     x-effect="if (mismoValor) inventario = serie">

    <h1 class="text-2xl font-semibold mb-4">Responsiva de equipo</h1>

    <form method="POST" action="{{ route('responsiva.pdf') }}" target="_blank">
        @csrf

        {{-- 📅 Fecha (campo simple arriba) --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Fecha</label>
            <input type="date"
                   name="fecha"
                   class="border w-full p-2 rounded"
                   x-model="fechaFormulario">
        </div>

        {{-- 👤 Responsable --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Nombre del responsable</label>
            <input type="text" name="nombre_responsable" class="border w-full p-2 rounded">
        </div>

        {{-- 💻 Tipo de equipo --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Tipo de equipo</label>
            <select name="tipo_equipo_id" class="border w-full p-2 rounded" x-model="seleccionado">
                <option value="">Seleccione...</option>
                <template x-for="tipo in tipos" :key="tipo.id">
                    <option :value="tipo.id"
                            x-text="`${tipo.tipo_equipo} - ${tipo.marca ?? ''} ${tipo.modelo ?? ''}`"></option>
                </template>
            </select>
        </div>

        {{-- 📋 Detalles del tipo de equipo --}}
        <template x-if="seleccionado">
            <div class="border rounded p-3 bg-gray-50 mt-4">
                <h2 class="font-semibold mb-2 text-gray-700">Detalles del equipo</h2>
                <template x-for="tipo in tipos" :key="'info-' + tipo.id">
                    <div x-show="tipo.id == seleccionado">
                        <p><strong>Marca:</strong> <span x-text="tipo.marca"></span></p>
                        <p><strong>Modelo:</strong> <span x-text="tipo.modelo"></span></p>
                        <p><strong>Color:</strong> <span x-text="tipo.color"></span></p>
                        <p><strong>Accesorios:</strong> <span x-text="tipo.accesorios"></span></p>
                        <p><strong>Valor:</strong> $<span x-text="tipo.valor"></span></p>
                    </div>
                </template>
            </div>
        </template>

        {{-- 🔢 Serie e inventario --}}
        <div class="mt-6 mb-4">
            <div class="flex items-center justify-between mb-2">
                <label class="font-medium">Datos de identificación</label>
                <label class="flex items-center space-x-1">
                    <input type="checkbox" x-model="mismoValor">
                    <span>Mismo serie e inventario</span>
                </label>
            </div>

            <div class="mb-3">
                <label class="block font-medium">Número de serie</label>
                <input type="text" class="border w-full p-2 rounded" x-model="serie">
            </div>

            <div class="mb-3">
                <label class="block font-medium">Número de inventario</label>
                <input type="text" class="border w-full p-2 rounded" x-model="inventario" :disabled="mismoValor">
            </div>
        </div>

        {{-- 📦 Fecha de entrega (abajo, con opción indefinida) --}}
        <div class="mb-4 border-t pt-4 mt-6">
            <label class="block font-medium mb-1">Fecha de entrega</label>

            {{-- Opciones: indefinido / definir fecha --}}
            <div class="flex items-center space-x-4 mb-2">
                <label class="flex items-center space-x-1">
                    <input type="radio" name="fecha_opcion" value="indefinido" x-model="fechaIndefinida">
                    <span>Indefinido</span>
                </label>
                <label class="flex items-center space-x-1">
                    <input type="radio" name="fecha_opcion" :value="false" x-model="fechaIndefinida">
                    <span>Definir fecha</span>
                </label>
            </div>

            <input type="date"
                   name="fecha_entrega"
                   class="border w-full p-2 rounded"
                   x-model="fechaEntrega"
                   x-bind:disabled="fechaIndefinida">
        </div>

        {{-- 🔘 Botón --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Generar PDF
        </button>

        {{-- Campos ocultos --}}
        <input type="hidden" name="fecha_entrega_final"
               :value="fechaIndefinida ? 'Indefinida' : (fechaEntrega || '')">

        <input type="hidden" name="tipo_equipo"
               x-model="seleccionado ? tipos.find(t => t.id == seleccionado).tipo_equipo : ''">
        <input type="hidden" name="marca"
               x-model="seleccionado ? tipos.find(t => t.id == seleccionado).marca : ''">
        <input type="hidden" name="modelo"
               x-model="seleccionado ? tipos.find(t => t.id == seleccionado).modelo : ''">
        <input type="hidden" name="color"
               x-model="seleccionado ? tipos.find(t => t.id == seleccionado).color : ''">
        <input type="hidden" name="accesorios"
               x-model="seleccionado ? tipos.find(t => t.id == seleccionado).accesorios : ''">
        <input type="hidden" name="numero_serie" x-model="serie">
        <input type="hidden" name="numero_inventario" x-model="inventario">
        <input type="hidden" name="valor"
               x-model="seleccionado ? tipos.find(t => t.id == seleccionado).valor : ''">

    </form>
</div>
@endsection
