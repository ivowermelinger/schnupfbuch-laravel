<script lang="ts">
	import debounce from 'lodash/debounce';
	import { interactionAPI, handleAuthResponse, activeLine } from '../stores';
	import { getHeaders } from '../helpers';
	import ThumbUp from '../svg/ThumbUp.svelte';

	const addLike = async () => {
		if (!$activeLine) return;

		const res = await fetch(`${$interactionAPI}/${$activeLine.id}/like`, {
			method: 'POST',
			headers: getHeaders(),
			body: JSON.stringify({
				liked: $activeLine?.liked ? false : true,
				disliked: false,
			}),
		});

		const like = await handleAuthResponse(res);
		like && activeLine.set(like);
	};
</script>

<button class="btn btn--icon" on:click|preventDefault={debounce(() => addLike(), 1000, { leading: true, trailing: false })}>
	<ThumbUp css="btn__icon btn__icon--lg {$activeLine?.liked ? 'btn--thumb' : ''}" />
</button>
