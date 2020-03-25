<template>
    <div class="col-3 d-flex justify-content-between">
        <div>
            <button class="btn btn-link" id="like" @click="like"><i class="far fa-thumbs-up fa-2x"></i></button>
            <div class="text-center" v-model="likes">{{ likes || 0}}</div>
        </div>
        <div>
            <button class="btn btn-link" id="dislike" @click="dislike"><i class="far fa-thumbs-down fa-2x"></i></button>
            <div class="text-center" v-model="dislikes">{{ dislikes || 0}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['likes', 'dislikes', 'user', 'url'],

        data(){
            return  {
                csrf: document.head.querySelector('meta[name="csrf-token"]').content,
                reactId: null,
                userReaction: null,
                likeButton: null,
                dislikeButton: null
            }
        },

        methods: {
            like() {
                if (this.userReaction !== null) {
                    if (this.userReaction.name === 'Dislike') {
                        this.removeDislike();
                        this.addLike();
                    } else if (this.userReaction.name === 'Like') {
                        this.removeLike()
                    }
                } else {
                    this.addLike();
                }
            },
            dislike() {
                if (this.userReaction !== null) {
                    if (this.userReaction.name === 'Like') {
                        this.removeLike();
                        this.addDislike();
                    } else if (this.userReaction.name === 'Dislike') {
                        this.removeDislike()
                    }
                } else {
                    this.addDislike();
                }
            },
            fillDislikeButton() {
                this.dislikeButton.firstChild.classList.replace('far', 'fas');
                this.dislikeButton.classList.add('text-danger');
            },
            emptyDislikeButton() {
                this.dislikeButton.firstChild.classList.replace('fas', 'far');
                this.dislikeButton.classList.remove('text-danger');
            },
            fillLikeButton() {
                this.likeButton.firstChild.classList.replace('far', 'fas');
                this.likeButton.classList.add('text-success');
            },
            emptyLikeButton() {
                this.likeButton.firstChild.classList.replace('fas', 'far');
                this.likeButton.classList.remove('text-success');
            },
            addLike() {
                axios.post(this.url + '/react', {'reaction_id': 1})
                    .then((response) => {
                        this.fillLikeButton();
                        this.likes++;
                        console.log(response);
                        this.userReaction = response.data;
                    });
            },
            removeLike() {
                axios.post(this.url + '/remove-react', {'reaction_id': 1})
                    .then((response) => {
                        console.log(response);
                        this.emptyLikeButton();
                        this.likes--;
                        this.userReaction = null;
                    });
            },
            addDislike() {
                axios.post(this.url + '/react', {'reaction_id': 2})
                    .then((response) => {
                        this.fillDislikeButton();
                        this.dislikes++;
                        this.userReaction = response.data;
                    });
            },
            removeDislike() {
                axios.post(this.url + '/remove-react', {'reaction_id': 2})
                    .then((response) => {
                        this.emptyDislikeButton();
                        this.dislikes--;
                        this.userReaction = null;
                    });
            }
        },

        mounted() {
            this.likeButton = document.querySelector('#like');
            this.dislikeButton = document.querySelector('#dislike');

            if (this.user.length === 0) {
                document.querySelectorAll('.btn').forEach((element) => {
                    element.disabled = true;
                    element.classList.add('disabled');
                });
            } else {
                if (this.user.reactions.length > 0) {
                    this.userReaction = this.user.reactions[0];
                    if (this.userReaction.name === 'Like') {
                        this.fillLikeButton();
                    } else if (this.userReaction.name === 'Dislike') {
                        this.fillDislikeButton();
                    }
                }
            }
        }
    }
</script>
