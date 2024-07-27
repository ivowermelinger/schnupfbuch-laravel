<script>
import Layout from './layout/Layout.svelte';
import Footer from './layout/Footer.svelte';
import Header from './layout/Header.svelte';
import { page } from '@inertiajs/svelte';
import { activeLine, lines, interactionAPI, flashMessage } from './stores';
import { onMount } from 'svelte';
import LineButton from './components/LineButton.svelte';
import LikeButton from './components/LikeButton.svelte';
import DislikeButton from './components/DislikeButton.svelte';
import { getHeaders } from './helpers';

const lineAPI = 'api/v1/list';

let counter = 0;

onMount(async () => {
    await getList();
    setLine();
});

const getList = async () => {
    // Check for flash messages in inerita page
    const flash = $page?.props?.flash;
    flash && flashMessage.set(flash);

    const res = await fetch(lineAPI);
    const list = await res.json();

    lines.set(list);
};

const addView = async () => {
    if (!$activeLine.id || !$page.props.user) return;

    const res = await fetch(`${$interactionAPI}/${$activeLine.id}/view`, {
        method: 'POST',
        headers: getHeaders(),
    });

    await res.json();
};

const setLine = async () => {
    if (counter < 10 && $lines[counter]) {
        activeLine.set($lines[counter]);

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

<Layout>
    <Header />

    <main class="main">
        <div class="full-height container">
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
    </main>

    <Footer />
</Layout>
