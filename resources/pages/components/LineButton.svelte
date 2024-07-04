<script lang="ts">
    import debounce from 'lodash/debounce';

    export let setLine;
    export let item;

    const callSetLine = () => {
        setLine ? setLine() : () => {};
    }
</script>

<button
    on:click|preventDefault={debounce(() => callSetLine(), 100, { leading: true, trailing: false })}
      class="btn btn--loading touch__trigger">
    {#if item}
        <span class="touch__line">{item.line}</span>
        <span class="touch__author">{item.nickname}</span>
    {/if}
</button>
