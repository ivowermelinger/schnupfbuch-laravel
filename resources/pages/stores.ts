import { readonly, writable, get } from 'svelte/store';

export const lines = writable([]);
export const activeLine = writable(null);
export const showLogin = writable(false);
export const interactionAPI = readonly(writable('/api/v1/interaction'));
export const dataAPI = readonly(writable('/api/v1'));
export const flashMessageAuth = writable(null);
export const flashMessage = writable(null);

export const user = writable(null);

export const handleAuthResponse = async (res) => {
	showLogin.set(res.status === 401);
	const json = await res.json();

	if (res.status === 401) {
		flashMessageAuth.set(json.message);
		return null;
	}

	return json;
};

export const handleServerResponse = async (res) => {
	const json = await res.json();

	flashMessage.set({
		message: json.message,
		severity: res.ok ? 'success' : 'error',
	});

	return json;
};

export const handleFormResponse = async (form: HTMLFormElement, res) => {
	const json = await res.json();

	const removeErrorClass = (input: HTMLElement) => {
		input.parentElement?.classList.remove('form__group--error');
	};

	const addErrorClass = (input: HTMLElement) => {
		input.parentElement?.classList.add('form__group--error');
	};

	if (res.ok) {
		flashMessage.set({
			message: json.message,
			severity: res.ok ? 'success' : 'error',
		});

		return json;
	}

	const inputs = form.querySelectorAll<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>('input, select, textarea');

	inputs.forEach((input) => {
		const errors = json.errors[input.name];
		removeErrorClass(input);
		if (!errors) return;

		addErrorClass(input);
		const hint = input.parentElement?.querySelector<HTMLElement>('.form__hint');

		if (!hint) return;
		hint.textContent = errors.join(', ');
	});

	return json;
};
