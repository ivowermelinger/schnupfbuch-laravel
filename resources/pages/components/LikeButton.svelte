<script lang="ts">
    import debounce from 'lodash/debounce';
    import { get } from 'svelte/store';
    import { interactionAPI } from '../stores';
	import { getHeaders } from '../helpers';

    const api = get(interactionAPI);
    export let item;
    export let updateItem;

    const addLike = async () => {
        if (!item) return;

        const res = await fetch(`${api}/${item.id}/like`, {
            method: 'POST',
            headers: getHeaders(),
            body: JSON.stringify({
                liked: item?.liked ? false : true,
                disliked: false,
            }),
        });

        const like = await res.json();
        updateItem(like);
    }
</script>

<button
    class="btn btn--icon"
    on:click|preventDefault={debounce(() => addLike(), 1000, { leading: true, trailing: false })}>
    <span>like


        {#if item?.liked}
            liked it
        {/if}
    </span>
</button>
