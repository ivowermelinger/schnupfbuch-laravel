<script lang="ts">
import debounce from 'lodash/debounce';
import { handleAuthResponse, interactionAPI, activeLine } from '../stores';
import { getHeaders } from '../helpers';
import ThumbUp from '../svg/ThumbUp.svelte';

const addDislike = async () => {
    if (!$activeLine) return;

    const res = await fetch(`${$interactionAPI}/${$activeLine.id}/like`, {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify({
            liked: false,
            disliked: $activeLine?.disliked ? false : true,
        }),
    });

    const dislike = await handleAuthResponse(res);
    dislike && activeLine.set(dislike);
};
</script>

<button
    class="btn btn--icon"
    on:click|preventDefault={debounce(() => addDislike(), 1000, { leading: true, trailing: false })}
>
    <ThumbUp
        css="btn__icon btn__icon--lg btn__icon--rotate {$activeLine?.disliked ? 'btn--thumb' : ''}"
    />
</button>
