<script>
	import Modal from '../components/Modal.svelte';
	$: show = false;

	const showForm = () => {
		show = true;
	};
</script>

<Modal bind:show name="Spruch erfassen">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<form class="form">
					<div class="form__group">
						<label class="form__label form__label--dark" for="line">Spruch</label>
						<textarea class="form__input form__input--dark" id="line" name="name" required />
					</div>
					<div class="form__group">
						<label class="form__label form__label--dark" for="author">Autor / Nickname</label>
						<input class="form__input form__input--dark" id="author" name="author" required />
					</div>
					<div class="row">
						<div class="col-12 col-s-6">
							<div class="form__group">
								<label class="form__label form__label--dark form__label--no-mb" for="firstName">Vorname</label>
								<div class="form__notice">wird nicht veröffentlicht</div>
								<input class="form__input form__input--dark" type="text" id="firstName" name="firstName" required />
							</div>
						</div>
						<div class="col-12 col-s-6">
							<div class="form__group">
								<label class="form__label form__label--dark form__label--no-mb" for="lastName">Nachname</label>
								<div class="form__notice">wird nicht veröffentlicht</div>
								<input class="form__input form__input--dark" type="text" id="lastName" name="lastName" required />
							</div>
						</div>
					</div>
					<div class="form__group">
						<label class="form__label form__label--dark form__label--no-mb" for="email">E-Mail</label>
						<div class="form__notice">wird nicht veröffentlicht</div>
						<input class="form__input form__input--dark" id="email" name="email" type="email" required />
					</div>
					<div class="form__group">
						<button class="btn btn--dark">
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
