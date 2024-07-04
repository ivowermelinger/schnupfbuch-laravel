<script context="module">
	export { default as layout } from './layout/Layout.svelte';
</script>

<script>
	import { page } from '@inertiajs/svelte';
	import { get } from 'svelte/store';
	import { activeLine, lines, interactionAPI } from './stores';
	import { onMount } from 'svelte';
	import LineButton from './components/LineButton.svelte';
	import LikeButton from './components/LikeButton.svelte';
	import DislikeButton from './components/DislikeButton.svelte';
	import { getHeaders } from './helpers';

	const lineAPI = 'api/v1/list';

	let counter = 0;
	let item = {};

	activeLine.subscribe((value) => {
		item = value;
	});

	onMount(async () => {
		await getList();
		setLine();
	});

	const getList = async () => {
		const res = await fetch(lineAPI);
		const list = await res.json();

		lines.set(list);
	};

	const addView = async () => {
		if (!get(activeLine).id || !$page.props.user) return;

		const res = await fetch(`${interactionAPI}/${get(activeLine).id}/view`, {
			method: 'POST',
			headers: getHeaders(),
		});

		const data = await res.json();
	};

	const updateItem = (item) => {
		activeLine.set(item);
	};

	const setLine = async () => {
		if (counter < 10 && get(lines)[counter]) {
			activeLine.set(get(lines)[counter]);

			// Add a view to this line
			addView();
		} else {
			counter = 0;
			await getList();
			setLine();
		}

		counter++;
	};
</script>

<div class="container full-height">
	<div class="row full-height">
		<div class="col-12">
			<div class="touch__area">
				<LineButton bind:item {setLine} />

				<div class="row">
					<div class="col-6">
						<LikeButton bind:item {updateItem} />
					</div>
					<div class="col-6">
						<DislikeButton bind:item {updateItem} />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
