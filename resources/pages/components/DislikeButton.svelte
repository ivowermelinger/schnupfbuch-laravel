<script lang="ts">
    import debounce from 'lodash/debounce';
    import { get } from 'svelte/store';
    import { interactionAPI } from '../stores';
	import { getHeaders } from '../helpers';

    const api = get(interactionAPI);
    export let item;

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

        const like = await res.json();
        console.log(like);
    }
</script>

<button
    class="btn btn--icon"
    on:click|preventDefault={debounce(() => addDislike(), 1000, { leading: true, trailing: false })}>
    <span>dislike

        {#if item?.disliked}
            disliked it
        {/if}

    </span>
</button>
