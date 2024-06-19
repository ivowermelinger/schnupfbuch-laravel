import autoprefixer from "autoprefixer";
import purgecss from "@fullhuman/postcss-purgecss";

export default {
    plugins: [
        autoprefixer,
        purgecss({
            content: [
                "./resources/views/**/*.{html,php}",
                "./resources/assets/js/**/*.{js,ts}",
            ],
            defaultExtractor: (content) =>
                content.match(/[\w-/:%@]+(?<!:)/g) || [],
        }),
    ],
};
