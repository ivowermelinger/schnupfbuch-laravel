<script context="module">
    export { default as layout } from '../layout/Layout.svelte';
</script>

<script>
    import { page } from '@inertiajs/svelte';
    import SimpleHeader from '../layout/SimpleHeader.svelte';
</script>

<SimpleHeader />

<main class="page">
    <div class="container">
        <div class="row flex--justify-center flex--no-wrap">
            <div class="col-12 col-s-8 col-m-6">
                <h1 class="text__title spacer--mb-1">
                    Aktivierungslink abgelaufen
                </h1>

                <p class="spacer--mb-1 text__small">
                    Ihr Aktivierungslink für die Registrierung ist abgelaufen.
                    Bitte klicken Sie auf den untenstehenden Link, um eine neue
                    E-Mail zur Bestätigung Ihrer Registrierung zu erhalten.
                    Überprüfen Sie anschließend Ihren Posteingang und folgen Sie
                    den Anweisungen, um Ihr Konto zu aktivieren. Prüfen Sie auch
                    Ihren Spam-Ordner
                </p>

                <form
                    action="/verify/resend/{$page.props.userToRefresh ?? 39}"
                    novalidate
                    method="POST"
                >
                    <button class="btn btn--primary" type="submit"
                        >E-Mail erneut senden</button
                    >
                </form>
            </div>
        </div>
    </div>
</main>
