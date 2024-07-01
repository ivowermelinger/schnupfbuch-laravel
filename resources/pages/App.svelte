<script context="module">
     export { default as layout } from './layout/Layout.svelte';
</script>

<script>
    import { get } from 'svelte/store'
    import { activeLine, lines } from './stores';
    import { onMount } from 'svelte';
    import LineButton from './components/LineButton.svelte';
	import LikeButton from './components/LikeButton.svelte';
	import DislikeButton from './components/DislikeButton.svelte';
	import { getHeaders } from './helpers';

    const lineAPI = 'api/v1/list';
    const interactionAPI = 'api/v1/interaction';

    let counter = 0;


    onMount(async () => {
        await getList();
        setLine();
    });

    const getList = async () => {
        const res = await fetch(lineAPI);
        const list = await res.json();

        lines.set(list);
    }

    const addView = async () => {
        if (!get(activeLine).id) return;

        const res = await fetch(`${interactionAPI}/${get(activeLine).id}/view`, {
            method: 'POST',
            headers: getHeaders(),
        });

        const data = await res.json();
        console.log(data);
    }

    const setLine = async () =>  {
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
    }

</script>

<div class="container full-height">
    <div class="row full-height">
        <div class="col-12">
            <div class="touch__area">
                <LineButton setLine={setLine} />

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
</div>
