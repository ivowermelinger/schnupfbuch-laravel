import { readonly, writable } from "svelte/store";

const lines = writable([]);
const activeLine = writable(null);

export { lines, activeLine };
