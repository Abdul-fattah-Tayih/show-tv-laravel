<template>
    <div>
        <div class="btn-group">
            <button id="follow-btn" class="btn btn-primary" v-model="follow_status"
                    v-on="follow_status === 'follow' ? { click: follow} : {click: unfollow}">{{ follow_status }}</button>
            <button class="btn btn-info text-white" v-model="follow_count" disabled>{{ follow_count }}</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FollowComponent",
        props: ['follow_url', 'unfollow_url', 'follow_count', 'user'],

        data() {
            return {
                follow_btn: null,
                follow_status: 'follow',
            }
        },

        methods: {
            follow() {
                axios.post(this.follow_url)
                .then((response) => {
                    this.activateButton();
                    this.follow_status = 'unfollow';
                    this.follow_count++;
                });
            },
            unfollow() {
                axios.post(this.unfollow_url)
                .then((response) => {
                    this.defaultButton();
                    this.follow_count--;
                });
            },
            disableButton() {
                this.follow_btn.classList.add('disabled');
                this.follow_btn.disabled = true;
                this.follow_status = 'follow';
            },
            activateButton() {
                this.follow_btn.classList.replace('btn-primary', 'btn-success');
                this.follow_btn.disabled = false;
                this.follow_status = 'followed';
            },
            defaultButton() {
                this.follow_btn.classList.remove('disabled');
                this.follow_btn.classList.replace('btn-success', 'btn-primary');
                this.disabled = false;
                this.follow_btn.html = '';
                this.follow_status = 'follow';
            },
        },

        mounted() {
            this.follow_btn = document.querySelector('#follow-btn');
            if (this.user.length === 0) {
                this.disableButton();
            } else if (this.user.followed_series.length > 0) {
                this.activateButton();
            }
        }
    }
</script>

<style scoped>

</style>