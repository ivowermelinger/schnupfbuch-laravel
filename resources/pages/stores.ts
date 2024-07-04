import { readonly, writable } from 'svelte/store';

const lines = writable([]);
const activeLine = writable(null);
const showLogin = writable(false);
const interactionAPI = readonly(writable('/api/v1/interaction'));
const flashMessage = writable(null);

const handleServerResponse = async (res) => {
	showLogin.set(res.status === 401);
	const json = await res.json();

	if (res.status === 401) {
		flashMessage.set(json.message);
	}

	return json;
};

export { lines, activeLine, interactionAPI, showLogin, flashMessage, handleServerResponse };
