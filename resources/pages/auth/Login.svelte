<script>
	import Modal from '../components/Modal.svelte';
	import { showLogin, flashMessage } from '../stores';

	$: show = false;
	$: flash = null;

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
</script>

<Modal {show} closeModal={hideForm} name="Login Formular">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form class="form">
					<div class="form__group">
						<label class="form__label form__label--dark" for="email">E-Mail</label>
						<input class="form__input form__input--dark" type="email" id="email" required autocomplete="email" />
					</div>
					<div class="form__group">
						<label class="form__label form__label--dark" for="password">Passwort</label>
						<input class="form__input form__input--dark" type="passsword" name="password" id="password" required autocomplete="current-password" />
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
