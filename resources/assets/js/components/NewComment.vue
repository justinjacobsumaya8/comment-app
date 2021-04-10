<template>
    <div id="commentForm" class="box has-shadow has-background-white text-left">
        <form @keyup.enter="postComment">
            <input type="hidden" v-model="comment.parent_id">
            <div class="field has-margin-top">
                <div class="field has-margin-top">
                    <label class="label">Name</label>
                    <div class="control">
                        <input type="text" placeholder="Enter Name" class="input is-medium" v-model="comment.name" required="" />
                    </div>
                </div>
                <div class="field has-margin-top">
                    <label class="label">Comment</label>
                    <div class="control">
                        <textarea style="height: 100px;" name="comment" class="input is-medium" autocomplete="true" v-model="comment.content" placeholder="Enter Comment" required=""></textarea>
                    </div>
                </div>
                <div class="control has-margin-top">
                    <button style="background-color: #47b784;" :class="{'is-loading': submit}" class="button has-shadow is-medium has-text-white" :disabled="!isValid" @click.prevent="postComment" type="submit">Submit</button>
                </div>
            </div>
        </form>
        <br />
    </div>
</template>

<script>

    import bus from '../bus'

    export default {
        name: "NewComment",
        data() {
            return {
                submit: false,
                comment: {
                    content: '',
                    name: '',
                    parent_id: ''
                },
            };
        },
        methods: {
            postComment() {
                this.submit = true;
                this.$store
                    .dispatch("ADD_COMMENT", this.comment)
                    .then((response) => {
                        this.submit = false;
                        if (response.data === 1)
                        {
                            this.comment.content = '';
                            this.comment.name = '';

                            bus.$emit('refresh', response.data);
                        }
                    })
                    .catch((err) => {
                        this.submit = false;
                    });
            },
        },
        computed: {
            isValid() {
                return this.comment.content !== "" && this.comment.name !== "";
            },
        },
    };
</script>

<style scoped>
    .has-margin-top {
        margin-top: 15px;
    }
    .text-left {
        text-align: left;
    }
</style>