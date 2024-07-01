<script lang="ts">
    const addLike = () => {
        console.log('like');
    }
</script>

<button on:click|preventDefault={addLike} class="btn btn--icon">
    <span>like</span>
</button>
