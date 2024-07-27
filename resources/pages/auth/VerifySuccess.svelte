<script context="module">
    export { default as layout } from '../layout/Layout.svelte';
</script>

<script>
    import SimpleHeader from '../layout/SimpleHeader.svelte';
</script>

<SimpleHeader />

<main class="page">
    <div class="container">
        <div class="row flex--justify-center flex--no-wrap">
            <div class="col-12 col-s-8 col-m-6">
                <h1 class="text__title spacer--mb-1">
                    Registrierung erfolgreich
                </h1>

                <p class="spacer--mb-1 text__small">
                    Ihre E-Mail-Adresse wurde erfolgreich bestätigt. Ihr Konto
                    ist nun aktiviert und Sie können alle Funktionen der App
                    nutzen.
                </p>

                <a href="/login" class="btn btn--primary">Zum Login</a>
            </div>
        </div>
    </div>
</main>
