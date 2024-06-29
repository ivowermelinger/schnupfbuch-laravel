interface Line {
    id: number,
    line: string;
    views: number;
    likes: number;
    dislkes: number;
    nickname: string;
}

class MainApp extends HTMLElement {
    api = 'api/v1/list';
    list : Line[];
    activeLine?: Line;
    counter = 0;

    lineBtn: HTMLButtonElement;
    likeBtn : HTMLButtonElement;
    dislikeBtn : HTMLButtonElement;

    line: HTMLElement;
    author: HTMLElement;

    likedList: Line[];
    isLiked: boolean;
    isDisliked: boolean;


    createElements() {
        const inner = document.createElement('div');
        this.line = document.createElement('div');
        this.author = document.createElement('div');


        inner.classList.add('touch__inner');
        this.line.classList.add('touch__line');
        this.author.classList.add('touch__author');

        inner.append(this.line, this.author);
        this.lineBtn.appendChild(inner);
    }

    connectedCallback() {
        this.lineBtn = this.querySelector('#line');
        this.likeBtn = this.querySelector('#like');
        this.dislikeBtn = this.querySelector('#dislike');

        if (!this.lineBtn || !this.likeBtn || !this.dislikeBtn) throw new Error(`Missing button elements on Main App!`);

        this.createElements();
        this.getList();
        this.lineBtn.addEventListener('click', this.setLine.bind(this));
    }

    async getList() {
        const res = await fetch(this.api);
        this.list = await res.json();
        this.setLine();
    }

    checkLikes() {
        console.log(this.activeLine);
    }

    setLine() {
        if (this.counter < 10 && this.list[this.counter]) {
            this.activeLine = this.list[this.counter];

            this.line.innerText = this.activeLine.line;
            this.author.innerText = this.activeLine.nickname;

            this.checkLikes();
        } else {
            this.counter = 0;
            this.getList();
        }

        this.counter++;
    }

    toggleLike()  {
        // Add a like to the lines table


        // Add a like to the users table
    }

}

customElements.define('main-app', MainApp);
