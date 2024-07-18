<script context="module">
	export { default as layout } from './layout/Layout.svelte';
</script>

<script>
	import SimpleHeader from './layout/SimpleHeader.svelte';
	import { dataAPI, handleFormResponse } from './stores';
	import { badWords } from './bad-words';
	import debounce from 'lodash/debounce';
	import { getHeaders, validateForm } from './helpers';

	$: showNicknameError = false;

	let form;
	let matcher;

	let nickname = 'w4Yne';
	let email = 'ivo_wermelinger@hotmail.com';
	let first_name = 'Ivo';
	let last_name = 'Wermelinger';
	let password = 'Wovi1996';
	let password_confirmation = 'Wovi1996';

	const resetFields = () => {
		nickname = '';
		email = '';
		first_name = '';
		last_name = '';
		password = '';
		password_confirmation = '';
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

		const res = await fetch(`${$dataAPI}/auth/register`, {
			method: 'POST',
			headers: getHeaders(),
			body: JSON.stringify({
				nickname,
				email,
				first_name,
				last_name,
				password,
				password_confirmation,
			}),
		});

		const data = await handleFormResponse(form, res);

		if (data.success) {
			resetFields();
		}
	};
</script>

<SimpleHeader />

<main class="page">
	<div class="container">
		<div class="row flex--justify-center flex--no-wrap">
			<div class="col-12 col-s-8 col-m-6">
				<h1 class="text__title spacer--mb-1">Account erstellen</h1>

				<form class="form form--light" bind:this={form} on:submit|preventDefault={submitLine} novalidate>
					<div class="row">
						<div class="col-12 col-s-6">
							<div class="form__group">
								<label class="form__label form__label--no-mb" for="firstName">Vorname</label>
								<div class="form__notice">Wird nicht veröffentlicht</div>
								<input class="form__input" type="text" id="firstName" name="firstName" required bind:value={first_name} />
								<p class="form__hint"></p>
							</div>
						</div>
						<div class="col-12 col-s-6">
							<div class="form__group">
								<label class="form__label form__label--no-mb" for="lastName">Nachname</label>
								<div class="form__notice">Wird nicht veröffentlicht</div>
								<input class="form__input" type="text" id="lastName" name="lastName" required bind:value={last_name} />
								<p class="form__hint"></p>
							</div>
						</div>
					</div>

					<div class="form__group" class:form__group--nickname={showNicknameError}>
						<label class="form__label" for="nickname">Nickname</label>
						<div class="form__notice">Nur Buchstaben, Zahlen, Unterstriche und Bindestriche erlaubt</div>
						<input class="form__input" id="nickname" name="nickname" pattern="([A-Za-z0-9\-_]+)" required bind:value={nickname} on:keyup={debounce(() => checkNickname(), 250)} />
						<p class="form__hint"></p>
						{#if showNicknameError && nickname}
							<p class="form__error">Verwende keine beleidigenden Wörter</p>
						{/if}
					</div>

					<div class="form__group">
						<label class="form__label form__label--no-mb" for="email">E-Mail</label>
						<div class="form__notice">Wird nicht veröffentlicht</div>
						<input class="form__input" id="email" name="email" type="email" required bind:value={email} />
						<p class="form__hint"></p>
					</div>

					<div class="form__group">
						<label class="form__label" for="password">Passwort</label>
						<div class="form__notice">Mindestens 8 Zeichen</div>
						<input class="form__input" type="password" minlength="8" name="password" id="password" required autocomplete="current-password" bind:value={password} />
						<p class="form__hint"></p>
					</div>

					<div class="form__group">
						<label class="form__label" for="passwordConfirm">Passwort bestätigen</label>
						<input class="form__input" type="password" minlength="8" name="password_confirmation" required id="password_confirmation" autocomplete="current-password" bind:value={password_confirmation} />
						<p class="form__hint"></p>
					</div>

					<div class="form__group form__group--button">
						<button type="submit" class="btn btn--primary">
							<span>Account erstellen</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
