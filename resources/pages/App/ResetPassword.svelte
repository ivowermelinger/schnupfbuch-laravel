<script context="module">
    export { default as layout } from '../layout/Layout.svelte';
</script>

<script>
    import { page } from '@inertiajs/svelte';
    import { getHeaders } from '../helpers';
    import SimpleHeader from '../layout/SimpleHeader.svelte';
    import { handleFormResponse } from '../stores';

    $: globalError = null;
    $: resetSuccess = false;

    let form;
    let password = '';
    let password_confirmation = '';

    const handleReset = async () => {
        globalError = null;

        const res = await fetch(`/password/reset/save`, {
            method: 'POST',
            headers: getHeaders(),
            body: JSON.stringify({
                password,
                password_confirmation,
                token: $page.props.token,
                email: $page.props.email,
            }),
        });

        const data = await handleFormResponse(form, res);

        if (data.success) {
            resetSuccess = true;
        } else {
            globalError = data?.message;
        }
    };
</script>

<SimpleHeader />
<main class="main">
    <div class="container">
        <div class="row flex--justify-center">
            <div class="col-12 col-s-10 col-m-6 spacer--mt-2">
                <h1 class="text__title spacer--mb-2">Passwort zurücksetzen</h1>

                {#if resetSuccess}
                    <p class="text__content spacer--mt-2 spacer--mb-2">
                        Passwort erfolgreich zurückgesetzt.
                    </p>
                    <a href="/login" class="btn btn--primary">
                        <span>Zum Login</span>
                    </a>
                {:else}
                    <form
                        class="form"
                        on:submit|preventDefault={handleReset}
                        novalidate
                        bind:this={form}
                    >
                        <div class="form__group">
                            <label class="form__label" for="password"
                                >Passwort</label
                            >
                            <input
                                class="form__input"
                                type="password"
                                bind:value={password}
                                name="password"
                                id="password"
                                required
                            />
                            <p class="form__hint"></p>
                        </div>

                        <div class="form__group">
                            <label
                                class="form__label"
                                for="password_confirmation"
                                >Passwort bestätigen</label
                            >
                            <input
                                class="form__input"
                                type="password"
                                bind:value={password_confirmation}
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                            />
                            <p class="form__hint"></p>
                        </div>

                        {#if globalError}
                            <p class="form__error">{globalError}</p>
                        {/if}

                        <div class="form__group form__group--button">
                            <button class="btn btn--primary" type="submit">
                                <span>Link anfordern</span>
                            </button>
                        </div>
                    </form>
                {/if}
            </div>
        </div>
    </div>
</main>
