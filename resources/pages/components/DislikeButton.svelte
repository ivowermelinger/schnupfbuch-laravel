<script lang="ts">
	import debounce from 'lodash/debounce';
	import { get } from 'svelte/store';
	import { handleServerResponse, interactionAPI } from '../stores';
	import { getHeaders } from '../helpers';

	const api = get(interactionAPI);
	export let item;
	export let updateItem;

	const addDislike = async () => {
		if (!item) return;

		const res = await fetch(`${api}/${item.id}/like`, {
			method: 'POST',
			headers: getHeaders(),
			body: JSON.stringify({
				liked: false,
				disliked: item?.disliked ? false : true,
			}),
		});

		const like = await handleServerResponse(res);
		like?.success && updateItem(like);
	};
</script>

<button class="btn btn--icon" on:click|preventDefault={debounce(() => addDislike(), 1000, { leading: true, trailing: false })}>
	<span>
		<span>dislike</span>

		{#if item?.disliked}
			disliked it
		{/if}
	</span>
</button>
