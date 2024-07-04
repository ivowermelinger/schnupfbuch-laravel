<script>
	import Modal from '../components/Modal.svelte';
	import { getHeaders } from '../helpers';
	import { showLogin, flashMessage, dataAPI } from '../stores';

	$: show = false;
	$: flash = null;

	let email = '';
	let password = '';

	showLogin.subscribe((value) => {
		show = value;
	});

	flashMessage.subscribe((value) => {
		flash = value;
	});

	const hideForm = () => {
		showLogin.set(false);
		flashMessage.set(null);
	};

	const handleLogin = async () => {
		const res = await fetch(`${$dataAPI}/auth/login`, {
			method: 'POST',
			headers: getHeaders(),
			body: JSON.stringify({
				email,
				password,
			}),
		});

		const login = await res.json();
		login?.success ? window.location.reload() : flashMessage.set(login?.message);
	};
</script>

<Modal {show} closeModal={hideForm} name="Login Formular">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form class="form" on:submit|preventDefault={handleLogin}>
					<div class="form__group">
						<label class="form__label form__label--dark" for="email">E-Mail</label>
						<input class="form__input form__input--dark" type="email" id="email" required autocomplete="email" bind:value={email} />
					</div>
					<div class="form__group">
						<label class="form__label form__label--dark" for="password">Passwort</label>
						<input class="form__input form__input--dark" type="password" name="password" id="password" required autocomplete="current-password" bind:value={password} />
					</div>
					<div class="form__group form__group--button">
						<button class="btn btn--dark" type="submit">
							<span>Login</span>
						</button>
					</div>
				</form>

				{#if flash}
					<p class="login__message">{flash}</p>
				{/if}

				<div class="login__links">
					<a href="/register" class="login__link">Registrieren</a>
					<a href="/password/reset" class="login__link">Passwort vergessen?</a>
				</div>
			</div>
		</div>
	</div>
</Modal>
