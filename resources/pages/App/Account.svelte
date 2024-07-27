<script context="module">
    export { default as layout } from '../layout/Layout.svelte';
</script>

<script>
    import Header from '../layout/Header.svelte';
</script>

<Header />

<main class="main">
    <div class="container">
        <div class="row flex--justify-center flex--no-wrap">
            <div class="col-12 col-s-8 col-m-6">
                <h1 class="text__title spacer--mb-1">Dein Account</h1>
                <p class="text__content">Settings Coming soon...</p>
            </div>
        </div>
    </div>
</main>
