<script>
	import Close from '../svg/Close.svelte';

	export let show = false;
	export let closeModal = () => {
		show = false;
	};
	export let name = 'Modal';
</script>

<div class="modal__wrapper" class:modal__wrapper--show={show}>
	<button class="modal__back" on:click|preventDefault={closeModal}>
		<span class="visually-hidden">{`${name} schliessen`}</span>
	</button>
	<div class="modal__inner">
		<button class="modal__close" on:click|preventDefault={closeModal}>
			<span class="visually-hidden">{`${name} schliessen`}</span>
			<Close css="modal__icon" />
		</button>
		<slot />
	</div>
</div>
