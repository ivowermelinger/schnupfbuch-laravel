<script>
	import { onMount } from 'svelte';
	import { showLogin, user } from '../stores';
	import User from '../svg/User.svelte';
	import Sidebar from '../components/Sidebar.svelte';

	$: svg = '';
	$: show = false;

	onMount(async () => {
		if (!$user) return;

		const creator = await import('@dicebear/core');
		const styles = await import('@dicebear/collection');

		const avatar = creator.createAvatar(styles.funEmoji, {
			seed: $user.nickname,
			backgroundColor: ['b6e3f4', 'c0aede', 'd1d4f9'],
			backgroundType: ['gradientLinear', 'solid'],
			radius: 50,
			size: 128,
		});

		svg = avatar.toString();
	});
</script>

<header class="header" id="header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				{#if $user}
					<button class="header__user" on:click|preventDefault={() => (show = true)}>
						<span class="visually-hidden">Sidebar öffnen</span>
						{#if svg}
							{@html svg}
						{/if}
					</button>
				{:else}
					<div class="header__user header__user--login">
						<button class="btn btn--link" on:click|preventDefault={() => showLogin.set(true)}>
							<span>Login</span>
						</button>
					</div>
				{/if}
			</div>
		</div>
	</div>
</header>

<Sidebar picture={svg} bind:show />
