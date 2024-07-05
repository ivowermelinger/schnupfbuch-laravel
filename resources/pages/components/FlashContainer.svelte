<script>
	import { flashMessage } from '../stores';
	import FlashMessage from './Flashmessage.svelte';
</script>

<div class="message__container" class:message__container--show={$flashMessage}>
	{#if $flashMessage}
		<FlashMessage item={$flashMessage} />
	{/if}
</div>
