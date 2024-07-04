import { readonly, writable } from 'svelte/store';

export const lines = writable([]);
export const activeLine = writable(null);
export const showLogin = writable(false);
export const interactionAPI = readonly(writable('/api/v1/interaction'));
export const dataAPI = readonly(writable('/api/v1'));
export const flashMessage = writable(null);

export const user = writable(null);

export const handleServerResponse = async (res) => {
	showLogin.set(res.status === 401);
	const json = await res.json();

	if (res.status === 401) {
		flashMessage.set(json.message);
		return null;
	}

	return json;
};
