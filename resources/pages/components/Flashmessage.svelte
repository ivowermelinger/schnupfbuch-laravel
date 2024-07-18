<script>
	import Close from '../svg/Close.svelte';
	import { onMount } from 'svelte';
	import { flashMessage } from '../stores';

	export let item;
	let message;

	const duration = 5100;
	const fadeDuration = 400;

	onMount(() => {
		setTimeout(() => {
			message.classList.add('message--show');
		}, 100);

		setTimeout(closeMessage, duration);
	});

	const closeMessage = () => {
		message.classList.remove('message--show');

		setTimeout(() => {
			flashMessage.set(null);
		}, fadeDuration);
	};
</script>

{#if item}
	<div class="message message--{item.severity}" style="--duration:{duration}ms; --slide-duration:{fadeDuration}ms;" bind:this={message}>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="message__inner">
						<span>{item.message}</span>
						<button class="message__close" on:click|preventDefault={closeMessage}>
							<span class="visually-hidden">Sidebar schliessen</span>
							<Close css="message__icon" />
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
{/if}
