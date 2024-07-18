<script>
	import { dataAPI, handleServerResponse } from '../stores';
	import { badWords } from '../bad-words';
	import Modal from '../components/Modal.svelte';
	import debounce from 'lodash/debounce';
	import { getHeaders, validateForm } from '../helpers';

	$: show = false;
	$: showNicknameError = false;

	let form;
	let matcher;

	let nickname = '';
	let email = '';
	let first_name = '';
	let last_name = '';
	let line = '';

	const resetFields = () => {
		nickname = '';
		email = '';
		first_name = '';
		last_name = '';
		line = '';
	};

	const showForm = () => {
		show = true;
	};

	const initMatcher = async () => {
		const { RegExpMatcher, pattern, englishDataset, englishRecommendedTransformers } = await import('obscenity');

		const blacklistedTerms = [];

		badWords.forEach((word, index) => {
			blacklistedTerms.push({ id: index, pattern: pattern`${word}` });
		});

		matcher = new RegExpMatcher({
			...englishDataset.build(),
			...englishRecommendedTransformers,
			blacklistedTerms: blacklistedTerms,
		});
	};

	const checkNickname = async () => {
		if (!matcher) await initMatcher();
		showNicknameError = matcher.hasMatch(nickname);
	};

	const submitLine = async () => {
		const errors = validateForm(form);
		if (errors.length || showNicknameError) return;

		const res = await fetch(`${$dataAPI}/line`, {
			method: 'POST',
			headers: getHeaders(),
			body: JSON.stringify({
				line,
				nickname,
				email,
				first_name,
				last_name,
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
				<form class="form" bind:this={form} on:submit|preventDefault={submitLine} novalidate>
					<div class="form__group">
						<label class="form__label form__label--dark" for="line">Spruch</label>
						<textarea class="form__input form__input--dark" id="line" name="name" required bind:value={line} />
						<p class="form__hint"></p>
					</div>
					<div class="form__group" class:form__group--nickname={showNicknameError}>
						<label class="form__label form__label--dark" for="nickname">Autor / Nickname</label>
						<div class="form__notice">Nur Buchstaben, Zahlen, Unterstriche und Bindestriche erlaubt</div>
						<input class="form__input form__input--dark" id="nickname" name="nickname" pattern="([A-Za-z0-9\-_]+)" required bind:value={nickname} on:keyup={debounce(() => checkNickname(), 250)} />
						<p class="form__hint"></p>
						{#if showNicknameError && nickname}
							<p class="form__error">Verwende keine beleidigenden Wörter</p>
						{/if}
					</div>
					<div class="row">
						<div class="col-12 col-s-6">
							<div class="form__group">
								<label class="form__label form__label--dark form__label--no-mb" for="firstName">Vorname</label>
								<div class="form__notice">Wird nicht veröffentlicht</div>
								<input class="form__input form__input--dark" type="text" id="firstName" name="firstName" required bind:value={first_name} />
								<p class="form__hint"></p>
							</div>
						</div>
						<div class="col-12 col-s-6">
							<div class="form__group">
								<label class="form__label form__label--dark form__label--no-mb" for="lastName">Nachname</label>
								<div class="form__notice">Wird nicht veröffentlicht</div>
								<input class="form__input form__input--dark" type="text" id="lastName" name="lastName" required bind:value={last_name} />
								<p class="form__hint"></p>
							</div>
						</div>
					</div>
					<div class="form__group">
						<label class="form__label form__label--dark form__label--no-mb" for="email">E-Mail</label>
						<div class="form__notice">Wird nicht veröffentlicht</div>
						<input class="form__input form__input--dark" id="email" name="email" type="email" required bind:value={email} />
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
