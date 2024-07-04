<script>
	import { showLogin, user } from '../stores';
	import User from '../svg/User.svelte';
</script>

<header class="header" id="header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				{#if $user}
					<div class="header__user">
						<span class="header__name">{$user.nickname}</span>
						<a href="/logout" class="btn btn--primary btn--link">
							<span>Logout</span>
						</a>
					</div>
				{:else}
					<div class="header__user header__user--login">
						<button class="btn btn--primary btn--icon-filled" on:click|preventDefault={() => showLogin.set(true)}>
							<span>Login</span>
							<User css="btn__icon" />
						</button>
					</div>
				{/if}
			</div>
		</div>
	</div>
</header>
