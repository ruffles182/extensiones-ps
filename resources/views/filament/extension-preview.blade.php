<div class="space-y-4">
    <p class="text-sm text-gray-500">
        Revisa el contenido generado. Puedes copiarlo haciendo clic en el botón de abajo.
    </p>

    <pre id="confContent"
         class="bg-gray-800 text-white p-4 rounded-lg overflow-x-auto text-sm">{{ $content }}</pre>


<x-filament::button
    color="primary"
    size="sm"
    icon="heroicon-o-clipboard"
    x-data="{ copied: false }"
    x-on:click="
        const text = document.getElementById('confContent').innerText.trim();
        navigator.clipboard.writeText(text)
            .then(() => { copied = true; setTimeout(() => copied = false, 1500); })
            .catch(err => alert('❌ Error al copiar: ' + err));
    "
    x-text="copied ? '¡Copiado!' : 'Copiar al portapapeles'"
>
</x-filament::button>

</div>

