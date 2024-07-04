import { readonly, writable } from "svelte/store";

const lines = writable([]);
const activeLine = writable(null);

const interactionAPI = readonly(writable('/api/v1/interaction'));

export { lines, activeLine, interactionAPI };
