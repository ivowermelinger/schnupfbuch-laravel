<script>
	import Close from '../svg/Close.svelte';
	export let show = true;
</script>

<div class="login__wrapper" class:login__wrapper--show={show}>
	<div class="login__back"></div>
	<div class="login__inner">
		<button class="login__close" on:click={() => (show = false)}>
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
				</div>
			</div>
		</div>
	</div>
</div>
