<script context="module">
    export { default as layout } from '../layout/Layout.svelte';
</script>

<script>
    import { getHeaders } from '../helpers';

    import SimpleHeader from '../layout/SimpleHeader.svelte';
    import { handleFormResponse } from '../stores';

    $: globalError = null;

    let form;
    let email;

    const handleReset = async () => {
        globalError = null;

        const res = await fetch(`/password/forgot/send`, {
            method: 'POST',
            headers: getHeaders(),
            body: JSON.stringify({
                email,
            }),
        });

        const data = await handleFormResponse(form, res);

        if (data.success) {
            console.log(data);
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
                <h1 class="text__title spacer--mb-2">Passwort vergessen?</h1>

                <p class="spacer--mb-3 text__content">
                    Gib bitte deine E-Mail-Adresse ein, damit wir dir einen Link
                    zum Zurücksetzen deines Passworts senden können.
                </p>

                <form
                    class="form"
                    on:submit|preventDefault={handleReset}
                    novalidate
                    bind:this={form}
                >
                    <div class="form__group">
                        <label class="form__label" for="email">E-Mail</label>
                        <input
                            class="form__input"
                            type="email"
                            bind:value={email}
                            name="email"
                            id="email"
                            required
                            autocomplete="email"
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
            </div>
        </div>
    </div>
</main>
