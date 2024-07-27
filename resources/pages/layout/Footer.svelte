<script>
    import { dataAPI, handleServerResponse } from '../stores';
    import Modal from '../components/Modal.svelte';
    import { getHeaders, validateForm } from '../helpers';
    import { user, showLogin, flashMessageAuth } from '../stores';

    $: show = false;
    $: showNicknameError = false;

    let form;

    let line = '';

    const resetFields = () => {
        line = '';
    };

    const showForm = () => {
        // Check if the user is authenticated
        if (!$user) {
            showLogin.set(true);
            flashMessageAuth.set(
                'Für diese Aktion müssen Sie angemeldet sein.'
            );
            return;
        }

        show = true;
    };

    const submitLine = async () => {
        const errors = validateForm(form);
        if (errors.length || showNicknameError) return;

        const res = await fetch(`${$dataAPI}/line`, {
            method: 'POST',
            headers: getHeaders(),
            body: JSON.stringify({
                line,
            }),
        });

        const data = await handleServerResponse(res);

        if (data.success) {
            resetFields();
            show = false;
        }
    };
</script>

<Modal bind:show name="Spruch erfassen">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form
                    class="form"
                    bind:this={form}
                    on:submit|preventDefault={submitLine}
                    novalidate
                >
                    <div class="form__group">
                        <label class="form__label form__label--dark" for="line"
                            >Spruch</label
                        >
                        <textarea
                            class="form__input form__input--dark"
                            id="line"
                            name="name"
                            required
                            bind:value={line}
                        />
                        <p class="form__hint"></p>
                    </div>

                    <div class="form__group form__group--button">
                        <button class="btn btn--primary">
                            <span>Spruch erfassen</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</Modal>

<footer class="footer">
    <div class="container">
        <button class="btn btn--primary" on:click|preventDefault={showForm}>
            <span>Spruch erfassen</span>
        </button>
    </div>
</footer>
