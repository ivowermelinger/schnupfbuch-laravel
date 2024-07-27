<script context="module">
    export { default as layout } from '../layout/Layout.svelte';
</script>

<script>
    import SimpleHeader from '../layout/SimpleHeader.svelte';
    import { getHeaders } from '../helpers';
    import { handleFormResponse, flashMessageAuth, dataAPI } from '../stores';

    $: globalError = null;

    let form;

    let email = '';
    let password = '';

    const handleLogin = async () => {
        globalError = null;

        const res = await fetch(`${$dataAPI}/auth/login`, {
            method: 'POST',
            headers: getHeaders(),
            body: JSON.stringify({
                email,
                password,
            }),
        });

        const data = await handleFormResponse(form, res);

        if (data.success) {
            // Redirect to homepage
            window.location.href = '/';
        } else {
            globalError = data.message;
        }
    };
</script>

<SimpleHeader />
<main class="main">
    <div class="container">
        <div class="row flex--justify-center">
            <div class="col-12 col-s-10 col-m-6 spacer--mt-2">
                <h1 class="text__title spacer--mb-2">Login</h1>

                <form
                    class="form"
                    on:submit|preventDefault={handleLogin}
                    novalidate
                    bind:this={form}
                >
                    <div class="form__group">
                        <label class="form__label" for="email">E-Mail</label>
                        <input
                            class="form__input"
                            type="email"
                            name="email"
                            id="email"
                            required
                            autocomplete="email"
                            bind:value={email}
                        />
                        <p class="form__hint"></p>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="password"
                            >Passwort</label
                        >
                        <input
                            class="form__input"
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            bind:value={password}
                        />
                        <p class="form__hint"></p>
                    </div>

                    {#if globalError}
                        <p class="form__error">{globalError}</p>
                    {/if}

                    <div class="form__group form__group--button">
                        <button class="btn btn--primary" type="submit">
                            <span>Login</span>
                        </button>
                    </div>
                </form>

                <div class="login__links">
                    <a href="/register" class="login__link">Registrieren</a>
                    <a href="/password/forgot" class="login__link"
                        >Passwort vergessen?</a
                    >
                </div>
            </div>
        </div>
    </div>
</main>
