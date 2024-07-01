<script lang="ts">
    const addDislike = () => {
        console.log('dislike');
    }
</script>

<button on:click|preventDefault={addDislike} class="btn btn--icon">
    <span>dislike</span>
</button>
