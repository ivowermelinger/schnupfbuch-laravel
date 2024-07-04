<script>
	import { showLogin, flashMessage } from '../stores';
	import Close from '../svg/Close.svelte';

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

<div class="login__wrapper" class:login__wrapper--show={show}>
	<button class="login__back" on:click|preventDefault={hideForm}>
		<span class="visually-hidden">Login schliessen</span>
	</button>
	<div class="login__inner">
		<button class="login__close" on:click|preventDefault={hideForm}>
			<span class="visually-hidden">Login schliessen</span>
			<Close css="login__icon" />
		</button>
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
	</div>
</div>
