<script context="module">
	export { default as layout } from './layout/Layout.svelte';
</script>

<script>
<<<<<<< HEAD
    import { get } from 'svelte/store'
    import { activeLine, lines, interactionAPI } from './stores';
    import { onMount } from 'svelte';
    import LineButton from './components/LineButton.svelte';
=======
	import { page } from '@inertiajs/svelte';
	import { get } from 'svelte/store';
	import { activeLine, lines } from './stores';
	import { onMount } from 'svelte';
	import LineButton from './components/LineButton.svelte';
>>>>>>> faadf0463c85227e6dcc3213ad7e874d5984b33d
	import LikeButton from './components/LikeButton.svelte';
	import DislikeButton from './components/DislikeButton.svelte';
	import { getHeaders } from './helpers';

<<<<<<< HEAD
    const lineAPI = 'api/v1/list';

    let counter = 0;
    let item = {};

    activeLine.subscribe(value => {
        item = value;
    });
=======
	const lineAPI = 'api/v1/list';
	const interactionAPI = 'api/v1/interaction';

	let counter = 0;
>>>>>>> faadf0463c85227e6dcc3213ad7e874d5984b33d

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

<<<<<<< HEAD
        const res = await fetch(`${get(interactionAPI)}/${get(activeLine).id}/view`, {
            method: 'POST',
            headers: getHeaders(),
        });

        const data = await res.json();
    }

    const updateItem = item => {
        activeLine.set(item);
    }
=======
		const data = await res.json();
	};

	const setLine = async () => {
		if (counter < 10 && get(lines)[counter]) {
			activeLine.set(get(lines)[counter]);
>>>>>>> faadf0463c85227e6dcc3213ad7e874d5984b33d

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
<<<<<<< HEAD
    <div class="row full-height">
        <div class="col-12">
            <div class="touch__area">

                <LineButton bind:item={item} setLine={setLine} />

                <div class="row">
                    <div class="col-6">
                        <LikeButton bind:item={item} updateItem={updateItem}/>
                    </div>
                    <div class="col-6">
                        <DislikeButton bind:item={item} updateItem={updateItem}/>
                    </div>
                </div>
            </div>
        </div>
    </div>
=======
	<div class="row full-height">
		<div class="col-12">
			<div class="touch__area">
				<LineButton {setLine} />

				<div class="row">
					<div class="col-6">
						<LikeButton />
					</div>
					<div class="col-6">
						<DislikeButton />
					</div>
				</div>
			</div>
		</div>
	</div>
>>>>>>> faadf0463c85227e6dcc3213ad7e874d5984b33d
</div>
