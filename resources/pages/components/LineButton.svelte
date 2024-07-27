<script lang="ts">
import debounce from 'lodash/debounce';
import { activeLine } from '../stores';

export let setLine;

const callSetLine = () => {
    setLine ? setLine() : () => {};
};
</script>

<button
    on:click|preventDefault={debounce(() => callSetLine(), 100, { leading: true, trailing: false })}
    class="btn btn--loading touch__trigger"
>
    {#if $activeLine}
        <span class="touch__line" data-id={$activeLine.id}
            >{$activeLine.line}</span
        >
        <span class="touch__author">{$activeLine.nickname}</span>
    {/if}
</button>
