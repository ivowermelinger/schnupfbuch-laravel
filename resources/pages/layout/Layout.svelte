<script>
    import Header from  './Header.svelte';
    import Footer from  './Footer.svelte';
</script>

<div class="app">
    <Header />
        <main class="main">
            <slot/>
        </main>
    <Footer />
</div>
