<template>
    <div class="container">
        <ul class="comment-list">
            <Comment :key="comment.id" v-for="comment in comments" :comment="comment"></Comment>
        </ul>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";
    import Comment from "./Comment";

    import bus from '../bus'

    export default {
        name: "Comments",
        components: { Comment },
        created (){
          bus.$on('refresh', (data) => {
            console.log(data);
            this.$store.dispatch("GET_COMMENTS");
          });
        },
        mounted() {
            this.$store.dispatch("GET_COMMENTS");
        },
        computed: {
            ...mapGetters(["comments"]),
        },
    };
</script>

<style scoped>
    .comment-list {
        padding: 1em 0;
        margin-bottom: 15px;
    }
</style>