<script>
import Layout from '../layout/Layout.svelte';
import SimpleHeader from '../layout/SimpleHeader.svelte';
</script>

<Layout>
    <SimpleHeader />

    <main class="page">
        <div class="container">
            <div class="row flex--justify-center flex--no-wrap">
                <div class="col-12 col-s-8 col-m-6">
                    <h1 class="text__title spacer--mb-1">
                        Registrierung erfolgreich
                    </h1>

                    <p class="spacer--mb-1 text__small">
                        Ihre E-Mail-Adresse wurde erfolgreich bestätigt. Ihr
                        Konto ist nun aktiviert und Sie können alle Funktionen
                        der App nutzen.
                    </p>

                    <a href="/" class="btn btn--primary">Zur App</a>
                </div>
            </div>
        </div>
    </main>
</Layout>
