<script>
    window.copyToClipboard = function (text) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text)
                .then(() => alert('✅ Copiado correctamente'))
                .catch(err => alert('❌ Error al copiar: ' + err));
        } else {
            const el = document.createElement('textarea');
            el.value = text;
            el.style.position = 'fixed';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.focus();
            el.select();
            try {
                document.execCommand('copy');
                alert('✅ Copiado correctamente (fallback)');
            } catch (err) {
                alert('❌ Error al copiar: ' + err);
            }
            document.body.removeChild(el);
        }
    };
</script>
