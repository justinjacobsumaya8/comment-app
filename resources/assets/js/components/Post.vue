<template>
    <div class="question-wrapper">
        <img width="40%" :src="`img/` + post.image" alt="" />
        <h6 v-html="post.description" style="color: #220052; font-size: 2rem;"></h6>
        <br />
        <a
            href="#commentForm"
            class="button is-medium has-shadow has-text-white"
            style="background-color: #47b784">
            
            Comment
        </a>

        <div class="mt-2">
            <Comments></Comments>
            <NewComment></NewComment>
        </div>
    </div>
</template>

<script>
    import Comments from "./Comments";
    import NewComment from "./NewComment";

    export default {
        name: "Post",
        components: {
            Comments,
            NewComment
        },
        mounted() {
            this.getPost();
        },
        data: function(){
          return {
            post: '',
          }
        },
        methods: {
            getPost(){
                let self = this;
                axios.get('/post')
                .then(function (response) {
                    self.post = response.data;
                }).catch(function (error) {
                    self.post = '';
                });
            }
        }
    };
</script>